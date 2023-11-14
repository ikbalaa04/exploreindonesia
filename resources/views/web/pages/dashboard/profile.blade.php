@extends('web.template.main')
@section('title','Dashboard user, your detail profile')
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
                        <a href="{{ route('dashboard.user.wishlist') }}" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Saved</a>
                    </div>
                    <div class="mt-4">
                        <div href="" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Purchase list</div>
                    </div>
                    <div class="border-bottom pt-5"></div>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.user.profile') }}" class="fontSize-16 " style="font-weight: bolder;color: #2F2F2F;line-height: normal;">My Account</a>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('logout') }}" class="fontSize-16" style="font-weight: 500;color: #2F2F2F;line-height: normal;">Logging Out</a>
                    </div>
                </div>

                <div class="col-md-8 ms-auto mt-4">
                    <div class="bg-white">
                        <div class="row">
                            <div class="py-3 px-5">
                                <div class="col-12 fw-bold">
                                    Personal Data
                                </div>
                            </div>
                            <div class="px-3">
                                <div class="border-bottom"></div>
                            </div>
                            <div class="col-12 px-5 pt-4 pb-5">
                                <form action="{{ route('userManagement.update', Auth::user()->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3 col-12">
                                        <label class="form-label text-center mx-auto d-block" for="">Edit Photo</label>
                                        <div class="d-flex justify-content-center">
                                            @if (Auth::user()->file != null)
                                                <img src="{{ asset('assets/images/user/'.Auth::user()->file) }}" id="imageResult" alt="" width="100">
                                            @else
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="100">
                                            @endif
                                        </div>
                                        <div class="avartar-picker mt-5">
                                            <input id="upload" class="input-btn mx-auto d-block"  name="file" type="file" onchange="readURL(this);" />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="fullname" value="{{ Auth::user()->name ?? null }}">
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email ?? null }}">
                                    </div>
                                    <div class="mb-4 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-6">
                                        <label for="mobile_phone" class="form-label">Mobile Phone</label>
                                        <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="{{ Auth::user()->mobile_phone ?? null }}">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-6">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ Auth::user()->facebook ?? null }}">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-6">
                                        <label for="twitter" class="form-label">twitter</label>
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{ Auth::user()->twitter ?? null }}">
                                    </div>
                                    <div class="mb-3 col-md-3 col-sm-6">
                                        <label for="instagram" class="form-label">instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{ Auth::user()->instagram ?? null }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="birth_date">birth date</label>
                                        <input type="date" name="birth_date" value="{{ Auth::user()->birth_date ?? null }}" placeholder="Example: someUrl.com" class="form-control" id="birth_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">--Select--</option>
                                            <option value="1" {{ (Auth::user()->gender == 1) ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ (Auth::user()->gender == 2) ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-2 mx-4">
                                        <label for="date" class="form-label">date</label>
                                        <select id="date" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="year" class="form-label">year</label>
                                        <select id="year" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                        </select>
                                    </div> --}}
                                    <div class="mb-3 col-12">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" value="{{ Auth::user()->address ?? null }}" class="form-control" id="address">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-end">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white mt-5">
                        <div class="row">
                            <div class="py-3 px-5">
                                <div class="col-12 fw-bold">
                                    Media Social
                                </div>
                            </div>
                            <div class="px-3">
                                <div class="border-bottom"></div>
                            </div>
                            <div class="col-12 px-5 pt-4 pb-5">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <iconify-icon icon="ant-design:facebook-filled" style="color: #3f579e;"></iconify-icon> <span class="fw-bold">Facebook</span>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <div class="text-primary fontSize-12 text-end">
                                            {{ Auth::user()->facebook ?? 'Yourusername' }}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <iconify-icon icon="skill-icons:instagram"></iconify-icon> <span class="fw-bold">instagram</span>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <div class="text-primary fontSize-12 text-end">
                                            {{ Auth::user()->instagram ?? 'Yourusername' }}
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <iconify-icon icon="logos:twitter"></iconify-icon> <span class="fw-bold">Twitter</span>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <div class="text-primary fontSize-12 text-end">
                                            {{ Auth::user()->twitter ?? 'Yourusername' }}
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
        $(document).ready(function() {
            /*  ==========================================
                SHOW UPLOADED IMAGE
            * ========================================== */
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imageResult')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(function () {
                $('#upload').on('change', function () {
                    readURL(input);
                });
            });

            /*  ==========================================
                SHOW UPLOADED IMAGE NAME
            * ========================================== */
            var input = document.getElementById( 'upload' );
            var infoArea = document.getElementById( 'upload-label' );

            input.addEventListener( 'change', showFileName );
            function showFileName( event ) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
            }
        });
    </script>
@endpush