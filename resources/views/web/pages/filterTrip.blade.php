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
        .form-check-input:checked {
            background-color: #FFAD0D;
            border-color: #FFAD0D;
        }
    </style>
@endpush
@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-7 pt-md-8 bg-softWhite" style="padding-bottom: 4rem">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 mb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fontSize-14 active"><a href="{{ route('web.home') }}" class="text-darkGray">Home</a></li>
                        <li class="breadcrumb-item text-darkGray fontSize-14 active" aria-current="page">Destination</li>
                        <li class="breadcrumb-item text-dark fontSize-14 active fw-bold" aria-current="page">Search</li>
                    </ol>
                </nav>
            </div>

            <form action="" class="col-md-4 align-items-start">
                <div class="">
                    <div class="bg-filter-trip p-4">
                        <div class="col-12">
                            <label for="people" class="form-label text-dark fontSize-16 fw-bold">Price Range</label>
                            <div class="price-range-slider">
                                <p class="range-value">
                                    <input type="text" class="sans fontSize-16" style="background: transparent;border:none;" id="amount" readonly>
                                </p>
                                <div id="slider-range" class="range-bar mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-filter-trip p-4 mt-4">
                        <div class="col-12">
                            <label for="people" class="form-label text-dark fontSize-18 fw-bold mb-3">Destination</label>
                            <div class="form-check mt-2 ms-3">
                            <input class="form-check-input destination" @if(\Request::query('destination') != null) {{ \Request::query('destination') == 'Kalimantan' ? 'checked' : '' }} @endif type="radio" name="destination" id="kalimantan2" value="Kalimantan">
                                <label class="form-check-label text-dark fontSize-14" for="kalimantan2">
                                    Kalimantan
                                </label>
                            </div>
                            <div class="form-check mt-2 ms-3">
                            <input class="form-check-input destination" @if(\Request::query('destination') != null) {{ \Request::query('destination') == 'Sumatera' ? 'checked' : '' }} @endif type="radio" name="destination" id="sumatera" value="Sumatera">
                                <label class="form-check-label text-dark fontSize-14" for="sumatera">
                                    Sumatera
                                </label>
                            </div>
                            <div class="form-check mt-2 ms-3">
                            <input class="form-check-input destination" @if(\Request::query('destination') != null) {{ \Request::query('destination') == 'Jawa' ? 'checked' : '' }} @endif type="radio" name="destination" id="jawa" value="Jawa">
                                <label class="form-check-label text-dark fontSize-14" for="jawa">
                                    Jawa
                                </label>
                            </div>
                            <div class="form-check mt-2 ms-3">
                            <input class="form-check-input destination" @if(\Request::query('destination') != null) {{ \Request::query('destination') == 'Papua' ? 'checked' : '' }} @endif type="radio" name="destination" id="papua" value="Papua">
                                <label class="form-check-label text-dark fontSize-14" for="papua">
                                    Papua
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="bg-filter-trip p-4 mt-4">
                        <div class="col-12">
                            <label for="people" class="form-label text-dark fontSize-18 fw-bold mb-3">Category</label>
                            @forelse ($categories as $key => $item)
                                <div class="form-check mt-2 ms-3">
                                    <input class="form-check-input categories" type="radio" {{ \Request::query('categories') == $item->name ? 'checked' : '' }} name="categories" id="categories{{ $key }}" value="{{ $item->name ?? '' }}">
                                    <label class="form-check-label text-dark fontSize-14" for="categories{{ $key }}">
                                        {{ $item->name ?? '' }}
                                    </label>
                                </div>
                            @empty
                                Categories not found
                            @endforelse
                        </div>
                    </div>

                </div>
            </form>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex py-3 ms-auto py-lg-0">
                            <button class="btn btn-sm fontSize-12 fw-normal order-1 order-lg-0" type="button">
                                Best Destination
                            </button>
                            <span class="fontSize-14 order-0 py-2 ">
                                <input type="text" value="{{ \Request::query('find') ?? '' }}" id="findTrip" name="find" class="form-control find" placeholder="Search Name, push enter to find">
                            </span>
                            {{-- <button class="btn bg-white backdrop-blur order-0 br-10 py-2" type="button">
                                <iconify-icon icon="mingcute:settings-6-line" style="color: #ffad0d;" width="32" flip="horizontal"></iconify-icon>
                            </button> --}}
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="card-group">
                            @forelse ($filter as $key => $popular)
                                @if ($key % 3 === 0 && $key !== 0)
                                    </div><div class="card-group mt-4">
                                @endif
                                <div class="card me-4 mb-4" style="max-width: 212px;">
                                    <div class="img-text-container">
                                        <img src="@if($popular->packetImage == null) {{ asset('assets/cms/images/noImage.jpg') }} @elseif($popular->packetImage->file == 'from file manager') {{ asset('assets/images/fileGallery/'.$popular->packetImage->name) }} @else {{ asset('assets/images/packagesGallery/'.$popular->packetImage->name) }} @endif" class="card-img-top" alt="...">
                                        <div class="inner">
                                            <div class="text-yellow-star fontSize-14">
                                                <iconify-icon icon="ic:round-star"></iconify-icon> {{ ($popular->packetRating->sum('ratings') == 0) ? $rating = '0' : $rating = (int) $popular->packetRating->sum('ratings') / (int) $popular->packetRating->count('ratings') }}{{ strlen($rating) < 2 ? '.0' : ''  }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('web.excursion',$popular->slug) }}">
                                            <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">{{ $popular->title_idn ?? '-' }}</div>
                                        </a>
                                        <p class="card-text poppins fontSize-10 modal-open">{{ $popular->tag }}</p>
                                        <p class="card-text pt-2">
                                            <small class="text-muted">${{ $popular->packetPrice->price_in_dollars ?? '0' }} /Person</small>
                                            <span>
                                                <button type="button" data-id="{{ $popular->id }}" data-user="{{ $userId }}" class="btn-none bookmarkelse float-end {{ \Controller::checkBookmark($popular->id,$userId) == true ? 'd-none' : '' }}" id="bookmarkelse{{ $popular->id }}"><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="30" height="30"></iconify-icon></button>
                                                <button type="button" data-id="{{ $popular->id }}" data-user="{{ $userId }}" class="btn-none unbookmarkelse float-end {{ \Controller::checkBookmark($popular->id,$userId) == true ? '' : 'd-none' }}" id="unbookmarkelse{{ $popular->id }}"><iconify-icon icon="mingcute:bookmark-fill" style="color: #ffc656;" width="30" height="30"></iconify-icon></button>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="w-100 bg-info fontSize-14 text-white text-center p-2">
                                    trip not found
                                </div>
                            @endforelse
                        </div>
                    </div>


                    {{-- <div class="col-12 mt-4">
                        <div class="h-100 justify-content-center">
                            <div class="card-group">
                                @forelse ($filter as $key => $popular)
                                    @if ($key == 2)
                                        <br>
                                    @endif
                                    <div class="card me-4" style="height: 420px;max-height: 440px;max-width: 257px;">
                                        <div class="img-text-container">
                                            <img src="@if($popular->packetImage == null) {{ asset('assets/cms/images/noImage.jpg') }} @elseif($popular->packetImage->file == 'from file manager') {{ asset('assets/images/fileGallery/'.$popular->packetImage->name) }} @else {{ asset('assets/images/packagesGallery/'.$popular->packetImage->name) }} @endif" class="card-img-top" alt="...">
                                            <div class="inner">
                                                <div class="text-yellow-star fontSize-14">
                                                    <iconify-icon icon="ic:round-star"></iconify-icon> {{ ($popular->packetRating->sum('ratings') == 0) ? $rating = '0' : $rating = (int) $popular->packetRating->sum('ratings') / (int) $popular->packetRating->count('ratings') }}{{ strlen($rating) < 2 ? '.0' : ''  }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <a href="{{ route('web.excursion',$popular->slug) }}">
                                            <div class="card-title inter text-dark fw-bolder fontSize-18 mt-2">{{ $popular->title_idn ?? '-' }}</div>
                                        </a>
                                        <p class="card-text poppins fontSize-10 modal-open">{{ $popular->tag }}</p>
                                        <p class="card-text pt-2">
                                            <small class="text-muted">${{ $popular->packetPrice->price_in_dollars ?? '0' }} /Person</small>
                                            <span>
                                                <button type="button" data-id="{{ $popular->id }}" data-user="{{ $userId }}" class="btn-none bookmarkelse float-end {{ \Controller::checkBookmark($popular->id,$userId) == true ? 'd-none' : '' }}" id="bookmarkelse{{ $popular->id }}"><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="30" height="30"></iconify-icon></button>
                                                <button type="button" data-id="{{ $popular->id }}" data-user="{{ $userId }}" class="btn-none unbookmarkelse float-end {{ \Controller::checkBookmark($popular->id,$userId) == true ? '' : 'd-none' }}" id="unbookmarkelse{{ $popular->id }}"><iconify-icon icon="mingcute:bookmark-fill" style="color: #ffc656;" width="30" height="30"></iconify-icon></button>
                                            </span>
                                        </p>
                                        </div>
                                    </div>
                                @empty
                                        <div class="w-100 bg-info fontSize-14 text-white text-center p-2">
                                            trip not found
                                        </div>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-12 mt-4">
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
                                    <div class="card-body">
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
                                    <div class="card-body">
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
                                    <div class="card-body">
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
                    </div> --}}

                    {{-- <div class="col-12 mt-4">
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
                                    <div class="card-body">
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
                                    <div class="card-body">
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
                                    <div class="card-body">
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
                    </div> --}}

                </div>
            </div>
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
        $(document).ready(function () {
            // bookmark
            $('.bookmarkelse').click(function (e) {
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
                        $('#bookmarkelse'+id).addClass('d-none');
                        $('#unbookmarkelse'+id).removeClass('d-none');
                    },
                    error: function(xhr) {
                        var err = eval("(" + xhr.responseText + ")");
                        Swal.fire(JSON.stringify(err.message));
                    }
                });
            });
            $('.unbookmarkelse').click(function (e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var user = $(this).attr('data-user');
                console.log(id)
                console.log(user)
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
                        $('#bookmarkelse'+id).removeClass('d-none');
                        $('#unbookmarkelse'+id).addClass('d-none');
                    },
                    error: function(xhr) {
                        var err = eval("(" + xhr.responseText + ")");
                        Swal.fire(JSON.stringify(err.message));
                    }
                });
            });
            // filter search
            $('#findTrip').keypress(function (e) {
                var key = e.which
                if (key == 13) {
                    var val = $(this).val();
                    var url = new URL(window.location.href);
                    var queryParams = Object.fromEntries(url.searchParams.entries());
                    queryParams.find = val;
                    url.search = new URLSearchParams(queryParams);
                    window.location.href = url.href;
                    // var url = "{{ route('web.filterTrip') }}?find="+val;
                    // window.location.href = url;
                }
            });
            // filter click category
            $('.categories').click(function() {
                var val = $(this).val();
                // Create a URL object from the current URL
                var url = new URL(window.location.href);
                // Get the existing query parameters as an object
                var queryParams = Object.fromEntries(url.searchParams.entries());
                // Update or add the 'categories' parameter
                queryParams.categories = val;
                // Set the new query parameters
                url.search = new URLSearchParams(queryParams);
                // Update the URL
                window.location.href = url.href;
            });
            $('.destination').click(function() {
                var val = $(this).val();
                // Create a URL object from the current URL
                var url = new URL(window.location.href);
                // Get the existing query parameters as an object
                var queryParams = Object.fromEntries(url.searchParams.entries());
                // Update or add the 'categories' parameter
                queryParams.destination = val;
                // Set the new query parameters
                url.search = new URLSearchParams(queryParams);
                // Update the URL
                window.location.href = url.href;
            });

        });
        //-----JS for Price Range slider-----
        $(function() {
            var minMax = "{{ \Request::query('minMax') ?? '0' }}";

            if (typeof minMax === 'string') {
                minMax = minMax.split("|")
            }

            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 10000,
                values: [parseInt(minMax[0] ?? 0), parseInt(minMax[1] ?? 0)],
                stop: function(event, ui) {
                    var val = ui.values[ 0 ]+'|'+ui.values[ 1 ];
                    var url = new URL(window.location.href);
                    var queryParams = Object.fromEntries(url.searchParams.entries());
                    queryParams.minMax = val;
                    url.search = new URLSearchParams(queryParams);
                    window.location.href = url.href;
                },
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$ " + ui.values[ 0 ] + " - $ " + ui.values[ 1 ] );
                }
            });

            $( "#amount" ).val( "$ " + $( "#slider-range" ).slider( "values", 0 ) +
            " - $ " + $( "#slider-range" ).slider( "values", 1 ) );
        });



    </script>
@endpush
