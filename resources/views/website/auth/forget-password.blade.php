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
            <h1>Forgot password?</h1>
            <p>No worries, we’ll send you reset instructions</p>
            @if (\Session::has('error'))
                <div class="alert alert-danger" role="alert" style="background-color: #556B2F;color: #fff">
                    {!! \Session::get('error') !!}
                </div>
            @endif
            <form action="{{ route('forget_password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleFormControlInput1"
                        placeholder="name@example.com" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class="text-error more-info-err" style="color: red;">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <button type="submit" class="btn">Continue</button>
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
