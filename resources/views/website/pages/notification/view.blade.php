@extends('website.layouts.app')
<style>
    #myTab{
        max-width: 300px;
        display: block;
        padding: 10px;
        margin: 20px auto !important;
        border: 2px solid #F9C100 !important;
        box-shadow: 0px 3px 6px #00000029;
        border-radius: 10px;
    }
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active{
        border-bottom: 2px solid #000 !important;
        padding-bottom: 4px !important;
    }
    .nav-tabs .nav-item .nav-link{
        padding: 0;
        margin: 10px 30px 0 7px;
        border: 0;
        color: #242424;
        width: 100%;
    }
    .nav-tabs .nav-item .nav-link span{
        background-color: #000;
        padding: 3px 7px 3px 5px;
        color: #F9C100;
        border-radius: 4px;
        font-size: 12px;
        margin: 0 4px;
    }
    .nav-tabs .nav-item .nav-link span:nth-child(1){
        background-color: transparent;
        color: #242424;
        padding: 0;
        margin: 0;
    }
    .dropdown-menu{
        left: auto !important;
        right: 0 !important;
        width: 300px;
        height: 380px;
        border: 2px solid #F9C100;
        box-shadow: 0px 3px 6px #00000029;
        z-index: 999;
        margin-top: 10px;
    }
    .dropdown-menu::before{
        content: "";
        width: 20px;
        height: 20px;
        transform: rotate(45deg);
        background: #fff;
        position: absolute;
        z-index: 998;
        left: 88%;
        top: -11px;
        border-top: 2px solid #F9C100;
        border-left: 2px solid #F9C100;
    }
    #myTabContent ul {
        box-shadow: 0px 3px 6px #00000029;
        background: #EFEFEF;
        max-height: 278px;
        overflow: auto;
    }

    #myTabContent ul::-webkit-scrollbar {
        width: 5px;
        background-color: #fff;
    }

    #myTabContent ul li {
        background-color: #EFEFEF;
        padding: 7px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #fff;
    }

    #myTabContent ul li:last-child {
        border: 0;
    }

    #myTabContent ul li img {
        margin-right: 10px;
    }

    #myTabContent ul li h5 {
        font-size: 12px;
        color: #000000;
    }

    #myTabContent ul li p {
        font-size: 10px;
        color: #5D5960;
    }

    #myTabContent ul li p span {
        font-size: 12px;
        color: #004AAD;
    }

    #myTabContent ul li .time span {
        font-size: 12px;
        color: #5D5960;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #000;
    }
</style>
@section('content')

<ul class="nav nav-tabs border-0 d-flex flex-column" id="myTab" role="tablist" style="margin: 17px 0;">
    <div class="d-flex align-items-center">
        <?php
                                                                                                
            $all_notifications=\App\Models\Notification::where('auth_user_id',auth()->user()->id)->whereHas('article', function ($q) {
                                                      
                                                        $q->where('approved', 1);
                                                    })->get();
            $mentiones=\App\Models\Notification::where('auth_user_id',auth()->user()->id)->where('type','mention')->whereHas('article', function ($q) {
                                                      
                                                      $q->where('approved', 1);
                                                  })->get();
            
        ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link pt-0 active" id="home-tab1" data-bs-toggle="tab" data-bs-target="#home1" type="button"
                role="tab" aria-controls="home1" aria-selected="true"><span>All</span>
                <span>{{ count($all_notifications)}}</span></button>
        </li>
        <li class="nav-item" role="presentation">

            <button class="nav-link pt-0" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile1" type="button"
                role="tab" aria-controls="profile1" aria-selected="false"><span>Mentiones</span>
                <span>{{ count($mentiones) }}</span></button>
        </li>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active p t-3" id="home1" role="tabpanel" aria-labelledby="home-tab1">
            <ul>
                @foreach ($all_notifications as $notification)
                @if($notification->type=='comment')
                @if ($notification->read == 1)
                <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                    <li>
                        <div class="d-flex align-items-center w-100">


                            @if (is_null($notification->user->image) || $notification->user->image == '')

                            <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                height="35px" />
                            @else
                            <img src="{{ asset($notification->user->image) }}" class="rounded" width="35px" height="35px">
                            @endif
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5>{{ $notification->user->first_name }}
                                        {{ $notification->user->last_name }}</h5>
                                    <div class="time">
                                        <span>{{ $notification->created_at }}</span>
                                    </div>
                                </div>
                                <p>Commented on your article
                                    <span>"{{ $notification->article->title }}"</span>
                                </p>
                            </div>
                        </div>
                    </li>
                </a>
                @else
                <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                    <li style="background-color: #fff;">
                        <div class="d-flex align-items-center w-100">
                            @if (is_null($notification->user->image) || $notification->user->image == '')

                            <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                height="35px" />
                            @else
                            <img src="{{ asset($notification->user->image) }}" class="rounded" width="35px" height="35px">
                            @endif
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5>{{ $notification->user->first_name }}
                                        {{ $notification->user->last_name }}</h5>
                                    <div class="time">
                                        <span>{{ $notification->created_at }}</span>
                                    </div>
                                </div>
                                <p>Commented on your article
                                    <span>"{{ $notification->article->title }}"</span>
                                </p>
                            </div>
                        </div>
                    </li>
                </a>
                @endif
                @else
                @if ($notification->read == 1 &&
                $notification->article->approved=='1')
                <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                    <li>
                        <div class="d-flex align-items-center w-100">
                            @if (is_null($notification->user->image) ||
                            $notification->user->image == '')

                            <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                height="35px" />
                            @else
                            <img src="{{ asset($notification->user->image) }}"
                                class="rounded" width="35px" height="35px">
                            @endif

                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5>{{ ucwords($notification->user->first_name) }}
                                        {{ ucwords($notification->user->last_name) }}
                                    </h5>
                                    <div class="time">
                                        <span>{{ $notification->created_at }}</span>
                                    </div>
                                </div>
                                <div>
                                    <p>Mentioned you in the article
                                        <span>"{{ $notification->article->title }}"</span>
                                    </p>
                                </div>
                                {{-- <p><span>@sherif </span> please make Sure that you’re…</p> --}}
                            </div>
                        </div>
                    </li>
                </a>
                @elseif($notification->read == 0 &&
                $notification->article->approved=='1')
                <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                    <li style="background-color: #fff;">
                        <div class="d-flex align-items-center w-100">
                            @if (is_null($notification->user->image) ||
                            $notification->user->image == '')

                            <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                height="35px" />
                            @else
                            <img src="{{ asset($notification->user->image) }}"
                                class="rounded" width="35px" height="35px">
                            @endif
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5>{{ ucwords($notification->user->first_name) }}
                                        {{ ucwords($notification->user->last_name) }}
                                    </h5>
                                    <div class="time">
                                        <span>{{ $notification->created_at }}</span>
                                    </div>
                                </div>
                                <div>
                                    <p>Mentioned you in the article
                                        <span>"{{ $notification->article->title }}"</span>
                                    </p>
                                </div>
                                {{-- <p><span>@sherif </span> please make Sure that you’re…</p> --}}
                            </div>
                        </div>
                    </li>
                </a>
                @endif
                @endif
                @endforeach

            </ul>
        </div>
        <div class="tab-pane fade pt-3" id="profile1" role="tabpanel" aria-labelledby="profile-tab1">
            <ul>
                @foreach ($mentiones as $mention)
                @if ($mention->read == 1 &&
                $mention->article->approved=='1')
                <a style="text-decoration: none;" href="{{ url('/article/read/' . $mention->id) }}">
                    <li>
                        <div class="d-flex align-items-center w-100">
                            @if (is_null($mention->user->image) ||
                            $mention->user->image == '')

                            <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                height="35px" />
                            @else
                            <img src="{{ asset($mention->user->image) }}"
                                class="rounded" width="35px" height="35px">
                            @endif
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5>{{ ucwords($mention->user->first_name) }}
                                        {{ ucwords($mention->user->last_name) }}
                                    </h5>
                                    <div class="time">
                                        <span>{{ $mention->created_at }}</span>
                                    </div>
                                </div>
                                <div>
                                    <p>Mentioned you in the article
                                        <span>"{{ $mention->article->title }}"</span>
                                    </p>
                                </div>
                                {{-- <p><span>@sherif </span> please make Sure that you’re…</p> --}}
                            </div>
                        </div>
                    </li>
                </a>
                @elseif($mention->read == 0 &&
                $mention->article->approved=='1')
                <a style="text-decoration: none;" href="{{ url('/article/read/' . $mention->id) }}">
                    <li style="background-color: #fff;">
                        <div class="d-flex align-items-center w-100">
                            @if (is_null($mention->user->image) ||
                            $mention->user->image == '')

                            <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                height="35px" />
                            @else
                            <img src="{{ asset($mention->user->image) }}"
                                class="rounded" width="35px" height="35px">
                            @endif
                            <div class="w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5>{{ ucwords($mention->user->first_name) }}
                                        {{ ucwords($mention->user->last_name) }}
                                    </h5>
                                    <div class="time">
                                        <span>{{ $mention->created_at }}</span>
                                    </div>
                                </div>
                                <div>
                                    <p>Mentioned you in the article
                                        <span>"{{ $mention->article->title }}"</span>
                                    </p>
                                </div>
                                {{-- <p><span>@sherif </span> please make Sure that you’re…</p> --}}
                            </div>
                        </div>
                    </li>
                </a>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</ul>



@endsection