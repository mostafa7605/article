<header class="topbar-nav" style="padding-right:60px">
 <nav class="navbar navbar-expand p-0 m-0">

  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item"  id="toogleMenu" onclick="openNav()">
      <a class="nav-link p-0" href="#">
        <div class="media align-items-center  media-left" >
          <img  src="{{asset('rwrite/assets/images/admin/homepage/Group 341.svg')}}" id="burger_icon" alt="">
          <img  id="main_logo" src="{{asset('rwrite/assets/images/admin/homepage/rwrite-1@2x.png')}}" alt="">
        </div>
     </a>
    </li>
  </ul>
  <ul class="navbar-nav align-items-center right-nav-link" style="margin-top: 45px;" >
    <li class="nav-item dropdown-lg notification-dropdown">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret " data-toggle="dropdown" href="javascript:void();">
        <i class="fa fa-bell-o"></i>
        @if(isset($unapproved_articles))
        @if(count($unapproved_articles)>0)
        <span class="badge badge-primary badge-up" id="notif">{{count($unapproved_articles)}}</span>
        @endif
        @endif
    </a>
        <div class="dropdown-menu dropdown-menu-right  notification-message">
            <ul class="list-group list-group-flush">
            @if(isset($unapproved_articles))
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{-- You have {{count($unapproved_articles)}} new Notifications --}}
                <span class="badge badge-primary">{{count($unapproved_articles)}}</span>
            </li>
            @else
            <li class="list-group-item d-flex justify-content-between align-items-center">
            You have 0 Notifications
            <span class="badge badge-info">0</span>
            </li>
            @endif

            <li class="list-group-item text-center"><a href="{!! route('unapprovedmedia') !!}">See All Notifications</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="envelope nav-link dropdown-toggle dropdown-toggle-nocaret " style="margin:0 13px" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i>
      @if(isset($unseen_messages))
      @if(count($unseen_messages)>0)
      <span class="badge badge-primary badge-up">{{count($unseen_messages)}}</span>
      @endif
      @endif
    </a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush message-dropdown">
         <li class="list-group-item d-flex justify-content-between align-items-center">
          {{-- You have {{count($unseen_messages)}} new messages --}}
          {{-- <span class="badge badge-primary">{{count($unseen_messages)}}</span> --}}
          </li>

          <li class="list-group-item text-center"><a href="{!! url('/admin/messages') !!}">See All Messages</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item">


      <a class="nav-link  pt-0 dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile">
          
          @if (is_null(auth()->user()->image) || auth()->user()->image == '')
              <img 
                  src="{{ asset('assets/img/person-img.png ') }}" class="img-circle" alt="user avatar" />
              
          @else
          <img src="{!! asset(Auth::user()->image)!!}" class="img-circle" alt="user avatar">
          @endif
        </span>

      </a>
      <ul class="dropdown-menu dropdown-menu-right" style="background:#FFF6DD;top:55px;    right: -38px;">
      <div class="arrow-up user-triangle"></div>

       <li class="dropdown-item user-details">
        <a href="{!! url('/admin/profile/edit') !!}">
           <div class="row">

              <div class=" col-12 user-avatar-col">
                
                @if (is_null(auth()->user()->image) || auth()->user()->image == '')
                <img 
                    src="{{ asset('assets/img/person-img.png ') }}" class="user-avatar" alt="user avatar" />
                
            @else
            <img class="user-avatar"  src="{!! asset(Auth::user()->image)!!}" alt="user avatar">
            @endif
              </div>

              <div  class="user-name-col col-12"> <span class="user-name">{{ucwords(Auth::user()->first_name)}}</span> </div>

           </div>
          </a>
        </li>
        <li class="dropdown-item"><a style="color:#D44000" href="{!! url('/admin/profile/edit') !!}">Profile Info</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a style="color:#D44000" href="{!! url('/admin/import/data') !!}">Import Data</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item" > <a style="color:#D44000" href="{!! url('/admin/logout') !!}">Logout</a></li>
      </ul>
    </li>
  </ul>


</nav>
<div class="row p-0 m-0" style="  padding-left:5px;  margin-top: 15px !important;">
      <div class="col-2 p-0 nav-bottom-left">
      @php
        $head_page =  Request::segment(2);
        $iamge='';
        if( ucwords($head_page) == 'Roles'||ucwords($head_page) == 'Role'){
          $iamge='Group 353.svg';
        }elseif( ucwords($head_page) =='Users' ||  ucwords($head_page) =='User'){
          $iamge=  'Group 317.svg';
        }elseif( ucwords($head_page) =='Rss'){
          $iamge=  'Group 376.svg';
        }
        elseif( ucwords($head_page) =='Media'||ucwords($head_page) =='UnapprovedMedia'){
          $iamge=  'Group 354.svg';
        }elseif( ucwords($head_page) =='Image_slider'||ucwords($head_page) =='Image_sliders'){
          $iamge=  'Group 320.svg';
        }
        if( Request::segment(2) == 'rss' &&  Request::segment(3) =='create_new'){
          $head_page='Add Rss feed';
          $iamge=  'Group 376.svg';

        }
      @endphp
      @if ($iamge==  'Group 317.svg')
      <a href="{!! url('/admin/users') !!}" >
        <div class="user_section user-profile" style="padding-right: 50px;">
            <img style="width:23px;height:23px;border-radius:0" src="{{asset('rwrite/assets/images/admin/homepage/'. $iamge)}}" alt="">
            <span class="gold-color" style="font-size:18px">{{ucwords($head_page) == 'Rss' ? 'Rss feed'  : ucwords($head_page)}}</span>
          </div>
      </a>
        @elseif ($iamge=='Group 353.svg')
        <a href="{!! route('roles') !!}" >
            <div class="user_section user-profile" style="padding-right: 50px;">
                <img style="width:23px;height:23px;border-radius:0" src="{{asset('rwrite/assets/images/admin/homepage/'. $iamge)}}" alt="">
                <span class="gold-color" style="font-size:18px">{{ucwords($head_page) == 'Rss' ? 'Rss feed'  : ucwords($head_page)}}</span>
              </div>
          </a>
        @elseif($iamge=='Group 320.svg')
        <a href="{!! route('image_sliders') !!}" >
            <div class="user_section user-profile" style=" margin-left:10px;">
                <img style="width:23px;height:23px;border-radius:0" src="{{asset('rwrite/assets/images/admin/homepage/'. $iamge)}}" alt="">
                <span class="gold-color" style="font-size:18px">Slider Images</span>
              </div>
          </a>
          @elseif($iamge=='Group 354.svg')
          <a href="{!! route('media') !!}" >
              <div class="user_section user-profile" style="padding-right: 50px;">
                  <img style="width:23px;height:23px;border-radius:0" src="{{asset('rwrite/assets/images/admin/homepage/'. $iamge)}}" alt="">
                  <span class="gold-color" style="font-size:18px">Media</span>
                </div>
            </a>
      @endif


      </div>
      <div class="offset-4 col-6 nav-bottom-right">
       @if ($iamge==  'Group 317.svg')
        <form id="search_form"  style="display: flex;align-items:center"
        method="post"
        action="{{ route('search_user') }}" enctype="multipart/form-data">
         @csrf
          <div class="search_bar">
            <img src="{{asset('rwrite/assets/images/admin/homepage/Icon feather-search.svg')}}" alt="">
            <input type="text" placeholder="Search" style=""name="search" id="search">
          </div>
          <div class="filter">
            <img src="{{asset('rwrite/assets/images/admin/homepage/Icon awesome-filter.svg')}}" alt="">
            <span>Filter</span>
          </div>
          <div class="role">
            <select name="filter_roles" id="filter_roles" style="width: 130px;color:#717171; background-color:#fff;" class="cell-select">
                <option value=""disabled selected>Roles</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach

              </select>

          </div>
          <input id="apply-btn" type="submit"  value="Apply">
        </form>
        @elseif ($iamge=='Group 353.svg')
           <form id="search_roles_form"  style="display: flex;align-items:center"
        method="post"
        action="{{ route('search_role') }}" enctype="multipart/form-data">
         @csrf
          <div class="search_bar"style="margin-right: 5px">
            <img src="{{asset('rwrite/assets/images/admin/homepage/Icon feather-search.svg')}}" alt="">
            <input type="text" placeholder="Search" style=""name="search2" id="search2">
          </div>

          <input id="apply-btn" type="submit"  value="Apply">
        </form>
        @elseif($iamge == 'Group 354.svg')
        <form id="search_media_form"  style="display: flex;align-items:center"
        method="post"
        action="{{ route('search_media') }}" enctype="multipart/form-data">
         @csrf
          <div class="search_bar">
            <img src="{{asset('rwrite/assets/images/admin/homepage/Icon feather-search.svg')}}" alt="">
            <input type="text" placeholder="Search" style=""name="search3" id="search3">
          </div>
          <div class="filter">
            <img src="{{asset('rwrite/assets/images/admin/homepage/Icon awesome-filter.svg')}}" alt="">
            <span>Filter</span>
          </div>
          <div class="role">
            <select name="filter_media" id="filter_media" style="width: 130px;color:#717171; background-color:#fff;" class="cell-select">
                <option value=""disabled selected>Statu</option>
                <option value="0">Unapproved</option>
                <option value="1">Approved</option>
              </select>

          </div>
          <input id="apply-btn" type="submit"  value="Apply">
        </form>
        @endif
      </div>
  </div>
</header>

<!-- loaded popover content -->
<div id="role-popover-content" style="display: none">
  <ul class="list-group custom-popover rolelist">
    <li class="list-group-item">Admin</li>
    <li class="list-group-item">Super Admin</li>
  </ul>
</div>
