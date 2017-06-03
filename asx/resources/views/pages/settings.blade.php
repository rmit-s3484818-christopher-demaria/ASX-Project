@extends('layouts.master')
@section('title')
    FAQ's
@stop
@section('body')
    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">FAQ's</h2>
                    <hr>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12  portfolio-tile portfolio-body-top-tile" id="port-recent-panel">
                            <h1 class="portfolio-options">Most Popular Questions</h1>

                            <div class="col-lg-5 col-lg-offset-1 FAQ_container">
                                <h3 class="faq-account"><strong>Account</strong></h3>
                                <ul>
                                    <li>How do I change my password?</li>
                                    <li>Can I change my username?</li>
                                    <li>How do I delete my account?</li>
                                    <li>Can I report an account?</li>
                                </ul>
                                <h3><strong>Gameplay</strong></h3>
                                <ul>
                                    <li>How do I buy shares?</li>
                                    <li>How do I sell shares I own?</li>
                                    <li>How does the Wish List work?</li>
                                    <li>Can I communicate with players? If so, how?</li>
                                    <li>What does my dashboard display?</li>
                                </ul>
                                <h3 class="text-center faq-manual"><strong>All questions can be answered in the User Manual. Download it <a>here.</a></strong></h3>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


@endsection
