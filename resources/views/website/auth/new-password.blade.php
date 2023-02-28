@extends('website.layouts.app')
<style>
    .login,.register_button {
        display: none !important;
    }
</style>
@section('content')

<section class="auth-pages" style="">

    <div class="auth-pages-contnet" style="width: 360px">

        <img src="{{ asset('assets/img/forget.png ') }}" class="d-block m-auto" width="84px" height="84px" />
        <h1>Set new password</h1>
        <p>Your new password must be different to the previously <br> used passwords.</p>
        <form>
            <div class="mb-3">
                <label  class="form-label">Password</label>
                <input type="password" class="form-control" />
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" />
            </div>
            <button type="submit" class="btn">Reset password</button>
            <div class="back-to">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('assets/img/arrow-left.png ') }}" width="15px" height="10px" />
                    <span>Back to login</span>
                </a>

            </div>
        </form>
    </div>
</section>

@endsection