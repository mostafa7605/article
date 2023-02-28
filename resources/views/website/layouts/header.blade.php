
<header>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand " href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo/logo.svg') }}" width="95px" />
            </a>
            <button class="navbar-toggler" style="background: #f9c10e !important;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" style="margin-right: auto;">
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a>
                    </li>
                    @endif
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('about_us') ? 'active' : '' }}" href="{{ route('about_us') }}">About</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('how_it_work') ? 'active' : '' }}" href="{{ route('how_it_work') }}">How it
                            work</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link" href="{{ route('user.logout') }}">
                                Logout
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="">
                    @if (Auth::check())
                        <div class="search-bell">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link icon_search" onclick="openSearch()" href="#">
                                        <img src="{{ asset('assets/img/search1.svg ') }}" />
                                    </a>
                                </li>
                                <li class="nav-item d-none d-lg-flex">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            
                                            <img src="{{ asset('assets/img/bell.svg ') }}" />
                                            
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                                            <div class="notificatio-header">
                                                <h2>Notifications</h2>
                                                {{--  <a href=""><img src="{{ asset('assets/img/correct.svg ') }}" /> Mark all as read</a> --}}
                                            </div>
                                            <ul class="nav nav-tabs border-0" id="myTab" role="tablist" style="margin-bottom: 17px;">
                                                <?php
                                                    $all_notifications=\App\Models\Notification::where('auth_user_id',auth()->user()->id)->whereHas('article', function ($q) {
                                                      
                                                      $q->where('approved', 1);
                                                  })->get();
          $mentiones=\App\Models\Notification::where('auth_user_id',auth()->user()->id)->where('type','mention')->whereHas('article', function ($q) {
                                                    
                                                    $q->where('approved', 1);
                                                })->get();                                     
                                                    
                                                    
                                                ?>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link pt-0 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                                        type="button" role="tab" aria-controls="home" aria-selected="true"><span>All</span>
                                                        <span>{{ count($all_notifications) }}</span></button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                    
                                                    <button class="nav-link pt-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                                        type="button" role="tab" aria-controls="profile" aria-selected="false"><span>Mentiones</span>
                                                        <span>{{ count($mentiones) }}</span></button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active p t-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <ul>
                                                        @foreach ($all_notifications as $notification)
                                                        @if($notification->type=='mention')
                                                        @if ($notification->read == 1 && $notification->article->approved=='1')
                                                        <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                                                            <li>
                                                                <div class="d-flex align-items-center w-100">
                                                                    @if (is_null($notification->user->image) || $notification->user->image == '')
                                    
                                                                        <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                                                        height="35px" />
                                                                        @else
                                                                            <img  src="{{ asset($notification->user->image) }}" class="rounded" width="35px"
                                                                            height="35px">
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
                                                        @elseif($notification->read == 0 && $notification->article->approved=='1')
                                                        <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                                                            <li style="background-color: #fff;">
                                                                <div class="d-flex align-items-center w-100">
                                                                    @if (is_null($notification->user->image) || $notification->user->image == '')
                                    
                                                                    <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                                                    height="35px" />
                                                                    @else
                                                                        <img  src="{{ asset($notification->user->image) }}" class="rounded" width="35px"
                                                                        height="35px">
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
                                                        @else
                                                        @if ($notification->read == 1)
                                                        <a style="text-decoration: none;" href="{{ url('/article/read/' . $notification->id) }}">
                                                            <li>
                                                                <div class="d-flex align-items-center w-100">
                                                                   

                                                                        @if (is_null($notification->user->image) || $notification->user->image == '')
                                    
                                                                        <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                                                        height="35px" />
                                                                        @else
                                                                            <img  src="{{ asset($notification->user->image) }}" class="rounded" width="35px"
                                                                            height="35px">
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
                                                                            <img  src="{{ asset($notification->user->image) }}" class="rounded" width="35px"
                                                                            height="35px">
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
                                                        @endif
                                                        @endforeach
                                                       
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <ul>
                                                        @foreach ($mentiones as $mention)
                                                        @if ($mention->read == 1 && $mention->article->approved=='1')
                                                        <a style="text-decoration: none;" href="{{ url('/article/read/' . $mention->id) }}">
                                                            <li>
                                                                <div class="d-flex align-items-center w-100">
                                                                    @if (is_null($mention->user->image) || $mention->user->image == '')
                                    
                                                                        <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                                                        height="35px" />
                                                                        @else
                                                                            <img  src="{{ asset($mention->user->image) }}" class="rounded" width="35px"
                                                                            height="35px">
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
                                                        @elseif($mention->read == 0 && $mention->article->approved=='1')
                                                        <a style="text-decoration: none;" href="{{ url('/article/read/' . $mention->id) }}">
                                                            <li style="background-color: #fff;">
                                                                <div class="d-flex align-items-center w-100">
                                                                    @if (is_null($mention->user->image) || $mention->user->image == '')
                                    
                                                                    <img src="{{ asset('assets/img/person-img.png ') }}" class="rounded" width="35px"
                                                                    height="35px" />
                                                                    @else
                                                                        <img  src="{{ asset($mention->user->image) }}" class="rounded" width="35px"
                                                                        height="35px">
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
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item d-flex d-lg-none">
                                    <a class="nav-link icon_search" href="{{ route('notification') }}">
                                        <img src="{{ asset('assets/img/bell.svg ') }}" />
                                    </a>
                                </li>
                                <li class="nav-item d-none d-lg-block">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                            @if (is_null(auth()->user()->image) || auth()->user()->image == '')
                                            <img src="{{ asset('assets/img/person-img.png ') }}"
                                                style="height: 35px; width: 35px;border-radius: 50%;border: 1px solid #F9C100;" />
                                            @else
                                            <img src="{{ asset(auth()->user()->image) }}"
                                                style="height: 35px;width: 35px;border-radius: 50%;border: 1px solid #F9C100;" />
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" style="height: 320px;width: 260px;margin-right: 15px;"
                                            aria-labelledby="dropdownMenuClickableInside">
                                            <div class="d-flex align-items-center py-3 border-bottom" style="justify-content: space-evenly;">
                                                <div class="img-profiles">
                                                    @if (is_null(auth()->user()->image) || auth()->user()->image == '')
                                                    <img src="{{ asset('assets/img/person-img.png ') }}"
                                                        style="width: 60px;height: 60px;border-radius: 50%;" />
                                                    @else
                                                    <img src="{{ asset(auth()->user()->image) }}" style="height: 60px;width: 60px;border-radius: 50%;" />
                                                    @endif
                                                </div>
                                                <div class="content_data">
                                                    <h3 style="font-size: 12px">{{ ucwords(auth()->user()->first_name) }}
                                                        {{ ucwords(auth()->user()->last_name) }}</h3>
                                                    <p style="font-size: 10px;margin: 3px 0  6px 0;">{{ auth()->user()->email }}
                                                    </p>
                                                    <a href="{{ route('edit-profile', ['id' => auth()->user()->id]) }}">Edit
                                                        Profile</a>
                                                </div>
                                            </div>
                                    
                                    
                                    
                                            <div class="border-bottom ">
                                    
                                                <div class="sub-title">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('profile') }}">
                                                                <img src="{{ asset('assets/img/user1.png ') }}" height="21px">
                                                                <span style="font-weight: 500">Profile</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('follower') }}">
                                                                <img src="{{ asset('assets/img/users1.png ') }}" height="21px">
                                                                <span>Followers</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('following') }}">
                                                                <img src="{{ asset('assets/img/users1.png ') }}" height="21px">
                                                                <span>Following</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="sub-title mt-3">
                                                <a href="{{ route('user.logout') }}" style="margin-left: 14px;">
                                                    <img src="{{ asset('assets/img/exit.png ') }}" height="21px">
                                                    <span>Logout</span>
                                                </a>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('article.create') }}" class="rock">
                                        <img src="{{ asset('assets/img/rock.svg ') }}" />
                                        <span>Create…</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                    <ul class="navbar-nav auth">
                        <li class="nav-item ">
                            <a href="{{ route('register') }}" class="rock register_button" style="width: 100px;">
                                <span>Register</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link login" href="{{ route('login') }}" style="width: 90px;">
                                <span>Login</span>
                            </a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>

<div id="myOverlay" class="overlay ">
    <div class="position-relative">
        <span class="closebtn" style="font-size: 60px;margin-right:25px;" onclick="closeSearch()"
            title="Close Overlay">×</span>
    </div>
    <div class="overlay-content">
        <form id="form_123" method="post" action="{{ route('search') }}" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="position-relative search-bar">
                    <input type="text" id="search" placeholder="Search.." name="search">
                    <img onclick="submit_search();" class="search-icon" src="{{ asset('assets/img/search1.svg ') }}" />
                    <span class="closebtn" onclick="removeValue()">×</span>
                </div>
                <select class="form-select" id="type_search2" name="search_type" aria-label="Default select example"
                    required>
                    <option value="1" selected>R-Content</option>
                    <option value="2">R-Writers</option>
                </select>
            </div>


            {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu23"
                data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </button> --}}

            {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenu23">
                <li><a style="cursor: pointer;" onclick="search_type2('1','Blog');"
                        class="dropdown-item">R-content</a></li>
                <li><a style="cursor: pointer;" onclick="search_type2('2','R-Writers');"
                        class="dropdown-item">R-Writers</a></li>
            </ul> --}}
            <div style="text-align: left; padding-left: 10px;">
                <p id="error_message" class="text-error more-info-err" style="color: red;"></p>

            </div>
            <button type="button" style="visibility: hidden"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $('body').keypress(function(e) {
            if (e.keyCode == 13) {
                if (document.getElementById("myOverlay").style.display == "block") {
                    const search = document.getElementById('search');
                    const type_search = document.getElementById('type_search2');

                    const search2 = search.value.trim();
                    const type_search2 = type_search.value.trim();
                    if (search2 === '' && type_search2 === '') {
                        document.getElementById('error_message').innerHTML =
                            'Search word and search type are required';


                    } else if (search2 === '') {
                        document.getElementById('error_message').innerHTML = 'Search word is required';

                    } else if (type_search2 === '') {
                        document.getElementById('error_message').innerHTML = 'Search type is required';

                    } else {
                        $('#form_123').submit();
                    }
                } else if (document.getElementById("myOverlay2").style.display == "block") {
                    const search2 = document.getElementById('search2');
                    const type_search2 = document.getElementById('type_search');

                    const search22 = search2.value.trim();
                    const type_search22 = type_search2.value.trim();
                    if (search22 === '' && type_search22 === '') {
                        document.getElementById('error_message2').innerHTML =
                            'Search word and search type are required';


                    } else if (search22 === '') {
                        document.getElementById('error_message2').innerHTML = 'Search word is required';

                    } else if (type_search22 === '') {
                        document.getElementById('error_message2').innerHTML = 'Search type is required';

                    } else {
                        $('#form_12').submit();
                    }
                }

            }
        });


        function submit_search(){
            if (document.getElementById("myOverlay").style.display == "block") {
                    const search = document.getElementById('search');
                    const type_search = document.getElementById('type_search2');

                    const search2 = search.value.trim();
                    const type_search2 = type_search.value.trim();
                    if (search2 === '' && type_search2 === '') {
                        document.getElementById('error_message').innerHTML =
                            'Search word and search type are required';


                    } else if (search2 === '') {
                        document.getElementById('error_message').innerHTML = 'Search word is required';

                    } else if (type_search2 === '') {
                        document.getElementById('error_message').innerHTML = 'Search type is required';

                    } else {
                        $('#form_123').submit();
                    }
                } else if (document.getElementById("myOverlay2").style.display == "block") {
                    const search2 = document.getElementById('search2');
                    const type_search2 = document.getElementById('type_search');

                    const search22 = search2.value.trim();
                    const type_search22 = type_search2.value.trim();
                    if (search22 === '' && type_search22 === '') {
                        document.getElementById('error_message2').innerHTML =
                            'Search word and search type are required';


                    } else if (search22 === '') {
                        document.getElementById('error_message2').innerHTML = 'Search word is required';

                    } else if (type_search22 === '') {
                        document.getElementById('error_message2').innerHTML = 'Search type is required';

                    } else {
                        $('#form_12').submit();
                    }
                }
        }

        // function search_type2(id, type) {
        //     document.getElementById('dropdownMenu23').innerHTML = type;
        //     document.getElementById('type_search2').value = id;
        // }

        function openSearch() {
            setTimeout(function() {
                document.getElementById("myOverlay").style.display = "block";
                document.getElementById("body").classList.add("my-body");
            }, 20);
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
            document.getElementById("body").classList.remove("my-body");
        }

        function removeValue() {
            document.getElementById("search").value = "";
        }

        function removeValue2() {
            document.getElementById("search2").value = "";
        }
    </script>
@endpush
