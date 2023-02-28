@extends('website.layouts.app')
@section('content')
    <section class="profile-view">
        <div class="row">
            <div class="col-xl-2  col-lg-3 col-md-4"
                style="padding-right: 0;
    border-right: 1px solid #dee2e6;
    display: flex;
    flex-direction: column;
    /* align-items: center; */
    height: calc(100vh - 64px);
    justify-content: space-between;">
                <div>
                    <div class="info" style="padding: 30px 0; ">
                        <div class="profile-logo">
                            @if (is_null($user->image) || $user->image == '')
                                <img src="{{ asset('assets/img/person-img.png ') }}">
                            @else
                                <img src="{{ asset($user->image) }}">
                            @endif
                        </div>
                        <div class="profile-information text-center">
                            <h3 class="name">{{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }}
                            </h3>
                            <p class="email">{{ $user->email }}</p>
                            <p style="color: #B4B2B6;font-size: 12px;">{{ ucwords($user->bio) }}</p>
                        </div>
                        <div class="w-100 pt-3">
                            <a style="cursor: pointer;
                            background: #5D5960;
                            color: #fff;
                            text-align: center;
                            text-decoration: none;
                            padding: 6px 30px;
                            display: block;
                            /* width: 70%; */
                            margin: auto;
                            border-radius: 27px;
                            width: 190px;"
                                onclick="following({{ $user->id }});" id="follow_link_{{ $user->id }}"
                                class="follow_link">
                                @if (\App\Models\Users_Followers::where('user_id', auth()->user()->id)->where('follow_id', $user->id)->first())
                                    Unfollow
                                @else
                                    Follow
                                @endif
                            </a>
                        </div>
                    </div>

                </div>
                <div class="conect text-center mt-3 mb-5 pt-3" style="border-top:1px solid #dee2e6;">
                    <img src="{{ asset('assets/img/conect.png ') }}" class="d-block m-auto" width="21px" height="21px">
                    <p style="color: #B4B2B6;" class="mt-2">Connect to your social accounts</p>
                    <div class="d-flex mt-4 align-items-center" style="justify-content: space-evenly;padding: 0 30px">
                        <a href="/socialsync/facebook">
                            <img src="{{ asset('assets/img/facebook_dark.png ') }}" class="" width="12px"
                                height="23px">
                        </a>
                        {{-- <a href="/socialsync/instagram">
                            <img src="{{ asset('assets/img/in_dark.png ') }}" class="" width="20px" height="20px">
                        </a> --}}
                        <a href="/socialsync/twitter">
                            <img src="{{ asset('assets/img/twitter_dark.png ') }}" class="" width="23px"
                                height="18px">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-8" style="padding-left: 15px;">
                <div class="follower_content">
                    <div class="follower_tittle">
                        <h1>R-Write Articles</h1>
                    </div>
                    @foreach ($articales as $articale)
                        @if ($articale->purchase_type == '0')
                            <div class="item_free">
                                <div class="row border-bottom">
                                    <div class="col-md-10">
                                        <ul class="top_item">
                                            <li>
                                                <a style="text-decoration: none;"
                                                    href="{{ url('/article/view/' . $articale->id) }}">
                                                    <h5 class="ellipse two-lines">{{ ucwords($articale->title) }}</h5>
                                                </a>
                                            </li>
                                            <li>
                                                <span>{{ ucwords($articale->category->name) }}</span>

                                            </li>
                                            {{-- <li style="margin-left: auto" class="date_articale">
                                                <img src="{{ asset('assets/img/rss_white.svg ') }}">
                                            </li> --}}
                                            <li>
                                                <img width="24px"
                                                    @if (in_array(
                                                            $articale->id,
                                                            auth()->user()->bookmark_article->pluck('article_id')->toArray())) class="marked" src="{{ asset('assets/img/bookmark_white_fill.svg ') }}" @else class="not_marked" src="{{ asset('assets/img/bookmark_white.svg ') }}" @endif
                                                    id="image_bookmark{{ $articale->id }}"
                                                    onclick="bookmark({{ $articale->id }},'light');">
                                            </li>
                                        </ul>
                                        <p class="search_pragh">
                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                            sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                            magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                                            dolores et ea rebum. Stet
                                            clita kasd
                                            gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="search_profile">
                                            <img src="{{ asset($articale->image) }}"
                                                onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <ul class="bottom_item mt-2">
                                    <li>
                                        <img src="{{ asset('assets/img/views.png ') }}" width="17px">
                                        <span>{{ views($articale)->unique()->count() }} view</span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/commits.png ') }}" width="17px">
                                        <span>{{ count($articale->comments) }} Comments</span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/person.png ') }}" width="17px">
                                        <span>{{ ucwords($articale->user->first_name) }}
                                            {{ ucwords($articale->user->last_name) }}</span>
                                    </li>
                                    <li style="margin-left: auto" class="date_articale">
                                        <ul>
                                            <li>
                                                <span>{{ date('m / d / Y, h:i:s A', strtotime($articale->created_at)) }}</span>
                                            </li>
                                            <li>
                                                <span class="span"
                                                    style="display: none; background-color: #EFEFEF;
                                                            color: #000000;"
                                                    id="all_span_{{ $articale->id }}">Link Copied</span>
                                                <img class="copy-link" onclick="copylink({{ $articale->id }},'all');"
                                                    src="{{ asset('assets/img/copy.png ') }}" width="17px">
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="item_paid">
                                <div class="row border-bottom">
                                    <div class="col-md-10">
                                        <ul class="top_item">
                                            <li class="icon_paid">
                                                <img src="{{ asset('assets/img/tag.svg ') }}">
                                                <span class="doller" style="background: transparent;margin:0;">{{ $articale->cost }}
                                                    $</span>
                                            </li>
                                            <li> <a style="text-decoration: none;"
                                                    href="{{ url('/article/view/' . $articale->id) }}">
                                                    <h5 class="ellipse two-lines">{{ ucwords($articale->title) }}</h5>
                                                </a>
                                            </li>
                                            <li>
                                                <span>{{ ucwords($articale->category->name) }}</span>

                                            </li>
                                            {{-- <li style="margin-left: auto" class="date_articale">
                                                <img src="{{ asset('assets/img/rss.svg ') }}">
                                            </li> --}}
                                            <li>
                                                <img width="24px"
                                                    @if (in_array(
                                                            $articale->id,
                                                            auth()->user()->bookmark_article->pluck('article_id')->toArray())) class="marked" src="{{ asset('assets/img/bookmark_fill.svg ') }}" @else class="not_marked" src="{{ asset('assets/img/bookmark.svg ') }}" @endif
                                                    id="image_bookmark{{ $articale->id }}"
                                                    onclick="bookmark({{ $articale->id }},'dark');">
                                            </li>
                                        </ul>
                                        <p class="search_pragh">
                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                            sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                            magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                                            dolores et ea rebum. Stet
                                            clita
                                            kasd
                                            gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="search_profile">
                                            <img src="{{ asset($articale->image) }}"
                                                onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <ul class="bottom_item mt-2">
                                    <li>
                                        <img src="{{ asset('assets/img/views.png ') }}" width="17px">
                                        <span>{{ views($articale)->unique()->count() }} view</span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/commits.png ') }}" width="17px">
                                        <span>{{ count($articale->comments) }} Comments</span>
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/person.png ') }}" width="17px">
                                        <span>{{ ucwords($articale->user->first_name) }}
                                            {{ ucwords($articale->user->last_name) }}</span>
                                    </li>
                                    <li style="margin-left: auto" class="date_articale">
                                        <ul>
                                            <li>
                                                <span>{{ date('m / d / Y, h:i:s A', strtotime($articale->created_at)) }}</span>
                                            </li>
                                            <li><span class="span"
                                                    style="display: none; background-color: #404040;
                                                        color: #F9C100;"
                                                    id="all_span_{{ $articale->id }}">Link Copied</span>
                                                <img class="copy-link" onclick="copylink({{ $articale->id }},'all');"
                                                    src="{{ asset('assets/img/copy.png ') }}" width="17px">
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function copylink(id, type) {
            let url = 'https://newrwrite.msol.dev/article/view/';

            var tempInput = document.createElement("input");

            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = url + id;
            document.body.appendChild(tempInput);
            tempInput.select();

            try {
                var successful = document.execCommand('copy');

                document.getElementById(type + '_span_' + id).style.display = 'inline-block';
                setTimeout(function() {
                    $('#' + type + '_span_' + id).fadeOut('fast');
                }, 1000);
                var msg = successful ? 'successful' : 'unsuccessful';

                console.log('Copying text command was ' + msg);
                document.body.removeChild(tempInput);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        }
    </script>
@endpush
