@extends('cms.template.main')
@section('title','Dashboard admin formulir admins')
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>
                    @if (\Request::query('type') == 'edit')
                        Edit {{ $data->user_type == 'admin' ? 'admin' : 'customer' }}
                    @else
                        Add admin
                    @endif
                </h1>
                <span>@if (\Request::query('type') == 'edit') Form untuk Mengedit {{ $data->user_type == 'admin' ? 'admin' : 'customer' }} {{ $data->name }}. @else Form untuk menambahkan admin baru. @endif </span>
                <br>
                <a href="{{ Route::is('userManagement.create') || Route::is('userManagement.edit') ? route('userManagement.index') :  route('dashboard.customer') }}">
                    <i class="fa-solid fa-caret-left fa-2xl" style="color: rgb(92, 92, 92)"><span style="font-size: 14px"> Kembali</span></i></i>
                </a>
            </div>
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
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">
                            <form action="{{ \Request::query('type') == 'edit' ? route('userManagement.update', $data->id) : route('userManagement.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (\Request::query('type') == 'edit') @method('put') @else @method('post') @endif
                                @if (\Request::query('type') == 'add') <input type="hidden" value="admin" name="user_type"> @endif
                                <div class="col-md-12">
                                    <div class="avartar mt-5 ">
                                        <label class="form-label text-center mx-auto d-block" for="">@if(\Request::query('type')=='edit') {{ $data->user_type == 'admin' ? 'Admin' : 'Customer' }} @else Admin @endif Photo</label>
                                        <div class="d-flex justify-content-center">
                                            @if (\Request::query('type') == 'edit')
                                                @if ($data->file != null)
                                                    <img src="{{ asset('assets/images/admin/'.$data->file) }}" id="imageResult" alt="" width="100">
                                                @else
                                                    <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="100">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="100">
                                            @endif
                                        </div>
                                        <div class="avartar-picker mt-5">
                                            <input id="upload" class="input-btn mx-auto d-block"  name="file" type="file" onchange="readURL(this);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name admin</label>
                                    <input type="text" name="name" value="@if(\Request::query('type') == 'edit') {{$data->name??old('name')}}@else{{old('name')}}@endif" placeholder="Example: admin 1" class="form-control" id="name">
                                </div>
                                <div class="col-md-6 @if(\Request::query('type')=='edit') {{ $data->user_type == 'admin' ? '' : 'd-none' }} @endif">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email"value="@if(\Request::query('type')=='edit'){{$data->email??old('email')}}@else{{old('email')}}@endif" placeholder="Example: yourEmail@company.com" class="form-control" id="email" required/>
                                </div>
                                <div class="col-md-6 @if(\Request::query('type')=='edit') {{ $data->user_type == 'admin' ? '' : 'd-none' }} @endif">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required/>
                                </div>
                                <div class="col-sm-6">
                                    <label for="mobile_phone" class="form-label">Mobile Phone</label>
                                    <input type="text" name="mobile_phone" value="@if(\Request::query('type') == 'edit') {{$data->mobile_phone??old('mobile_phone')}}@else{{old('mobile_phone')}}@endif" placeholder="Example: 080989999" class="form-control" id="mobile_phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="website">Website</label>
                                    <input type="text" name="website" value="@if(\Request::query('type') == 'edit') {{$data->website??old('website')}}@else{{old('website')}}@endif" placeholder="Example: someUrl.com" class="form-control" id="website">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="birth_date">birth_date</label>
                                    <input type="date" name="birth_date" value="@if(\Request::query('type') == 'edit') {{$data->birth_date??old('birth_date')}}@else{{old('birth_date')}}@endif" placeholder="Example: someUrl.com" class="form-control" id="birth_date">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="address" class="form-label">Address</label>
                                    <input type="text" name="address" value="@if(\Request::query('type') == 'edit'){{$data->address??old('address')}}@else{{old('address')??''}}@endif" class="form-control" id="address" placeholder="Example: jalan simatupang">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="twitter">ID Twitter</label>
                                    <input type="text" name="twitter" value="@if(\Request::query('type') == 'edit'){{$data->twitter??old('twitter')}}@else{{old('twitter')??''}}@endif" class="form-control" id="twitter" placeholder="Example: anonim">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="instagram">ID Instagram</label>
                                    <input type="text" name="instagram" value="@if(\Request::query('type') == 'edit'){{$data->instagram??old('instagram')}}@else{{old('instagram')??''}}@endif" class="form-control" id="instagram" placeholder="Example: anonim">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="facebook">ID Facebook</label>
                                    <input type="text" name="facebook" value="@if(\Request::query('type') == 'edit'){{$data->facebook??old('facebook')}}@else{{old('facebook')??''}}@endif" class="form-control" id="facebook" placeholder="Example: anonim">
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label" for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                            <option value="1" @if (old('gender') == 1) selected @endif>Laki-Laki</option>
                                            <option value="2" @if (old('gender') == 2) selected @endif>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn @if(\Request::query('type') == 'edit') btn-warning @else btn-primary @endif">@if(\Request::query('type') == 'edit') Update @else Save @endif</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @php
    header("Location: " . URL::to('/'), true, 302);
    exit();
    @endphp
@endif
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
