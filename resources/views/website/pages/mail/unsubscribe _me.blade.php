@extends('website.layouts.app')
<style>
    header,
    footer {
        display: none;
    }
</style>
@section('content')
<div class="navbar navbar-light ">
    <div style="width:90%;margin:20px auto;">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo/logo.svg') }}" width="129px" />
        </a>
    </div>
</div>

<section class="mail" style="height: calc(100vh - 82px);">

    <div class="mail_content">
        <img src="{{ asset('assets/img/unsubscribe3.svg') }}" width="300px" />
        <h1>Unsubscribe</h1>
        <p>We are sorry to see you go!</p>
        <ul>
            <li>
                <a href="">Confirm</a>
            </li>
        </ul>
    </div>

</section>




@endsection