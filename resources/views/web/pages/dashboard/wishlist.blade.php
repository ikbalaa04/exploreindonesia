@extends('web.template.main')
@section('title','Dashboard user, your wishlist')
@push('after-style')

@endpush
@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
@if (Auth::user() != null && Auth::user()->user_type != 'partner')
    <section class="pt-7 pt-md-8 bg-softWhite" style="padding-bottom: 4rem">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 mb-2">
                    <img src="{{ asset('assets/web/img/indecon/backgroundDashboardUser.png') }}" alt="" class="img-fluid br-10">
                </div>

                <div class="col-md-3 ms-4">
                    <div class="mb-2">
                        <img src="{{ Auth::user()->file == null ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/user/'.Auth::user()->file) }}" alt="" class="img-fluid fit-cover br-100Persen ms-2 mt-n7" style="width: 100px;height:100px">
                    </div>
                    <div class="fontSize-20" style="color: #2F2F2F;font-style: normal;font-weight: 700;line-height: normal;">{{ Auth::user()->name ?? '-' }}</div>
                    <div class="text-dark mt-3 pb-5 fontSize-14 border-bottom" style="font-weight: 400;line-height: normal;">
                        <div class="row">
                            <div class="col-12">@if(Auth::user()->gender == 1) <iconify-icon icon="entypo:man"></iconify-icon> Men @else <iconify-icon icon="fa:female"></iconify-icon> Female @endif</div>
                            <div class="col-12"><iconify-icon icon="bi:phone"></iconify-icon> {{ Auth::user()->mobile_phone ?? '-' }}</div>
                            <div class="col-12"><iconify-icon icon="dashicons:email-alt"></iconify-icon> {{ Auth::user()->email ?? '-' }}</div>
                            <div class="col-12"><iconify-icon icon="entypo:address"></iconify-icon> {{ Auth::user()->address ?? '-' }}</div>
                        </div>
                        <ul>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('dashboard.user.chat') }}" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Chat</a>
                    </div>
                    <div class="mt-4">
                        <div href="" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Trip History</div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.user.wishlist') }}" class="fontSize-16" style="font-weight: bolder;color: #2F2F2F;line-height: normal;">Saved</a>
                    </div>
                    <div class="mt-4">
                        <div href="" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Purchase list</div>
                    </div>
                    <div class="border-bottom pt-5"></div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.user.profile') }}" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">My Account</a>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('logout') }}" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Logging Out</a>
                    </div>
                </div>

                <div class="col-md-8 ms-auto mt-4">
                    @forelse ($wishlist as $key => $wish)
                        <div class="bg-white p-4 mt-5 br-20">
                            <div class="row">
                                <div class="col-3 ml-auto">
                                    <img src="@if($wish->packet->packetImage == null) {{ asset('assets/cms/images/noImage.jpg') }} @elseif($wish->packet->packetImage->file == 'from file manager') {{ asset('assets/images/fileGallery/'.$wish->packet->packetImage->name) }} @else {{ asset('assets/images/packagesGallery/'.$wish->packet->packetImage->name) }} @endif" alt="" class="img-fluid br-10">
                                </div>
                                <div class="col-5">
                                    <div class="fontSize-18 text-dark" style="font-weight: 600;line-height: normal;">{{ $wish->packet->title_idn ?? '-' }}</div>
                                    <div class="fontSize-12 mt-3 mb-1" style="font-weight: 300;line-height: normal;">
                                        <iconify-icon icon="ic:round-star" style="color: #FFC62B;"></iconify-icon> <span class="pe-3 text-yellow-navbar"> 
                                            {{ ($wish->packet->packetRating->sum('ratings') == 0) ? $rating = '0' : $rating = (int) $wish->packet->packetRating->sum('ratings') / (int) $wish->packet->packetRating->count('ratings') }}{{ strlen($rating) < 2 ? '.0' : ''  }}
                                            <span class="text-darkGray fontSize-12 ms-3" style="font-style: normal;font-weight: 500;line-height: normal;">{{ (int) $wish->packet->packetRating->count('ratings') ?? 0 }} reviews</span>
                                            <div class="poppins  fontSize-12" style="color: #2F2F2F;font-style: normal;font-weight: 500;">By {{ $wish->packet->partner->name ?? '-' }}</div>
                                        </span>
                                    </div>
                                    <div class="fontSize-12 poppins" style="font-style: normal;color: #000;">
                                        {{ $wish->packet->short_description_idn ?? '-' }}
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-end">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#shareModal" class="pe-1 btn-none"><iconify-icon icon="ri:share-line" style="color: #ffc656;" width="28" height="28"></iconify-icon></button>
                                            <button type="button" data-id="{{ $wish->packet->id }}" data-user="{{ Auth::user() ? Auth::user()->id : null }}" class="btn-none bookmark {{ \Controller::checkBookmark($wish->packet->id,Auth::user()->id) == true ? 'd-none' : '' }}" id="bookmark{{ $wish->packet->id }}"><iconify-icon icon="iconoir:bookmark-empty" style="color: #ffc656;" width="28" height="28"></iconify-icon></a>
                                            <button type="button" data-id="{{ $wish->packet->id }}" data-user="{{ Auth::user() ? Auth::user()->id : null }}" class="btn-none unbookmark {{ \Controller::checkBookmark($wish->packet->id,Auth::user()->id) == true ? '' : 'd-none' }}" id="unbookmark{{ $wish->packet->id }}"><iconify-icon icon="mingcute:bookmark-fill" style="color: #ffc656;" width="28" height="28"></iconify-icon></a>
                                    </div>
                                    <div class="col-12 fontSize-12 mt-3" style="color: #999999;">
                                        From
                                        <span class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" data-key={{ $key }} role="switch" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">IDR</label>
                                        </span>
                                        <div class="col-12 mt-sm-n3">
                                            <sup class="fontSize-16 prefixCurrency" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">$</sup>
                                            <span class="fontSize-28 valueCurrency" style="color: #1D1D1D;font-weight: 600;">{{ $wish->packet->packetPrice->price_in_dollars ?? 0 }}</span>
                                            <sup class="fontSize-16 currency" style="color: #1D1D1D;font-style: normal;font-weight: 600;line-height: 145.5%;">USD</sup>
                                            <sub class="fontSize-14" style="color: #999;font-style: normal;font-weight: 500;line-height: normal;">/Person</sub>
                                        </div>
                                    <div class="fontSize-12 mt-3 mb-2" style="font-weight: 300;line-height: normal;">*Paket ini Tidak Bisa dibatalkan</div>
                                    <div>
                                        <a href="" class="bg-yellow br-10 uppercase p-2 fontSize-12 d-block text-white text-center">BOOK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal share -->
                        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="shareModalLabel">Share to your bestie</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            $actual_link = route('web.excursion',$wish->packet->slug) ?? null;
                                        @endphp
                                        <a id="shareExcursion" data-id="whatsapp" target="_blank" href="https://wa.me/?text={{ $wish->packet->title_idn ?? '-' }}%0a{{ $actual_link }}" class="btn bg-cyan text-dark shareExcursion"><iconify-icon icon="logos:whatsapp-icon"></iconify-icon> Whatsapp</a>
                                        <a id="shareExcursion" data-id="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $actual_link }}" class="btn bg-cyan text-dark shareExcursion"><iconify-icon icon="devicon:facebook"></iconify-icon> Facebook</a>
                                        <a id="shareExcursion" data-id="twitter" target="_blank" href="https://twitter.com/intent/tweet?url={{ $actual_link }}" class="btn bg-cyan text-dark shareExcursion"><iconify-icon icon="simple-icons:x"></iconify-icon> Twitter / X</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    @empty
                        <div class="bg-white p-5">
                            <div class="row">
                                <div class="col-6">
                                    <div class="fontSize-18 text-dark" style="font-weight: 600;line-height: normal;">Make your journey now</div>
                                    <div class="fontSize-12 my-3" style="font-weight: 300;line-height: normal;">discover your best destinations and make your wish list here. we are waiting for you to experience the latest ecperience in your life.</div>
                                    <div>
                                        <a href="{{ route('web.destination') }}" class="btn bg-yellow text-white fontSize-12 br-5">Find</a>
                                    </div>
                                </div>
                                <div class="col-4 ms-auto">
                                    <img src="{{ asset('assets/web/img/indecon/nowishlist.png') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @endforelse

                    
                </div>
                
            </div>
        </div>
        <!-- end of .container-->
        
    </section>
@else 
    @php
    header("Location: " . URL::to('/'), true, 302);
    exit();   
    @endphp
@endif
<!-- <section> close ============================-->
<!-- ============================================-->
@endsection
@push('after-script')
    <script>
        $(document).ready(function () {
            // share 
            $('.shareExcursion').click(function (e) { 
                var type = $(this).attr('data-id');
                fbq('trackCustom', 'ShareExcursion', {promotion: 'share_with_'+type});
            });

            // switch idr/usd
            $('#flexSwitchCheckDefault').change(function() {
                var key = $(this).attr('data-key');
                
                if ($(this).is(':checked')) {
                    var valueIdr = {{ $wishlist[$key ?? 0]->packet->packetPrice->price_in_rupiah ?? '0' }}

                    $('.prefixCurrency').text('Rp');
                    $('.valueCurrency').text(valueIdr);
                    $('.currency').text('IDR');
                } else {
                    var key = $(this).attr('data-key');
                    var valueUsd = {{ $wishlist[$key ?? 0]->packet->packetPrice->price_in_dollars ?? '0' }}
           
                    $('.prefixCurrency').text('$');
                    $('.valueCurrency').text(valueUsd);
                    $('.currency').text('USD');
                }
                
            })
            // bookmark
            $('.bookmark').click(function (e) { 
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
                        $('#bookmark'+id).addClass('d-none');
                        $('#unbookmark'+id).removeClass('d-none');
                    },
                    error: function(xhr) {
                        var err = eval("(" + xhr.responseText + ")");
                        Swal.fire(JSON.stringify(err.message));
                    }
                });
            });
            // unbbokmark
            $('.unbookmark').click(function (e) { 
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
                        $('#bookmark'+id).removeClass('d-none');
                        $('#unbookmark'+id).addClass('d-none');
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