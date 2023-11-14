@extends('web.template.main')
@section('title','Explore Borneo Indonesia (indecon)')
@section('banner')
    <section class="pb-8" style="background: @if($banner->bannerFile != null) url({{ asset('assets/images/banner/'.$banner->bannerFile->file_name) }}) @else url({{ asset('assets/cms/images/noImage.jpg') }}) @endif no-repeat;max-heigth:1349px;background-size:cover">>
        <div class="container">
        <div class="row flex-center">
            <div class="col-lg-6 col-md-5 order-md-1 pe-0 "><img class="img-fluid img-banner-about" src="{{ asset('assets/web/img/indecon/banner2.png') }}" alt="" /></div>
            <div class="col-md-7 col-lg-6 mt-5 text-center text-md-start">
            <div class="fw-bold mt-2 fontSize-40 roboto" style="color: #333;line-height: 124.5%;">
                {{ $banner->bannerFile != null ? $banner->bannerFile->title : 'no title' }}
                <span class="fw-normal fontSize-32 py-2 opacity-85">{{ $banner->bannerFile != null ? $banner->bannerFile->subtitle : 'no subtitle'  }}</span>
            </div>
            <p class="mt-5 mb-4 roboto fontSize-14">{{ $banner->bannerFile != null ? $banner->bannerFile->description : 'no description' }}</p>
            </div>
        </div>
        </div>
        <!-- end of .container-->
    </section>
@endsection
@section('content')
<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-7 pt-md-8 bg-about-2" style="padding-bottom: 4rem">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-5 col-lg-6 text-lg-center"><img class="img-fluid mb-5 mb-md-0" src="{{ asset('assets/web/img/indecon/bg-about-1.png') }}" alt="" /></div>
        <div class="col-md-7 col-lg-5 text-center text-md-start ms-auto">
            <div class="fontSize-30 roboto" style="color: #505050;line-height: 44.719px;">Our travel experience with a focus point on the sustainability of natural forest ecosystems in Indonesia</div class="fontSize-34 roboto">
            <p class="roboto fontSize-12 pt-4" style="color: #505050;line-height: 22.36px;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
        </div>
        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="bg-about-3 py-7 text-center">

    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="roboto fontSize-30 fw-bold">Achievement of Roots</div>
            <p class="roboto fontSize-12 fw-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has industry's</p>
        </div>
        <div class="pt-3">
            <div class="row">
                @forelse ($achievement as $item)
                    <div class="col-3">
                        <div class="border-end  justify-content-md-center">
                            <div class="fontSize-42 fw-bolder roboto">{{ $item->number ?? 0 }}</div>
                            <div class="fontSize-14 roboto fw-normal" style="color: #505050">{{ $item->name ?? 0 }}</div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">No Achievement found</div>
                @endforelse
            </div>
        </div>
        </div>
    </div>
    <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- <section> member of roots begin ============================-->
<section>
    <div class="row">
        @forelse ($companyMembers as $item)
            <div class="col-3">
                <div class="bg-member pt-5 pb-3 pe-5 ps-4">
                    <div class="text-center">
                        <img src="{{ ($item->file != null) ? asset('assets/images/companyMembers/'.$item->file) : asset('assets/web/img/indecon/noimage.png') }}" alt="" width="159" height="159">
                    </div>
                    <div class="text-softGray fontSize-16 pt-5 mt-2 fw-bold roboto">
                        {{ $item->first_name ?? '' }} {{ $item->last_name ?? '' }}
                    </div>
                    <div class="text-softGray fontSize-12 roboto">
                        {{ $item->title ?? '-' }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">No member found</div>
        @endforelse
        
        <div class="col-3">
            <div class="fontSize-34 mt-4 roboto text-softGray">Members of Roots</div>
            <div class="fontSize-12 mt-2 fw-lighter roboto text-softGray">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has industry's</div>
        </div>
    </div>
</section>
<!-- <section> close ============================-->

@endsection