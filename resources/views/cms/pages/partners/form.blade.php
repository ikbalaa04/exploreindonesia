@extends('cms.template.main')
@section('title','Dashboard admin formulir partners')
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>@if (\Request::query('type') == 'edit') Edit partner @else Add partner @endif</h1>
                <span>@if (\Request::query('type') == 'edit') Form untuk Mengedit partner {{ $data->name }}. @else Form untuk menambahkan partner baru. @endif </span>
                <br>
                <a href="{{ route('websiteManagement.partner.index') }}">
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
                            <form action="{{ \Request::query('type') == 'edit' ? route('websiteManagement.partner.update', $data->id) : route('websiteManagement.partner.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (\Request::query('type') == 'edit') @method('put') @else @method('post') @endif
                                <div class="col-md-12">
                                    <div class="avartar mt-5 ">
                                        <label for="" class="text-center mx-auto d-block">Picture partner</label>
                                        <div class="d-flex justify-content-center">
                                            @if (\Request::query('type') == 'edit')
                                                @if ($data->file != null)
                                                    <img src="{{ asset('assets/images/partner/'.$data->file) }}" id="imageResult" alt="" width="100">
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
                                    <label for="name" class="form-label">Name Partner</label>
                                    <input type="text" name="name" value="@if(\Request::query('type') == 'edit') {{$data->name??old('name')}}@else{{old('name')}}@endif" placeholder="Example: partner 1" class="form-control" id="name">
                                </div>
                                <div class="col-md-6">
                                    @php
                                        if (\Request::query('type') == 'edit' && $data->member != null) {
                                            $member = explode(',',$data->member);
                                        }
                                    @endphp
                                    <label for="member" class="form-label">Anggota Partner</label>
                                    <select class="js-states form-control" name="member[]" id="member" tabindex="-1" style="display: none; width: 100%" multiple="multiple">
                                    @forelse ($members as $item)
                                        <option value=""></option>
                                        <option value="{{ $item->email }}"
                                            @if (\Request::query('type') == 'edit' && $memberInLine != null)
                                                @foreach ($memberInLine as $mem)
                                                    {{ ($mem->email == $item->email) ? 'selected' : '' }}
                                                @endforeach
                                            @endif
                                        >{{ $item->email ?? '-' }}</option>
                                    @empty
                                        <option value="">Maaf belum ada user yang tersedia</option>
                                    @endforelse
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile_phone" class="form-label">mobile phone</label>
                                    <input type="text" name="mobile_phone" value="@if(\Request::query('type') == 'edit') {{$data->mobile_phone??old('mobile_phone')}}@else{{old('mobile_phone')}}@endif" placeholder="Example: 080989999" class="form-control" id="mobile_phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
                                </div>
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="@if(\Request::query('type') == 'edit') {{ $data->email ?? old('email') }} @else {{ old('email') }} @endif" class="form-control" id="email" placeholder="Example: yourCompany@company.com">
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" value="@if(\Request::query('type') == 'edit'){{$data->address??old('address')}}@else{{old('address')??''}}@endif" class="form-control" id="address" placeholder="Example: jalan simatupang">
                                </div>
                                <div class="col-6">
                                    <label for="website" class="form-label">website</label>
                                    <input type="text" name="website" value="@if(\Request::query('type') == 'edit'){{ $data->website ?? old('website') }}@else{{ old('website') }}@endif" class="form-control" id="website" placeholder="Example: https://yourcompany.com">
                                </div>
                                <div class="col-6">
                                    <label for="account_chat" class="form-label">account_chat</label>
                                    <input type="text" placeholder="Example: agent1" name="account_chat" value="@if(\Request::query('type') == 'edit'){{$data->account_chat??old('account_chat')}}@else{{old('account_chat')}}@endif" class="form-control" id="account_chat">
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
        // select2 
        $('#member').select2({placeholder: "pilih anggota dari partner ini"});
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