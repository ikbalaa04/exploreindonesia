@extends('web.template.main')
@section('title','Explore Borneo Indonesia (indecon)')

@section('banner')
    <section class="pb-6" style="background: @if($banner->bannerFile != null) url({{ asset('assets/images/banner/'.$banner->bannerFile->file_name) }}) @else url({{ asset('assets/cms/images/noImage.jpg') }}) @endif no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
        <div class="container">
        <div class="row flex-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-white fontSize-12 active"><a href="{{ route('web.home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item text-white fontSize-12 active" aria-current="page"><a href="{{ route('web.destination') }}" class="text-white">Destination</a></li>
                        <li class="breadcrumb-item text-white fontSize-12 active" aria-current="page">Kalimantan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-5 col-md-4 order-md-1 pe-0 ">

            </div>
            <div class="col-md-8 col-lg-7 mt-5 text-center text-md-start">
                <div class="fw-thin fontSize-40 text-white montserrat mb-2" style="line-height: normal;">
                    {{ $banner->bannerFile != null ? $banner->bannerFile->title : 'no title' }}
                    <br>
                    <span class="fw-bolder fontSize-60">{{ $banner->bannerFile != null ? $banner->bannerFile->subtitle : 'no subtitle' }}</span>
                </div>
                <p class="mt-3 mb-5 fontSize-14 text-white">{{ $banner->bannerFile != null ? $banner->bannerFile->description : 'no description' }}</p>

                <div class="mt-5 pt-4">
                    <div class="bg-white mt-5 py-2 px-4 br-10">
                        <form action="{{ route('web.filterTrip') }}" class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="border-end  justify-content-md-center">
                                    <label for="formGroupPeople" class="form-label ">
                                        <img src="{{ asset('assets/web/img/indecon/peopleform.png') }}" alt="">
                                    </label>
                                    <input type="text" class="form-control-borneo" id="formGroupPeople" placeholder="How many people ?">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="justify-content-md-center">
                                    <label for="formGroupDate" class="form-label ">
                                        <img src="{{ asset('assets/web/img/indecon/dateform.png') }}" alt="">
                                    </label>
                                    <input type="date" class="form-control-borneo" id="formGroupDate" placeholder="When do you want to go ?">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 text-end">
                                <button class="btn  btn-warning fontSize-14 br-10 h-100">Find Trip</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- end of .container-->
    </section>
@endsection
@section('content')
    <!-- <section> begin ============================-->
    <section class="bg-softPink py-4">
        <div class="container-lg">
            <div class="row justify-content-start">
                <div class="col-md-12 col-lg-12 text-left mb-3 text-center">
                    <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active-borneo fontSize-14 poppins" style="color: #2F2F2F" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview" aria-selected="true">Over View</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#categoryTab" class="nav-link fontSize-14 poppins" style="color: #2F2F2F" id="pills-category-tab">Category</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#ecotourismTab" class="nav-link fontSize-14 poppins" style="color: #2F2F2F" id="pills-ecotourism-tab">Ecotourism Guide</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#popularTab" class="nav-link fontSize-14 poppins" style="color: #2F2F2F" id="pills-popular-tab">Popular</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fontSize-14 poppins" style="color: #2F2F2F" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false">Review</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active sans fontSize-16 py-5 w-90 mx-auto" style="color: #191919;line-height: 145.5%;" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
                            Memualai petualangan  di pulau Kalimantan yang memukau dengan keindahan hutan tropisnya yang lebat dan keanekaragaman satwa liar yang mendiami habitatnya. Dari hutan-hutan megah yang menjulang tinggi hingga sungai-sungai yang mengalir melintasi pulau, Kalimantan menawarkan panorama alam yang menakjubkan. Di antara suara kicauan burung-burung tropis dan riuhnya suara air terjun, kita dapat menjumpai spesies ikonis seperti orangutan, harimau Sumatera, dan gajah, memberikan pengalaman alam yang tak terlupakan bagi para pengunjung yang menjelajah pulau ini.
                        </div>
                        {{-- <div class="tab-pane fade sans fontSize-16 py-5 w-90 mx-auto" style="color: #191919;line-height: 145.5%;" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab">
                        </div> --}}
                        {{-- <div class="tab-pane fade sans fontSize-16 py-5 w-90 mx-auto" style="color: #191919;line-height: 145.5%;" id="pills-ecotourism" role="tabpanel" aria-labelledby="pills-ecotourism-tab">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi fuga ad consequuntur pariatur quibusdam distinctio illo sit? Laborum modi a aliquid illum suscipit assumenda pariatur repudiandae sapiente voluptates, quas ea!
                        </div> --}}
                        {{-- <div class="tab-pane fade sans fontSize-16 py-5 w-90 mx-auto" style="color: #191919;line-height: 145.5%;" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque voluptatem fugit eveniet maxime cumque explicabo sapiente culpa, magnam dolore suscipit deserunt impedit facilis qui minima quasi harum ratione architecto nihil!
                        </div> --}}
                        <div class="tab-pane fade sans fontSize-16 py-5 w-90 mx-auto" style="color: #191919;line-height: 145.5%;" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                            <div class="row">
                                @forelse ($reviews as $review)
                                    <div class="col-3">
                                        <div class="bg-member pt-3 pb-3 pe-5 ps-4" style="background: #FDF8F1 !important;border:none !important;border-radius:11px">
                                            <div class="text-center">
                                                <img src="{{ ($review->file != null) ? asset('assets/images/testimony/'.$review->file) : asset('assets/web/img/indecon/noimage.png') }}" alt="" width="159" height="159" style="border-radius: 500px">
                                            </div>
                                            <div class="text-center mt-2">
                                                @for ($i=0; $i < $review->rating; $i++)
                                                    <iconify-icon icon="solar:star-bold-duotone" style="color: #ffc62b;"></iconify-icon>
                                                @endfor
                                            </div>
                                            <div class="text-softGray fontSize-16  fw-bold roboto">
                                                {{ $review->name ?? '' }}
                                            </div>
                                            <div class="text-softGray fontSize-12 roboto">
                                                {{ $review->title ?? '-' }}
                                            </div>
                                            <div class="text-softGray mt-2 fontSize-12 roboto">
                                                {{ $review->description ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">No review found</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->

    <!-- <section> begin ============================-->
    <section class="bg-softPink py-4" id="categoryTab">
        <div class="container-lg">
            <div class="row justify-content-start">
                <div class="col-12 text-center mb-5">
                    <div class="fontSize-18 poppins" style="color: #4E672A">Find Your Dream Destination</div>
                    <div class="roboto fontSize-28 fw-bold text-dark">Explore Top Category In Kalimantan</div>
                </div>
                <div class="col-12 text-center">
                    <ul class="nav nav-pills justify-content-center shuffle-filter">
                        @forelse ($categories as $key => $category)
                            <input type="hidden" value="{{ $category->name }}" name="firstFilter" id="firstFilter" class="firstFilter">
                            <li class="nav-item pe-3" data-target={{ $category->name ?? '-' }}>
                                <button id="{{ $category->name ?? '-' }}" class="@if($key == 0) btn-active-borneo @else btn-grey @endif btn py-2 px-4 fontSize-14">{{ $category->name ?? '-' }}</button>
                            </li>
                        @empty
                            <li>
                                Categories not found
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="h-100 mt-4 justify-content-center mx-20">
                <div class="card-group shuffle-container">
                    @forelse ($packets as $key => $item)
                        @php
                            $dataGroup = [];
                            if ($item->categories_id != null) {
                                $explode =  explode(',',$item->categories_id);
                                foreach ($explode as $key => $value) {
                                    $dataGroup[] = App\Http\Controllers\Controller::getCategory($value);
                                }
                                $groups = implode(',',$dataGroup);
                            }
                        @endphp
                        <div class="card me-4 min-card-shuffle" data-groups='{{ json_encode($dataGroup) }}' style="background-image: @if($item->packetImage == null) url('../assets/cms/images/noImage.jpg') @elseif($item->packetImage->file == 'from file manager') url('../assets/images/fileGallery/{{ $item->packetImage->name }}') @else url('../assets/images/packagesGallery/{{ $item->packetImage->name }}') @endif;background-repeat: no-repeat;background-size: cover;background-position: center;width:235px">
                            <div class="card-body inter">
                            </div>
                            <div class="card-footer inter">
                                <a href="{{ route('web.excursion',$item->slug) }}" class="card-title text-white fontSize-22">{{$item->title_idn ?? '-'}}</a>
                                <div class="card-title fontSize-12 text-white">{{ $item->length_of_vacation ?? '-' }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-12">
                                <div class="text-white bg-danger text-center p-2 col-12">no travel package found</div>
                            </div>
                        </div>
                    @endforelse
                </div>


                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-4 bg-softPink pt-md-6" id="ecotourismTab">

        <div class="container">
          <div class="row align-items-center">
              <div class="col-md-6 col-lg-6 me-5 text-center ms-auto text-md-start">
                <div class="fontSize-24 roboto uppercase" style="color: #2F2F2F;letter-spacing: 3.375px;line-height: 42.188px;">travel experience with natural forest ecosystem in Kalimantan</div>
                <p class="fontSize-16 sans pt-5" style="color: #2F2F2F;line-height: 25.313px;">
                    Welcome to Kalimantan, Indonesia's eco-tourism gem! This captivating region invites you to immerse yourself in its natural wonders and experience the true essence of sustainable travel. Kalimantan is home to vast stretches of pristine rainforests, breathtaking landscapes, and a rich biodiversity that will leave you in awe.
                    <br>
                    <br>
                    As you explore Kalimantan's untamed wilderness, you'll be amazed by the dense jungles teeming with life. Traverse the winding trails, surrounded by towering trees and an orchestra of chirping birds. Encounter rare and exotic wildlife, including the iconic orangutans swinging through the trees, as well as proboscis monkeys, sun bears, and a myriad of bird species. Kalimantan's lush rainforests offer a glimpse into an untouched world, where nature reigns supreme.
                </p>
                <div class="pt-4">
                    <a href="{{ route('web.tourPlanning') }}" class="btn btn-warning text-white uppercase fontSize-14 br-5 py-2">Start Planning here</a>
                </div>
              </div>
            <div class="col-md-6 lato col-lg-5 text-lg-center"><img class="img-fluid mb-5 mb-md-0" src="{{ asset('assets/web/img/indecon/About-Us-Homepage.png') }}" alt=""></div>
          </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->

    <!-- <section> begin ============================-->
    <section class="bg-softPink pt-4" id="popularTab" style="padding-bottom:0px !important">
        <div class="container-lg">
            <div class="row justify-content-start">
                <div class="col-md-12 col-lg-12 text-left pt-2 mb-5">
                    <div class="roboto fontSize-28 fw-bold text-dark">Popular Destination</div>
                </div>
            </div>
            <div class="h-100 justify-content-center">
                <div class="card-group">
                    @forelse ($populars as $popular)
                        <div class="card me-4" style="height: 335px;max-height: 350px;max-width: 257px;">
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
                                <div class="card-title inter text-dark fw-bolder fontSize-16 mt-2">{{ $popular->title_idn ?? '-' }}</div>
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
                        <div class="w-100 bg-warning text-white text-center p-2 br-10">
                            popular packet not found
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>
    <!-- <section> close ============================-->

    <!-- <section> begin ============================-->
    <section class="bg-softPink" id="blog" style="padding-top:2rem !important">
        <div class="container-lg">
            <div class="row justify-content-start">
                <div class="col-md-12 col-lg-12 text-center pt-2 mb-5">
                    <div class="roboto fontSize-36 text-dark">Discover the Enchanting Charms of Kalimantan</div>
                </div>
            </div>
            <div class="row justify-content-start">
                @forelse ($blogs as $key => $item)
                    @if ($key == 0)
                        <div class="col-md-7 col-sm-12">
                            <img src="{{ $item->file == null ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/news/'.$item->file) }}" alt="" class="img-fluid">
                            <div class="roboto fontSize-14" style="color: #717171;">{{ $item->type ?? '-' }}</div>
                            <a href="{{ route('web.detailBlog',[$item->slug]) }}" class="w-45 roboto fontSize-18 pt-2 pb-3" style="color: #505050;cursor: pointer;">{{ $item->name ?? '-' }}</a>
                            <div class="roboto fontSize-12" style="color: #5C5C5C;">{!! strip_tags( \Illuminate\Support\Str::words($item->description, 60,' ...')) !!}</div>
                        </div>
                    @endif
                @empty
                    <div class="col-md-12 bg-warning text-white fontSize-18 text-center">No News or article found</div>
                @endforelse
                <div class="col-md-5 col-sm-12">
                    <div class="row">
                        @forelse ($blogs as $key => $item)
                            @if ( $key >= 1)
                                <div class="col-12 {{ ($key == 2) ? 'pt-4' : '' }}">
                                    <img src="{{ $item->file == null ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/news/'.$item->file) }}" alt="" class="img-fluid img-blog-right">
                                    <div class="roboto fontSize-14" style="color: #717171;">{{ $item->type ?? '-' }}</div>
                                    <a href="{{ route('web.detailBlog',[$item->slug]) }}" class="w-45 roboto fontSize-18 pt-2 pb-3" style="color: #505050;cursor: pointer">{{ $item->name ?? '-' }}.</a>
                                    <div class="roboto fontSize-12" style="color: #5C5C5C;">{!! strip_tags( \Illuminate\Support\Str::words($item->description, 60,' ...')) !!}</div>
                                </div>
                            @endif
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->

    <div class="row justify-content-center bg-softPink pb-5 mt-n1" style="background: #2B2927 !important">
        @forelse ($partner as $item)
            <div class="col-1 col-sm-1 col-md-1 mt-5 mb-md-0 align-self-center"><img class="img-fluid" src="{{ $item->file == null ? asset('assets/web/img/indecon/noimage.png') : asset('assets/images/partner/'.$item->file) }}" alt="" height="50"></div>
        @empty
            <div class="col-12 text-center bg-danger text-white p-2 fontSize-14">No partners found</div>
        @endforelse
    </div>



@endsection

@push('after-script')
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
            $('#pills-overview-tab').click(function (e) {
                $('#pills-category-tab').removeClass('active active-borneo');
                $('#pills-ecotourism-tab').removeClass('active active-borneo');
                $('#pills-popular-tab').removeClass('active active-borneo');
                $('#pills-review-tab').removeClass('active active-borneo');
                $('#pills-overview-tab').removeClass('active');
                $('#pills-overview-tab').addClass('active-borneo');
            });

            $('#pills-ecotourism-tab').click(function (e) {
                $('#pills-category-tab').removeClass('active active-borneo');
                $('#pills-overview-tab').removeClass('active active-borneo');
                $('#pills-popular-tab').removeClass('active active-borneo');
                $('#pills-review-tab').removeClass('active active-borneo');
                $('#pills-ecotourism-tab').removeClass('active');
                $('#pills-ecotourism-tab').addClass('active-borneo');
            });

            $('#pills-category-tab').click(function (e) {
                $('#pills-ecotourism-tab').removeClass('active active-borneo');
                $('#pills-overview-tab').removeClass('active active-borneo');
                $('#pills-popular-tab').removeClass('active active-borneo');
                $('#pills-review-tab').removeClass('active active-borneo');
                $('#pills-category-tab').removeClass('active');
                $('#pills-category-tab').addClass('active-borneo');
            });

            $('#pills-popular-tab').click(function (e) {
                $('#pills-ecotourism-tab').removeClass('active active-borneo');
                $('#pills-overview-tab').removeClass('active active-borneo');
                $('#pills-category-tab').removeClass('active active-borneo');
                $('#pills-review-tab').removeClass('active active-borneo');
                $('#pills-popular-tab').removeClass('active');
                $('#pills-popular-tab').addClass('active-borneo');
            });

            $('#pills-review-tab').click(function (e) {
                $('#pills-ecotourism-tab').removeClass('active active-borneo');
                $('#pills-overview-tab').removeClass('active active-borneo');
                $('#pills-category-tab').removeClass('active active-borneo');
                $('#pills-popular-tab').removeClass('active active-borneo');
                $('#pills-review-tab').removeClass('active');
                $('#pills-review-tab').addClass('active-borneo');
            });
        });
        // shuffle.js
        window.onload = function () {
            var Shuffle = window.Shuffle;
            var element = document.querySelector('.shuffle-container');
            var shuffleInstance = new Shuffle(element, {
                itemSelector: 'div',
            });
            var firstFilter = $('#firstFilter').val();
            shuffleInstance.filter(firstFilter);

            $('.shuffle-filter li').on('click',function(e){
            e.preventDefault();

            $('.shuffle-filter li').removeClass('selected');
            $('.shuffle-filter li button').removeClass('btn-active-borneo');
            $('.shuffle-filter li button').addClass('btn-grey');
            $(this).addClass('selected');
            var keyword = $(this).attr('data-target');

            $('#'+keyword).removeClass('btn-grey');
            $('#'+keyword).addClass('btn-active-borneo');

            shuffleInstance.filter(keyword);
            });
        }
    </script>
@endpush
