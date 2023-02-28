<div class="result_search">
    <div class="container">
        @if (count($all_articales) == 0)
            <div style="text-align: center;">

                <h2>No Results </h2>
            </div>
        @else
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                        type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="free-tab" data-bs-toggle="tab" data-bs-target="#free" type="button"
                        role="tab" aria-controls="free" aria-selected="false">Free</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid" type="button"
                        role="tab" aria-controls="paid" aria-selected="false">Paid <img
                            src="{{ asset('assets/img/tag.svg ') }}" width="20px"></button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    @foreach ($all_articales as $articale)
                        @if ($articale->purchase_type == '0')
                            <div class="item_free">
                                <div class="row border-bottom">
                                    <div class="col-md-10">
                                        <ul class="top_item">
                                            <li><a style="text-decoration: none;"
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
                                                    onclick="bookmark_all({{ $articale->id }},'light');">
                                            </li>
                                        </ul>
                                        <p class="search_pragh">
                                            {{ $articale->description }}

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
                                        @if (Auth::check())
                                            <a style="text-decoration: none; color: #fff;"
                                                @if ($articale->user->id == auth()->user()->id) href="{{ url('/profile') }}" @else href="{{ url('/person_profile/' . $articale->user->id) }}" @endif>
                                                <span>{{ ucwords($articale->user->first_name) }}
                                                    {{ ucwords($articale->user->last_name) }}</span>
                                            </a>
                                        @else
                                            <span>{{ ucwords($articale->user->first_name) }}
                                                {{ ucwords($articale->user->last_name) }}</span>
                                        @endif
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
                                            <li><a style="text-decoration: none;"
                                                    href="{{ url('/article/view/' . $articale->id) }}">
                                                    <h5>{{ ucwords($articale->title) }}</h5>
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
                                                    onclick="bookmark_all({{ $articale->id }},'dark');">
                                            </li>
                                        </ul>
                                        <p class="search_pragh">
                                            {{ $articale->description }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="search_profile">
                                            <img src="{{ asset($articale->image) }}"
                                                onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';"class="img-fluid">
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
                                        @if (Auth::check())
                                            <a style="text-decoration: none; color: #fff;"
                                                @if ($articale->user->id == auth()->user()->id) href="{{ url('/profile') }}" @else href="{{ url('/person_profile/' . $articale->user->id) }}" @endif>
                                                <span>{{ ucwords($articale->user->first_name) }}
                                                    {{ ucwords($articale->user->last_name) }}</span>
                                            </a>
                                        @else
                                            <span>{{ ucwords($articale->user->first_name) }}
                                                {{ ucwords($articale->user->last_name) }}</span>
                                        @endif
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
                <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                    @foreach ($free_articales as $articale_2)
                        <div class="item_free">
                            <div class="row border-bottom">
                                <div class="col-md-10">
                                    <ul class="top_item">
                                        <li><a style="text-decoration: none;"
                                                href="{{ url('/article/view/' . $articale_2->id) }}">
                                                <h5 class="ellipse two-lines">{{ ucwords($articale_2->title) }}</h5>
                                            </a>
                                        </li>
                                        <li>
                                            <span>{{ ucwords($articale_2->category->name) }}</span>

                                        </li>
                                        {{-- <li style="margin-left: auto" class="date_articale">
                                            <img class="rss_white" src="{{ asset('assets/img/rss_white.svg ') }}">
                                        </li> --}}
                                        <li>
                                            <img width="24px"
                                                @if (in_array(
                                                        $articale_2->id,
                                                        auth()->user()->bookmark_article->pluck('article_id')->toArray())) class="marked" src="{{ asset('assets/img/bookmark_white_fill.svg ') }}" @else class="not_marked" src="{{ asset('assets/img/bookmark_white.svg ') }}" @endif
                                                id="free_image_bookmark{{ $articale_2->id }}"
                                                onclick="bookmark2_free({{ $articale_2->id }});">
                                        </li>
                                    </ul>
                                    <p class="search_pragh">
                                        {{ $articale->description }}
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <div class="search_profile">
                                        <img src="{{ asset($articale_2->image) }}"
                                            onerror="this.src='{{ asset('assets/img/book.png ') }}';this.onerror='';"class="img-fluid">
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
                                    <span>{{ count($articale_2->comments) }} Comments</span>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/person.png ') }}" width="17px">
                                    @if (Auth::check())
                                        <a style="text-decoration: none; color: #fff;"
                                            @if ($articale_2->user->id == auth()->user()->id) href="{{ url('/profile') }}" @else href="{{ url('/person_profile/' . $articale_2->user->id) }}" @endif>
                                            <span>{{ ucwords($articale_2->user->first_name) }}
                                                {{ ucwords($articale_2->user->last_name) }}</span>
                                        </a>
                                    @else
                                        <span>{{ ucwords($articale_2->user->first_name) }}
                                            {{ ucwords($articale_2->user->last_name) }}</span>
                                    @endif
                                </li>
                                <li style="margin-left: auto" class="date_articale">
                                    <ul>
                                        <li>
                                            <span>{{ date('m / d / Y, h:i:s A', strtotime($articale_2->created_at)) }}</span>
                                        </li>
                                        <li>
                                            <span class="span"
                                                style="display: none; background-color: #EFEFEF;
                                            color: #000000;"
                                                id="free_span_{{ $articale_2->id }}">Link Copied</span>
                                            <img class="copy-link" onclick="copylink({{ $articale_2->id }},'free');"
                                                src="{{ asset('assets/img/copy.png ') }}" width="17px">
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                    @foreach ($paid_articales as $articale_3)
                        <div class="item_paid">
                            <div class="row border-bottom">
                                <div class="col-md-10">
                                    <ul class="top_item">
                                        <li class="icon_paid">
                                            <img src="{{ asset('assets/img/tag.svg ') }}">
                                            <span class="doller" style="background: transparent;margin:0;">{{ $articale_3->cost }}
                                                $</span>
                                        </li>
                                        <li><a style="text-decoration: none;"
                                                href="{{ url('/article/view/' . $articale_3->id) }}">
                                                <h5>{{ ucwords($articale_3->title) }}</h5>
                                            </a>
                                        </li>
                                        <li>
                                            <span>{{ ucwords($articale_3->category->name) }}</span>

                                        </li>
                                        {{-- <li style="margin-left: auto" class="date_articale">
                                            <img src="{{ asset('assets/img/rss.svg ') }}">
                                        </li> --}}
                                        <li>
                                            <img width="24px"
                                                @if (in_array(
                                                        $articale_3->id,
                                                        auth()->user()->bookmark_article->pluck('article_id')->toArray())) class="marked" src="{{ asset('assets/img/bookmark_fill.svg ') }}" @else class="not_marked" src="{{ asset('assets/img/bookmark.svg ') }}" @endif
                                                id="paid_image_bookmark{{ $articale_3->id }}"
                                                onclick="bookmark2_paid({{ $articale_3->id }});">
                                        </li>
                                    </ul>
                                    <p class="search_pragh">
                                        {{ $articale->description }}
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <div class="search_profile">
                                        <img src="{{ asset($articale_3->image) }}"
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
                                    <span>{{ count($articale_3->comments) }} Comments</span>
                                </li>
                                <li>
                                    <img src="{{ asset('assets/img/person.png ') }}" width="17px">
                                    @if (Auth::check())
                                        <a style="text-decoration: none; color: #fff;"
                                            @if ($articale_3->user->id == auth()->user()->id) href="{{ url('/profile') }}" @else href="{{ url('/person_profile/' . $articale_3->user->id) }}" @endif>
                                            <span>{{ ucwords($articale_3->user->first_name) }}
                                                {{ ucwords($articale_3->user->last_name) }}</span>
                                        </a>
                                    @else
                                        <span>{{ ucwords($articale_3->user->first_name) }}
                                            {{ ucwords($articale_3->user->last_name) }}</span>
                                    @endif
                                </li>
                                <li style="margin-left: auto" class="date_articale">
                                    <ul>
                                        <li>
                                            <span>{{ date('m / d / Y, h:i:s A', strtotime($articale_3->created_at)) }}</span>
                                        </li>
                                        <li><span class="span"
                                                style="display: none; background-color: #404040;
                                        color: #F9C100;"
                                                id="paid_span_{{ $articale_3->id }}">Link Copied</span>
                                            <img class="copy-link" onclick="copylink({{ $articale_3->id }},'paid');"
                                                src="{{ asset('assets/img/copy.png ') }}" width="17px">
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>
