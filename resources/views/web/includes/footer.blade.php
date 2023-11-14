<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="bg-200 pb-0">
    <!-- subscribe -->
    <div class="container">
        <div class="card py-5 px-5 border-0 shadow-sm mb-5 mt-n5 bg-subscribe">
            <div class="card-body">
                <div class="row flex-center">
                <div class="col-12 col-lg-12 text-lg-start">
                    <div class="text-white roboto fontSize-42 text-softWhite fw-bold">Unforgettable Experiences</div>
                    <p class="mb-lg-0 text-softWhite roboto fontSize-32 opacity-80">Sustainable Footprints!</p>
                    <div class="input-group mt-3 w-75">
                        <input type="text" name="emailSubscribe" id="emailSubscribe" class="form-control p-2 fontSize-10 bg-input-footer" placeholder="Enter Email Address" aria-label="Enter Email Address" aria-describedby="button-subscribe">
                        <button class="btn btn-warning" type="button" style="box-shadow: 10.233778953552246px 10.233778953552246px 43.72614288330078px 0px rgba(0, 0, 0, 0.10)" id="button-subscribe">Subscribe</button>
                    </div>
                </div>
                {{-- <div class="col-12 col-lg-6 text-lg-end"><a class="btn btn-lg btn-danger hover-top btn-glow text-end" href="#">Subscribe Now</a></div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        <div class="col-12 col-lg-4 mb-3"><a href="#">
            <img class="d-inline-block align-middle" src="{{ App\Http\Controllers\controller::logoFooter() }}" alt="" width="150" />
            {{-- <span class="d-inline-block text-1000 fs-1 ms-2 fw-medium lh-base">
                Lasles<span class="fw-bold">VPN</span> --}}
            </span>
            </a>

            <p class="my-3 fontSize-12 w-75 ms-3 text-softWhite fw-normal cairo">
                {{ App\Http\Controllers\Controller::aboutUs()->short_description_idn; }}
            </p>
            <div class="ms-3 text-white mb-2 cairo">Follow Us</div>
            <ul class="list-unstyled list-inline cairo ms-3">
                <li class="list-inline-item">
                    <a class="text-decoration-none btn btn-outline-grey btn-sm" href="https://www.facebook.com/{{ App\Http\Controllers\Controller::aboutUs()->facebook; }}">
                        <iconify-icon icon="basil:facebook-solid" style="color: #1e33e5;"></iconify-icon>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="text-decoration-none btn btn-outline-grey btn-sm" href="https://www.youtube.com/{{ App\Http\Controllers\Controller::aboutUs()->youtube; }}">
                        <iconify-icon icon="mdi:youtube" style="color: #ff2b2b;"></iconify-icon>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="text-decoration-none btn btn-outline-grey btn-sm" href="https://www.twitter.com/{{ App\Http\Controllers\Controller::aboutUs()->twitter; }}">
                        <iconify-icon icon="mdi:twitter" style="color: #3cb5db;"></iconify-icon>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="text-decoration-none btn btn-outline-grey btn-sm" href="https://www.linkedin.com/{{ App\Http\Controllers\Controller::aboutUs()->linkedin; }}">
                        <iconify-icon icon="mdi:linkedin" style="color: #286fa3;"></iconify-icon>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="text-decoration-none btn btn-outline-grey btn-sm" href="https://www.instagram.com/{{ App\Http\Controllers\Controller::aboutUs()->instagram; }}">
                        <iconify-icon icon="mdi:instagram" style="color: #fd3e77;"></iconify-icon>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-6 col-sm-4 col-lg-2 mb-3 fontSize-14 text-white cairo">
            <h5 class="lh-lg text-white cairo">About </h5>
            <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('web.about') }}">about us</a></li>
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('web.destination') }}">Destination</a></li>
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('web.home') }}#pills-review-tab">Testimonial</a></li>
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('web.home') }}#blog">news & article</a></li>
            </ul>
        </div>
        <div class="col-6 col-sm-4 fontSize-14 text-white col-lg-2 mb-3 cairo">
            <h5 class="lh-lg text-white cairo">Features</h5>
            <ul class="list-unstyled mb-md-4 mb-lg-0 text-white">
                {{-- <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="#!">payment</a></li> --}}
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('web.about') }}">Contact us</a></li>
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('dashboard.user.profile') }}">accounts</a></li>
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('login') }}">Login</a></li>
                <li class="lh-lg"><a class="text-900 text-decoration-none text-white" href="{{ route('register') }}">Sign Up</a></li>
            </ul>
        </div>
        <div class="col-12 col-sm-4 fontSize-14 text-white col-lg-4 mb-3 ps-xxl-7 ps-xl-5 cairo">
            <h5 class="lh-lg text-white cairo">Our company</h5>
            <ul class="list-unstyled mb-md-4 mb-lg-0 text-white">
                <li class="lh-lg text-white">
                    <a class="text-900 text-decoration-none text-white" href="#!">
                        <iframe
                            frameborder="0"
                            scrolling="no"
                            marginheight="0"
                            marginwidth="0"
                            allowfullscreen="true" loading="lazy" style="margin: auto;display: block;width=350height=100border:0;border-radius:5px"
                            src="https://maps.google.com/maps?q={{ App\Http\Controllers\Controller::aboutUs()->latitude }},{{ App\Http\Controllers\Controller::aboutUs()->longitude }}&z=14&amp;output=embed"
                        >
                        </iframe>
                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15860.402019600551!2d106.88036080822756!3d-6.381026973753211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1689082822164!5m2!1sid!2sid" width="350" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                    </a>
                </li>
                <li class="lh-lg">
                    <a class="text-900 text-decoration-none text-white" href="#!">
                        <iconify-icon icon="clarity:map-marker-line" style="color: white;"></iconify-icon>
                        <span>
                            {{ App\Http\Controllers\Controller::aboutUs()->address }}
                        </span>
                    </a>
                </li>
                <li class="lh-lg">
                    <a class="text-900 text-decoration-none text-white" href="#!">
                        <iconify-icon icon="solar:phone-outline" style="color: white;"></iconify-icon>
                        <span>
                            {{ App\Http\Controllers\Controller::aboutUs()->mobile_phone }}
                        </span>
                    </a>
                </li>
                <li class="lh-lg">
                    <a class="text-900 text-decoration-none text-white" href="#!">
                        <iconify-icon icon="mdi:email" style="color: white;"></iconify-icon>
                        <span>
                            {{ App\Http\Controllers\Controller::aboutUs()->email }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="opacity-25" />
        <div class="text-400 text-center text-white">
            {{-- <p>Made with&nbsp;
            <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" viewBox="0 0 16 16">
                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
            </svg>
            &nbsp;by&nbsp;<a class="text-900" href="{{ route('web.home') }}" target="_blank">Indecon</a>
            </p> --}}
        </div>
        </div>
    </div>
    <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->
<script src="{{ asset('assets/cms/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/cms/js/sweetalert2.all.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#button-subscribe').click(function() {
            var emailSubscribe = $('#emailSubscribe').val();
            if (emailSubscribe.length == 0) {
                Swal.fire('','Please fill your email address to subscribe','failed')
            };
            $.ajax({
                type: "post",
                url: "{{ route('subscribe.subscribeEmail') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'userId' : {{ \Auth::user()->id ?? '0' }},
                    'email' : emailSubscribe
                },
                dataType: "json",
                success: function (response) {
                    Swal.fire('Thank you!',response.message,'success')
                },
                error: function(xhr) {
                    var err = eval("(" + xhr.responseText + ")");
                    Swal.fire(JSON.stringify(err.message));
                }
            });
            console.log(emailSubscribe);
        })
    });
</script>
