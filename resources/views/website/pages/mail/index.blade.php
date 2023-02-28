@extends('website.layouts.app')
<style>
    header,footer{
        display: none;
    }
</style>
@section('content')
<div class="navbar navbar-light ">
    <div style="width:90%;margin:20px auto;">
        <a class="navbar-brand"  href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo/logo.svg') }}" width="129px" />
        </a>
    </div>
</div>

<section class="mail" style="height: calc(100vh - 82px);">

    <div class="mail_content">
        <img src="{{ asset('assets/img/unsubscribe1.svg') }}" width="300px" />
        <h1>Are you sure about unsubscribing?</h1>
        <p>If you unsubscribe now.you might miss nice deals and hints from R-Write!</p>
        <ul>
            <li>
                <a style="background: #EFEFEF;" href="{{ route('unsubscribe2') }}"><img src="{{ asset('assets/img/left-arrow.png') }}" style="margin-right: 5px;" width="13px" /> I’d rather stay </a>
            </li>
            <li>
                <a href="{{ route('unsubscribe3') }}">Unsubscribe me <img src="{{ asset('assets/img/right-arrow.png') }}" style="margin-left: 5px;" width="13px" /></a>
            </li>
        </ul>
    </div>

</section>




@endsection