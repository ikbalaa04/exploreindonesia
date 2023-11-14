@extends('cms.template.main')
@section('title','Dashboard admin file manager')
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h1>File Manager</h1>
                </div>
                <div class="page-description-actions">
                    <a href="{{ route('fileManager.file.create') }}" class="btn btn-primary"><i class="material-icons">add</i>Upload File</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="card file-manager-group">
                <div class="card-body d-flex align-items-center">
                    <i class="material-icons text-primary">folder</i>
                    <div class="file-manager-group-info flex-fill">
                        <a href="{{ route('fileManager.file.show', Auth::user()->id) }}" class="file-manager-group-title">Photos</a>
                        <span class="file-manager-group-about">{{ $total ?? 0 }} files, {{ $size ?? 0 }} BYTES</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-description">
        <h1>Recent Files</h1>
    </div>
    <div class="row">
        <div class="col-xxl-6">
            @forelse ($recent as $key => $item)
                <div class="card file-manager-recent-item">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            {{-- <i class="material-icons-outlined text-success align-middle m-r-sm">image</i> --}}
                            <img src="{{ asset('assets/images/fileGallery/'.$item->file) }}" width="24" height="24" class="align-middle m-r-sm" alt="">
                            <a href="{{ asset('assets/images/fileGallery/'.$item->file) }}" target="_blank" class="file-manager-recent-item-title flex-fill">{{ $item->file }}.png</a>
                            <span class="p-h-sm">{{ $item->size ?? 0 }}B</span>
                            <span class="p-h-sm text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.y') }}</span>
                            <a href="#" class="dropdown-toggle file-manager-recent-file-actions" id="file-manager-recent-5" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="file-manager-recent-5">
                                <li><a class="dropdown-item" href="{{ asset('assets/images/fileGallery/'.$item->file) }}" download="">Download</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center mx-auto fontSize-14 text-dark">Belum ada data terbaru</div>
            @endforelse
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
    
    <script type="text/javascript"> 
        
    </script>
@endpush