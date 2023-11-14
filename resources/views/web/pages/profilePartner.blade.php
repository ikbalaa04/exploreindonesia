@extends('web.template.main')
@section('title','Dashboard user, your wishlist')
@push('after-style')

@endpush
@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-7 pt-md-8 bg-softWhite" style="padding-bottom: 4rem">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 mb-2">
                <img src="{{ asset('assets/web/img/indecon/backgroundDashboardUser.png') }}" alt="" class="img-fluid br-10">
            </div>

            <div class="col-12 ms-4">
                <div class="row">
                    <div class="col-3">
                        <div class="mb-2">
                            <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" class="img-fluid fit-cover br-100Persen ms-2 mt-n7" style="width: 100px;height:100px">
                        </div>
                        <div class="fontSize-20" style="color: #2F2F2F;font-style: normal;font-weight: 700;line-height: normal;">Lonely planet</div>
                        <div class="fontSize-14 mt-4" style="color:#5B5F62">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                <g clip-path="url(#clip0_456_7223)">
                                    <path d="M10.7129 5.9375C10.0454 5.9375 9.39286 6.13544 8.83784 6.50629C8.28283 6.87714 7.85024 7.40424 7.5948 8.02094C7.33935 8.63764 7.27252 9.31624 7.40274 9.97093C7.53297 10.6256 7.8544 11.227 8.32641 11.699C8.79841 12.171 9.39978 12.4924 10.0545 12.6227C10.7091 12.7529 11.3877 12.686 12.0044 12.4306C12.6212 12.1751 13.1483 11.7426 13.5191 11.1875C13.89 10.6325 14.0879 9.98001 14.0879 9.3125C14.0879 8.41739 13.7323 7.55895 13.0994 6.92601C12.4664 6.29308 11.608 5.9375 10.7129 5.9375ZM10.7129 11C10.3791 11 10.0529 10.901 9.77537 10.7156C9.49786 10.5302 9.28157 10.2666 9.15385 9.95828C9.02612 9.64993 8.9927 9.31063 9.05782 8.98329C9.12293 8.65594 9.28365 8.35526 9.51965 8.11926C9.75565 7.88326 10.0563 7.72254 10.3837 7.65742C10.711 7.59231 11.0503 7.62573 11.3587 7.75345C11.667 7.88118 11.9306 8.09747 12.116 8.37498C12.3014 8.65248 12.4004 8.97874 12.4004 9.3125C12.4004 9.76005 12.2226 10.1893 11.9061 10.5057C11.5897 10.8222 11.1604 11 10.7129 11Z" fill="#FFC656"/>
                                    <path d="M10.7129 21.1252C10.0024 21.1289 9.30141 20.9622 8.66856 20.6393C8.03571 20.3163 7.48944 19.8464 7.0755 19.269C3.85997 14.8334 2.229 11.4989 2.229 9.35744C2.229 7.10737 3.12284 4.94946 4.71388 3.35841C6.30492 1.76737 8.46284 0.873535 10.7129 0.873535C12.963 0.873535 15.1209 1.76737 16.7119 3.35841C18.303 4.94946 19.1968 7.10737 19.1968 9.35744C19.1968 11.4989 17.5658 14.8334 14.3503 19.269C13.9364 19.8464 13.3901 20.3163 12.7573 20.6393C12.1244 20.9622 11.4234 21.1289 10.7129 21.1252ZM10.7129 2.71544C8.95151 2.71745 7.26283 3.41805 6.01733 4.66355C4.77184 5.90905 4.07123 7.59773 4.06922 9.35913C4.06922 11.0551 5.66644 14.1913 8.56557 18.1898C8.81168 18.5288 9.13457 18.8047 9.50779 18.995C9.88102 19.1852 10.294 19.2844 10.7129 19.2844C11.1318 19.2844 11.5448 19.1852 11.918 18.995C12.2913 18.8047 12.6141 18.5288 12.8603 18.1898C15.7594 14.1913 17.3566 11.0551 17.3566 9.35913C17.3546 7.59773 16.654 5.90905 15.4085 4.66355C14.163 3.41805 12.4743 2.71745 10.7129 2.71544Z" fill="#FFC656"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_7223">
                                    <rect width="20.25" height="20.25" fill="white" transform="translate(0.587891 0.875)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="ps-1">Kalimantan</span>
                        </div>
                        <div class="fontSize-14 my-3" style="color:#5B5F62">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                <path d="M11.5415 1.71977C11.5415 1.49563 11.6305 1.28066 11.789 1.12217C11.9475 0.963681 12.1625 0.874641 12.3866 0.874641C14.6273 0.877101 16.7755 1.76829 18.3599 3.35268C19.9442 4.93707 20.8354 7.08525 20.8379 9.32591C20.8379 9.55005 20.7489 9.76501 20.5904 9.92351C20.4319 10.082 20.2169 10.171 19.9928 10.171C19.7686 10.171 19.5537 10.082 19.3952 9.92351C19.2367 9.76501 19.1476 9.55005 19.1476 9.32591C19.1456 7.5334 18.4327 5.81487 17.1652 4.54737C15.8977 3.27987 14.1791 2.56691 12.3866 2.56489C12.1625 2.56489 11.9475 2.47585 11.789 2.31736C11.6305 2.15887 11.5415 1.94391 11.5415 1.71977ZM12.3866 5.9454C13.2832 5.9454 14.143 6.30156 14.777 6.93553C15.411 7.5695 15.7671 8.42935 15.7671 9.32591C15.7671 9.55005 15.8562 9.76501 16.0147 9.92351C16.1732 10.082 16.3881 10.171 16.6123 10.171C16.8364 10.171 17.0514 10.082 17.2099 9.92351C17.3683 9.76501 17.4574 9.55005 17.4574 9.32591C17.456 7.98147 16.9214 6.69249 15.9707 5.74182C15.0201 4.79116 13.7311 4.25649 12.3866 4.25515C12.1625 4.25515 11.9475 4.34419 11.789 4.50268C11.6305 4.66117 11.5415 4.87613 11.5415 5.10028C11.5415 5.32442 11.6305 5.53938 11.789 5.69787C11.9475 5.85636 12.1625 5.9454 12.3866 5.9454ZM20.0714 15.0212C20.5611 15.5123 20.8362 16.1776 20.8362 16.8712C20.8362 17.5648 20.5611 18.2301 20.0714 18.7212L19.3023 19.6077C12.3807 26.2344 -4.46265 9.39521 2.06173 2.45165L3.03362 1.60652C3.52529 1.13044 4.18462 0.867076 4.86898 0.873402C5.55334 0.879729 6.2077 1.15524 6.69048 1.64033C6.71668 1.66652 8.2827 3.70075 8.2827 3.70075C8.74737 4.18891 9.00605 4.83738 9.00494 5.51135C9.00384 6.18532 8.74305 6.83293 8.27678 7.31958L7.29813 8.55009C7.83972 9.86604 8.63601 11.062 9.64125 12.0693C10.6465 13.0765 11.8408 13.8752 13.1557 14.4195L14.3938 13.4349C14.8805 12.969 15.528 12.7085 16.2018 12.7076C16.8755 12.7066 17.5238 12.9653 18.0118 13.4298C18.0118 13.4298 20.0452 14.995 20.0714 15.0212ZM18.9085 16.25C18.9085 16.25 16.8861 14.6942 16.8599 14.668C16.6858 14.4953 16.4505 14.3985 16.2053 14.3985C15.9601 14.3985 15.7249 14.4953 15.5508 14.668C15.528 14.6916 13.8233 16.0497 13.8233 16.0497C13.7085 16.1412 13.5718 16.2011 13.4267 16.2236C13.2816 16.2462 13.1332 16.2305 12.996 16.1782C11.2926 15.544 9.74539 14.5511 8.45919 13.2668C7.17299 11.9825 6.17783 10.4368 5.54111 8.73432C5.48465 8.59526 5.46625 8.44367 5.48779 8.29514C5.50932 8.14661 5.57002 8.0065 5.66365 7.8892C5.66365 7.8892 7.02177 6.18373 7.04459 6.16176C7.21722 5.98765 7.31408 5.75239 7.31408 5.50721C7.31408 5.26202 7.21722 5.02676 7.04459 4.85265C7.01839 4.8273 5.46251 2.80322 5.46251 2.80322C5.2858 2.64477 5.05517 2.5599 4.81789 2.56603C4.58062 2.57216 4.35467 2.66881 4.18637 2.83618L3.21448 3.68131C-1.55372 9.41465 13.0424 23.2012 18.0667 18.4533L18.8366 17.5659C19.017 17.3988 19.1254 17.1681 19.1388 16.9225C19.1522 16.6769 19.0696 16.4358 18.9085 16.25Z" fill="#FFC656"/>
                            </svg>
                            <span class="ps-1">08829677635</span>
                        </div>
                        <div class="fontSize-14" style="color:#5B5F62">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                <g clip-path="url(#clip0_456_7225)">
                                    <path d="M14.9629 1.62476H4.46289C3.46869 1.62595 2.51556 2.02142 1.81256 2.72442C1.10955 3.42742 0.714082 4.38056 0.712891 5.37476L0.712891 14.3748C0.714082 15.369 1.10955 16.3221 1.81256 17.0251C2.51556 17.7281 3.46869 18.1236 4.46289 18.1248H14.9629C15.9571 18.1236 16.9102 17.7281 17.6132 17.0251C18.3162 16.3221 18.7117 15.369 18.7129 14.3748V5.37476C18.7117 4.38056 18.3162 3.42742 17.6132 2.72442C16.9102 2.02142 15.9571 1.62595 14.9629 1.62476ZM4.46289 3.12476H14.9629C15.412 3.12564 15.8505 3.26089 16.2221 3.51311C16.5937 3.76533 16.8813 4.12297 17.0479 4.54001L11.3044 10.2843C10.8817 10.7052 10.3095 10.9416 9.71289 10.9416C9.11633 10.9416 8.54407 10.7052 8.12139 10.2843L2.37789 4.54001C2.5445 4.12297 2.8321 3.76533 3.20368 3.51311C3.57525 3.26089 4.0138 3.12564 4.46289 3.12476ZM14.9629 16.6248H4.46289C3.86615 16.6248 3.29386 16.3877 2.8719 15.9657C2.44994 15.5438 2.21289 14.9715 2.21289 14.3748V6.49976L7.06089 11.3448C7.76486 12.0469 8.71858 12.4413 9.71289 12.4413C10.7072 12.4413 11.6609 12.0469 12.3649 11.3448L17.2129 6.49976V14.3748C17.2129 14.9715 16.9758 15.5438 16.5539 15.9657C16.1319 16.3877 15.5596 16.6248 14.9629 16.6248Z" fill="#FFC656"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_7225">
                                    <rect width="18" height="18" fill="white" transform="translate(0.712891 0.875)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="ps-1">lonely_planet@gail.com</span>
                        </div>
                        
                    </div>
                    <div class="col-4 mt-4 pt-2">
                        <div class="fontSize-16" style="color: #2F2F2F;">About</div>
                        <div class="text-dark fontSize-12 mt-2">Lorem ipsum dolor sit amet consectetur. Fermentum tristique eu amet morbi nulla sapien viverra tortor habitant. Dignissim sit turpis tellus gravida dolor nisi vitae egestas aliquet. Et ut sed mauris ipsum vitae consectetur pellentesque in mattis. Ultrices pharetra id orci mauris gravida. Fermentum magna.</div>
                    </div>
                    <div class="col-5 mt-4 pt-2">
                        <div class="row">
                            <div class="col-3 pe-0">
                                <div class="text-yellow-star fontSize-28">
                                <svg xmlns="http://www.w3.org/2000/svg" width="43" height="40" viewBox="0 5 43 40" fill="none">
                                    <path d="M14.9006 28.6328L8.48338 33.2676C8.16542 33.5137 7.81854 33.6302 7.44276 33.617C7.06698 33.6039 6.73456 33.5011 6.44549 33.3086C6.15643 33.1172 5.9327 32.8574 5.77429 32.5293C5.61588 32.2012 5.60837 31.8457 5.75174 31.4629L8.22323 23.875L1.93612 19.6504C1.58924 19.4316 1.37245 19.1445 1.28573 18.7891C1.19901 18.4336 1.21346 18.1055 1.32909 17.8047C1.44471 17.5039 1.64706 17.237 1.93612 17.0041C2.22518 16.7711 2.57206 16.6552 2.97674 16.6563H10.7381L13.2529 8.78126C13.3974 8.39845 13.6218 8.10423 13.9259 7.8986C14.2299 7.69298 14.5549 7.59071 14.9006 7.59181C15.2474 7.59181 15.5729 7.69462 15.877 7.90024C16.1811 8.10587 16.4049 8.39954 16.5482 8.78126L19.0631 16.6563H26.8244C27.2291 16.6563 27.576 16.7727 27.865 17.0057C28.1541 17.2387 28.3564 17.505 28.4721 17.8047C28.5877 18.1055 28.6021 18.4336 28.5154 18.7891C28.4287 19.1445 28.2119 19.4316 27.865 19.6504L21.5779 23.875L24.0494 31.4629C24.1939 31.8457 24.187 32.2012 24.0286 32.5293C23.8702 32.8574 23.6459 33.1172 23.3556 33.3086C23.0666 33.5 22.7342 33.6028 22.3584 33.617C21.9826 33.6313 21.6357 33.5148 21.3178 33.2676L14.9006 28.6328Z" fill="#FFC62B"/>
                                </svg>
                                <span class="fw-bold ms-n3">5.0</span>
                                </div>
                                <div class="text-start fontSize-14" style="color: #999;">234 reviews</div>
                            </div>
                            <div class="col-8">
                                <div class="row align-items-center">
                                    <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                        Excellent
                                    </div>
                                    <div class="col-8">
                                        <div class="progress-review" style="width: 25%">
                                            <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">25</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                        Excellent
                                    </div>
                                    <div class="col-8">
                                        <div class="progress-review" style="width: 80%">
                                            <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">80</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                        Excellent
                                    </div>
                                    <div class="col-8">
                                        <div class="progress-review" style="width: 10%">
                                            <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">10</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                        Excellent
                                    </div>
                                    <div class="col-8">
                                        <div class="progress-review" style="width: 100%">
                                            <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">100</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

            </div>

            
        </div>
    </div>
    <!-- end of .container-->
        
</section>
<!-- <section> close ============================-->
<!-- card recomendation trip -->
<section class="bg-softWhite pt-0 pb-5">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-5 fontSize-20" style="color: #2F2F2F;font-weight: 500;">
                Rekomendasi
            </div>
            <div class="col-7 text-end">
                <a href="" class="btn btn-outline-yellow w-40 fontSize-14 br-5 text-yellow uppercase">
                    chat now
                </a>
            </div>

            <div class="col-12 bg-white mt-4 br-10 p-4" style="border: 2px solid #FFF;">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('assets/web/img/indecon/sigending.jpg') }}" alt="" class="img-fluid fit-cover br-10">
                    </div>
                    <div class="col-5 ms-2">
                        <div class="fw-semi-bold fontSize-22 inter mt-1" style="color: #2D3134;">Keliling Banjarmasin</div>
                        <div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10.2767 14.261L7.28905 16.5421C7.14101 16.6632 6.97952 16.7206 6.80457 16.7141C6.62962 16.7077 6.47485 16.6571 6.34028 16.5623C6.2057 16.4681 6.10154 16.3403 6.02779 16.1788C5.95404 16.0173 5.95054 15.8423 6.01729 15.6539L7.16793 11.9194L4.24086 9.84016C4.07937 9.73249 3.97844 9.59119 3.93806 9.41624C3.89769 9.24128 3.90442 9.07979 3.95825 8.93176C4.01208 8.78372 4.10629 8.65237 4.24086 8.53771C4.37544 8.42305 4.53693 8.36599 4.72534 8.36653H8.33876L9.50958 4.49069C9.57687 4.30228 9.6813 4.15748 9.82288 4.05627C9.96445 3.95507 10.1157 3.90474 10.2767 3.90528C10.4382 3.90528 10.5897 3.95588 10.7313 4.05708C10.8729 4.15828 10.977 4.30282 11.0438 4.49069L12.2146 8.36653H15.828C16.0164 8.36653 16.1779 8.42386 16.3125 8.53852C16.4471 8.65318 16.5413 8.78426 16.5951 8.93176C16.6489 9.07979 16.6557 9.24128 16.6153 9.41624C16.5749 9.59119 16.474 9.73249 16.3125 9.84016L13.3854 11.9194L14.5361 15.6539C14.6033 15.8423 14.6001 16.0173 14.5264 16.1788C14.4526 16.3403 14.3482 16.4681 14.2131 16.5623C14.0785 16.6565 13.9237 16.7071 13.7488 16.7141C13.5738 16.7211 13.4123 16.6638 13.2643 16.5421L10.2767 14.261Z" fill="#FFC62B"/>
                                </svg>
                            </span>
                            <span class="text-yellow-star fontSize-14">
                                4.8
                            </span>
                            <span class="fontSize-10" style="color: #999;">60 Review</span>
                        </div>
                        <div class="fontSize-12 fw-normal" style="color: #2F2F2F;">By Lonely planet</div>
                        <div class="fw-light fontSize-14 mt-5" style="color: #000;">
                            Lorem ipsum dolor sit amet consectetur. Risus fames ultricies volutpat donec nisl. Faucibus turpis sed ac ullamcorper sed ante pulvinar et. Et ultrices amet amet.
                        </div>
                    </div>
                    <div class="col-3 ms-auto me-3">
                        <div class="text-end">
                            <a href="" class="pe-1"><iconify-icon icon="ri:share-line" style="color: #ffc656;" width="38" height="38"></iconify-icon></a>
                            <a href=""><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="38" height="38"></iconify-icon></a>
                        </div>
                        <div class="fontSize-12 mt-1" style="color: ##999999;">
                            From
                        </div>
                        <div>
                            <sup class="fontSize-16" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">$</sup>
                            <span class="fontSize-28" style="color: #1D1D1D;font-weight: 600;">70</span>
                            <sup class="fontSize-16" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">USD</sup>
                            <sub class="fontSize-14" style="color: #999;font-style: normal;font-weight: 500;line-height: normal;">/Person</sub>
                        </div>
                        <div class="fontSize-12 fw-light mt-4 mb-3" style="color: #5B5F62;">*Paket ini Tidak Bisa dibatalkan</div>
                        <div class="mt-3">
                            <a href="" class="bg-yellow br-10 uppercase p-2 fontSize-12 d-block text-white text-center" style="opacity: 0.699999988079071;backdrop-filter: blur(33.75px);">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 bg-white mt-4 br-10 p-4" style="border: 2px solid #FFF;">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ asset('assets/web/img/indecon/sigending.jpg') }}" alt="" class="img-fluid fit-cover br-10">
                    </div>
                    <div class="col-5 ms-2">
                        <div class="fw-semi-bold fontSize-22 inter mt-1" style="color: #2D3134;">Keliling Banjarmasin</div>
                        <div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M10.2767 14.261L7.28905 16.5421C7.14101 16.6632 6.97952 16.7206 6.80457 16.7141C6.62962 16.7077 6.47485 16.6571 6.34028 16.5623C6.2057 16.4681 6.10154 16.3403 6.02779 16.1788C5.95404 16.0173 5.95054 15.8423 6.01729 15.6539L7.16793 11.9194L4.24086 9.84016C4.07937 9.73249 3.97844 9.59119 3.93806 9.41624C3.89769 9.24128 3.90442 9.07979 3.95825 8.93176C4.01208 8.78372 4.10629 8.65237 4.24086 8.53771C4.37544 8.42305 4.53693 8.36599 4.72534 8.36653H8.33876L9.50958 4.49069C9.57687 4.30228 9.6813 4.15748 9.82288 4.05627C9.96445 3.95507 10.1157 3.90474 10.2767 3.90528C10.4382 3.90528 10.5897 3.95588 10.7313 4.05708C10.8729 4.15828 10.977 4.30282 11.0438 4.49069L12.2146 8.36653H15.828C16.0164 8.36653 16.1779 8.42386 16.3125 8.53852C16.4471 8.65318 16.5413 8.78426 16.5951 8.93176C16.6489 9.07979 16.6557 9.24128 16.6153 9.41624C16.5749 9.59119 16.474 9.73249 16.3125 9.84016L13.3854 11.9194L14.5361 15.6539C14.6033 15.8423 14.6001 16.0173 14.5264 16.1788C14.4526 16.3403 14.3482 16.4681 14.2131 16.5623C14.0785 16.6565 13.9237 16.7071 13.7488 16.7141C13.5738 16.7211 13.4123 16.6638 13.2643 16.5421L10.2767 14.261Z" fill="#FFC62B"/>
                                </svg>
                            </span>
                            <span class="text-yellow-star fontSize-14">
                                4.8
                            </span>
                            <span class="fontSize-10" style="color: #999;">60 Review</span>
                        </div>
                        <div class="fontSize-12 fw-normal" style="color: #2F2F2F;">By Lonely planet</div>
                        <div class="fw-light fontSize-14 mt-5" style="color: #000;">
                            Lorem ipsum dolor sit amet consectetur. Risus fames ultricies volutpat donec nisl. Faucibus turpis sed ac ullamcorper sed ante pulvinar et. Et ultrices amet amet.
                        </div>
                    </div>
                    <div class="col-3 ms-auto me-3">
                        <div class="text-end">
                            <a href="" class="pe-1"><iconify-icon icon="ri:share-line" style="color: #ffc656;" width="38" height="38"></iconify-icon></a>
                            <a href=""><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="38" height="38"></iconify-icon></a>
                        </div>
                        <div class="fontSize-12 mt-1" style="color: ##999999;">
                            From
                        </div>
                        <div>
                            <sup class="fontSize-16" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">$</sup>
                            <span class="fontSize-28" style="color: #1D1D1D;font-weight: 600;">70</span>
                            <sup class="fontSize-16" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">USD</sup>
                            <sub class="fontSize-14" style="color: #999;font-style: normal;font-weight: 500;line-height: normal;">/Person</sub>
                        </div>
                        <div class="fontSize-12 fw-light mt-4 mb-3" style="color: #5B5F62;">*Paket ini Tidak Bisa dibatalkan</div>
                        <div class="mt-3">
                            <a href="" class="bg-yellow br-10 uppercase p-2 fontSize-12 d-block text-white text-center" style="opacity: 0.699999988079071;backdrop-filter: blur(33.75px);">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- grid recomendation trip -->
<section class="pt-0 pb-5 bg-softWhite">
    <div class="container-lg">
        <div class="h-100 justify-content-center">
            <div class="card-group">
                <div class="card me-4">
                    <div class="img-text-container">
                        <img src="{{ asset('assets/web/img/indecon/betangutik.jpg') }}" class="card-img-top" alt="...">
                        <div class="inner">
                            <div class="text-yellow-star fontSize-14">
                                <iconify-icon icon="ic:round-star"></iconify-icon> 5.0
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                    <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">Keliling Banjarmasin</div>
                    <p class="card-text poppins fontSize-10 modal-open">Bukit rimpi, danau Biru, danau seran, danau sriambun, penjemputan, dan makanan</p>
                    <p class="card-text pt-5">
                        <small class="text-muted">$70 /Person</small>
                        <span>
                            <button class="btn-none float-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                <g clip-path="url(#clip0_456_11141)">
                                    <path d="M18.9001 22.2195C18.5597 22.2185 18.2229 22.1502 17.9091 22.0183C17.5953 21.8864 17.3107 21.6937 17.0718 21.4511L11.4128 15.8253L5.75388 21.4548C5.39045 21.8236 4.92435 22.0742 4.41636 22.1742C3.90837 22.2742 3.38204 22.2188 2.906 22.0152C2.42524 21.8218 2.01395 21.488 1.72586 21.0572C1.43778 20.6265 1.28627 20.1189 1.29113 19.6007V4.73652C1.29113 3.51632 1.77585 2.34609 2.63867 1.48328C3.50148 0.620466 4.67171 0.135742 5.89191 0.135742L16.9338 0.135742C17.538 0.135742 18.1362 0.254745 18.6944 0.485956C19.2526 0.717166 19.7598 1.05606 20.187 1.48328C20.6142 1.9105 20.9531 2.41769 21.1843 2.97588C21.4156 3.53407 21.5346 4.13234 21.5346 4.73652V19.6007C21.5397 20.1185 21.3887 20.6258 21.1013 21.0565C20.8139 21.4871 20.4034 21.8212 19.9234 22.0152C19.5993 22.1507 19.2514 22.2202 18.9001 22.2195ZM5.89191 1.97605C5.15979 1.97605 4.45765 2.26689 3.93996 2.78458C3.42227 3.30226 3.13144 4.0044 3.13144 4.73652V19.6007C3.13111 19.754 3.17622 19.904 3.26109 20.0317C3.34596 20.1594 3.46677 20.2591 3.60826 20.3182C3.74975 20.3773 3.90557 20.3931 4.05605 20.3637C4.20653 20.3342 4.34491 20.2608 4.4537 20.1528L10.7687 13.8764C10.9411 13.705 11.1744 13.6089 11.4174 13.6089C11.6605 13.6089 11.8937 13.705 12.0662 13.8764L18.3738 20.151C18.4826 20.259 18.621 20.3324 18.7715 20.3618C18.922 20.3913 19.0778 20.3754 19.2193 20.3164C19.3608 20.2573 19.4816 20.1576 19.5664 20.0299C19.6513 19.9022 19.6964 19.7522 19.6961 19.5989V4.73652C19.6961 4.0044 19.4052 3.30226 18.8876 2.78458C18.3699 2.26689 17.6677 1.97605 16.9356 1.97605H5.89191Z" fill="#FFC656"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_11141">
                                    <rect width="22.0837" height="22.0837" fill="white" transform="translate(0.37085 0.135742)"/>
                                    </clipPath>
                                </defs>
                                </svg>
                            </button>
                        </span>
                    </p>
                    </div>
                </div>
                <div class="card me-4">
                    <div class="img-text-container">
                        <img src="{{ asset('assets/web/img/indecon/betangutik.jpg') }}" class="card-img-top" alt="...">
                        <div class="inner">
                            <div class="text-yellow-star fontSize-14">
                                <iconify-icon icon="ic:round-star"></iconify-icon> 5.0
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                    <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">Keliling Banjarmasin</div>
                    <p class="card-text poppins fontSize-10 modal-open">Bukit rimpi, danau Biru, danau seran, danau sriambun, penjemputan, dan makanan</p>
                    <p class="card-text pt-5">
                        <small class="text-muted">$70 /Person</small>
                        <span>
                            <button class="btn-none float-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                <g clip-path="url(#clip0_456_11141)">
                                    <path d="M18.9001 22.2195C18.5597 22.2185 18.2229 22.1502 17.9091 22.0183C17.5953 21.8864 17.3107 21.6937 17.0718 21.4511L11.4128 15.8253L5.75388 21.4548C5.39045 21.8236 4.92435 22.0742 4.41636 22.1742C3.90837 22.2742 3.38204 22.2188 2.906 22.0152C2.42524 21.8218 2.01395 21.488 1.72586 21.0572C1.43778 20.6265 1.28627 20.1189 1.29113 19.6007V4.73652C1.29113 3.51632 1.77585 2.34609 2.63867 1.48328C3.50148 0.620466 4.67171 0.135742 5.89191 0.135742L16.9338 0.135742C17.538 0.135742 18.1362 0.254745 18.6944 0.485956C19.2526 0.717166 19.7598 1.05606 20.187 1.48328C20.6142 1.9105 20.9531 2.41769 21.1843 2.97588C21.4156 3.53407 21.5346 4.13234 21.5346 4.73652V19.6007C21.5397 20.1185 21.3887 20.6258 21.1013 21.0565C20.8139 21.4871 20.4034 21.8212 19.9234 22.0152C19.5993 22.1507 19.2514 22.2202 18.9001 22.2195ZM5.89191 1.97605C5.15979 1.97605 4.45765 2.26689 3.93996 2.78458C3.42227 3.30226 3.13144 4.0044 3.13144 4.73652V19.6007C3.13111 19.754 3.17622 19.904 3.26109 20.0317C3.34596 20.1594 3.46677 20.2591 3.60826 20.3182C3.74975 20.3773 3.90557 20.3931 4.05605 20.3637C4.20653 20.3342 4.34491 20.2608 4.4537 20.1528L10.7687 13.8764C10.9411 13.705 11.1744 13.6089 11.4174 13.6089C11.6605 13.6089 11.8937 13.705 12.0662 13.8764L18.3738 20.151C18.4826 20.259 18.621 20.3324 18.7715 20.3618C18.922 20.3913 19.0778 20.3754 19.2193 20.3164C19.3608 20.2573 19.4816 20.1576 19.5664 20.0299C19.6513 19.9022 19.6964 19.7522 19.6961 19.5989V4.73652C19.6961 4.0044 19.4052 3.30226 18.8876 2.78458C18.3699 2.26689 17.6677 1.97605 16.9356 1.97605H5.89191Z" fill="#FFC656"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_11141">
                                    <rect width="22.0837" height="22.0837" fill="white" transform="translate(0.37085 0.135742)"/>
                                    </clipPath>
                                </defs>
                                </svg>
                            </button>
                        </span>
                    </p>
                    </div>
                </div>
                <div class="card me-4">
                    <div class="img-text-container">
                        <img src="{{ asset('assets/web/img/indecon/betangutik.jpg') }}" class="card-img-top" alt="...">
                        <div class="inner">
                            <div class="text-yellow-star fontSize-14">
                                <iconify-icon icon="ic:round-star"></iconify-icon> 5.0
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                    <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">Keliling Banjarmasin</div>
                    <p class="card-text poppins fontSize-10 modal-open">Bukit rimpi, danau Biru, danau seran, danau sriambun, penjemputan, dan makanan</p>
                    <p class="card-text pt-5">
                        <small class="text-muted">$70 /Person</small>
                        <span>
                            <button class="btn-none float-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                <g clip-path="url(#clip0_456_11141)">
                                    <path d="M18.9001 22.2195C18.5597 22.2185 18.2229 22.1502 17.9091 22.0183C17.5953 21.8864 17.3107 21.6937 17.0718 21.4511L11.4128 15.8253L5.75388 21.4548C5.39045 21.8236 4.92435 22.0742 4.41636 22.1742C3.90837 22.2742 3.38204 22.2188 2.906 22.0152C2.42524 21.8218 2.01395 21.488 1.72586 21.0572C1.43778 20.6265 1.28627 20.1189 1.29113 19.6007V4.73652C1.29113 3.51632 1.77585 2.34609 2.63867 1.48328C3.50148 0.620466 4.67171 0.135742 5.89191 0.135742L16.9338 0.135742C17.538 0.135742 18.1362 0.254745 18.6944 0.485956C19.2526 0.717166 19.7598 1.05606 20.187 1.48328C20.6142 1.9105 20.9531 2.41769 21.1843 2.97588C21.4156 3.53407 21.5346 4.13234 21.5346 4.73652V19.6007C21.5397 20.1185 21.3887 20.6258 21.1013 21.0565C20.8139 21.4871 20.4034 21.8212 19.9234 22.0152C19.5993 22.1507 19.2514 22.2202 18.9001 22.2195ZM5.89191 1.97605C5.15979 1.97605 4.45765 2.26689 3.93996 2.78458C3.42227 3.30226 3.13144 4.0044 3.13144 4.73652V19.6007C3.13111 19.754 3.17622 19.904 3.26109 20.0317C3.34596 20.1594 3.46677 20.2591 3.60826 20.3182C3.74975 20.3773 3.90557 20.3931 4.05605 20.3637C4.20653 20.3342 4.34491 20.2608 4.4537 20.1528L10.7687 13.8764C10.9411 13.705 11.1744 13.6089 11.4174 13.6089C11.6605 13.6089 11.8937 13.705 12.0662 13.8764L18.3738 20.151C18.4826 20.259 18.621 20.3324 18.7715 20.3618C18.922 20.3913 19.0778 20.3754 19.2193 20.3164C19.3608 20.2573 19.4816 20.1576 19.5664 20.0299C19.6513 19.9022 19.6964 19.7522 19.6961 19.5989V4.73652C19.6961 4.0044 19.4052 3.30226 18.8876 2.78458C18.3699 2.26689 17.6677 1.97605 16.9356 1.97605H5.89191Z" fill="#FFC656"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_11141">
                                    <rect width="22.0837" height="22.0837" fill="white" transform="translate(0.37085 0.135742)"/>
                                    </clipPath>
                                </defs>
                                </svg>
                            </button>
                        </span>
                    </p>
                    </div>
                </div>
                <div class="card">
                    <div class="img-text-container">
                        <img src="{{ asset('assets/web/img/indecon/betangutik.jpg') }}" class="card-img-top" alt="...">
                        <div class="inner">
                            <div class="text-yellow-star fontSize-14">
                                <iconify-icon icon="ic:round-star"></iconify-icon> 5.0
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                    <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">Keliling Banjarmasin</div>
                    <p class="card-text poppins fontSize-10 modal-open">Bukit rimpi, danau Biru, danau seran, danau sriambun, penjemputan, dan makanan</p>
                    <p class="card-text pt-5">
                        <small class="text-muted">$70 /Person</small>
                        <span>
                            <button class="btn-none float-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                <g clip-path="url(#clip0_456_11141)">
                                    <path d="M18.9001 22.2195C18.5597 22.2185 18.2229 22.1502 17.9091 22.0183C17.5953 21.8864 17.3107 21.6937 17.0718 21.4511L11.4128 15.8253L5.75388 21.4548C5.39045 21.8236 4.92435 22.0742 4.41636 22.1742C3.90837 22.2742 3.38204 22.2188 2.906 22.0152C2.42524 21.8218 2.01395 21.488 1.72586 21.0572C1.43778 20.6265 1.28627 20.1189 1.29113 19.6007V4.73652C1.29113 3.51632 1.77585 2.34609 2.63867 1.48328C3.50148 0.620466 4.67171 0.135742 5.89191 0.135742L16.9338 0.135742C17.538 0.135742 18.1362 0.254745 18.6944 0.485956C19.2526 0.717166 19.7598 1.05606 20.187 1.48328C20.6142 1.9105 20.9531 2.41769 21.1843 2.97588C21.4156 3.53407 21.5346 4.13234 21.5346 4.73652V19.6007C21.5397 20.1185 21.3887 20.6258 21.1013 21.0565C20.8139 21.4871 20.4034 21.8212 19.9234 22.0152C19.5993 22.1507 19.2514 22.2202 18.9001 22.2195ZM5.89191 1.97605C5.15979 1.97605 4.45765 2.26689 3.93996 2.78458C3.42227 3.30226 3.13144 4.0044 3.13144 4.73652V19.6007C3.13111 19.754 3.17622 19.904 3.26109 20.0317C3.34596 20.1594 3.46677 20.2591 3.60826 20.3182C3.74975 20.3773 3.90557 20.3931 4.05605 20.3637C4.20653 20.3342 4.34491 20.2608 4.4537 20.1528L10.7687 13.8764C10.9411 13.705 11.1744 13.6089 11.4174 13.6089C11.6605 13.6089 11.8937 13.705 12.0662 13.8764L18.3738 20.151C18.4826 20.259 18.621 20.3324 18.7715 20.3618C18.922 20.3913 19.0778 20.3754 19.2193 20.3164C19.3608 20.2573 19.4816 20.1576 19.5664 20.0299C19.6513 19.9022 19.6964 19.7522 19.6961 19.5989V4.73652C19.6961 4.0044 19.4052 3.30226 18.8876 2.78458C18.3699 2.26689 17.6677 1.97605 16.9356 1.97605H5.89191Z" fill="#FFC656"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_456_11141">
                                    <rect width="22.0837" height="22.0837" fill="white" transform="translate(0.37085 0.135742)"/>
                                    </clipPath>
                                </defs>
                                </svg>
                            </button>
                        </span>
                    </p>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>

<!-- revview -->
<section class="bg-softWhite pt-0 pb-5">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 fontSize-20" style="color: #2F2F2F;font-weight: 500;">
                Review
            </div>
            <div class="col-5 mt-4 pt-2">
                <div class="row">
                    <div class="col-3 pe-0">
                        <div class="text-yellow-star fontSize-28">
                        <svg xmlns="http://www.w3.org/2000/svg" width="43" height="40" viewBox="0 5 43 40" fill="none">
                            <path d="M14.9006 28.6328L8.48338 33.2676C8.16542 33.5137 7.81854 33.6302 7.44276 33.617C7.06698 33.6039 6.73456 33.5011 6.44549 33.3086C6.15643 33.1172 5.9327 32.8574 5.77429 32.5293C5.61588 32.2012 5.60837 31.8457 5.75174 31.4629L8.22323 23.875L1.93612 19.6504C1.58924 19.4316 1.37245 19.1445 1.28573 18.7891C1.19901 18.4336 1.21346 18.1055 1.32909 17.8047C1.44471 17.5039 1.64706 17.237 1.93612 17.0041C2.22518 16.7711 2.57206 16.6552 2.97674 16.6563H10.7381L13.2529 8.78126C13.3974 8.39845 13.6218 8.10423 13.9259 7.8986C14.2299 7.69298 14.5549 7.59071 14.9006 7.59181C15.2474 7.59181 15.5729 7.69462 15.877 7.90024C16.1811 8.10587 16.4049 8.39954 16.5482 8.78126L19.0631 16.6563H26.8244C27.2291 16.6563 27.576 16.7727 27.865 17.0057C28.1541 17.2387 28.3564 17.505 28.4721 17.8047C28.5877 18.1055 28.6021 18.4336 28.5154 18.7891C28.4287 19.1445 28.2119 19.4316 27.865 19.6504L21.5779 23.875L24.0494 31.4629C24.1939 31.8457 24.187 32.2012 24.0286 32.5293C23.8702 32.8574 23.6459 33.1172 23.3556 33.3086C23.0666 33.5 22.7342 33.6028 22.3584 33.617C21.9826 33.6313 21.6357 33.5148 21.3178 33.2676L14.9006 28.6328Z" fill="#FFC62B"/>
                        </svg>
                        <span class="fw-bold ms-n3">5.0</span>
                        </div>
                        <div class="text-start fontSize-14" style="color: #999;">234 reviews</div>
                    </div>
                    <div class="col-8">
                        <div class="row align-items-center">
                            <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                Excellent
                            </div>
                            <div class="col-8">
                                <div class="progress-review" style="width: 25%">
                                    <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">25</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                Excellent
                            </div>
                            <div class="col-8">
                                <div class="progress-review" style="width: 80%">
                                    <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">80</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                Excellent
                            </div>
                            <div class="col-8">
                                <div class="progress-review" style="width: 10%">
                                    <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">10</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-2 me-3 fontSize-12" style="color: #2F2F2F;">
                                Excellent
                            </div>
                            <div class="col-8">
                                <div class="progress-review" style="width: 100%">
                                    <div class="progress-bar bg-yellow-progress" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><span class="fontSize-12">100</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 pt-2 mt-4">
                <div class="border-top"></div>

                <div class="card-body ps-0 mt-3">
                    <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong me-3 fit-cover"
                            src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="avatar" width="60" height="60" />
                        <div>
                        <div class="fw-bold mt-3 fontSize-14" style="color: #2F2F2F;">Tatang</div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 fontSize-12 fw-normal" style="color: #999;">
                                Indonesia . 10 kontribusi
                            </p>
                        </div>
                        <p class="mb-2">
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                        </p>
                        <p class="mb-0 text-dark fontSize-12 fw-normal">
                        Gede was great. Got us to gates of heaven early and we didn't have to wait too long and he took great photos! Lots of local knowledge and good chats in the car. Highly recommend
                        </p>
                    </div>
                    </div>
                </div>
                <div class="border-top"></div>

                <div class="card-body ps-0 mt-3">
                    <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong me-3 fit-cover"
                            src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="avatar" width="60" height="60" />
                        <div>
                        <div class="fw-bold mt-3 fontSize-14" style="color: #2F2F2F;">Tatang</div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 fontSize-12 fw-normal" style="color: #999;">
                                Indonesia . 10 kontribusi
                            </p>
                        </div>
                        <p class="mb-2">
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                            <iconify-icon icon="iconamoon:star-fill" style="color: #ffc62b;"></iconify-icon>
                        </p>
                        <p class="mb-0 text-dark fontSize-12 fw-normal">
                        Gede was great. Got us to gates of heaven early and we didn't have to wait too long and he took great photos! Lots of local knowledge and good chats in the car. Highly recommend
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('after-script')
@endpush