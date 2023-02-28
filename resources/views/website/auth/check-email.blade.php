@extends('website.layouts.app')
<style>
    .login,.register_button{
        display: none !important;
    }
</style>
@section('content')

<section class="auth-pages" style="">

    <div class="auth-pages-contnet" style="width: 360px">

        <img src="{{ asset('assets/img/change-password.png ') }}" class="d-block m-auto" width="84px" height="84px" />
        <h1>Check your email</h1>
        <p>We sent a password reset link to <br> Adrian.a.santalla@r-write.com</p>

        <button type="submit" class="btn">Open email app</button>
        <div class="back-to">
            <div class="click">
                Didn’t receive the email ? <a href="">Click to Resend</a> 
            </div>
            <a href="{{ route('login') }}">
                <img src="{{ asset('assets/img/arrow-left.png ') }}" width="15px" height="10px" />
                <span>Back to login</span>
            </a>

        </div>
    </div>
</section>

@endsection