@extends('web.template.main')
@section('title','Explore Borneo Indonesia (indecon)')
@push('after-style')
<link rel="stylesheet" href="{{ asset('assets/web/css/jquery-ui.css') }}">
    <style>
        .price-range-slider {
            .range-bar {
                border: none;
                background: #000;
                height: 3px;	
                width: 96%;
                margin-left: 8px;
                
                .ui-slider-range {
                    background:#06b9c0;
                }
                
                .ui-slider-handle {
                    border:none;
                    border-radius:25px;
                    background:#fff;
                    border:2px solid #06b9c0;
                    height:17px;
                    width:17px;
                    top: -0.52em;
                    cursor:pointer;
                }
                .ui-slider-handle + span {
                    background:#06b9c0;
                }
            }
        }
        /*--- /.price-range-slider ---*/
    </style>
@endpush
@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-7 pt-md-8 bg-softWhite" style="padding-bottom: 4rem">
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ms-5">
            <li class="breadcrumb-item fontSize-12 active"><a href="{{ route('web.home') }}" class="text-darkGray">Home</a></li>
            <li class="breadcrumb-item text-darkGray fontSize-12 active" aria-current="page">Planning</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 mb-4">
                <div class="text-center sans fontSize-14 w-50 mx-auto mt-3">
                    We'll be in touch shortly after you submit the form, matching you with a Travel Expert and setting
                    up a time to talk – over email, phone or video call. For an immediate conversation, simply call us on
                    {{ \Controller::formatPhone(\Controller::aboutUs()->mobile_phone) }}
                </div>
            </div>
            <form action="{{ route('tourPlanning.create') }}" class="row align-items-start" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8 col-sm-12">
                    <div class="bg-tour-planning p-4">
                        @if(session('failed'))
                        <div class="alert alert-danger">
                            {{ session('failed') }}
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="fw-bolder uppercase fontSize-20">Your trip</div>
                        <div class="mt-4 border-bottom"></div>
                        <div class="form">
                            <div class="mt-4 col-12">
                                <label for="destination_request" class="form-label sans fontSize-16">Where would you like to go?*</label>
                                <input type="text" class="form-control" name="destination_request" id="destination_request" aria-describedby="destination_request" placeholder="Tell us where you want to go on holiday, and what it's like?">
                            </div>
                            <div class="mt-4 col-6">
                                <label for="departure_date" class="form-label sans fontSize-16">what date do you want to go?*</label>
                                <input type="date" class="departure_date form-control" id="departure_date" name="departure_date">
                                  
                            </div>
                            <div class="mt-4 col-6">
                                <label for="duration_trip" class="form-label sans fontSize-16">How long for?*</label>
                                <input type="text" class="form-control duration_trip" name="duration_trip" id="duration_trip" placeholder="duration_trip of trip">
                            </div>
                            <div class="mt-4 col-5">
                                <label for="number_of_participant" class="form-label sans fontSize-16">How many people are travelling?</label>
                                <select class="form-select" name="number_of_participant" id="number_of_participant" aria-label="Default select example">
                                    <option selected>Select a number</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                    <option value="5">Five</option>
                                    <option value="6">Six</option>
                                    <option value="7">Seven</option>
                                    <option value="8">Eight</option>
                                    <option value="9">Nine</option>
                                    <option value="10">Ten</option>
                                    <option value="11">Eleven</option>
                                </select>
                            </div>
                            <div class="col-8 mt-4">
                                <label for="price" class="form-label sans fontSize-16">How much would you like to spend per person?</label>
                                <div class="price-range-slider">
                                    <p class="range-value">
                                        <input type="text" class="sans fontSize-16 fw-bold" style="background: transparent;border:none;" id="amount" readonly>
                                    </p>
                                    <div id="slider-range" name="price-range" class="range-bar mt-2"></div>
                                </div>
                            </div>
                            <div class="mt-4 col-12">
                                <label for="note" class="form-label sans fontSize-16">Any other comments or requests?</label>
                                <textarea name="note" id="note" class="form-control" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="bg-tour-planning text-center p-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="27" viewBox="0 0 26 27" fill="none">
                                <g clip-path="url(#clip0_456_6836)">
                                    <path d="M12.977 25.3671C19.508 25.3671 24.8024 20.0727 24.8024 13.5417C24.8024 7.01073 19.508 1.71631 12.977 1.71631C6.44603 1.71631 1.15161 7.01073 1.15161 13.5417C1.15161 20.0727 6.44603 25.3671 12.977 25.3671Z" stroke="black" stroke-width="1.81929" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M20.117 13.5269H12.9259V4.1333" stroke="black" stroke-width="1.81929" stroke-miterlimit="10" stroke-linecap="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_6836">
                                    <rect width="25.4701" height="25.4701" fill="white" transform="translate(0.241943 0.806641)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="fontSize-14 sans fw-bolder mb-2 mt-1 uppercase">Office Hours</div>
                        @forelse ($officeHours as $item)
                            <div class="fontSize-14 sans">{{ Ucfirst($item->day) ?? '-' }}: {{ $item->time ?? '' }} {{ $item->note != null ? '('.$item->note.')' : '' }}</div>
                        @empty
                            <div class="fontSize-14 sans">Office Hours Not found</div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-8 col-sm-12 mt-3">
                    <div class="bg-tour-planning p-4">
                        <div class="fw-bolder uppercase fontSize-20">Your details</div>
                        <div class="mt-4 border-bottom"></div>
                        <div class="form mt-4">
                            <label for="first_name" class="form-label sans fontSize-16">Your name*</label>
                            <div class="row g-3">
                                <div class="col">
                                    <input type="text" class="form-control" value="{{ Auth::user()->name ?? '' }}" id="first_name" name="first_name" placeholder="First name*" aria-label="First name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last name*" aria-label="Last name">
                                </div>
                            </div>

                            <div class="mt-4 col-12">
                                <label for="email" class="form-label sans fontSize-16">Email address*</label>
                                <input type="email" class="form-control email" name="email" value="{{ Auth::user()->email ?? '' }}" id="email" placeholder="example@email.com">
                            </div>

                            {{-- <div class="mt-4 col-12">
                                <label for="confirm_email" class="form-label sans fontSize-16">Confirm email address*</label>
                                <input type="email" class="form-control confirm_email" name="confirm_email" id="confirm_email" placeholder="example@email.com">
                            </div> --}}

                            <label for="prefix_code" class="form-label sans fontSize-16">Telephone*</label>
                            <div class="row g-3">
                                <div class="col">
                                    <select name="code_phone" class="form-select" id="prefix_code">
                                        <option selected>International Dial Code</option>
                                        <option value="+62">+62</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone number" aria-label="Phone number">
                                </div>
                            </div>

                            <div class="mt-4 col-5">
                                <label for="get_info_from" class="form-label sans fontSize-16">How did you hear about us?</label>
                                <select class="form-select" name="hear_about_us" id="get_info_from" aria-label="Default select example">
                                    <option selected>Select an option</option>
                                    <option value="advertisement">advertisement</option>
                                    <option value="relatives or friends">relatives or friends</option>
                                    <option value="Website">Website</option>
                                </select>
                            </div>
                        
                            <div class="mt-5 col-12 text-center">
                                <button class="btn btn-warning p-3 px-4 mx-auto btn-block fontSize-16 uppercase">Submit Request</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end of .container-->
        
</section>
<!-- <section> close ============================-->
<!-- ============================================-->
@endsection
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script>
        //-----JS for Price Range slider-----
        $(function() {
            $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 15000,
            values: [ 0, 10000 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$ " + ui.values[ 0 ] + " - $ " + ui.values[ 1 ] );
            }
            });
            $( "#amount" ).val( "$ " + $( "#slider-range" ).slider( "values", 0 ) +
            " - $ " + $( "#slider-range" ).slider( "values", 1 ) );
        });
    </script>
@endpush