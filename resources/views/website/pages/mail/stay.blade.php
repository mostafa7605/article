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
            <img src="{{ asset('assets/img/unsubscribe2.svg') }}" width="300px" />
            <h1>Excellent choice!</h1>
            <p>Now we will keep you posted on the latest R-Write insights!</p>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Go Back </a>
                </li>
            </ul>
        </div>

    </section>
@endsection
