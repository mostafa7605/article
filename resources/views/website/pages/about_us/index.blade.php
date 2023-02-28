@extends('website.layouts.app')
@section('content')

<div class="about_us">
    <div class="about-img d-none d-lg-block">
        <img src="{{ asset('assets/img/about_us.png ') }}" class="w-100 h-auto">
    </div>
    <div class="about-img d-none d-md-block d-lg-none">
        <img src="{{ asset('assets/img/800x.svg ') }}" class="w-100 h-auto">
    </div>
    <div class="about-img d-none d-sm-block d-md-none">
        <img src="{{ asset('assets/img/600x.svg ') }}" class="w-100 h-auto">
    </div>
    <div class="about-img d-block d-sm-none">
        <img src="{{ asset('assets/img/300x.svg ') }}" class="w-100 h-auto">
    </div>
    <div class="person_img" >
        <div class="row">
            <div class="col-md-4">
                <div class="person_name_img text-center">
                    <img src="{{ asset('assets/img/1.png ') }}"  width="300px" height="300px"
                                    class="d-block m-auto mt-5 rounded-circle p-3" />
                    <h3 class="mt-3">Andrea Barmettler</h3>
                    <p class="mt-2" >Marketing</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="person_name_img text-center">
                    <img src="{{ asset('assets/img/2.png ') }}" width="300px" height="300px"
                        class="d-block m-auto  rounded-circle p-3" />
                    <h3 class="mt-3">Daniel Hofmann</h3>
                    <p class="mt-2">Co-Founder</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="person_name_img text-center">
                    <img src="{{ asset('assets/img/3.png ') }}" width="300px" height="300px"
                        class="d-block m-auto mt-5 rounded-circle p-3" />
                    <h3 class="mt-3">Philipp Lauwiner</h3>
                    <p class="mt-2">Development</p>
                </div>
            </div>
        </div>
    </div>
    <div class="our_team text-center">
        <div class="our_team_title">
            <h2>From our team</h2>
        </div>
        <div class="our_team_content" >
            <img src="{{ asset('assets/img/owner2.png ') }}" width="280px" height="280px" class="d-block m-auto  rounded-circle" />
            <p >But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give
            you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the
            master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but
            because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor
            again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain.</p>
            <h5 >Adrian A. Santalla</h5>
        </div>
    </div>
    {{-- =======================================  Newsletter  ====================================== --}}
    <div class="newsletter m-0" >
        <h2 style="color: #000;">Get the free daily newsletter</h2>
        <p style="color: #000;">Join <span class="number-subscribe">10,000+</span> R-write authors who grow with us every day</p>
        <form method="POST" action="{{ url('/subscribe') }}">
        @csrf
            <div class="subscribe-form">
                <input required style="box-shadow: inset 0px 3px 6px #00000029;" name="email" type="email" class="form-control" placeholder="Your.email@example.com">
                <button style="color: #000;font-weight: 500;" type="submit" class="subscribe">Subscribe</button>
            </div>
        </form>
        <p style="color: #000;" class="unsubscribe">No spam. No nonsense. Unsubscribe anytime.</p>
    </div>
</div>

@endsection