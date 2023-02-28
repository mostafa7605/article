@extends('website.layouts.app')
<style>
    footer,.login,.register_button{
        display: none !important;
    }
</style>
@section('content')

<div class="auth">
    <div class="row">
        <div class="col-lg-5 p-0 d-none d-lg-block">
            <div class="img-owner">
                <img src="{{ asset('assets/img/owner.png ') }}" />
            </div>
        </div>
        <div class="col-lg-7 p-0">
            <div class="secound-auth">
                <div class="secound-auth-content">
                    <div class="w-100">
                        <div class="title-auth">
                            {{-- <p>Not a member ? <a href="{{ route('register') }}">Register</a></p> --}}
                            <h1 class="text-center mb-5">Log in to your Account</h1>
                        </div>
                        {{-- <div class="google-apple">
                            <a href="{{ route('auth.google') }}" class="google">
                                <img src="{{ asset('assets/img/google.png ') }}" />Log in with Google
                            </a>
                        </div>
                        <div class="or">
                            <span class="line"></span>
                            <span class="ors">OR</span>
                            <span class="line"></span>
                        </div> --}}
                         @if (\Session::has('error'))
                                <div class="alert alert-danger" id="error_" role="alert">
                                    {!! \Session::get('error') !!}
                                </div>
                                <script>
    
                                    setTimeout(function() {
                                $('#error_').fadeOut('fast');
                                }, 5000);
                                </script>
                            @endif
                        <div class="form-auth">
                            <form action="{{ route('loginuser') }}" method="POST">
                                 @csrf
                                <div class="mb-3">
                                    <label class="form-label" >Email address</label>
                                    <input type="text" class="form-control" placeholder="Enter your Email" name="email"value="{{ old('email') }}">
                                     @if($errors->has('email'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('email') }}</p>
                      @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" >Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password">
                                      @if($errors->has('password'))
                                        <p

                                        class="text-error more-info-err"
                                        style="color: red;"
                                    >{{ $errors->first('password') }}</p>
                                    @endif

                                    <div class="mb-3 mt-2">
                                        <a href="{{ route('forget') }}" class="forget m-0" style="float: right;font-size: 15px;font-weight: 300;">Forgot Password?</a>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1" style="color: #EFEFEF;font-weight: 300;font-size:17px;">Remember password</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Log in</button>
                                <div class="title-auth text-center mt-3">
                                    <p>Not a member ? <a href="{{ route('register') }}">Register</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@push('script')
<script>
    setTimeout(function() {
        $('#error_').fadeOut('fast');
    }, 1000);
</script>
@endpush