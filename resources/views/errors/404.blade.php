@extends('website.layouts.app')
<style>
    header,footer{
        display: none;
    }

</style>
@section('content')

    <section class="error_404">
        <div class="error-content">
            <h2>Page not found</h2>
            <p>Sorry, but the page you are looking for could not <br> be found.</p>
            <div class="steps-error">
                <h5 style="">We suggest the following options:</h5>
                <ul style="">
                    <li>Search Page to find articles.</li>
                    <li>Home page for the latest issue.</li>
                    <li>Customer service for subscription problems</li>
                    <li>Contact us for company-wide mailing, telephone <br> and email details</li>
                </ul>
                <p style="">If you continue to have problems please email <br> support@lrb.co.uk and we will try our best to help.</p>
            </div>
        </div>
        
    </section>

@endsection