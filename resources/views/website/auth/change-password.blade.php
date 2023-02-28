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

            <img src="{{ asset('assets/img/change-password.png ') }}" class="d-block m-auto" width="84px" height="84px" />
            <h1>Change password</h1>
            <form action="{{ route('update_password') }}" method="POST">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="old_password" class="form-control" />
                </div>
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" />
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="new_password_confirmation" />

                </div>
                <button type="submit" class="btn">Change password</button>
                {{-- <div class="back-to"> --}}
                {{-- <a href="{{ route('login') }}">
                        <img src="{{ asset('assets/img/arrow-left.png ') }}" width="15px" height="10px" />
                        <span>Back to login</span>
                    </a> --}}

                {{-- </div> --}}
            </form>
        </div>
    </section>
@endsection
