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

            <img src="{{ asset('assets/img/forget.png ') }}" class="d-block m-auto" width="84px" height="84px" />
            <h1>Set new password</h1>
            <p>Your new password must be different to the previously <br> used passwords.</p>
            <form method="post" action="/user/forget">
                {!! csrf_field() !!}
                @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {!! \Session::get('error') !!}
                    </div>
                @endif

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" />

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" />
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
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
