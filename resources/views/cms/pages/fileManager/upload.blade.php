@extends('cms.template.main')
@section('title','Dashboard admin file manager')
@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/cms/plugins/dropzone/min/dropzone.min.css') }}">
@endpush
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <a href="{{ route('fileManager.file.index') }}">
                    <i class="fa-solid fa-caret-left fa-2xl" style="color: rgb(92, 92, 92)"><span style="font-size: 14px"> Kembali</span></i></i>
                </a>
                <h1>File Upload</h1>
                <span>Silahkan upload beberapa file gambar bertype jpg,png,jpeg</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                    <div id="dropzone">
                        <form action="{{ route('fileManager.file.store') }}" class="dropzone needsclick" id="demo-upload" enctype="multipart/form-data">
                            @csrf
                            <div class="dz-message needsclick">
                                <button type="button" class="dz-button">Silahkan menjatuhkan beberapa gambar atau klik untuk mengugah gambar.</button><br />
                                <span class="note needsclick">(Hanya dapat menerima file ber-ekstensi <strong>jpg,png,jpeg</strong>)</span>
                            </div>
                        </form>
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
@push('before-script')
    <script src="{{ asset('assets/cms/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/cms/plugins/highlight/highlight.pack.js') }}"></script>
@endpush
@push('after-script')
    <script src="{{ asset('assets/cms/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script type="text/javascript"> 
        
    </script>
@endpush