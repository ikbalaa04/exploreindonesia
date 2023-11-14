@extends('cms.template.main')
@section('title','Dashboard admin formulir banners')
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>@if (\Request::query('type') == 'edit') Edit Banner @else Add Banner @endif</h1>
                <span>@if (\Request::query('type') == 'edit') Form untuk Mengedit banner {{ $data->name }}. @else Form untuk menambahkan banner baru. @endif </span>
                <br>
                <a href="{{ route('websiteManagement.banner.index') }}" class="">
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
                            <form action="{{ \Request::query('type') == 'edit' ? route('websiteManagement.banner.update', $data->id) : route('websiteManagement.banner.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (\Request::query('type') == 'edit') @method('put') @else @method('post') @endif
                                <div class="col-md-12">
                                    <div class="avartar mt-5 ">
                                        <label for="" class="text-center mx-auto d-block">Picture Banner <span class="fontSize-8 text-warning">(*jpg,png,jpeg)</span> <br><span class="fontSize-8 text-info">*Best size 1440px x 857px</span></label>
                                        <div class="d-flex justify-content-center">
                                            @if (\Request::query('type') == 'edit')
                                                @if ($data->bannerFile->file_name != null)
                                                    <img src="{{ asset('assets/images/banner/'.$data->bannerFile->file_name) }}" id="imageResult" alt="" width="100">
                                                @else
                                                    <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="100">
                                                @endif
                                            @else
                                                <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="100">
                                            @endif
                                        </div>
                                        <div class="avartar-picker mt-5">
                                            <input id="upload" class="input-btn mx-auto d-block"  name="file_banner" type="file" onchange="readURL(this);" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="white_label" class="form-label">white_label</label>
                                    <select name="white_label" class="white_label form-control" id="white_label">
                                        <option value=""></option>
                                        <option value="homepage" @if(\Request::query('type') == 'edit') {{ $data->white_label == 'homepage' ? 'selected' : '' }} @else {{ old('white_label') }} @endif>homepage</option>
                                        <option value="trip_finder" @if(\Request::query('type') == 'edit') {{ $data->white_label == 'trip_finder' ? 'selected' : '' }} @else {{ old('white_label') }} @endif>trip_finder</option>
                                        <option value="about" @if(\Request::query('type') == 'edit') {{ $data->white_label == 'about' ? 'selected' : '' }} @else {{ old('white_label') }} @endif>about</option>
                                    </select>
                                    {{-- <input type="text" name="white_label" value="@if(\Request::query('type') == 'edit') {{ $data->white_label ?? old('white_label') }} @else {{ old('white_label') }} @endif" class="form-control" id="white_label"> --}}
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title"value="@if(\Request::query('type') == 'edit') {{ $data->bannerFile->title ?? old('title') }} @else {{ old('title') }} @endif" placeholder="Title 1" class="form-control" id="title">
                                </div>
                                <div class="col-md-6">
                                    <label for="subtitle" class="form-label">subtitle</label>
                                    <input type="text" name="subtitle" value="@if(\Request::query('type') == 'edit') {{ $data->bannerFile->subtitle ?? old('subtitle') }} @else {{ old('subtitle') }} @endif" placeholder="sub title 1" class="form-control" id="subtitle">
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" name="description" value="@if(\Request::query('type') == 'edit') {{ $data->bannerFile->description ?? old('description') }} @else {{ old('description') }} @endif" class="form-control" id="description" placeholder="Example: Lorem ipsum dolor sit amet consectetur adipisicing elit">
                                </div>
                                <div class="col-6">
                                    <label for="cta_url" class="form-label">URL call to action <span class="text-danger fontSize-10">*optional</span></label>
                                    <input type="text" name="cta_url" value="@if(\Request::query('type') == 'edit') {{ $data->bannerFile->cta_url ?? old('cta_url') }} @else {{ old('cta_url') }} @endif" class="form-control" id="cta_url" placeholder="Example: https://someurl.com">
                                </div>
                                <div class="col-6">
                                    <label for="cta_name" class="form-label">name call to action <span class="text-danger fontSize-10">*optional</span></label>
                                    <input type="text" name="cta_name" value="@if(\Request::query('type') == 'edit') {{ $data->bannerFile->cta_name ?? old('cta_name') }} @else {{ old('cta_name') }} @endif" class="form-control" id="cta_name" placeholder="Example: Let's explore">
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
            $('.white_label').select2({
                placeholder: "Select a white label",
                allowClear: true
            });
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