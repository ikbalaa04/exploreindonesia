@extends('cms.template.main')
@section('title','Dashboard admin formulir packages')
@push('after-style')
    <link href="{{ asset('assets/cms/css/tagsinput.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/cms/plugins/dropzone/min/dropzone.min.css') }}">
    <style>
        .imageFileManager {
            width: 100px !important;
            height: 50px !important;
        }
    </style>
@endpush
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1 style="font-size: 20px">@if (\Request::query('type') == 'edit') Edit packages @else Add packages @endif</h1>
                <a href="{{ route('masterData.packages.index') }}">
                    <i class="fa-solid fa-caret-left fa-2xl" style="color: rgb(92, 92, 92)"><span style="font-size: 12px"> Kembali</span></i></i>
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
                            <div class="col-12 btn btn-info" style="cursor: none">
                                Bahasa Indonesia
                            </div>
                            <!-- SmartWizard html -->
                            <div id="smartwizard">
                                <ul class="nav">
                                    <li class="nav-item">
                                    <a class="nav-link" href="#information-tour">
                                        <div class="num">1</div>
                                        Informasi Tur
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="#upload-image">
                                        <span class="num">2</span>
                                        Upload Gambar
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="#detail-tour">
                                        <span class="num">3</span>
                                        Detail Tur
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link " href="#itenary">
                                        <span class="num">4</span>
                                        Rencana Perjalanan
                                    </a>
                                    </li>
                                </ul>
                            
                                <div class="tab-content">
                                    <div id="information-tour" class="tab-pane" role="tabpanel" aria-labelledby="information-tour">
                                        <form id="information-tour-form">
                                            <div class="row g-3">
                                                <input type="hidden" name="packetId" id="packetId" @if(\Request::query('type') == 'edit')value="{{ $data->id }}"@endif>
                                                <input type="hidden" name="from" id="from" value="information-tour">
                                                <div class="col-md-6">
                                                    <label for="title" class="form-label">Judul <button type="button" class="btn btn-none p-0 m-0 fontSize-12 text-primary" data-bs-toggle="modal" data-bs-target="#translateJudul">| Translate </button></label>
                                                    <input type="text" name="title_idn" value="@if(\Request::query('type')=='edit'){{ $data->title_idn ?? null }}@endif" class="form-control" id="title" placeholder="Menjelajah pulau kapuk">
                                                    <!-- modal  -->
                                                    <div class="modal fade" id="translateJudul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Translate judul Ke Bahasa Inggris</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" name="title_en" value="@if(\Request::query('type')=='edit'){{ $data->title_en ?? null }}@endif" class="form-control" id="title" placeholder="Example: Exploring Kapok Island">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="length_of_vacation" class="form-label">Lamanya wisata</label>
                                                    <input type="text" name="length_of_vacation" value="@if(\Request::query('type')=='edit'){{ $data->length_of_vacation ?? null }}@endif" class="form-control" id="length_of_vacation" placeholder="5 hari 1 malem">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="province" class="form-label">Propinsi</label>
                                                    <select class="js-states form-control" id="province" name="province_id" tabindex="-1" style="display: none; width: 100%">
                                                    @forelse ($provinces as $item)
                                                        <option value=""></option>
                                                        <option value="{{ $item->id }}" @if(\Request::query('type') == 'edit') {{ $item->id == $data->province_id ? 'selected' : '' }} @endif>{{ $item->name ?? '-' }}</option>
                                                    @empty
                                                        <option value="">Maaf belum ada zona</option>
                                                    @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="categories_id" class="form-label">Kategori</label>
                                                    <select class="js-states form-control" name="categories_id" id="categories_id" tabindex="-1" style="display: none; width: 100%" multiple="multiple">
                                                    @forelse ($categories as $item)
                                                            <option value=""></option>
                                                            <option value="{{ $item->id }}"
                                                                @if (\Request::query('type') == 'edit')
                                                                    @foreach (explode(',',$data->categories_id) as $dataCategories)
                                                                        {{ ($dataCategories == $item->id) ? 'selected' : '' }}
                                                                    @endforeach
                                                                @endif
                                                                >{{ $item->name ?? '-' }}</option>
                                                    @empty
                                                        <option value="">Maaf belum ada kategori</option>
                                                    @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" data-type="yes" @if( \Request::query('type')=='edit'){{ $data->different_prices_for_tourists == 1 ? 'checked' : '' }}@endif type="checkbox" name="different_prices_for_tourists"  id="different_prices_for_tourists">
                                                        <label class="form-check-label" for="different_prices_for_tourists">
                                                            Harga tidak sama untuk turis?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label for="price_in_rupiah" class="form-label">Harga (Dalam Rupiah)</label>
                                                    <input type="text" class="form-control" value="@if(\Request::query('type')=='edit'){{ $data->packetPrice->price_in_rupiah ?? null }}@endif" name="price_in_rupiah" id="price_in_rupiah" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 0, 'digitsOptional': false, 'prefix': 'Rp ', 'placeholder': '0'" inputmode="decimal">
                                                </div>
                                                <div class="col-4">
                                                    <label for="price_in_dollar" class="form-label">Harga (Dalam Dollar)</label>
                                                    <input type="text" class="form-control" value="@if(\Request::query('type')=='edit'){{ $data->packetPrice->price_in_dollars ?? null }}@endif" name="price_in_dollar" id="price_in_dollar" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 0, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" inputmode="decimal">
                                                </div>
                                                <div class="col-6 d-none" id="price_in_rupiah_tourists">
                                                    <label for="price_in_rupiah_tourist" class="form-label">Harga Dalam Rupiah (turis)</label>
                                                    <input type="text" class="form-control" value="@if(\Request::query('type')=='edit'){{$data->packetPrice->price_tourist_in_rupiah ?? null}}@endif" name="price_in_rupiah_tourist" id="price_in_rupiah_tourist" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 0, 'digitsOptional': false, 'prefix': 'Rp ', 'placeholder': '0'" inputmode="decimal">
                                                </div>
                                                <div class="col-6 d-none" id="price_in_dollar_tourists">
                                                    <label for="price_in_dollar_tourist" class="form-label">Harga Dalam Dollar (turis)</label>
                                                    <input type="text" class="form-control" name="price_in_dollar_tourist" value="@if(\Request::query('type')=='edit'){{ $data->packetPrice->price_tourist_in_dollars ?? null }}@endif" id="price_in_dollar_tourist" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 0, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" inputmode="decimal">
                                                </div>
                                                <div class="col-4">
                                                    <label for="min_ticket" class="form-label">Minimal tiket yang terjual</label>
                                                    <input type="number" class="form-control" value="@if(\Request::query('type')=='edit'){{ $data->min_ticket ?? null }}@endif" id="min_ticket" name="min_ticket">
                                                </div>
                                                <div class="col-4">
                                                    <label for="max_ticket" class="form-label">Maximal tiket yang terjual</label>
                                                    <input type="number" class="form-control" value="@if(\Request::query('type')=='edit'){{ $data->max_ticket ?? null }}@endif" id="max_ticket" name="max_ticket">
                                                </div>
                                                <div class="col-4">
                                                    <label for="tag" class="form-label">Tags <span class="text-info text-sm"> *Press enter to add a new tag</span></label>
                                                    <input data-role="tagsinput" type="text" name="tag"value="@if(\Request::query('type')=='edit'){{$data->tag??old('tag')}}@else{{old('tag')}}@endif" placeholder="Example: #2023 #cool-news" class="form-control" id="tag">
                                                </div>
                                                <div class="col-12">
                                                    <label for="short_description_idn" class="form-label">Deskripsi Singkat <button type="button" class="btn btn-none p-0 m-0 fontSize-12 text-primary" data-bs-toggle="modal" data-bs-target="#translateDeskripsiSingkat">| Translate </button></label>
                                                    <input type="text" class="form-control" id="short_description_idn" value="@if(\Request::query('type')=='edit'){{ $data->short_description_idn ?? null }}@endif" name="short_description_idn" placeholder="lorem ipsum">
                                                    <!-- modal  -->
                                                    <div class="modal fade" id="translateDeskripsiSingkat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Translate Deskripsi singkat Ke Bahasa Inggris</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="text" class="form-control" id="short_description_en" value="@if(\Request::query('type')=='edit'){{ $data->short_description_en ?? null }}@endif" name="short_description_en" placeholder="Example: lorem ipsum">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="description_idn" class="form-label">Deskripsi <button type="button" class="btn btn-none p-0 m-0 fontSize-12 text-primary" data-bs-toggle="modal" data-bs-target="#translateDeskripsi">| Translate </button></label>
                                                    <textarea class="form-control" id="description_idn" name="description_idn" cols="10" rows="5">@if(\Request::query('type')=='edit'){{ $data->description_idn ?? null }}@endif</textarea>
                                                    <!-- modal  -->
                                                    <div class="modal fade" id="translateDeskripsi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Translate Deskripsi singkat Ke Bahasa Inggris</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea class="form-control" id="description_en" name="description_en" cols="10" rows="5">@if(\Request::query('type')=='edit'){{ $data->description_en ?? null }}@endif</textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div id="upload-image" class="tab-pane" role="tabpanel" aria-labelledby="upload-image">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="dropzone">
                                                        <form action="{{ route('masterData.packages.uploadImage') }}" method="post" class="dropzone needsclick" id="demo-upload" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="packetId" id="packetId" @if(\Request::query('type') == 'edit')value="{{ $data->id }}"@endif>
                                                            <div class="dz-message needsclick">
                                                                <button type="button" class="dz-button">Silahkan menjatuhkan beberapa gambar atau klik untuk mengugah gambar.</button><br />
                                                                <span class="note needsclick">(Hanya dapat menerima file ber-ekstensi <strong>jpg,png,jpeg</strong> maks 5 gambar, <strong>auto replace jika lebih dari 5 gambar yang di unggah</strong>)</span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    Atau pilih dari file manager yang sudah pernah di upload
                                                </div>
                                                <form id="upload-image-form">
                                                    <input type="hidden" name="packetId" id="packetId" @if(\Request::query('type') == 'edit')value="{{ $data->id }}"@endif>
                                                    <input type="hidden" name="from" id="from" value="upload-image">
                                                    <div class="col-md-12">
                                                        <label for="from_file" class="form-label">Dari File Manager</label>
                                                        <select class="js-states form-control" name="from_file" id="from_file" tabindex="-1" style="display: none; width: 100%" multiple="multiple">
                                                        @forelse ($file as $item)
                                                                <option value=""></option>
                                                                <option value="{{ $item->file }}">{{$item->file}}</option>
                                                        @empty
                                                            <option value="">Maaf belum ada foto yang diupload di file manager</option>
                                                        @endforelse
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                    <div id="detail-tour" class="tab-pane" role="tabpanel" aria-labelledby="detail-tour">
                                        <form id="detail-tour-form">
                                            <input type="hidden" name="packetId" id="packetId" @if(\Request::query('type') == 'edit')value="{{ $data->id }}"@endif>
                                            <input type="hidden" name="from" id="from" value="detail-tour">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="table-responsive d-web">
                                                        <table class="table mt-30" id="">
                                                            <thead>
                                                            <tr><th>Ikon</th>
                                                                <th>Nama Judul</th>
                                                                <th>Detail / penjelasannya</th>
            
                                                                <th ><a class="btn btn-sm btn-dark align-top buttonAppend text-white" id="buttonAppend"> Tambah Data</a></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="append">
                                                                @if (\Request::query('type') == 'edit')
                                                                    @forelse ($data->packetTourDetail as $key => $item)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="row">
                                                                                    <input type="hidden" value="{{ $item->id }}" id="idPacketTourDetail" name="idPacketTourDetail[]">
                                                                                    <div class="col-3">
                                                                                        @if ($item->file != null)
                                                                                            <img src="{{ asset('assets/images/iconTourPackages/'.$item->file) }}" id="imageResult" alt="" width="20">
                                                                                            <span style="font-size: 8px">Previous Image</span>
                                                                                        @else
                                                                                            <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="20">
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-9">
                                                                                        <input required type="file" name="icon[]" data-id="{{ $key }}" class="form-control icon icon_{{ $key }}" id="icon"/>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <input required type="text" name="title[]"  value="{{ $item->title ?? null }}" placeholder="Contoh: Penginapan" data-id="{{ $key }}" class="form-control title title_{{ $key }}" id="title"/>
                                                                            </td>
                                                                            <td>
                                                                                <input required type="text" name="description[]" value="{{ $item->description ?? null }}" placeholder="Contoh: Dirumah pak rt" data-id="{{ $key }}" class="form-control description description_{{ $key }}" id="description"/>
                                                                            </td>
                                                                        
                                                                            <td>
                                                                                <button type="button" id="remCF" class="btn btn-danger btn-sm remCF">
                                                                                    <span class="iconify" data-icon="bx:bookmark-minus"></span>Hapus
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        
                                                                    @endforelse
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="itenary" class="tab-pane" role="tabpanel" aria-labelledby="itenary">
                                        <form id="itenary-form">
                                            <input type="hidden" name="packetId" id="packetId" @if(\Request::query('type') == 'edit')value="{{ $data->id }}"@endif>
                                            <input type="hidden" name="from" id="from" value="itenary">
                                            <div class="row g-3">
                                                <div class="col-6" id="declarationDayTrip">
                                                    Harap mengisi Lamanya berwisata
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="day" id="dayTrip" class="form-control" placeholder="Contoh: 5" aria-label="isi dengan angka, berapa lama trip ini dilaksanakan?" aria-describedby="buttonDayTrip" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        <button class="btn btn-info" type="button" id="buttonDayTrip">Oke</button>
                                                    </div>
                                                </div>
                                                <div id="appendDay">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            
                                <!-- Include optional progressbar HTML -->
                                <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>  
                        
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
    <script src="{{ asset('assets/cms/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/cms/js/tagsinput.js') }}"></script>
    <script>
        $(document).ready(function() {
            // append long trip 
            $('#buttonDayTrip').click(function (e) {
                var dayTrip = $('#dayTrip').val();
                $('#declarationDayTrip').addClass('d-none');
                for (let i = 1; i <= dayTrip; i++) {
                    // increase height in tab content 
                    var diiv= $(".tab-content");
                    var height = diiv.css('height')//read
                    height = parseInt(height.slice(0,-2)) + 130;
                    diiv.css('height',height);
                    b = `
                        <div class="col-12 fontSize-16 p-3 bg-dark text-white">
                            Hari ke `+i+`
                        </div>
                        <div class="col-12">
                            <div class="table-responsive d-web">
                                <table class="table mt-30" id="">
                                    <thead>
                                    <tr><th>Nama Kegiatan</th>
                                        <th>Waktunya</th>
                                        <th>Detail kegiatan</th>
                                        <th>Pemandu</th>

                                        <th ><a class="btn btn-sm btn-dark align-top buttonAppendDayTrip text-white" data-id="`+i+`" id="buttonAppendDayTrip"> Tambah Kegiatan</a></th>
                                    </tr>
                                    </thead>
                                    <tbody id="appendDayTrip_`+i+`">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                    $('#appendDay').append(b);
                }
            });
            // append detail kegiatan trip 
            var randomDayTrip;
            $(document).on('click','.buttonAppendDayTrip', function() {
                // increase height in tab content 
                var diiv= $(".tab-content");
                var height = diiv.css('height')//read
                height = parseInt(height.slice(0,-2)) + 80;
                diiv.css('height',height);
                var ids = $(this).attr('data-id');
                randomDayTrip = Math.floor((Math.random() * 100000) + 1);
                a = `
                <tr>
                    <td>
                        <input required type="text" name="name[]" data-id="`+randomDayTrip+`" data-head-id="`+ids+`" placeholder="Petualangan di hari pertama" class="form-control name name_`+randomDayTrip+`" id="name"/>
                    </td>
                    <td>
                        <input required type="text" name="range_time[]" placeholder="07:00 - 09:00" data-id="`+randomDayTrip+`" data-head-id="`+ids+`" class="form-control range_time range_time`+randomDayTrip+`" id="range_time"/>
                    </td>
                    <td>
                        <input required type="text" name="detail[]" placeholder="Bebersih" data-id="`+randomDayTrip+`" data-head-id="`+ids+`" class="form-control detail detail_`+randomDayTrip+`" id="detail"/>
                    </td>
                    <td>
                        <select name="guide[]" id="guide" class="form-control guide guide_`+randomDayTrip+`" data-head-id="`+ids+`" data-id="`+randomDayTrip+`">
                            <option value="">Pilih</option>
                            <option value="local">Lokal</option>
                            <option value="profesional">Dari Trip</option>
                        </select>
                    </td>
                
                    <td>
                        <button type="button" id="remCFDayTrip" class="btn btn-danger btn-sm remCFDayTrip">
                            <span class="iconify" data-icon="bx:bookmark-minus"></span>Hapus
                        </button>
                    </td>
                </tr>
                `;
                $("#appendDayTrip_"+ids+"").append(a);
                // script hapus kolom  
                $("#appendDayTrip_"+ids+"").on('click','.remCFDayTrip',function(){
                    var diiv= $(".tab-content");
                    var height = diiv.css('height')//read
                    height = parseInt(height.slice(0,-2)) - 20;
                    diiv.css('height',height);
                    $(this).parent().parent().remove();
                });
            });
            // append tr td 
            var random;
            $('#buttonAppend').click(function (e) { 
                // increase height in tab content 
                var diiv= $(".tab-content");
                var height = diiv.css('height')//read
                height = parseInt(height.slice(0,-2)) + 80;
                diiv.css('height',height);

                random = Math.floor((Math.random() * 100000) + 1);
                a = `
                <tr>
                    <td>
                        <input required type="file" name="icon[]" data-id="`+random+`" class="form-control icon icon_`+random+`" id="icon"/>
                    </td>
                    <td>
                        <input required type="text" name="title[]" placeholder="Contoh: Penginapan" data-id="`+random+`" class="form-control title title_`+random+`" id="title"/>
                    </td>
                    <td>
                        <input required type="text" name="description[]" placeholder="Contoh: Dirumah pak rt" data-id="`+random+`" class="form-control description description_`+random+`" id="description"/>
                    </td>
                
                    <td>
                        <button type="button" id="remCF" class="btn btn-danger btn-sm remCF">
                            <span class="iconify" data-icon="bx:bookmark-minus"></span>Hapus
                        </button>
                    </td>
                </tr>
                `;
                $("#append").append(a);
            });
            // script hapus kolom  
            $("#append").on('click','.remCF',function(){
                var diiv= $(".tab-content");
                var height = diiv.css('height')//read
                height = parseInt(height.slice(0,-2)) - 80;
                diiv.css('height',height);
                $(this).parent().parent().remove();
            });
            // dropzone max file 
            Dropzone.options.demoUpload = {
                maxFiles: 5, // Set the maximum number of files that can be uploaded
            };
            // change and show input price for tourist 
            $('#different_prices_for_tourists').click(function (e) { 
                if ($(this).is(':checked') == true) {
                    $('#price_in_dollar_tourists').removeClass('d-none');
                    $('#price_in_rupiah_tourists').removeClass('d-none');
                } else {
                    $('#price_in_dollar_tourists').addClass('d-none');
                    $('#price_in_rupiah_tourists').addClass('d-none');
                }
            });
            // inputmask 
            $('#price_in_dollar').inputmask();
            $('#price_in_dollar_tourist').inputmask();
            $('#price_in_rupiah').inputmask();
            $('#price_in_rupiah_tourist').inputmask();
            // select2 
            $('#province').select2({placeholder: "pilih zona / provisi tempat wisata"});
            $('#categories_id').select2({placeholder: "pilih kategori wisata"});
            $('#from_file').select2({
                templateResult: formatState,
                placeholder: "pilih gambar dari file manager"
            });
            
            // SmartWizard initialize
            $('#smartwizard').smartWizard({
                toolbar: {
                    showPreviousButton: false,
                    position: 'bottom', // none|top|bottom|both
                    extraHtml: `<button class="btn btn-success d-none" id="finish" type="button">Finish</button>`
                },
                getContent: provideContent
            });
            var ajaxInvokeInformationTour = false;
            var ajaxInvokeUploadImage = false;
            var ajaxInvokeTourDetail = false;
            function provideContent(idx, stepDirection, stepPosition, selStep, callback) {
                if (idx == 1 && stepDirection == 'forward' && ajaxInvokeInformationTour == false) {
                    var dataArray1 = [];
                    $("#information-tour-form :input").each(function(){
                        var input = $(this); // This is the jquery object of the input, do what you will
                        var arrayStep1 = {};
                        arrayStep1[input.attr('name')] = input.val()
                        dataArray1.push(arrayStep1);
                    });
                    var type = "{{ \Request::query('type') }}"
                    if (type == 'edit') {
                        var idPacket = $('#packetId').val();
                        var url = "{{ route('masterData.packages.update',':id') }}"
                        url = url.replace(':id',idPacket);
                        $.ajax({
                            type: "put",
                            url,
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                'data' : dataArray1
                            },
                            dataType: "json",
                            beforeSend: function(response) {
                                $('#smartwizard').smartWizard("loader", "show");
                            },
                            success: function (response) {
                                ajaxInvokeInformationTour = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                            },
                            error: function(xhr) {
                                var err = eval("(" + xhr.responseText + ")");
                                if (err.code == '400') {
                                    Swal.fire(JSON.stringify(err.message));
                                    $('#smartwizard').smartWizard("loader", "hide");
                                }
                            }
                        });
                    }
                    if (type == 'add') {
                        $.ajax({
                            type: "post",
                            url: "{{ route('masterData.packages.store') }}",
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                'data' : dataArray1
                            },
                            dataType: "json",
                            beforeSend: function(response) {
                                $('#smartwizard').smartWizard("loader", "show");
                            },
                            success: function (response) {
                                $('input[name=packetId]').val(response.packetId);
                                ajaxInvokeInformationTour = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                            },
                            error: function(xhr) {
                                var err = eval("(" + xhr.responseText + ")");
                                if (err.code == '400') {
                                    Swal.fire(JSON.stringify(err.message));
                                    $('#smartwizard').smartWizard("loader", "hide");
                                }
                            }
                        });
                    }
                    return false;
                }
                if (idx == 2 && stepDirection == 'forward' && ajaxInvokeUploadImage == false) {
                    var dataArray1 = [];
                    $("#upload-image-form :input").each(function(){
                        var input = $(this); // This is the jquery object of the input, do what you will
                        var arrayStep1 = {};
                        arrayStep1[input.attr('name')] = input.val()
                        dataArray1.push(arrayStep1);
                    });
                    
                    var type = "{{ \Request::query('type') }}"
                    if (type == 'edit') {
                        var idPacket = $('#packetId').val();
                        var url = "{{ route('masterData.packages.update',':id') }}"
                        url = url.replace(':id',idPacket);
                        $.ajax({
                            type: "put",
                            url,
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                'data' : dataArray1
                            },
                            dataType: "json",
                            beforeSend: function(response) {
                                $('#smartwizard').smartWizard("loader", "show");
                            },
                            success: function (response) {
                                ajaxInvokeUploadImage = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                            },
                            error: function(xhr) {
                                var err = eval("(" + xhr.responseText + ")");
                                if (err.code == '400') {
                                    Swal.fire(JSON.stringify(err.message));
                                    $('#smartwizard').smartWizard("loader", "hide");
                                }
                            }
                        });
                    }
                    if (type == 'add') {
                        $.ajax({
                            type: "post",
                            url: "{{ route('masterData.packages.store') }}",
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                'data' : dataArray1
                            },
                            dataType: "json",
                            beforeSend: function(response) {
                                $('#smartwizard').smartWizard("loader", "show");
                            },
                            success: function (response) {
                                ajaxInvokeUploadImage = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                            },
                            error: function(xhr) {
                                var err = eval("(" + xhr.responseText + ")");
                                if (err.code == '400') {
                                    Swal.fire(JSON.stringify(err.message));
                                    $('#smartwizard').smartWizard("loader", "hide");
                                }
                            }
                        });
                    }
                    return false;
                }
                if (idx == 3 && stepDirection == 'forward' && ajaxInvokeTourDetail == false) {
                    var type = "{{ \Request::query('type') }}"
                    var paramsTitle = {};
                    var i = 1;
                    $("input[name='title[]']").each(function(){
                        paramsTitle[i] = $(this).val();
                        i++;
                    });
                    var paramsDescription = {};
                    var s = 1;
                    $("input[name='description[]']").each(function(){
                        paramsDescription[s] = $(this).val();
                        s++;
                    });
                    if (type == 'edit') {
                        var paramsIdPacketTourDetail = {};
                        var d = 1;
                        $("input[name='idPacketTourDetail[]']").each(function(){
                            paramsIdPacketTourDetail[d] = $(this).val();
                            d++;
                        });
                    }
                  
                    var formData = new FormData();

                    // Collect file input values
                    var iconNo = 0;
                    $("input[name='icon[]']").each(function() {
                        var files = $(this)[0].files;
                        // for (var i = 0; i < files.length; i++) {
                        //     formData.append('icon[]', files[i]);
                        // }
                        if (files.length == 0) {
                            formData.append('icon[' + iconNo + ']', null);
                        } else {
                            formData.append('icon[' + iconNo + ']', files[0]);
                        }
                        iconNo++
                    });
                    // Add other data to FormData
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('packetId', $('#packetId').val());
                    if (type == 'edit') {
                        $("input[name='idPacketTourDetail[]']").each(function(){
                            formData.append('idPacketTourDetail[]', $(this).val());
                        });
                    }

                    var allData = [];
                    allData[0] = {'packetId' : $('#packetId').val()};
                    allData[1] = {'from' : 'detail-tour'};
                    // allData[2] = formData;
                    allData[3] = paramsTitle;
                    allData[4] = paramsDescription;
                    if (type == 'edit') {
                        allData[5] = paramsIdPacketTourDetail;
                    }
                    
                    if (type == 'edit') {
                        var idPacket = $('#packetId').val();
                        var url = "{{ route('masterData.packages.update',':id') }}"
                        url = url.replace(':id',idPacket);
                        $.ajax({
                            type: "put",
                            url,
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                'data' : allData
                            },
                            dataType: "json",
                            beforeSend: function(response) {
                                $('#smartwizard').smartWizard("loader", "show");
                            },
                            success: function (response) {
                                ajaxInvokeTourDetail = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                               
                            },
                            error: function(xhr) {
                                var err = eval("(" + xhr.responseText + ")");
                                if (err.code == '400') {
                                    Swal.fire(JSON.stringify(err.message));
                                    $('#smartwizard').smartWizard("loader", "hide");
                                }
                            }
                        });   
                        // uploadicon 
                        $.ajax({
                            type: "post",
                            url: "{{ route('masterData.packages.uploadIcon') }}",
                            data: formData,
                            processData: false,  // Prevent jQuery from processing the data
                            contentType: false,
                            dataType: "dataType",
                            success: function (response) {
                                ajaxInvoke = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                            }
                        });
                    }
                    if (type == 'add') {
                        $.ajax({
                            type: "post",
                            url: "{{ route('masterData.packages.store') }}",
                            data: {
                                '_token' : '{{ csrf_token() }}',
                                'data' : allData
                            },
                            dataType: "json",
                            beforeSend: function(response) {
                                $('#smartwizard').smartWizard("loader", "show");
                            },
                            success: function (response) {
                                ajaxInvokeTourDetail = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                               
                            },
                            error: function(xhr) {
                                var err = eval("(" + xhr.responseText + ")");
                                if (err.code == '400') {
                                    Swal.fire(JSON.stringify(err.message));
                                    $('#smartwizard').smartWizard("loader", "hide");
                                }
                            }
                        });   
                        // uploadicon 
                        $.ajax({
                            type: "post",
                            url: "{{ route('masterData.packages.uploadIcon') }}",
                            data: formData,
                            processData: false,  // Prevent jQuery from processing the data
                            contentType: false,
                            dataType: "dataType",
                            success: function (response) {
                                ajaxInvoke = true; // Prevent step change
                                $('#smartwizard').smartWizard("next");
                                $('#smartwizard').smartWizard("loader", "hide");
                                if (response.code != 200) {
                                    alert('AJAX Error: ' + response.error);
                                }
                            }
                        });
                    }
                     
                    return false;
                    
                }
                if (idx == 3 && stepDirection == 'forward') {
                    $('button.sw-btn-next').addClass('d-none'); 
                    $('#finish').removeClass('d-none');
                }
                if (stepDirection == 'backward') {
                    if ($('button.sw-btn-next').hasClass('d-none')) {
                        $('button.sw-btn-next').removeClass('d-none');
                    }
                    $('#finish').addClass('d-none'); 
                }

                callback();
              
            }
            
            $('#finish').click(function (e) { 
                // membuat  tampungan hasil multiple array yang kita cari berdasarkan namenya serta data head id yang berfungsi untuk mengetahui data ini untuk berapa hari
                var paramsName = {};
                var i = 1;
                $("input[name='name[]']").each(function(){
                    paramsName[i] = $(this).val()+"_"+$(this).attr('data-head-id');
                    i++;
                });
                var paramsRangeTime = {};
                var r = 1;
                $("input[name='range_time[]']").each(function(){
                    paramsRangeTime[r] = $(this).val();
                    r++;
                });
                var paramsDetail = {};
                var d = 1;
                $("input[name='detail[]']").each(function(){
                    paramsDetail[d] = $(this).val();
                    d++;
                });
                var paramsGuide = {};
                var g = 1;
                $("select[name='guide[]']").each(function(){
                    paramsGuide[g] = $(this).val();
                    g++;
                });
                
                var allData = [];
                allData[0] = {'packetId' : $('#packetId').val()};
                allData[1] = {'from' : 'itenary'};
                allData[2] = paramsName;
                allData[3] = paramsRangeTime;
                allData[4] = paramsDetail;
                allData[5] = paramsGuide;
                var type = "{{ \Request::query('type') }}"
                if (type == 'edit') {
                    var idPacket = $('#packetId').val();
                    var url = "{{ route('masterData.packages.update',':id') }}"
                    url = url.replace(':id',idPacket);
                    $.ajax({
                        type: "put",
                        url,
                        data: {
                            '_token' : '{{ csrf_token() }}',
                            'data' : allData
                        },
                        dataType: "json",
                        beforeSend: function(response) {
                            $('#smartwizard').smartWizard("loader", "show");
                        },
                        success: function (response) {
                            Swal.fire('berhasil simpan');
                            window.location.href = '{{ route('masterData.packages.index') }}'
                        },
                        error: function(xhr) {
                            var err = eval("(" + xhr.responseText + ")");
                            if (err.code == '400') {
                                Swal.fire(JSON.stringify(err.message));
                                $('#smartwizard').smartWizard("loader", "hide");
                            }
                        }
                    });            
                }
                if (type == 'add') {
                    $.ajax({
                        type: "post",
                        url: "{{ route('masterData.packages.store') }}",
                        data: {
                            '_token' : '{{ csrf_token() }}',
                            'data' : allData
                        },
                        dataType: "json",
                        beforeSend: function(response) {
                            $('#smartwizard').smartWizard("loader", "show");
                        },
                        success: function (response) {
                            Swal.fire('berhasil simpan');
                            window.location.href = '{{ route('masterData.packages.index') }}'
                        },
                        error: function(xhr) {
                            var err = eval("(" + xhr.responseText + ")");
                            if (err.code == '400') {
                                Swal.fire(JSON.stringify(err.message));
                                $('#smartwizard').smartWizard("loader", "hide");
                            }
                        }
                    });            
                }
            });
            /*  ==========================================
                SHOW UPLOADED IMAGE
            * ========================================== */
            // function readURL(input) {
            //     if (input.files && input.files[0]) {
            //         var reader = new FileReader();

            //         reader.onload = function (e) {
            //             $('#imageResult')
            //                 .attr('src', e.target.result);
            //         };
            //         reader.readAsDataURL(input.files[0]);
            //     }
            // }

            // $(function () {
            //     $('#upload').on('change', function () {
            //         readURL(input);
            //     });
            // });

            // /*  ==========================================
            //     SHOW UPLOADED IMAGE NAME
            // * ========================================== */
            // var input = document.getElementById( 'upload' );
            // var infoArea = document.getElementById( 'upload-label' );

            // input.addEventListener( 'change', showFileName );
            // function showFileName( event ) {
            // var input = event.srcElement;
            // var fileName = input.files[0].name;
            // infoArea.textContent = 'File name: ' + fileName;
            // }
        });

        function formatState (state) {
            var $state = $(
            '<span ><img class="imageFileManager" src="{{asset("assets/images/fileGallery")}}'+'/'+state.text+'"> ' + state.text + '</span>'
            );
            return $state;
        }
    </script>
@endpush