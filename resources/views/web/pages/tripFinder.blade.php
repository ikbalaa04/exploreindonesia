@extends('web.template.main')
@section('title','Trip Finder Explore Indonesia (indecon)')
@section('banner')
    <section style="background: @if($banner->bannerFile != null) url({{ asset('assets/images/banner/'.$banner->bannerFile->file_name) }}) @else url({{ asset('assets/cms/images/noImage.jpg') }}) @endif no-repeat;max-heigth:1349px;background-size:cover">
        <div class="container">
        <div class="row">
            <div class="col-12 mx-auto text-center">
                <div class="text-white pt-5 fw-normal mt-4 fontSize-28 ">
                    {{  $banner->bannerFile != null ? $banner->bannerFile->title : 'no title' }}
                </div>
                <div class="my-5 py-5">
                    <input type="text" id="findTrip" class="form-trip-finder" placeholder="Push enter, to find your next trip">
                </div>

                <div>
                    <div class="row justify-content-center">
                        <div class="col-12 text-white fontSize-14 mb-5">Tour Organizer</div>
                        @forelse ($tourOrganizer as $item)
                            <div class="col-1 col-sm-1 col-md-1 mb-2 mb-md-0"><img class="img-fluid" src="{{ asset('assets/images/partner/'.$item->file) }}" alt="" height="50"></div>
                        @empty
                            <div class="col-1 col-sm-1 col-md-1 mb-2 mb-md-0">Belum terdapat mitra</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- end of .container-->
    </section>
@endsection
@section('content')

@endsection

@push('after-script')
    <script>
        $(document).ready(function () {
            $('#findTrip').keypress(function (e) { 
                var key = e.which
                if (key == 13) {
                    var val = $(this).val();
                    var url = "{{ route('web.filterTrip') }}?find="+val;
                    window.location.href = url;
                }
            });
        });
    </script>
@endpush