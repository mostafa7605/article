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
                                <li>
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
                                <li class="active">
                                    <a href="{{ route('following') }}">
                                        <img src="{{ asset('assets/img/user.svg ') }}" width="21px" height="21px">
                                        <span style="font-weight: 500">Following</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="conect text-center mt-3 mb-5">
                    <img src="{{ asset('assets/img/conect.png ') }}" class="d-block m-auto" width="21px" height="21px">
                    <p style="color: #B4B2B6;" class="mt-2">Connect to your social accounts</p>
                    <div class="d-flex mt-4 align-items-center" style="justify-content: space-evenly;padding: 0 30px">
                        <a href="">
                            <img src="{{ asset('assets/img/facebook_dark.png ') }}" class="" width="12px"
                                height="23px">
                        </a>
                        <a href="">
                            <img src="{{ asset('assets/img/in_dark.png ') }}" class="" width="20px" height="20px">
                        </a>
                        <a href="">
                            <img src="{{ asset('assets/img/twitter_dark.png ') }}" class="" width="23px"
                                height="18px">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-10 col-lg-9 col-md-8" style="padding-left: 15px;">
                <div class="follower_content">
                    <div class="follower_tittle">
                        <h1>Following</h1>
                    </div>

                    <div class="follower d-flex flex-wrap justify-content-lg-start">
                        @foreach ($following as $user)
                            @if ($user->roles->first()->name == 'Customer')
                                <div class="card_follower">
                                    <div class="card_head">
                                        @if (is_null($user->image) || $user->image == '')
                                            <img src="{{ asset('assets/img/profile.png ') }}" width="110px"
                                                height="110px">
                                        @else
                                            <img style="border-radius: 50%;" src="{{ asset($user->image) }}" width="110px"
                                                height="110px">
                                        @endif
                                        <div>
                                            <ul>
                                                <li>
                                                    <span>{{ count(\App\Models\Article::where('user_id', $user->id)->get()) }}</span>
                                                    <p>R-Publications</p>
                                                </li>
                                                <li>
                                                    <span
                                                        id="follower_span_{{ $user->id }}">{{ count(\App\Models\Users_Followers::where('follow_id', $user->id)->get()) }}</span>
                                                    <p>Followers</p>
                                                </li>
                                                <li>
                                                    <span>{{ count(\App\Models\Users_Followers::where('user_id', $user->id)->get()) }}</span>
                                                    <p>Following</p>
                                                </li>
                                            </ul>
                                            <div class="w-100 pt-3">
                                                <a style="cursor: pointer;" onclick="following({{ $user->id }});"
                                                    id="follow_link_{{ $user->id }}" class="follow_link">Unfollow</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a style="text-decoration: none;" href="{{ url('/person_profile/' . $user->id) }}">
                                        <h2>{{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }} <span>(
                                                {{ ucwords($user->username) }} )</span></h2>
                                    </a>
                                    <p>{{ $user->bio }}</p>
                                    {{--
                            <ul class="articale_link">
                                <li>
                                    <span>Article</span>
                                </li>
                                <li>
                                    <span>Hashtag</span>
                                </li>
                                <li>
                                    <span>Tag</span>
                                </li>
                                <li>
                                    <span>#</span>
                                </li>
                                <li>
                                    <span>…</span>
                                </li>
                            </ul> --}}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
