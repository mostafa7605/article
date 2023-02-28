@extends('website.layouts.app')
@section('content')
    {{-- ======================================== Slider  ========================================== --}}
    <div class="main ">
        <div class="row h-100 ">
            <div class="col-lg-6 position-relative h-100">
                <div id="counter">
                    <span>0<span class=counter></span> </span>
                </div>
                <div class="slider slider-for ">
                    @foreach ($images as $img)
                        @if (!is_null($img->deeb_link))
                            <a href="{{ $img->deeb_link }}">
                                <div class="slide">
                                    <img src="{{ asset($img->image) }}" />
                                </div>
                            </a>
                        @else
                            <div class="slide">
                                <img src="{{ asset($img->image) }}" />
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 position-relative h-100 d-none d-lg-block">
                <div class="slider slider-nav h-100 w-100">
                    @for ($i = 0; $i < count($images); $i++)
                        <div class="slider-two">
                            <h1 class="mt-3">{{ $images[$i]->title }}</h1>
                            <p class="mt-5">{{ $images[$i]->description }}</p>
                            <div class="slider-two-img">
                                @if ($i + 1 == count($images))
                                    <img class="h-100 w-100" src="{{ asset($images[0]->image) }}">
                                @elseif (count($images) == 1)
                                @else
                                    <img class="h-100 w-100" src="{{ asset($images[$i + 1]->image) }}">
                                @endif
                            </div>
                            <div class="artical">
                                {{-- <div>
                                    <p style="color: #F9C100; ">Article</p>
                                    <p>@marlon a.cox</p>
                                </div> --}}
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    {{-- ======================================== R-Media  ========================================= --}}
    <div class="container">
        <div class="media-title">
            <h2>R-Media</h2>
            <div class="line"></div>
        </div>
        <div class="media-title-contnet">
            <div class="row">
                @foreach ($articles as $article)
                    <div class="col-md-3 col-sm-4  col-6 p-2">
                        <div class="card">
                            @if (Auth::check())
                                <div class="position-absolute top-0 end-0 m-3">
                                    <img @if (in_array(
                                            $article->id,
                                            auth()->user()->bookmark_article->pluck('article_id')->toArray())) class="marked" src="{{ asset('assets/img/bookmark_fill.svg ') }}" @else class="not_marked" src="{{ asset('assets/img/bookmark.svg ') }}" @endif
                                        id="image_bookmark{{ $article->id }}"
                                        onclick="bookmark({{ $article->id }},'dark');" width="20px" height="20px">
                                </div>
                                {{-- <div class="position-absolute top-0 start-0 m-3">
                                    <img src="{{ asset('assets/img/rss.svg ') }}" width="65px" height="24px">
                                </div> --}}
                            @endif
                            <img src="{{ asset($article->image) }}"
                                onerror="this.onerror=null;this.src='{!! asset('/assets/img/logo/logo.svg') !!}';" class="card-img-top">
                            <div class="card-body p-0">
                                <a href="/article/view/{{ $article->id }}" class="card-title ellipse two-lines"
                                    title="{{ $article->title }}">{{ $article->title }}
                                </a>
                                <p class="card-text">
                                    {{ $article->created_at }}
                                </p>
                                <div class="person">
                                    @if (isset($article->user))
                                        <img src="{{ $article->user->image }}"
                                            onerror="this.onerror=null;this.src='{!! asset('/assets/img/person.png') !!}';" width="20px"
                                            height="20px">
                                    @else
                                        <img src="{{ asset('assets/img/person.png ') }}" width="20px" height="20px">
                                    @endif
                                    @if (isset($article->user))
                                        @if (Auth::check())
                                            <a style="text-decoration: none; color: #fff;"
                                                @if ($article->user->id == auth()->user()->id) href="{{ url('/profile') }}" @else href="{{ url('/person_profile/' . $article->user->id) }}" @endif><span>{{ $article->user->first_name }}
                                                    {{ $article->user->last_name }}</span></a>
                                        @else
                                            <span>{{ $article->user->first_name }} {{ $article->user->last_name }}</span>
                                        @endif
                                    @else
                                        <span>{{ $article->author }}</span>
                                    @endif
                                </div>
                                <div class="articale-link">
                                    <div class="articale-link-content">
                                        <p> {{ ucwords($article->category->name) }} </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="page-number">
            {!! $articles->links() !!}
        </div>
    </div>
    {{-- =======================================  Newsletter  ====================================== --}}
    <div class="newsletter">
        <h2>Get the free daily newsletter</h2>
        <p>Join <span class="number-subscribe">10,000+</span> R-write authors who grow with us every day</p>
        <form method="POST" action="{{ url('/subscribe') }}">
            @csrf
            <div class="subscribe-form">
                <input type="email" name="email" class="form-control" placeholder="Your.email@example.com" required>
                <button type="submit" class="subscribe">Subscribe</button>
            </div>
        </form>
        <p class="unsubscribe">No spam. No nonsense. Unsubscribe anytime.</p>
    </div>
    {{-- =======================================  Marlon A. Cox  ====================================== --}}
    <div class="marlon">
        <div class="marlon-content">
            <img src="{{ asset('assets/img/marlon.png ') }}">
            <p class="mb-3">" It starts, and ends with you "</p>
            <p class="name">Adrian A. Santalla</p>
        </div>
    </div>
@endsection
