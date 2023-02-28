@extends('website.layouts.app')

@section('content')
    <section class="profile-view">
        <div class="row">
            <div class="col-xl-2  col-lg-3 col-md-4" style="padding-right: 0;border-right: 1px solid #dee2e6;">
                <div>
                    <div class="info" style="padding: 30px 0; border-bottom:1px solid #dee2e6;">
                        <a href="{{ route('edit-profile', ['id' => auth()->user()->id]) }}">
                            <img src="{{ asset('assets/img/edit.svg ') }}" width="18px"
                                style="display: block; margin-left: auto; margin-right: 30px;" />
                        </a>
                        <div class="profile-logo">
                            @if (is_null(auth()->user()->image) || auth()->user()->image == '')
                                <img src="{{ asset('assets/img/person-img.png ') }}">
                            @else
                                <img src="{{ asset(auth()->user()->image) }}">
                            @endif
                        </div>
                        <div class="profile-information text-center">
                            <h3 class="name">{{ ucwords(auth()->user()->first_name) }}
                                {{ ucwords(auth()->user()->last_name) }}</h3>
                            <p class="email">{{ auth()->user()->email }}</p>
                            <p style="color: #B4B2B6;font-size: 12px;">{{ ucwords(auth()->user()->bio) }}</p>
                        </div>
                    </div>
                </div>
                <div class="my-account border-bottom">
                    <div class="w-100">
                        <div class="sub-title ">
                            <ul class="">
                                <li class="active">
                                    <a href="{{ route('profile') }}">
                                        <img src="{{ asset('assets/img/user.svg ') }}" width="21px" height="21px">
                                        <span style="font-weight: 500">Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('follower') }}">
                                        <img src="{{ asset('assets/img/followers.svg ') }}" width="21px" height="21px">
                                        <span>Followers</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('following') }}">
                                        <img src="{{ asset('assets/img/followers.svg ') }}" width="21px" height="21px">
                                        <span>Following</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="conect text-center mt-3 mb-4">
                    <img src="{{ asset('assets/img/conect.png ') }}" class="d-block m-auto" width="21px" height="21px">
                    <p style="color: #B4B2B6;" class="mt-2">Connect to your social accounts</p>
                    <div class="d-flex mt-4 align-items-center" style="justify-content: space-evenly;padding: 0 30px">
                        <a href="/socialsync/facebook">
                            <img src="{{ asset('assets/img/facebook_dark.png ') }}" class="" width="12px"
                                height="23px">
                        </a>
                        {{-- <a href="">
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
                <div class="profile-content">
                    <div>
                        <ul class="nav nav-tabs mt-5 border-0" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link m-0 active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home_" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">R-Write Articles</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link m-0" style="margin:auto !important;" id="profile-tab"
                                    data-bs-toggle="tab" data-bs-target="#profile_" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">Bookmarks</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link m-0 " style="margin-left:auto !important;" id="contact-tab"
                                    data-bs-toggle="tab" data-bs-target="#contact_" type="button" role="tab"
                                    aria-controls="contact" aria-selected="false">Tagged in</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home_" role="tabpanel"
                                aria-labelledby="home-tab">
                                @foreach ($articles as $article)
                                    <div class="main-articale">
                                        <div class="d-flex main-articale-content">
                                            <div class="img-articale">
                                                <img src="{{ asset($article->image) }}" width="100px" height="100px"
                                                    onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';">
                                            </div>
                                            <div class="content-articale">
                                                <span class="articale">{{ ucwords($article->category->name) }}</span>
                                                <a style="text-decoration: none;"
                                                    href="{{ url('/article/view/' . $article->id) }}">
                                                    <h3>{{ ucwords($article->title) }}</h3>
                                                </a>

                                                <div class="views-comments d-flex">
                                                    <ul class="views">
                                                        <li>
                                                            <img src="{{ asset('assets/img/views.png ') }}"
                                                                width="17px" height="auto">
                                                        </li>
                                                        <li>
                                                            <span>{{ views($article)->unique()->count() }} view</span>
                                                        </li>
                                                    </ul>
                                                    <ul class="comments">
                                                        <li>
                                                            <img src="{{ asset('assets/img/commits.png ') }}"
                                                                width="17px" height="auto">
                                                        </li>
                                                        <li>
                                                            <span>{{ count($article->comments) }} Comments</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="date-articale">

                                            <p>{{ date('m / d / Y, h:i:s A', strtotime($article->created_at)) }}</p>
                                            <div class="copy-download d-flex">
                                                <div class="copy">
                                                    <span class="span"
                                                        style="display: none; background-color: #000000; color: #fff"
                                                        id="span_{{ $article->id }}">Link Copied</span>
                                                    <img class="copy-link" onclick="copylink({{ $article->id }});"
                                                        src="{{ asset('assets/img/copy.png ') }}" width="17px"
                                                        height="auto">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="tab-pane fade" id="profile_" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach ($bookmarks_articles as $bookmarks_article)
                                    <?php
                                    $art = \App\Models\Article::where('id', $bookmarks_article->article_id)->first();
                                    ?>
                                    @if ($art)
                                        <div class="main-articale">
                                            <div class="d-flex main-articale-content">
                                                <div class="img-articale">
                                                    <div class="position-absolute top-0 start-0 m-2">
                                                        <img @if (in_array(
                                                                $bookmarks_article->article->id,
                                                                auth()->user()->bookmark_article->pluck('article_id')->toArray())) class="marked" src="{{ asset('assets/img/bookmark_fill.svg ') }}" @else class="not_marked"
                                                src="{{ asset('assets/img/bookmark.svg ') }}" @endif
                                                            id="image_bookmark{{ $bookmarks_article->article->id }}"
                                                            onclick="bookmark({{ $bookmarks_article->article->id }},'dark');"
                                                            style="border-radius: 0px;margin-left:10px;" width="20px"
                                                            height="20px">
                                                    </div>
                                                    <img src="{{ asset($bookmarks_article->article->image) }}"
                                                        width="100px" height="100px"
                                                        onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';">
                                                </div>
                                                <div class="content-articale">
                                                    <span
                                                        class="articale">{{ ucwords($bookmarks_article->article->category->name) }}</span>
                                                    <a style="text-decoration: none;"
                                                        href="{{ url('/article/view/' . $bookmarks_article->article->id) }}">
                                                        <h3>{{ ucwords($bookmarks_article->article->title) }}</h3>
                                                    </a>
                                                    <div class="views-comments d-flex">
                                                        <ul class="views">
                                                            <li>
                                                                <img src="{{ asset('assets/img/views.png ') }}"
                                                                    width="17px" height="auto">
                                                            </li>
                                                            <li>
                                                                <span>{{ views($bookmarks_article->article)->unique()->count() }}
                                                                    view</span>
                                                            </li>
                                                        </ul>
                                                        <ul class="comments">
                                                            <li>
                                                                <img src="{{ asset('assets/img/commits.png ') }}"
                                                                    width="17px" height="auto">
                                                            </li>
                                                            <li>
                                                                <span>{{ count($bookmarks_article->article->comments) }}
                                                                    Comments</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="date-articale">
                                                <p>{{ date('m / d / Y, h:i:s A', strtotime($bookmarks_article->article->created_at)) }}
                                                </p>
                                                <div class="copy-download d-flex">
                                                    <div class="copy">
                                                        <span class="span"
                                                            style="display: none; background-color: #000000; color: #fff"
                                                            id="span_{{ $bookmarks_article->article->id }}">Link
                                                            Copied</span>
                                                        <img class="copy-link" onclick="copylink({{ $bookmarks_article->article->id }});"
                                                            src="{{ asset('assets/img/copy.png ') }}" width="17px"
                                                            height="auto">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="contact_" role="tabpanel" aria-labelledby="contact-tab">
                                @foreach ($taged_articles as $taged_article)
                                    <div class="main-articale">
                                        <div class="d-flex main-articale-content">
                                            <div class="img-articale position-relative">
                                                <img src="{{ asset($taged_article->image) }}" width="100px"
                                                    height="100px"
                                                    onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';">
                                                <img src="{{ asset($taged_article->user->image) }}"
                                                    class="rounded-circle position-absolute bottom-0 end-0" width="50px"
                                                    height="50px"
                                                    onerror="this.src='{{ asset('assets/img/person-img.png ') }}';this.onerror='';">
                                            </div>
                                            <div class="content-articale">
                                                <a style="text-decoration: none;"
                                                    href="{{ url('/person_profile/' . $taged_article->user->id) }}">
                                                    <h3>{{ ucwords($taged_article->user->first_name) }}
                                                        {{ ucwords($taged_article->user->last_name) }}</h3>
                                                </a>
                                                <p class="mentioned">Mentioned you in the article <a
                                                        style="text-decoration: none;"
                                                        href="{{ url('/article/view/' . $taged_article->id) }}"><span>"
                                                            {{ $taged_article->title }} "</span></a> </p>
                                            </div>
                                        </div>
                                        <div class="date-articale">
                                            <p>{{ date('m / d / Y, h:i:s A', strtotime($taged_article->created_at)) }}</p>
                                            <div class="copy-download d-flex mt-3">
                                                <div class="copy">
                                                    <span>View</span>
                                                </div>
                                                <div class="download">
                                                    <a href="{{ url('/article/view/' . $taged_article->id) }}"><img
                                                            src="{{ asset('assets/img/view.png ') }}" width="24px"
                                                            height="24"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function copylink(id) {
            let url = 'https://newrwrite.msol.dev/article/view/';

            var tempInput = document.createElement("input");

            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = url + id;
            document.body.appendChild(tempInput);
            tempInput.select();

            try {
                var successful = document.execCommand('copy');
                document.getElementById('span_' + id).style.display = 'inline-block';
                setTimeout(function() {
                    $('#span_' + id).fadeOut('fast');
                }, 1000);
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
                document.body.removeChild(tempInput);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        }
    </script>
@endsection
