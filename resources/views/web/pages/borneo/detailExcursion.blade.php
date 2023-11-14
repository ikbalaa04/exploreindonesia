@extends('web.template.main')
@section('title','Explore Borneo Indonesia (indecon)')
@push('share')
    <meta property="og:title" content="{{ $packet->title_idn ?? null }}">
    <meta property="og:image" content="{{ ($packet->allPacketImage[0]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[0]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[0]['name']) }}">
    <meta property="og:image:type" content="website">
    <meta property="og:image:width" content="200">
    <meta property="og:description" content="{{ $packet->title_idn ?? null }}">
    <meta property="og:image:height" content="200">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="{{ (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; }}">
    <meta property="twitter:title" content="{{ $packet->title_idn ?? null }}">
    <meta property="twitter:description" content="{{ $packet->title_idn ?? null }}">
    <meta property="og:url" content="{{ (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; }}">
@endpush
@push('after-style')
<style>
    .card{
        margin-right:20px!important;
        background: transparent;
        border: none;
    }
    .qtyValue {
        box-shadow: none;
        margin-bottom: 3px;
        padding: 0;
        width: 0px !important;
        max-width: 30px;
        text-align: center;
        margin-bottom: 5px;
    }
   .timeline {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline .timeline-item {
        position: relative;
    }

    .timeline .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .timeline-item:after {
        background-color: hsl(0, 0%, 90%);
        left: -38px;
        border-radius: 50%;
        height: 11px;
        width: 11px;
        content: "";
    }
</style>
@endpush
@section('content')
    @php
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        Session::put('backUrl',url()->current());
    @endphp
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-7 pt-md-8 bg-softWhite" style="padding-bottom: 4rem">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-darkGray fontSize-14 active"><a href="{{ route('web.home') }}" class="text-darkGray">Home</a></li>
                            <li class="breadcrumb-item text-darkGray fontSize-14 active" aria-current="page"><a href="{{ route('web.destination') }}" class="text-darkGray">Packet</a></li>
                            <li class="breadcrumb-item text-darkGray fontSize-14 active" aria-current="page">{{ $packet->title_idn ?? '-' }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 mb-3">
                    <div class="fontSize-28 fw-normal mt-2 mb-3" style="color: #1D1D1D">{{ $packet->title_idn ?? '-' }}</div>
                </div>
                <div class="col-12 mb-5">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                    <g clip-path="url(#clip0_456_6957)">
                                        <path d="M27.9629 13.625C27.9629 17.2054 26.5406 20.6392 24.0088 23.1709C21.4771 25.7027 18.0433 27.125 14.4629 27.125C10.8825 27.125 7.44869 25.7027 4.91695 23.1709C2.38521 20.6392 0.962891 17.2054 0.962891 13.625C0.962891 13.3266 1.08142 13.0405 1.2924 12.8295C1.50337 12.6185 1.78952 12.5 2.08789 12.5C2.38626 12.5 2.67241 12.6185 2.88339 12.8295C3.09436 13.0405 3.21289 13.3266 3.21289 13.625C3.21289 15.85 3.87269 18.0251 5.10886 19.8752C6.34502 21.7252 8.10203 23.1672 10.1577 24.0186C12.2134 24.8701 14.4754 25.0929 16.6577 24.6588C18.8399 24.2248 20.8445 23.1533 22.4178 21.58C23.9912 20.0066 25.0626 18.0021 25.4967 15.8198C25.9308 13.6375 25.708 11.3755 24.8565 9.31981C24.0051 7.26414 22.5631 5.50713 20.7131 4.27097C18.863 3.0348 16.6879 2.375 14.4629 2.375C14.1645 2.375 13.8784 2.25647 13.6674 2.0455C13.4564 1.83452 13.3379 1.54837 13.3379 1.25C13.3379 0.951631 13.4564 0.665483 13.6674 0.454505C13.8784 0.243526 14.1645 0.125 14.4629 0.125C18.0421 0.128871 21.4737 1.55243 24.0046 4.08333C26.5355 6.61424 27.959 10.0458 27.9629 13.625ZM12.5245 12.5H9.96289C9.66452 12.5 9.37837 12.6185 9.1674 12.8295C8.95642 13.0405 8.83789 13.3266 8.83789 13.625C8.83789 13.9234 8.95642 14.2095 9.1674 14.4205C9.37837 14.6315 9.66452 14.75 9.96289 14.75H12.5245C12.6963 15.0484 12.9345 15.3032 13.2206 15.4947C13.5067 15.6863 13.8331 15.8094 14.1744 15.8545C14.5158 15.8997 14.8629 15.8656 15.189 15.7551C15.5151 15.6445 15.8113 15.4603 16.0548 15.2169C16.2982 14.9734 16.4824 14.6772 16.5929 14.3511C16.7035 14.025 16.7376 13.6779 16.6924 13.3365C16.6473 12.9952 16.5242 12.6688 16.3326 12.3827C16.1411 12.0966 15.8863 11.8584 15.5879 11.6866V8C15.5879 7.70163 15.4694 7.41548 15.2584 7.2045C15.0474 6.99353 14.7613 6.875 14.4629 6.875C14.1645 6.875 13.8784 6.99353 13.6674 7.2045C13.4564 7.41548 13.3379 7.70163 13.3379 8V11.6866C13.0009 11.8827 12.7206 12.163 12.5245 12.5ZM3.01827 10.007C3.24077 10.007 3.45828 9.94102 3.64328 9.8174C3.82829 9.69379 3.97248 9.51809 4.05763 9.31252C4.14278 9.10695 4.16506 8.88075 4.12165 8.66252C4.07824 8.44429 3.97109 8.24384 3.81376 8.0865C3.65643 7.92917 3.45597 7.82202 3.23774 7.77862C3.01951 7.73521 2.79331 7.75749 2.58775 7.84264C2.38218 7.92778 2.20648 8.07198 2.08286 8.25698C1.95925 8.44199 1.89327 8.6595 1.89327 8.882C1.89327 9.18037 2.01179 9.46652 2.22277 9.6775C2.43375 9.88847 2.7199 10.007 3.01827 10.007ZM5.71152 5.98287C5.93402 5.98287 6.15153 5.91689 6.33653 5.79328C6.52154 5.66966 6.66573 5.49396 6.75088 5.28839C6.83603 5.08283 6.85831 4.85663 6.8149 4.6384C6.77149 4.42017 6.66434 4.21971 6.50701 4.06238C6.34968 3.90505 6.14922 3.7979 5.93099 3.75449C5.71276 3.71108 5.48656 3.73336 5.281 3.81851C5.07543 3.90366 4.89973 4.04785 4.77611 4.23286C4.6525 4.41786 4.58652 4.63537 4.58652 4.85787C4.58652 5.15624 4.70504 5.44239 4.91602 5.65337C5.127 5.86435 5.41315 5.98287 5.71152 5.98287ZM9.71427 3.32113C9.93677 3.32113 10.1543 3.25514 10.3393 3.13153C10.5243 3.00791 10.6685 2.83221 10.7536 2.62664C10.8388 2.42108 10.8611 2.19488 10.8176 1.97665C10.7742 1.75842 10.6671 1.55796 10.5098 1.40063C10.3524 1.2433 10.152 1.13615 9.93374 1.09274C9.71551 1.04933 9.48931 1.07161 9.28375 1.15676C9.07818 1.24191 8.90248 1.3861 8.77886 1.57111C8.65525 1.75611 8.58927 1.97362 8.58927 2.19613C8.58927 2.49449 8.70779 2.78064 8.91877 2.99162C9.12975 3.2026 9.4159 3.32113 9.71427 3.32113Z" fill="#FFC656"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_456_6957">
                                        <rect width="27" height="27" fill="white" transform="translate(0.962891 0.125)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="ps-2 fontSize-14 fw-bold" style="color: ##2F2F2F">{{ $packet->length_of_vacation ?? '-' }}</span>
                            </span>
                            <span class="px-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                    <g clip-path="url(#clip0_456_6966)">
                                        <path d="M14.2129 6.875C13.3229 6.875 12.4528 7.13892 11.7128 7.63339C10.9728 8.12785 10.396 8.83066 10.0554 9.65292C9.71484 10.4752 9.62573 11.38 9.79936 12.2529C9.97299 13.1258 10.4016 13.9276 11.0309 14.557C11.6602 15.1863 12.4621 15.6149 13.335 15.7885C14.2079 15.9622 15.1127 15.8731 15.935 15.5325C16.7572 15.1919 17.46 14.6151 17.9545 13.8751C18.449 13.135 18.7129 12.265 18.7129 11.375C18.7129 10.1815 18.2388 9.03693 17.3949 8.19302C16.551 7.34911 15.4064 6.875 14.2129 6.875ZM14.2129 13.625C13.7679 13.625 13.3329 13.493 12.9629 13.2458C12.5928 12.9986 12.3045 12.6472 12.1342 12.236C11.9639 11.8249 11.9193 11.3725 12.0061 10.936C12.0929 10.4996 12.3072 10.0987 12.6219 9.78401C12.9366 9.46934 13.3375 9.25505 13.7739 9.16823C14.2104 9.08142 14.6628 9.12597 15.0739 9.29627C15.4851 9.46657 15.8365 9.75496 16.0837 10.125C16.3309 10.495 16.4629 10.93 16.4629 11.375C16.4629 11.9717 16.2258 12.544 15.8039 12.966C15.3819 13.3879 14.8096 13.625 14.2129 13.625Z" fill="#FFC656"/>
                                        <path d="M14.2128 27.1253C13.2654 27.1301 12.3308 26.908 11.487 26.4774C10.6432 26.0467 9.9148 25.4202 9.36288 24.6503C5.0755 18.7362 2.90088 14.2902 2.90088 11.4349C2.90088 8.43483 4.09266 5.55761 6.21405 3.43622C8.33544 1.31483 11.2127 0.123047 14.2128 0.123047C17.2129 0.123047 20.0901 1.31483 22.2115 3.43622C24.3328 5.55761 25.5246 8.43483 25.5246 11.4349C25.5246 14.2902 23.35 18.7362 19.0626 24.6503C18.5107 25.4202 17.7824 26.0467 16.9386 26.4774C16.0948 26.908 15.1601 27.1301 14.2128 27.1253ZM14.2128 2.57892C11.8642 2.5816 9.61265 3.51574 7.95198 5.1764C6.29132 6.83707 5.35718 9.08864 5.3545 11.4372C5.3545 13.6984 7.48413 17.8801 11.3496 23.2114C11.6778 23.6634 12.1083 24.0313 12.6059 24.285C13.1036 24.5386 13.6542 24.6709 14.2128 24.6709C14.7713 24.6709 15.3219 24.5386 15.8196 24.285C16.3172 24.0313 16.7477 23.6634 17.0759 23.2114C20.9414 17.8801 23.071 13.6984 23.071 11.4372C23.0683 9.08864 22.1342 6.83707 20.4735 5.1764C18.8129 3.51574 16.5613 2.5816 14.2128 2.57892Z" fill="#FFC656"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_456_6966">
                                        <rect width="27" height="27" fill="white" transform="translate(0.712891 0.125)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="ps-2 fontSize-14 fw-bold" style="color: ##2F2F2F">{{ strtolower(\Indonesia::findProvince($packet->province_id, $with = null)->name) }}, {{ $packet->partner->region ?? 'Indonesia' }}</span>
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                    <g clip-path="url(#clip0_456_6967)">
                                        <path d="M23.4629 9.125C22.2694 9.125 21.1248 8.65089 20.2809 7.80698C19.437 6.96307 18.9629 5.81847 18.9629 4.625C18.9629 3.43153 19.437 2.28693 20.2809 1.44302C21.1248 0.599106 22.2694 0.125 23.4629 0.125C24.6564 0.125 25.801 0.599106 26.6449 1.44302C27.4888 2.28693 27.9629 3.43153 27.9629 4.625C27.9629 5.81847 27.4888 6.96307 26.6449 7.80698C25.801 8.65089 24.6564 9.125 23.4629 9.125ZM23.4629 2.375C22.8662 2.375 22.2939 2.61205 21.8719 3.03401C21.4499 3.45597 21.2129 4.02826 21.2129 4.625C21.2129 5.22174 21.4499 5.79403 21.8719 6.21599C22.2939 6.63795 22.8662 6.875 23.4629 6.875C24.0596 6.875 24.6319 6.63795 25.0539 6.21599C25.4758 5.79403 25.7129 5.22174 25.7129 4.625C25.7129 4.02826 25.4758 3.45597 25.0539 3.03401C24.6319 2.61205 24.0596 2.375 23.4629 2.375ZM25.0964 27.125H15.1255C14.6211 27.1294 14.1245 27.0007 13.6858 26.7518C13.2471 26.503 12.8818 26.1427 12.6269 25.7075C12.377 25.2881 12.2425 24.8101 12.2367 24.3219C12.231 23.8338 12.3543 23.3528 12.5943 22.9276L17.5848 13.9738C17.8417 13.53 18.2109 13.1616 18.6551 12.9054C19.0994 12.6493 19.6032 12.5145 20.116 12.5145C20.6288 12.5145 21.1326 12.6493 21.5769 12.9054C22.0212 13.1616 22.3903 13.53 22.6473 13.9738L27.6254 22.9209C27.8658 23.3467 27.9895 23.8284 27.9839 24.3173C27.9784 24.8062 27.8439 25.285 27.5939 25.7053C27.3391 26.1405 26.974 26.5009 26.5356 26.7501C26.0971 26.9994 25.6007 27.1287 25.0964 27.125ZM20.1138 14.75C20 14.7473 19.8876 14.7755 19.7886 14.8316C19.6895 14.8876 19.6075 14.9694 19.5513 15.0684L14.5608 24.0223C14.5125 24.1053 14.4877 24.1999 14.4889 24.296C14.4901 24.3921 14.5172 24.486 14.5675 24.5679C14.6251 24.6648 14.7077 24.7444 14.8067 24.7985C14.9057 24.8525 15.0173 24.8789 15.13 24.875H25.1009C25.2137 24.8783 25.3254 24.8514 25.4243 24.797C25.5232 24.7426 25.6058 24.6627 25.6634 24.5656C25.7128 24.4824 25.7389 24.3874 25.7389 24.2906C25.7389 24.1938 25.7128 24.0987 25.6634 24.0155L20.6774 15.0695C20.6214 14.97 20.5393 14.8877 20.44 14.8314C20.3407 14.7751 20.2279 14.747 20.1138 14.75ZM9.96289 26C9.96289 25.7016 9.84437 25.4155 9.63339 25.2045C9.42241 24.9935 9.13626 24.875 8.83789 24.875H4.73164C4.46855 24.8748 4.21001 24.8063 3.9814 24.6761C3.75279 24.5458 3.56196 24.3584 3.42764 24.1322C3.29331 23.906 3.2201 23.6487 3.21519 23.3857C3.21029 23.1226 3.27385 22.8628 3.39964 22.6318L10.8831 8.79425C11.0111 8.55306 11.2027 8.35152 11.4372 8.21151C11.6716 8.07149 11.9398 7.99834 12.2129 8C12.4862 7.99776 12.7549 8.07066 12.9896 8.21072C13.2243 8.35079 13.416 8.55264 13.5438 8.79425L14.9241 11.3446C14.9945 11.4746 15.0897 11.5895 15.2044 11.6827C15.3192 11.7759 15.4511 11.8456 15.5928 11.8878C15.7344 11.93 15.883 11.9439 16.03 11.9287C16.177 11.9135 16.3196 11.8694 16.4496 11.7991C16.5797 11.7288 16.6945 11.6336 16.7877 11.5188C16.8809 11.4041 16.9506 11.2722 16.9928 11.1305C17.035 10.9888 17.0489 10.8403 17.0337 10.6932C17.0185 10.5462 16.9745 10.4036 16.9041 10.2736L15.5249 7.72438C15.2025 7.12727 14.7246 6.62849 14.1419 6.28086C13.5591 5.93322 12.8932 5.74968 12.2146 5.74968C11.536 5.74968 10.8701 5.93322 10.2873 6.28086C9.70454 6.62849 9.22666 7.12727 8.90427 7.72438L1.41964 21.5619C1.10926 22.1358 0.953164 22.7805 0.966623 23.4329C0.980082 24.0853 1.16263 24.723 1.49643 25.2836C1.83022 25.8443 2.30382 26.3087 2.8709 26.6315C3.43799 26.9542 4.07914 27.1243 4.73164 27.125H8.83789C9.13626 27.125 9.42241 27.0065 9.63339 26.7955C9.84437 26.5845 9.96289 26.2984 9.96289 26Z" fill="#FFC656"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_456_6967">
                                        <rect width="27" height="27" fill="white" transform="translate(0.962891 0.125)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="ps-2 fontSize-14 fw-bold" style="color: ##2F2F2F">
                                    @php
                                        $dataGroup = [];
                                        if ($packet->categories_id != null) {
                                            $explode =  explode(',',$packet->categories_id);
                                            foreach ($explode as $key => $value) {
                                                $dataGroup[] = App\Http\Controllers\Controller::getCategory($value);
                                            }
                                            echo implode(',',$dataGroup);
                                        }
                                    @endphp
                                </span>
                            </span>
                        </div>
                        <div class="col-md-3 col-sm-3 text-end">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#shareModal" class="pe-1 btn-none"><iconify-icon icon="ri:share-line" style="color: #ffc656;" width="42" height="42"></iconify-icon></button>
                            <button type="button" data-id="{{ $packet->id }}" data-user="{{ Auth::user() ? Auth::user()->id : null }}" class="btn-none {{ $bookmark == true ? 'd-none' : '' }}" id="bookmark"><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="42" height="42"></iconify-icon></a>
                            <button type="button" data-id="{{ $packet->id }}" data-user="{{ Auth::user() ? Auth::user()->id : null }}" class="btn-none {{ $bookmark == true ? '' : 'd-none' }}" id="unbookmark"><iconify-icon icon="mingcute:bookmark-fill" style="color: #ffc656;" width="42" height="42"></iconify-icon></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="row">
                        @for ($key = 0; $key < 5; $key++)
                            @if ($key == 0)
                                <div class="col-4 pe-0">
                                    @if (isset($packet->allPacketImage[$key]) == false)
                                        <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                    @else
                                        <a data-fslightbox="gallery"
                                            data-caption="<h1>{{ $packet->title_idn ?? 'no title' }}</h1>"
                                            data-type="image"
                                            href="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}">
                                                <img src="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                        </a>
                                    @endif
                                </div>
                                <div class="col-4 pe-0">
                                    <div class="row">
                            @endif
                            @if ($key == 1)
                                        <div class="col-12">
                                            @if (isset($packet->allPacketImage[$key]) == false)
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                            @else
                                                <a data-fslightbox="gallery"
                                                    data-caption="<h1>{{ $packet->title_idn ?? 'no title' }}</h1>"
                                                    data-type="image"
                                                    href="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}">
                                                        <img src="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}" alt="" class="img-fluid br-10 fit-cover h-100 pb-3">
                                                </a>
                                            @endif
                                        </div>
                            @endif
                            @if ($key == 2)
                                        <div class="col-12">
                                            @if (isset($packet->allPacketImage[$key]) == false)
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                            @else
                                                <a data-fslightbox="gallery"
                                                    data-caption="<h1>{{ $packet->title_idn ?? 'no title' }}</h1>"
                                                    data-type="image"
                                                    href="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}">
                                                        <img src="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 pe-0">
                                    <div class="row">
                            @endif
                            @if ($key == 3)
                                        <div class="col-12">
                                            @if (isset($packet->allPacketImage[$key]) == false)
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                            @else
                                                <a data-fslightbox="gallery"
                                                    data-caption="<h1>{{ $packet->title_idn ?? 'no title' }}</h1>"
                                                    data-type="image"
                                                    href="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}">
                                                        <img src="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}" alt="" class="img-fluid br-10 fit-cover h-100 pb-3">
                                                </a>
                                            @endif
                                        </div>
                            @endif
                            @if ($key == 4)
                                        <div class="col-12">
                                            @if (isset($packet->allPacketImage[$key]) == false)
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                            @else
                                                <a data-fslightbox="gallery"
                                                    data-caption="<h1>{{ $packet->title_idn ?? 'no title' }}</h1>"
                                                    data-type="image"
                                                    href="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}">
                                                        <img src="{{ ($packet->allPacketImage[$key]['file'] == 'from file manager') ? asset('assets/images/fileGallery/'.$packet->allPacketImage[$key]['name']) : asset('assets/images/packagesGallery/'.$packet->allPacketImage[$key]['name']) }}" alt="" class="img-fluid br-10 fit-cover h-100">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card-excursion">
                        <div class="bg-yellow p-1 br-0-10 text-end w-40 ms-auto" style="opacity: 0.699999988079071;backdrop-filter: blur(33.75px);">
                            <div class="uppercase text-white text-center fontSize-12" style="font-style: normal;font-weight: 600;line-height: 37.969px;letter-spacing: 0.945px;">On Sale</div>
                        </div>
                        <div class="container mt-2">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <div class="card-header" style="background: transparent;border-bottom:none">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $packet->partner->file == null ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/partner/'.$packet->partner->file) }}" alt="..." width="40" height="40" class="img-fluid">
                                            </div>
                                            <div class="flex-grow-1 ms-3 fw-bold fontSize-12" style="color: #2F2F2F;font-weight: 500;line-height: normal;">
                                                {{ $packet->partner->name ?? '-' }}
                                                <br>
                                                <span class="fontSize-10" style="color: #999;font-weight: 500;line-height: normal;">{{ $packet->partner->email ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <iconify-icon icon="ic:round-star" style="color: #FFC62B;"></iconify-icon> <span class="pe-3 text-yellow-navbar">
                                        {{ ($packet->packetRating->sum('ratings') == 0) ? $rating = '0' : $rating = (int) $packet->packetRating->sum('ratings') / (int) $packet->packetRating->count('ratings') }}{{ strlen($rating) < 2 ? '.0' : ''  }}
                                    </span>
                                    <div class="text-darkGray fontSize-12 text-end" style="font-style: normal;font-weight: 500;line-height: normal;">{{ (int) $packet->packetRating->count('ratings') ?? 0 }} reviews</div>
                                </div>
                                <div class="col-7 my-3">
                                    <input class="form-control border-yellow br-10" type="date" placeholder="Default input" aria-label="default input example">
                                </div>
                                <div class="col-5 ms-auto my-3">
                                    <div class="input-group">
                                        <iconify-icon icon="ci:user-add" class="pe-2" style="color: #ffc656;"width="24" height="24"> </iconify-icon>
                                        <iconify-icon class="decreaseQty" id="decreaseQty" icon="formkit:caretleft" style="color: #374957;cursor: pointer;" width="24" height="24"></iconify-icon>
                                        <input type="text" name="qtyValue" id="qtyValue" data-id="qtyValue" class="qtyValue form-control btn-none" value="0" />
                                        <iconify-icon class="increaseQty" id="increaseQty" icon="formkit:caretright" style="color: #374957;cursor: pointer;" width="24" height="24"></iconify-icon>
                                    </div>
                                </div>
                                <div class="col-12 fontSize-18 mt-1" style="color: #2F2F2F">
                                    {{ $packet->title_idn ?? '-' }}
                                </div>
                                <div class="col-12 fontSize-12 mt-2" style="color: #808080;text-overflow: ellipsis;line-height: 145.5%;whitespace: nowrap;">
                                    {{ $packet->short_description_idn ?? '-' }}
                                </div>
                                <div class="col-12 fontSize-14 mt-3" style="color: ##999999;">
                                    <div class="row">
                                        <div class="col-9">
                                            From
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">IDR</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <sup class="fontSize-18 prefixCurrency" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">$</sup>
                                    <span class="fontSize-30 valueCurrency" style="color: #1D1D1D;font-weight: 600;">{{ $packet->packetPrice->price_in_dollars ?? '0' }}</span>
                                    <sup class="fontSize-18 currency" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">USD</sup>
                                    <sub class="fontSize-16" style="color: #999;font-style: normal;font-weight: 500;line-height: normal;">/Person</sub>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="" class="bg-yellow br-10 uppercase p-2 fontSize-12 d-block text-white text-center">BOOK</a>
                                </div>
                                <div class="col-12 mt-2">
                                    @if (Auth::user() == null)
                                        <a type="button" class="btn-outline-yellow br-10 fontSize-12 uppercase p-2 d-block text-yellow-navbar text-center chatnow" id="chatnow">CHAT now</a>
                                    @else
                                        <a href="{{ Auth::user() == null ? route('login') : route('dashboard.user.chat') }}?to={{ $packet->partner->id }}" class="btn-outline-yellow br-10 fontSize-12 uppercase p-2 d-block text-yellow-navbar text-center">CHAT now</a>
                                    @endif
                                </div>
                                <div class="col-12 fontSize-16 mt-3" style="color: #2F2F2F;">
                                    Disclimer
                                </div>
                                <div class="col-12 fontSize-12 mt-2 mb-4" style="color: #999999;">
                                    Paket ini akan dijalankan ketika sudah memenuhi quota pengunjung
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 mt-n8">
                    <ul class="nav nav-pills justify-content-start mb-3" id="pills-tab" role="">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-yellow-navbar ps-0 fontSize-14 poppins" style="color: #2F2F2F" id="pills-overview-tab" type="button">Over View</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#tourDetails" class="nav-link fontSize-14 poppins" style="color: #2F2F2F" id="pills-tourDetail-tab" type="button">Tour Detail</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#scheduleTour" class="nav-link fontSize-14 poppins" style="color: #2F2F2F" id="pills-schedule-tab" type="button">Schedule Tour</a>
                        </li>
                    </ul>
                    <div class="text-dark fontSize-14 mt-3" style="font-style: normal;font-weight: 400;line-height: normal;">
                        {!! $packet->description_idn !!}

                        <div class="mt-3 fontSize-12">Tags:

                            @php
                                $explodeTag = explode(',',$packet->tag);
                            @endphp
                            @forelse ($explodeTag as $tag)
                                <div class="btn-rounded btn-none mt-1 fontSize-10 p-2 btn" style="cursor: auto">#{{ $tag }}</div>
                            @empty
                                #noTag
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mt-3" id="tourDetails">
                    <div class="fw-bold my-4 fontSize-18" style="color: #2F2F2F;">Tour Detail</div>
                    <div class="row">
                        <!-- one card -->
                        @forelse ($packet->packetTourDetail as $item)
                            <div class="col-4">
                                <div>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32" fill="none">
                                        <g clip-path="url(#clip0_456_6958)">
                                            <path d="M16.2117 15.75C17.2501 15.75 18.2651 15.4421 19.1285 14.8652C19.9918 14.2883 20.6648 13.4684 21.0621 12.5091C21.4595 11.5498 21.5634 10.4942 21.3609 9.47578C21.1583 8.45738 20.6583 7.52191 19.9241 6.78769C19.1898 6.05346 18.2544 5.55345 17.236 5.35088C16.2176 5.1483 15.162 5.25227 14.2027 5.64963C13.2433 6.04699 12.4234 6.7199 11.8465 7.58326C11.2697 8.44661 10.9617 9.46165 10.9617 10.5C10.9617 11.8924 11.5149 13.2277 12.4994 14.2123C13.484 15.1969 14.8194 15.75 16.2117 15.75ZM16.2117 7.875C16.7309 7.875 17.2384 8.02895 17.6701 8.31739C18.1018 8.60583 18.4382 9.0158 18.6369 9.49546C18.8356 9.97511 18.8876 10.5029 18.7863 11.0121C18.685 11.5213 18.435 11.989 18.0679 12.3562C17.7008 12.7233 17.2331 12.9733 16.7239 13.0746C16.2147 13.1758 15.6869 13.1239 15.2072 12.9252C14.7275 12.7265 14.3176 12.3901 14.0291 11.9584C13.7407 11.5267 13.5867 11.0192 13.5867 10.5C13.5867 9.80381 13.8633 9.13613 14.3556 8.64384C14.8479 8.15156 15.5156 7.875 16.2117 7.875ZM27.578 12.0186L26.6343 11.7049C26.8041 10.2348 26.6613 8.74538 26.2151 7.33436C25.7689 5.92334 25.0295 4.62258 24.0454 3.51736C23.0613 2.41214 21.8546 1.52743 20.5046 0.921261C19.1545 0.315088 17.6916 0.00113857 16.2117 0C14.7126 0.000578772 13.2309 0.322473 11.8666 0.943996C10.5023 1.56552 9.28708 2.47223 8.30278 3.60304C7.31848 4.73385 6.58798 6.0625 6.1605 7.49945C5.73302 8.93641 5.61849 10.4483 5.82462 11.9333C4.5686 12.1674 3.40716 12.76 2.48037 13.6395C1.83878 14.2495 1.32874 14.9842 0.981596 15.7986C0.634451 16.613 0.457542 17.4897 0.461743 18.375V23.7234C0.464501 25.1427 0.926095 26.523 1.77764 27.6584C2.62919 28.7938 3.82504 29.6234 5.18674 30.0234L8.95362 31.2047C9.58633 31.4016 10.2453 31.5012 10.9079 31.5C11.509 31.4992 12.1073 31.4171 12.6864 31.2559L20.2726 29.0115C20.9484 28.827 21.6614 28.827 22.3372 29.0115L25.4701 30.0615C26.2423 30.2494 27.047 30.2596 27.8236 30.0913C28.6003 29.923 29.3286 29.5806 29.9537 29.0899C30.5788 28.5992 31.0843 27.9729 31.4321 27.2584C31.7799 26.5439 31.961 25.7597 31.9617 24.9651V18.207C31.9588 16.8491 31.5359 15.5254 30.7511 14.4172C29.9663 13.3091 28.8579 12.4708 27.578 12.0173V12.0186ZM10.6441 4.93762C11.3742 4.20458 12.2419 3.62292 13.1973 3.22604C14.1527 2.82915 15.1772 2.62484 16.2117 2.62484C17.2463 2.62484 18.2707 2.82915 19.2262 3.22604C20.1816 3.62292 21.0493 4.20458 21.7794 4.93762C23.2522 6.41962 24.0801 8.42338 24.0828 10.5128C24.0855 12.6022 23.2628 14.6081 21.7938 16.0939L17.1305 20.6286C16.8871 20.8672 16.5598 21.0009 16.219 21.0009C15.8781 21.0009 15.5508 20.8672 15.3074 20.6286L10.6441 16.1136C9.16817 14.6283 8.33977 12.6195 8.33977 10.5256C8.33977 8.43171 9.16817 6.42286 10.6441 4.93762ZM29.3367 24.9651C29.3375 25.3626 29.2476 25.7551 29.0739 26.1126C28.9001 26.4701 28.6471 26.7833 28.334 27.0283C28.0382 27.2662 27.6936 27.4359 27.3247 27.5255C26.9559 27.6151 26.5718 27.6224 26.1999 27.5468L23.1221 26.5125C21.9579 26.178 20.724 26.1708 19.556 26.4915L11.9645 28.7332C11.2351 28.9344 10.4632 28.9212 9.74112 28.6952L5.94274 27.5139C5.12066 27.2762 4.39788 26.7782 3.8829 26.0948C3.36793 25.4113 3.08856 24.5792 3.08674 23.7234V18.375C3.08379 17.8445 3.18939 17.3189 3.39705 16.8307C3.6047 16.3425 3.91003 15.9019 4.29424 15.5361C4.89571 14.9628 5.66189 14.5928 6.48481 14.4782C7.01388 15.7896 7.80174 16.981 8.80137 17.9812L13.4831 22.5133C14.2148 23.2298 15.1981 23.6311 16.2222 23.6311C17.2464 23.6311 18.2297 23.2298 18.9614 22.5133L23.6379 17.9681C24.6849 16.9169 25.4961 15.6547 26.0174 14.2656L26.7222 14.4992C27.4866 14.7731 28.1479 15.2761 28.6158 15.9397C29.0837 16.6033 29.3354 17.3951 29.3367 18.207V24.9651Z" fill="#FFC656"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_456_6958">
                                            <rect width="31.5" height="31.5" fill="white" transform="translate(0.462891)"/>
                                            </clipPath>
                                        </defs>
                                    </svg> --}}
                                    <img class="img-fluid" style="color: #FFC656" width="28px" height="28px" src="{{ $item->file == null ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/iconTourPackages/'.$item->file) }}" alt="">
                                    <span class="fontSize-16" style="margin-left: 10px;color:#2F2F2F;font-style: normal;font-weight: 500;line-height: normal;">{{ $item->title ?? '-' }}</span>
                                </div>
                                <div class="card" style="margin-left: 25px;">
                                    <div class="card-body">
                                        <p class="fontSize-16 mt-1" style="color: #999;">
                                            {{ $item->description ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 bg-danger text-white text-center p-2 fontSize-16">Tour Detail cannot found</div>
                        @endforelse
                    </div>
                </div>

                <div class="col-12" id="scheduleTour">
                    <div class="fw-bold my-4 fontSize-18" style="color: #2F2F2F;">Schedule Tour</div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($packet->packetScheduleTour as $item)
                            <div class="accordion-item card-accordion">
                                <h2 class="accordion-header" id="flush-heading{{ $item->text }}">
                                <button class="accordion-button collapsed" style="border: none !important" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $item->text }}" aria-expanded="false" aria-controls="flush-collapse{{ $item->text }}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="br-100Persen bg-softDark br-accordion text-center fontSize-38 text-white">
                                                {{ $item->text }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-4">
                                            <div class="fontSize-16" style="color: #2F2F2F;">{{ $packet->title_idn ?? '-' }}</div>
                                            <div class="fontSize-14 py-2" style="color: #999;">Day {{ $item->text }}</div>
                                            <div class="fontSize-14" style="color: #2F2F2F;">See detail</div>
                                        </div>
                                    </div>
                                </button>
                                </h2>
                                <div id="flush-collapse{{ $item->text }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $item->text }}" data-bs-parent="#accordionFlushExample">
                                    <div class="container mt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <ul class="timeline">
                                                    @foreach ($item->packetScheduleTourDetail as $packetDetail)
                                                    <li class="timeline-item mb-5">
                                                        <h5 class="fw-bold">{{ $packetDetail->name ?? '-' }}</h5>
                                                        <p class="text-muted mb-2 fw-bold">{{ $packetDetail->range_time ?? '-' }} (Guide: {{ $packetDetail->guide ?? '-' }})</p>
                                                        <p class="text-muted">
                                                            {{ $packetDetail->detail ?? '-' }}
                                                        </p>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <!-- end of .container-->
        <!-- modal share -->
        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shareModalLabel">Share to your bestie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a id="shareExcursion" data-id="whatsapp" target="_blank" href="https://wa.me/?text={{ $packet->title_idn ?? '-' }}%0a{{ $actual_link }}" class="btn bg-cyan text-dark shareExcursion"><iconify-icon icon="logos:whatsapp-icon"></iconify-icon> Whatsapp</a>
                        <a id="shareExcursion" data-id="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $actual_link }}" class="btn bg-cyan text-dark shareExcursion"><iconify-icon icon="devicon:facebook"></iconify-icon> Facebook</a>
                        <a id="shareExcursion" data-id="twitter" target="_blank" href="https://twitter.com/intent/tweet?url={{ $actual_link }}" class="btn bg-cyan text-dark shareExcursion"><iconify-icon icon="simple-icons:x"></iconify-icon> Twitter / X</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <section class="pt-0 bg-softWhite">
        <div class="container-lg">
            <div class="row justify-content-start">
                <div class="col-md-12 col-lg-12 text-left pt-2 mb-5">
                    <div class="roboto fontSize-28 fw-bold text-dark">Paket lainnya dari {{ $packet->partner->name ?? '-' }}</div>
                </div>
            </div>
            <div class="h-100 justify-content-center">
                <div class="card-group">
                    @forelse ($anotherPacket as $key => $value)
                        <div class="card me-4" style="height: 420px;max-height: 440px;max-width: 257px;">
                            <div class="img-text-container">
                                <img src="@if($value->packetImage == null) {{ asset('assets/cms/images/noImage.jpg') }} @elseif($value->packetImage->file == 'from file manager') {{ asset('assets/images/fileGallery/'.$value->packetImage->name) }} @else {{ asset('assets/images/packagesGallery/'.$value->packetImage->name) }} @endif" class="card-img-top" alt="...">
                                <div class="inner">
                                    <div class="text-yellow-star fontSize-14">
                                        <iconify-icon icon="ic:round-star"></iconify-icon> {{ ($value->packetRating->sum('ratings') == 0) ? $rating = '0' : $rating = (int) $value->packetRating->sum('ratings') / (int) $value->packetRating->count('ratings') }}{{ strlen($rating) < 2 ? '.0' : ''  }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('web.excursion',$value->slug) }}">
                                    <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">{{ $value->title_idn ?? '-' }}</div>
                                </a>
                                <p class="card-text poppins fontSize-10 modal-open">{{ $value->short_description_idn ?? '-' }}</p>
                                <p class="card-text pt-2">
                                <small class="text-muted">${{ $value->packetPrice->price_in_dollars ?? '0' }} /Person</small>
                                <span>
                                    <button type="button" data-id="{{ $value->id }}" data-user="{{ $userId }}" class="btn-none float-end {{ \Controller::checkBookmark($value->id,$userId) == true ? 'd-none' : '' }}" id="bookmarkelse"><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="30" height="30"></iconify-icon></button>
                                    <button type="button" data-id="{{ $value->id }}" data-user="{{ $userId }}" class="btn-none float-end {{ \Controller::checkBookmark($value->id,$userId) == true ? '' : 'd-none' }}" id="unbookmarkelse"><iconify-icon icon="mingcute:bookmark-fill" style="color: #ffc656;" width="30" height="30"></iconify-icon></button>
                                    {{-- <button class="btn-none float-end">
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
                                    </button> --}}
                                </span>
                            </p>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-12">
                                Another packet not found in this partner
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
@endsection
@push('after-script')
<script>
    $(document).ready(function () {
        // alert chatnow if auth null
        $('#chatnow').click(function (e) {
            Swal.fire({
                title: "Please login, before chat tour guide",
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: "Lets go",
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "{{ route('login') }}";
                }
            });
        });
        // bookmark
        $('#bookmark').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var user = $(this).attr('data-user');
            if (user.length == 0) {
                Swal.fire('','Please log in first, so you can save your wish list','error')
            }
            $.ajax({
                type: "post",
                url: "{{ route('bookmark.store') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id' : id,
                    'userId' : user
                },
                dataType: "json",
                success: function (response) {
                    $('#bookmark').addClass('d-none');
                    $('#unbookmark').removeClass('d-none');
                },
                error: function(xhr) {
                    var err = eval("(" + xhr.responseText + ")");
                    Swal.fire(JSON.stringify(err.message));
                }
            });
        });

        $('#bookmarkelse').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var user = $(this).attr('data-user');
            if (user.length == 0) {
                Swal.fire('','Please log in first, so you can save your wish list','error')
            }
            $.ajax({
                type: "post",
                url: "{{ route('bookmark.store') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id' : id,
                    'userId' : user
                },
                dataType: "json",
                success: function (response) {
                    $('#bookmarkelse').addClass('d-none');
                    $('#unbookmarkelse').removeClass('d-none');
                },
                error: function(xhr) {
                    var err = eval("(" + xhr.responseText + ")");
                    Swal.fire(JSON.stringify(err.message));
                }
            });
        });
        // unbbokmark
        $('#unbookmark').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var user = $(this).attr('data-user');
            if (user.length == 0) {
                Swal.fire('','Please log in first, so you can delete your wish list','error')
            }
            $.ajax({
                type: "delete",
                url: "{{ route('bookmark.destroy') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id' : id,
                    'userId' : user
                },
                dataType: "json",
                success: function (response) {
                    $('#bookmark').removeClass('d-none');
                    $('#unbookmark').addClass('d-none');
                },
                error: function(xhr) {
                    var err = eval("(" + xhr.responseText + ")");
                    Swal.fire(JSON.stringify(err.message));
                }
            });
        });
        $('#unbookmarkelse').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var user = $(this).attr('data-user');
            if (user.length == 0) {
                Swal.fire('','Please log in first, so you can delete your wish list','error')
            }
            $.ajax({
                type: "delete",
                url: "{{ route('bookmark.destroy') }}",
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'id' : id,
                    'userId' : user
                },
                dataType: "json",
                success: function (response) {
                    $('#bookmarkelse').removeClass('d-none');
                    $('#unbookmarkelse').addClass('d-none');
                },
                error: function(xhr) {
                    var err = eval("(" + xhr.responseText + ")");
                    Swal.fire(JSON.stringify(err.message));
                }
            });
        });
        // share
        $('.shareExcursion').click(function (e) {
            var type = $(this).attr('data-id');
            fbq('trackCustom', 'ShareExcursion', {promotion: 'share_with_'+type});
        });
        // switch idr/usd
        $('#flexSwitchCheckDefault').change(function() {
            if ($(this).is(':checked')) {
                var valueIdr = {{ $packet->packetPrice->price_in_rupiah ?? '0' }}
                $('.prefixCurrency').text('Rp');
                $('.valueCurrency').text(valueIdr);
                $('.currency').text('IDR');
            } else {
                var valueUsd = {{ $packet->packetPrice->price_in_dollars ?? '0' }}
                $('.prefixCurrency').text('$');
                $('.valueCurrency').text(valueUsd);
                $('.currency').text('USD');
            }

        })

        // Increase product quantity on cart page
        $(".increaseQty").on('click', function(){
            var val = parseInt($('#qtyValue').val()) + 1;
            $('#qtyValue').val(val);
        });
        // Decrease product quantity on cart page
        $(".decreaseQty").on('click', function(){
            if ($('#qtyValue').val() > 0) {
            var val = parseInt($('#qtyValue').val()) - 1;
            $('#qtyValue').val(val);
            }
        });

        $('#pills-overview-tab').click(function (e) {
            $('#pills-tourDetail-tab').removeClass('active text-yellow-navbar');
            $('#pills-schedule-tab').removeClass('active text-yellow-navbar');
            $('#pills-overview-tab').removeClass('active');
            $('#pills-overview-tab').addClass('text-yellow-navbar');
        });

        $('#pills-schedule-tab').click(function (e) {
            $('#pills-tourDetail-tab').removeClass('active text-yellow-navbar');
            $('#pills-overview-tab').removeClass('active text-yellow-navbar');
            $('#pills-schedule-tab').removeClass('active');
            $('#pills-schedule-tab').addClass('text-yellow-navbar');
        });

        $('#pills-tourDetail-tab').click(function (e) {
            $('#pills-schedule-tab').removeClass('active text-yellow-navbar');
            $('#pills-overview-tab').removeClass('active text-yellow-navbar');
            $('#pills-tourDetail-tab').removeClass('active');
            $('#pills-tourDetail-tab').addClass('text-yellow-navbar');
        });
    });
</script>
@endpush
