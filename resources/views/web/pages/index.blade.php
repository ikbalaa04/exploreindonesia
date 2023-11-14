@extends('web.template.main')
@section('title','Explore Borneo Indonesia (indecon)')
@section('banner')
    <section class="pb-6 bg-banner-1">
        <div class="container">
        <div class="row flex-center">
            <div class="col-lg-6 col-md-5 order-md-1 pe-0 "><img class="img-fluid ps-7" src="{{ asset('assets/web/img/indecon/banner.png') }}" alt="" /></div>
            <div class="col-md-7 col-lg-6 mt-5 text-center text-md-start">
            <div class="fw-bold fontSize-40" style="color: #333;line-height: 124.5%;">
                Start your journey
                <br>
                by one click, explore
                <br>
                beautiful world!
            </div>
            <p class="mt-3 mb-4 fontSize-14">Plan and book your perfect trip with expert advice, travel tips, destination information and inspiration from us!</p>
            {{-- <a class="btn btn-lg btn-danger hover-top btn-glow" href="#">Get Started </a> --}}
            </div>
        </div>
        </div>
        <!-- end of .container-->
    </section>
@endsection
@section('content')
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-popular-destination py-4">
        <div class="container-lg">
            <div class="row justify-content-start">
            <div class="col-md-12 col-lg-12 text-left mb-3">
                <div class="lato fontSize-34 fw-bold">Popular Destinations</div>
                <p class="lato fontSize-14 mt-1">Vacations to make your experience enjoyable in Indonesia!</p>
            </div>
            </div>
            <div class="h-100 justify-content-center">
                <div class="card-group">
                <div class="card me-4">
                    <img src="{{ asset('assets/web/img/indecon/betangutik.jpg') }}" class="card-img-popular-destination" alt="...">
                    <div class="card-body lato">
                        <div class="card-title fontSize-10 text-gray"><iconify-icon icon="heroicons-solid:location-marker" style="color: #42a8c3;"></iconify-icon> Manggarai Barat</div>
                        <h5 class="card-title text-black fontSize-16">Flores Road Trip 3D2N</h5>
                        <p class="card-text text-gray fontSize-14">3 Days</p>
                        <p class="card-text text-blue fontSize-14 mt-4"><span class="fw-bold">Rp 6.705.000</span> /orang</p>
                    </div>
                </div>
                <div class="card me-4">
                    <img src="{{ asset('assets/web/img/indecon/hutansadap.jpg') }}" class="card-img-popular-destination" alt="...">
                    <div class="card-body lato">
                        <div class="card-title fontSize-10 text-gray"><iconify-icon icon="heroicons-solid:location-marker" style="color: #42a8c3;"></iconify-icon> Manggarai Barat</div>
                        <h5 class="card-title text-black fontSize-16">Flores Road Trip 3D2N</h5>
                        <p class="card-text text-gray fontSize-14">3 Days</p>
                        <p class="card-text text-blue fontSize-14 mt-4"><span class="fw-bold">Rp 6.705.000</span> /orang</p>
                    </div>
                </div>
                <div class="card me-4">
                    <img src="{{ asset('assets/web/img/indecon/sigending.jpg') }}" class="card-img-popular-destination" alt="...">
                    <div class="card-body lato">
                        <div class="card-title fontSize-10 text-gray"><iconify-icon icon="heroicons-solid:location-marker" style="color: #42a8c3;"></iconify-icon> Manggarai Barat</div>
                        <h5 class="card-title text-black fontSize-16">Flores Road Trip 3D2N</h5>
                        <p class="card-text text-gray fontSize-14">3 Days</p>
                        <p class="card-text text-blue fontSize-14 mt-4"><span class="fw-bold">Rp 6.705.000</span> /orang</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ asset('assets/web/img/indecon/hutansadap.jpg') }}" class="card-img-popular-destination" alt="...">
                    <div class="card-body lato">
                        <div class="card-title fontSize-10 text-gray"><iconify-icon icon="heroicons-solid:location-marker" style="color: #42a8c3;"></iconify-icon> Manggarai Barat</div>
                        <h5 class="card-title text-black fontSize-16">Flores Road Trip 3D2N</h5>
                        <p class="card-text text-gray fontSize-14">3 Days</p>
                        <p class="card-text text-blue fontSize-14 mt-4"><span class="fw-bold">Rp 6.705.000</span> /orang</p>
                    </div>
                </div>
              
                
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-4 bg-choose-us pt-md-6">

        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-5 col-lg-5 me-5 text-lg-center"><img class="img-fluid mb-5 mb-md-0" src="{{ asset('assets/web/img/indecon/illustrasi.png') }}" alt=""></div>
            <div class="col-md-7 lato col-lg-6 text-center ms-auto text-md-start">
              <div class="fontSize-34">Why Choose Us</div>
              <p class="fontSize-19">Enjoy different experiences in every place you visit and discover new and affordable adventures of course.</p>
                <div class="d-flex bg-choose-us-2 pe-4 ps-4 pt-3">
                    <!-- Media object -->
                    <div class="d-flex">
                        <div class="flex-shrink-0 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32" fill="none">
                                <path d="M6.78571 25.0547L1.83229 21.1585C1.5617 20.955 1.47311 20.5957 1.63552 20.3605C2.42944 19.2107 3.95884 18.818 5.46155 19.3781L9.94142 21.9194L6.78571 25.0547Z" fill="#42A8C3"/>
                                <path d="M8.448 26.7168L12.3544 31.6805C12.5579 31.9511 12.9172 32.0396 13.1524 31.8772L13.4477 31.6733C14.4202 31.0018 14.7523 29.7082 14.2786 28.4371L11.5935 23.5713L8.448 26.7168Z" fill="#42A8C3"/>
                                <path d="M7.07456 20.293L4.27197 23.0774L6.78556 25.0545L9.94134 21.9192L7.07456 20.293Z" fill="#219FC0"/>
                                <path d="M8.12735 9.79515C7.50527 9.17307 7.45606 8.18185 8.01181 7.49989C8.80671 6.52442 9.80262 5.43824 10.4 4.84082C11.2173 4.02353 11.2887 4.12117 12.1619 3.58592C12.2905 3.5071 12.4564 3.5261 12.563 3.63272L14.2899 5.35954C14.3965 5.46616 14.4154 5.63208 14.3367 5.76064C13.8014 6.63384 13.899 6.70518 13.0818 7.52247C12.4843 8.11989 11.3981 9.11579 10.4227 9.91069C9.74065 10.4664 8.74937 10.4172 8.12735 9.79515Z" fill="#FFBFAB"/>
                                <path d="M23.7172 25.385C23.0951 24.7629 23.0459 23.7717 23.6017 23.0897C24.3966 22.1143 25.3925 21.0281 25.9899 20.4307C26.8072 19.6134 26.8785 19.711 27.7518 19.1758C27.8803 19.0969 28.0462 19.1159 28.1529 19.2226L29.8797 20.9494C29.9863 21.056 30.0052 21.2219 29.9265 21.3505C29.3912 22.2237 29.4889 22.295 28.6716 23.1124C28.0742 23.7098 26.988 24.7057 26.0125 25.5006C25.3305 26.0563 24.3393 26.0071 23.7172 25.385Z" fill="#FFBFAB"/>
                                <path d="M15.9259 15.6836L22.0371 9.57231L3.10571 3.62422C2.71587 3.5247 2.32832 3.61947 2.07042 3.87737L0.470987 5.4768C-0.0646537 6.01244 0.165251 6.99435 0.921422 7.40039L15.9259 15.6836Z" fill="#42A8C3"/>
                                <path d="M17.7597 8.22852L12.304 13.6843L15.926 15.6837L22.0372 9.57247L17.7597 8.22852Z" fill="#219FC0"/>
                                <path d="M17.8289 17.5869L23.9401 11.4756L29.8882 30.407C29.9877 30.7968 29.893 31.1844 29.6351 31.4423L28.0356 33.0417C27.5 33.5774 26.5181 33.3475 26.112 32.5913L17.8289 17.5869Z" fill="#42A8C3"/>
                                <path d="M29.3638 8.90638L19.097 19.1731C17.3743 20.8958 15.5428 22.5027 13.6253 23.9736L8.74058 27.7208C7.60974 28.5884 6.26481 28.6933 5.54197 27.9705C4.81912 27.2476 4.92405 25.9027 5.7916 24.7719L9.5388 19.8871C11.0098 17.9696 12.6165 16.1382 14.3393 14.4154L24.6061 4.14869C26.0096 2.74518 27.6216 1.57581 29.3245 0.772965C30.7909 0.0816246 32.3497 -0.351496 33.1068 0.405652C33.864 1.1628 33.4308 2.72155 32.7395 4.18801C31.9367 5.891 30.7673 7.50287 29.3638 8.90638Z" fill="#E0F3FC"/>
                                <path d="M33.1068 0.405556C32.8403 0.13907 32.4742 0.0204729 32.0481 0.00830078C32.0787 0.796823 31.7368 1.79689 31.284 2.75739C30.4812 4.46025 29.3118 6.07219 27.9082 7.4757L17.6415 17.7424C15.9188 19.4651 14.0873 21.072 12.1698 22.5429L7.28508 26.2901C6.56581 26.8419 5.76011 27.0846 5.08276 27.0026C5.13367 27.3785 5.28539 27.7136 5.54199 27.9702C6.26483 28.6931 7.60976 28.5882 8.74059 27.7206L13.6253 23.9734C15.5428 22.5025 17.3742 20.8957 19.097 19.1729L29.3638 8.90622C30.7673 7.50271 31.9367 5.89078 32.7395 4.18791C33.4308 2.72146 33.8639 1.1627 33.1068 0.405556Z" fill="#C3D3DB"/>
                                <path d="M30.2145 6.94033L29.8639 7.29092C29.5383 7.61651 25.8962 3.97436 26.2217 3.64877L26.5723 3.29819C26.7933 3.0772 27.1177 3.00755 27.3818 3.12439C28.6979 3.70657 29.8061 4.81483 30.3883 6.13092C30.5051 6.39499 30.4355 6.71935 30.2145 6.94033Z" fill="#51C4F5"/>
                                <path d="M6.65126 27.3495C6.52635 27.3495 6.40137 27.3018 6.30608 27.2065C6.11542 27.0158 6.11542 26.7067 6.30608 26.5161L10.5693 22.2529C10.76 22.0622 11.0691 22.0622 11.2597 22.2529C11.4503 22.4435 11.4503 22.7526 11.2597 22.9432L6.99644 27.2065C6.90115 27.3018 6.77623 27.3495 6.65126 27.3495Z" fill="#42A8C3" fill-opacity="0.92"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3 lato">
                            <div class="fw-bold fontSize-18" style="line-height: 140%;letter-spacing: 0.15px;">Flight Ticket</div>
                            <p class="text-gray fontSize-14" style="line-height: 140%;letter-spacing: 0.5px;">Vitae donec pellentesque a aliquam et ultricies auctor. </p>
                        </div>
                    </div>
                    <!-- Media object -->
                </div>
                <div class="d-flex  pe-4 ps-4 pt-3">
                    <!-- Media object -->
                    <div class="d-flex">
                        <div class="flex-shrink-0 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" viewBox="0 0 37 37" fill="none">
                            <path d="M16.0303 0.630859H7.03203C6.44995 0.630859 5.97754 1.10327 5.97754 1.68535V7.33248C5.97754 7.91526 6.44995 8.38696 7.03203 8.38696H16.0303C16.6124 8.38696 17.0848 7.91526 17.0848 7.33248V1.68535C17.0848 1.10327 16.6124 0.630859 16.0303 0.630859ZM14.9758 6.27799L11.5025 7.89487L8.08651 6.27799V2.73983H14.9758V6.27799Z" fill="#525C74"/>
                            <path d="M17.0849 1.68535V7.33248C17.0849 7.91526 16.6125 8.38696 16.0304 8.38696H11.5024V7.96517L14.9759 6.27799V2.73983H11.5024V0.630859H16.0304C16.6125 0.630859 17.0849 1.10327 17.0849 1.68535Z" fill="#444E66"/>
                            <path d="M21.1622 10.1913L20.7404 33.0385C20.7404 35.0618 19.4595 35.2881 17.4363 35.2881L11.011 36.6238H8.04012L7.10233 36.2723L5.93114 36.6238H4.51532C2.49211 36.6238 0.845703 34.9774 0.845703 32.9542V12.9049L1.2675 11.8785L0.845703 10.7959V9.94669C0.845703 7.92348 2.49211 6.27637 4.51532 6.27637H5.97473L6.96173 6.95757L8.08651 6.27637H11.011L14.8352 7.80116L18.3502 7.02787C19.8809 11.6824 21.1558 8.22808 21.1622 10.1913Z" fill="#68B9CF"/>
                            <path d="M22.1592 9.94675V32.9541C22.1592 34.9775 20.5127 36.624 18.4893 36.624H11.5024V6.90955L12.6317 6.27686H18.4894C20.5128 6.27686 22.1592 7.92333 22.1592 9.94675Z" fill="#68B9CF"/>
                            <path d="M22.159 10.7959H13.1199V6.27637H11.011V10.7959H8.07723L8.0837 6.27637H5.97473L5.96826 10.7959H0.845703V12.9049H5.96524L5.93114 36.6238H8.04012L8.07421 12.9049H11.011V36.6238H13.1199V12.9049H22.159V10.7959Z" fill="#4AB7D3"/>
                            <path d="M22.1592 10.7936H12.6317V6.27686H11.5024V36.624H12.6317V12.9108H22.1592V10.7936Z" fill="#42A8C3"/>
                            <path d="M27.0063 15.3105H20.8409C18.8436 15.3105 17.219 16.9352 17.219 18.9324V20.886C17.219 21.4703 17.6932 21.9446 18.2776 21.9446H29.5696C30.154 21.9446 30.6282 21.4704 30.6282 20.886V18.9324C30.6282 16.9352 29.0036 15.3105 27.0063 15.3105ZM28.5109 19.8273L23.9236 20.8818L19.3362 19.8273V18.9324C19.3362 18.1025 20.0109 17.4277 20.8409 17.4277H27.0063C27.8363 17.4277 28.511 18.1024 28.511 18.9324V19.8273H28.5109Z" fill="#525C74"/>
                            <path d="M30.6285 18.9325V20.886C30.6285 21.4704 30.1542 21.9447 29.5698 21.9447H23.9238V21.1631L28.5112 19.8274V18.9325C28.5112 18.1025 27.8365 17.4278 27.0065 17.4278H23.9238V15.3105H27.0065C29.0039 15.3106 30.6285 16.9352 30.6285 18.9325Z" fill="#444E66"/>
                            <path d="M36.8389 22.8675V33.5836C36.8389 35.2597 35.4747 36.6239 33.7985 36.6239H14.0489C12.3728 36.6239 11.0085 35.2597 11.0085 33.5836V22.8675C11.0085 21.1914 12.3728 19.8271 14.0489 19.8271H33.7985C35.4747 19.8271 36.8389 21.1913 36.8389 22.8675Z" fill="#FFCAAF"/>
                            <path d="M36.839 22.8675V33.5836C36.839 35.2597 35.4748 36.6239 33.7987 36.6239H23.9238V19.8271H33.7987C35.4748 19.8271 36.839 21.1913 36.839 22.8675Z" fill="#FFBFAB"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3 lato">
                            <div class="fw-bold fontSize-18" style="line-height: 140%;letter-spacing: 0.15px;">Flight Ticket</div>
                            <p class="text-gray fontSize-14" style="line-height: 140%;letter-spacing: 0.5px;">Vitae donec pellentesque a aliquam et ultricies auctor. </p>
                        </div>
                    </div>
                    <!-- Media object -->
                </div>
                <div class="d-flex  pe-4 ps-4 pt-3">
                    <!-- Media object -->
                    <div class="d-flex">
                        <div class="flex-shrink-0 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41" fill="none">
                            <g clip-path="url(#clip0_440_19651)">
                                <path d="M9.67763 13.6484H0.845947V40.6433H9.67763V13.6484Z" fill="#E8EAEA"/>
                                <path d="M40.8383 13.6484H32.0066V40.6433H40.8383V13.6484Z" fill="#E8EAEA"/>
                                <path d="M0.845947 14.1484H40.8383C40.8383 13.1486 40.0051 12.3154 39.0053 12.3154H2.67896C1.67915 12.3154 0.845947 13.1486 0.845947 14.1484Z" fill="#FFA679"/>
                                <path d="M32.0069 9.14941H9.67773V40.6434H32.0069V9.14941Z" fill="#F2F2F2"/>
                                <path d="M33.2565 7.31641H8.42794C7.92804 7.31641 7.51147 7.73297 7.51147 8.23287C7.51147 8.73278 7.92804 9.14942 8.42794 9.14942H33.2566C33.7565 9.14942 34.173 8.73285 34.173 8.23295C34.173 7.73305 33.7564 7.31641 33.2565 7.31641Z" fill="#FFA679"/>
                                <path d="M7.17809 16.1479H3.34546V20.3971H7.17809V16.1479Z" fill="#42A8C3"/>
                                <path d="M7.17809 22.0635H3.34546V26.3127H7.17809V22.0635Z" fill="#42A8C3"/>
                                <path d="M7.17809 27.979H3.34546V32.2282H7.17809V27.979Z" fill="#42A8C3"/>
                                <path d="M7.17809 33.8945H3.34546V38.1437H7.17809V33.8945Z" fill="#42A8C3"/>
                                <path d="M38.3387 16.1479H34.5061V20.3971H38.3387V16.1479Z" fill="#42A8C3"/>
                                <path d="M38.3387 22.0635H34.5061V26.3127H38.3387V22.0635Z" fill="#42A8C3"/>
                                <path d="M38.3387 27.979H34.5061V32.2282H38.3387V27.979Z" fill="#42A8C3"/>
                                <path d="M38.3387 33.8945H34.5061V38.1437H38.3387V33.8945Z" fill="#42A8C3"/>
                                <path d="M16.3431 23.563H12.1772V27.8122H16.3431V23.563Z" fill="#8ECBDB"/>
                                <path d="M25.258 30.2285H16.343V40.6432H25.258V30.2285Z" fill="#056D8A"/>
                                <path d="M40.8383 38.8936H0.845947V40.6432H40.8383V38.8936Z" fill="#ACB3BA"/>
                                <path d="M16.3431 11.7319H12.1772V15.9811H16.3431V11.7319Z" fill="#8ECBDB"/>
                                <path d="M16.3431 17.6475H12.1772V21.8966H16.3431V17.6475Z" fill="#8ECBDB"/>
                                <path d="M22.9251 11.7319H18.7593V15.9811H22.9251V11.7319Z" fill="#8ECBDB"/>
                                <path d="M22.9251 17.6475H18.7593V21.8966H22.9251V17.6475Z" fill="#8ECBDB"/>
                                <path d="M22.9251 23.563H18.7593V27.8122H22.9251V23.563Z" fill="#8ECBDB"/>
                                <path d="M29.5074 11.7319H25.3416V15.9811H29.5074V11.7319Z" fill="#8ECBDB"/>
                                <path d="M29.5074 17.6475H25.3416V21.8966H29.5074V17.6475Z" fill="#8ECBDB"/>
                                <path d="M29.5074 23.563H25.3416V27.8122H29.5074V23.563Z" fill="#8ECBDB"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_440_19651">
                                <rect width="39.9924" height="39.9924" fill="white" transform="translate(0.845947 0.650879)"/>
                                </clipPath>
                            </defs>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3 lato">
                            <div class="fw-bold fontSize-18" style="line-height: 140%;letter-spacing: 0.15px;">Flight Ticket</div>
                            <p class="text-gray fontSize-14" style="line-height: 140%;letter-spacing: 0.5px;">Vitae donec pellentesque a aliquam et ultricies auctor. </p>
                        </div>
                    </div>
                    <!-- Media object -->
                </div>
                <div class="fontSize-19 fw-bolder ms-4 lato mt-3" style="color: #121212">
                    Another Product 
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path d="M9.84375 18.6144L15.8426 12.6156L9.84375 6.6167" stroke="black" stroke-width="1.99962" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

@endsection