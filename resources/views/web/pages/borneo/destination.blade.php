@extends('web.template.main')
@section('title','Destination reference in kalimantan Indonesia (indecon)')
@section('banner')
    <section class="pb-6 bg-softWhite">
        <div class="container">
        <div class="row flex-center">
            <div class="col-12 mt-2 text-center">
                <div class="fw-bold fontSize-32" style="color: #1D1D1D;">
                    Maps Regions in Kalimantan
                </div>
                <p class="mt-3 mb-4 fontSize-14 w-75 mx-auto" style="color: #4E672A;">
                    Traveling opens the door to extraordinary adventures, connecting us to diverse cultures, breathtaking landscapes, and unforgettable moments that enrich our souls.
                </p>
            </div>
            <div class="col-12 mt-4">
                <a href="#">
                    <img src="{{ asset('assets/web/img/indecon/borneo.png') }}" class="d-block mx-auto" alt="">
                </a>
            </div>
        </div>
        </div>
        <!-- end of .container-->
    </section>
@endsection
@section('content')
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-softWhite py-4">
        <div class="container-lg">
            <div class="row justify-content-start">
            <div class="col-md-12 col-lg-12 text-left mb-5">
                <div class="roboto fontSize-28 fw-bold text-dark">Top Category In Kalimantan</div>
            </div>
            </div>
            <div class="h-100 justify-content-center">
                <div class="card-group">
                    @forelse ($packets as $item)
                        @php
                            $dataGroup = [];
                            if ($item->categories_id != null) {
                                $explode =  explode(',',$item->categories_id);
                                foreach ($explode as $key => $value) {
                                    if ($key == 0) {
                                        $dataGroup[] = App\Http\Controllers\Controller::getCategory($value);
                                    }
                                }
                                $groups = implode(',',$dataGroup);
                            }
                        @endphp
                        <div class="card me-4 min-card-shuffle" style="background-image: @if($item->packetImage == null) url('../assets/cms/images/noImage.jpg') @elseif($item->packetImage->file == 'from file manager') url('../assets/images/fileGallery/{{ $item->packetImage->name }}') @else url('../assets/images/packagesGallery/{{ $item->packetImage->name }}') @endif;background-repeat: no-repeat;background-size: cover;background-position: center;max-width:200px">
                            <div class="card-body inter">
                            </div>
                            <div class="card-footer inter">
                                <h5 class="card-title text-white fontSize-22">{{ $groups ?? '-' }}</h5>
                                <a href="{{ route('web.excursion',$item->slug) }}" style="cursor: pointer" class="card-title fontSize-12 text-white">{{ $item->title_idn ?? '-' }}</a>
                            </div>
                        </div>
                    @empty
                        <div class="w-100 bg-warning text-white text-center p-2 br-10">
                            top category not found
                        </div>
                    @endforelse

                    {{-- <div class="card me-4" style="background-image: url('assets/web/img/indecon/hutansadap.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;height:350px;">
                        <div class="card-body inter">
                        </div>
                        <div class="card-footer inter">
                            <h5 class="card-title text-white fontSize-22">Nature</h5>
                            <div class="card-title fontSize-12 text-white">Taman Naisonal Kutai</div>
                        </div>
                    </div>
                    <div class="card me-4" style="background-image: url('assets/web/img/indecon/hutansadap.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;height:350px;">
                        <div class="card-body inter">
                        </div>
                        <div class="card-footer inter">
                            <h5 class="card-title text-white fontSize-22">Nature</h5>
                            <div class="card-title fontSize-12 text-white">Taman Naisonal Kutai</div>
                        </div>
                    </div>
                    <div class="card" style="background-image: url('assets/web/img/indecon/hutansadap.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;height:350px;">
                        <div class="card-body inter">
                        </div>
                        <div class="card-footer inter">
                            <h5 class="card-title text-white fontSize-22">Nature</h5>
                            <div class="card-title fontSize-12 text-white">Taman Naisonal Kutai</div>
                        </div>
                    </div> --}}
                
                </div>
              
                
                </div>
            </div>
        </div>
        <!-- end of .container-->

    </section>

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-softWhite pt-5 py-4">
        <div class="container-lg">
            <div class="row justify-content-start">
            <div class="col-md-12 col-lg-12 text-left pt-2 mb-5">
                <div class="roboto fontSize-28 fw-bold text-dark">Popular Destination</div>
            </div>
            </div>
            <div class="h-100 justify-content-center">
                <div class="card-group">
                    @forelse ($populars as $popular)
                        <div class="card me-4" style="max-height: 350px;max-width: 257px;">
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
                            <p class="card-text pt-4">
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
        });
    </script>
@endpush