@extends('cms.template.main')
@section('title','Dashboard admin file manager')
@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/cms/plugins/dropzone/min/dropzone.min.css') }}">
    <style>
    </style>
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
                <h1>Gallery Photo</h1>
                <span>Kumpulan foto-foto yang sudah di unggah, dan dapat digunakan sebagai, foto dari wisata, yang sudah anda buat.</span>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($getAll as $key => $item)
        <div class="col-md-4 mt-3 col-lg-4 ">
            <span class="close" data-id="{{ $item->id }}" style="cursor: pointer">
                <iconify-icon icon="mingcute:delete-back-fill" style="color: #ff4857;" width="20" height="20"></iconify-icon>
            </span>
            <a data-fslightbox="gallery"
                data-caption="<h1>{{ $item->file ?? 'no title' }}</h1>"
                data-type="image"
                href="{{ asset('assets/images/fileGallery/'.$item->file) }}">
                
                <img src="{{ asset('assets/images/fileGallery/'.$item->file) }}" class="img-fluid" alt="image">
            </a>
        </div>
        @empty
        <div class="col-md-12">
            <div class="fontSize-18 text-dark text-center mx-auto">Tidak ada gambar apa apa disini</div>
        </div>
        @endforelse
        
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
    <script src="{{ asset('assets/cms/plugins/lightbox/fslightbox.js') }}"></script>
    <script type="text/javascript"> 
        $(document).ready(function () {
            $('.close').click(function (e) {
                var id = $(this).attr('data-id');
                var url = "{{ route('fileManager.file.destroy',':id') }}";
                url = url.replace(':id',id);
                Swal.fire({
                title: 'Yakin hapus gambar?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: "json",
                        success: function (response) {
                            Swal.fire('Berhasil hapus!', '', 'success')
                            window.location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('gagal!', '', 'info')
                        }
                    });
                }
                })
            });
        });
    </script>
@endpush