@extends('website.layouts.app')
<style>
    .login,
    .register_button {
        display: none !important;
    }
</style>
@section('content')
    <section class="auth-pages" style="">

        <div class="auth-pages-contnet" style="width: 360px">

            <img src="{{ asset('assets/img/password-eset.png ') }}" class="d-block m-auto" width="84px" height="84px" />
            <h1>Password Reset</h1>
            <p>Your password has been successfully reset.<br> Click below to log in magically.</p>

            <a href="{{ route('home') }}" class="btn">Continue</a>
            <div class="back-to">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('assets/img/arrow-left.png ') }}" width="15px" height="10px" />
                    <span>Back to login</span>
                </a>

            </div>
        </div>
    </section>
@endsection
