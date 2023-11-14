@extends('web.template.main')
@section('title','Explore Borneo Indonesia (indecon)')
@push('after-style')
<style>
    .card{
        margin-right:20px!important;
        background: transparent;
        border: none;
    }
</style>
@endpush
@push('share')
    <meta property="og:title" content="{{ $data->name ?? null }}">
    <meta property="og:image" content="{{ ($data->user->file == null) ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/user/'.$data->user->file) }}">
    <meta property="og:image:type" content="website">
    <meta property="og:image:width" content="200">
    <meta property="og:description" content="{{ $data->name ?? null }}">
    <meta property="og:image:height" content="200">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="{{ (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; }}">
    <meta property="twitter:title" content="{{ $data->name ?? null }}">
    <meta property="twitter:description" content="{{ $data->name ?? null }}">
    <meta property="og:url" content="{{ (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; }}">
@endpush
@section('content')
@php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
@endphp
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-7 pt-md-8 bg-softWhite" style="padding-bottom: 4rem">

    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 mb-4">
                <div class="roboto fontSize-18 " style="color: #01366C">{{ $data->type ?? '-' }} <span class="roboto fontSize-12 ps-2 " style="color: #717171">{{ \Carbon\Carbon::parse($data['book_date_time'])->isoFormat('MMMM D, Y') ?? '-' }}</span></div>
            </div>
            <div class="col-12 mb-3">
                <div class="roboto fontSize-30 w-50" style="color: #333">{{ $data->name ?? '-' }}</div>
            </div>
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-7">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ ($data->user->file == null) ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/user/'.$data->user->file) }}" alt="..." class="img-fluid img-detail-news br-100Persen" style="width: 80px;height: 75px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <span class="roboto fontSize-16" style="color: #333">{{ $data->user != null ? $data->user->name : '-' }}</span>
                                <br>
                                <span class="roboto fontSize-12" style="color: #717171">{{ $data->user != null ? $data->user->email : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="text-end">
                            <span class="roboto fontSize-14" style="color:#484848">share:</span> 
                            <a id="shareExcursion" data-id="facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $actual_link }}" class=""><span class="border-end px-1"><iconify-icon icon="gg:facebook" style="color: #717171;"></iconify-icon></span></a>
                            <a id="shareExcursion" data-id="twitter" target="_blank" href="https://twitter.com/intent/tweet?url={{ $actual_link }}" class=""><span class="border-end px-1"><iconify-icon icon="akar-icons:twitter-fill" style="color: #717171;"></iconify-icon></span></a>
                            <a id="shareExcursion" data-id="whatsapp" target="_blank" href="https://wa.me/?text={{ $data->name ?? '-' }}%0a{{ $actual_link }}" class=""><span class="px-1"><iconify-icon icon="ic:round-whatsapp" style="color: #717171;"></iconify-icon></span></a>
                        </div>
                    </div>
                </div>
            </div>
            
           
            <div class="col-9 mt-5">
                <img src="{{ $data->file == null ? asset('assets/cms/images/noImage.jpg') : asset('assets/images/news/'.$data->file) }}" alt="" class="img-fluid img-detail-news" width="100%" style="height:400px">
                <div class="mt-5"></div>
                {!! $data->description !!}

                <div>Tags: 
                    <br>
                    @php
                        $explodeTag = explode(',',$data->tag);
                    @endphp
                    @forelse ($explodeTag as $tag)

                        <div class="btn-active-borneo mt-1 fontSize-10 p-2 btn" style="cursor: auto">#{{ $tag }}</div>
                    @empty
                        #noTag
                    @endforelse
                </div>
                {{-- <div class="my-4">
                    Building a product is something challenging. Putting ourselves in the user's shoes makes us uncover user’s frustrations and identify their problems, which really motivates us to generate ideas and build something for them. Something to meet their needs.
                </div>
                <div>
                    And we want to believe that our solution will be a rock star that users won't stop using. But by the time we finish it, we'll have a hypothesis. A candidate to a solution. Even the best usability experts won't be able to work on a perfect solution with just a single attempt.
                </div> --}}
            </div>

            {{-- related  --}}
            <div class="col-12 text-start mt-5 fw-bolder montserrat fontSize-40" style="color: #333">
                Related blog posts
            </div>
            <div class="col-12 mt-3">
                <div class="card-group">
                    @forelse ($relateds as $item)
                        <div class="card" style="max-width: 435px">
                            <img src="{{ $item->file != null ? asset('assets/images/news/'.$item->file) : asset('assets/cms/images/noImage.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body ps-0">
                            <div class="mt-3 mb-2 roboto fontSize-12" style="color: #717171">{{ $item->type ?? '-' }}</div>
                            <a href="{{ route('web.detailBlog',[$item->slug]) }}" class="card-title roboto fontSize-18" style="color: #505050">{{ $item->name ?? '-' }}</a>
                            <p class="card-text mt-2 roboto fontSize-16" style="color: #5C5C5C">{!! strip_tags( \Illuminate\Support\Str::words($item->description, 40,' ...')) !!}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-white bg-danger text-center p-2 col-12">No found related blogs</div>
                    @endforelse
                    
                
                </div>
            </div>
           
        </div>
    </div>
    <!-- end of .container-->
        
</section>
<!-- <section> close ============================-->
<!-- ============================================-->
@endsection
@push('after-script')
@endpush