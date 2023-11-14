@extends('cms.template.main')
@section('title','Dashboard admin Formulir testimony')
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>@if (\Request::query('type') == 'edit') Edit testimony @else Add testimony @endif</h1>
                <span>@if (\Request::query('type') == 'edit') Form untuk Mengedit testimony {{ $data->name }}. @else Form untuk menambahkan testimony baru. @endif </span>
                <br>
                <a href="{{ route('websiteManagement.testimony.index') }}">
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
                            <form action="{{ \Request::query('type') == 'edit' ? route('websiteManagement.testimony.update', $data->id) : route('websiteManagement.testimony.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (\Request::query('type') == 'edit') @method('put') @else @method('post') @endif
                                <div class="col-md-12">
                                    <div class="avartar mt-5 ">
                                        <label for="" class="text-center mx-auto d-block">Picture testimony</label>
                                        <div class="d-flex justify-content-center">
                                            @if (\Request::query('type') == 'edit')
                                                @if ($data->file != null)
                                                    <img src="{{ asset('assets/images/testimony/'.$data->file) }}" id="imageResult" alt="" width="100">
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
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" value="@if(\Request::query('type') == 'edit') {{$data->name??old('name')}}@else{{old('name')}}@endif" placeholder="Example: John kemod" class="form-control" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Occupation</label>
                                    <input type="text" name="title"value="@if(\Request::query('type')=='edit'){{$data->title??old('title')}}@else{{old('title')}}@endif" placeholder="Example: CEO" class="form-control" id="title">
                                </div>
                                <div class="col-6">
                                    <label for="website" class="form-label">website</label>
                                    <input type="text" name="website" value="@if(\Request::query('type') == 'edit') {{ $data->website ?? old('website')}}@else{{old('website')}}@endif" class="form-control" id="website" placeholder="Example: https://yourcompany.com">
                                </div>
                                <div class="col-6">
                                    <label for="rating" class="form-label">rating</label>
                                    <input type="number" max="5" min="1" name="rating" value="@if(\Request::query('type') == 'edit'){{ $data->rating ?? old('rating') }}@else{{ old('rating') }}@endif" class="form-control" id="rating" placeholder="Example: 5" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">description</label>
                                    <input type="text" name="description" value="@if(\Request::query('type') == 'edit'){{$data->description??old('description')}}@else{{old('description')??''}}@endif" class="form-control" id="description" placeholder="Example: lorem ipsum">
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