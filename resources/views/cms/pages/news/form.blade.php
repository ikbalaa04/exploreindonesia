@extends('cms.template.main')
@section('title','Dashboard admin formulir news')
@push('after-style')
    <link href="{{ asset('assets/cms/plugins/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/cms/css/tagsinput.css') }}" rel="stylesheet">
@endpush
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>@if (\Request::query('type') == 'edit') Edit news / article @else Add news / article @endif</h1>
                <span>@if (\Request::query('type') == 'edit') Form untuk Mengedit news / article {{ $data->name }}. @else Form untuk menambahkan news / article baru. @endif </span>
                <br>
                <a href="{{ route('newsManagement.news.index') }}">
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
                            <form action="{{ \Request::query('type') == 'edit' ? route('newsManagement.news.update', $data->id) : route('newsManagement.news.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (\Request::query('type') == 'edit') @method('put') @else @method('post') @endif
                                <div class="col-md-12">
                                    <div class="avartar mt-5 ">
                                        <label for="" class="text-center mx-auto d-block">Picture news / article</label>
                                        <div class="d-flex justify-content-center">
                                            @if (\Request::query('type') == 'edit')
                                                @if ($data->file != null)
                                                    <img src="{{ asset('assets/images/news/'.$data->file) }}" id="imageResult" alt="" width="100">
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
                                    <label for="name" class="form-label">Name news / article</label>
                                    <input type="text" name="name" value="@if(\Request::query('type') == 'edit') {{$data->name??old('name')}}@else{{old('name')}}@endif" placeholder="Example: news / article 1" class="form-control" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="tag" class="form-label">Tags <span class="text-info text-sm"> *Press enter to add a new tag</span></label>
                                    <input data-role="tagsinput" type="text" name="tag"value="@if(\Request::query('type')=='edit'){{$data->tag??old('tag')}}@else{{old('tag')}}@endif" placeholder="Example: #2023 #cool-news" class="form-control" id="tag">
                                </div>
                                <div class="col-md-12">
                                    <label for="type" class="form-label">Category</label>
                                    <input type="text" name="type" value="@if(\Request::query('type') == 'edit') {{$data->type??old('type')}}@else{{old('type')}}@endif" placeholder="Example: Culture" class="form-control" id="type">
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Content</label>
                                    <textarea name="description" id="description" class="form-control summernote" cols="30" rows="10">{{ (\Request::query('type') == 'edit') ? $data->description  : old('description') }}</textarea>
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
    <script src="{{ asset('assets/cms/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/cms/js/tagsinput.js') }}"></script>
    <script>
        
        $(document).ready(function() {
            $('#description').summernote({
                height: 400
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