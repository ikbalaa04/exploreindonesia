@extends('cms.template.main')
@section('title','Dashboard admin formulir about us')
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description page-description-tabbed">
                <h1>@if (\Request::query('type') == 'edit') Edit about us @else Add about us @endif</h1>
                <span>@if (\Request::query('type') == 'edit') Form untuk Mengedit about us {{ $data->name }}. @else Form untuk menambahkan about us. @endif </span>
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo" type="button" role="tab" aria-controls="logo" aria-selected="false">Logo</button>
                    </li>
                </ul>
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
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <!-- general form  !-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                General Form
                                <button class="btn btn-none p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#generalForm" aria-expanded="true" aria-controls="generalForm"><iconify-icon icon="ion:chevron-collapse"></iconify-icon> Toggle</button>
                            </h5>
                        </div>
                        <div class="card-body hide collapse" id="generalForm">
                            <div class="example-container">
                                <div class="example-content">
                                    <form action="{{ route('companyManagement.about-us.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-4">
                                            <label for="name" class="form-label">name</label>
                                            <input type="text" name="name" value="{{ $aboutUs == null ? '' : $aboutUs->name }}" placeholder="PT.Example" class="form-control" id="name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="since" class="form-label">since</label>
                                            <input type="text" name="since" value="{{ $aboutUs == null ? '' : $aboutUs->since }}" placeholder="17 Agustus 2023" class="form-control" id="since">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="country" class="form-label">country</label>
                                            <select name="nation" class="country form-control" id="country">
                                                <option value=""></option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->iso }}" @if($aboutUs != null) {{ $aboutUs->nation == $country->iso ? 'selected' : '' }} @else {{ old('nation') }} @endif>{{$country->name ?? ''}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">email</label>
                                            <input type="text" name="email"value="{{ $aboutUs == null ? '' : $aboutUs->email }}" placeholder="company@example.com" class="form-control" id="email">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mobile_phone" class="form-label">mobile_phone</label>
                                            <input type="text" name="mobile_phone"value="{{ $aboutUs == null ? '' : $aboutUs->mobile_phone }}" placeholder="08222xxxx" class="form-control" id="mobile_phone">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="whatsapp" class="form-label">Nomer whatsapp</label>
                                            <input type="text" name="whatsapp"value="{{ $aboutUs == null ? '' : $aboutUs->whatsapp }}" placeholder="08222xxxx" class="form-control" id="whatsapp">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="instagram" class="form-label">Username instagram</label>
                                            <input type="text" name="instagram"value="{{ $aboutUs == null ? '' : $aboutUs->instagram }}" placeholder="your username" class="form-control" id="instagram">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="facebook" class="form-label">Username facebook</label>
                                            <input type="text" name="facebook"value="{{ $aboutUs == null ? '' : $aboutUs->facebook }}" placeholder="your username" class="form-control" id="facebook">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="twitter" class="form-label">Username twitter (x)</label>
                                            <input type="text" name="twitter"value="{{ $aboutUs == null ? '' : $aboutUs->twitter }}" placeholder="your username" class="form-control" id="twitter">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="youtube" class="form-label">Username youtube</label>
                                            <input type="text" name="youtube"value="{{ $aboutUs == null ? '' : $aboutUs->youtube }}" placeholder="your username" class="form-control" id="youtube">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Alamat Perusahaan</label>
                                            <input type="text" name="address"value="{{ $aboutUs == null ? '' : $aboutUs->address }}" placeholder="Example : Jalan Tebet Timur, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta" class="form-control" id="address">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="text" name="latitude"value="{{ $aboutUs == null ? '' : $aboutUs->latitude }}" placeholder="-6.339079502747909" class="form-control" id="latitude">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="text" name="longitude"value="{{ $aboutUs == null ? '' : $aboutUs->longitude }}" placeholder="106.87770005687314" class="form-control" id="longitude">
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <label for="iframe_google_maps" class="form-label">iframe_google_maps</label>
                                            <input type="text" name="iframe_google_maps"value="{{ $aboutUs == null ? '' : $aboutUs->iframe_google_maps }}" placeholder="Example: check google maps" class="form-control" id="iframe_google_maps">
                                        </div> --}}
                                        <div class="col-md-6">
                                            <label for="title_idn" class="form-label">Title (Indonesia)</label>
                                            <input type="text" name="title_idn"value="{{ $aboutUs == null ? '' : $aboutUs->title_idn }}" placeholder="Title_idn 1" class="form-control" id="title_idn">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="short_description_idn" class="form-label">Subtitle (Indonesia)</label>
                                            <input type="text" name="short_description_idn" value="{{ $aboutUs == null ? '' : $aboutUs->short_description_idn }}" placeholder="sub title 1" class="form-control" id="short_description_idn">
                                        </div>
                                        <div class="col-12">
                                            <label for="description_idn" class="form-label">Description (Indonesia)</label>
                                            <input type="text" name="description_idn" value="{{ $aboutUs == null ? '' : $aboutUs->description_idn }}" class="form-control" id="description_idn" placeholder="Example: Lorem ipsum dolor sit amet consectetur adipisicing elit">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="title_en" class="form-label">Title (English)</label>
                                            <input type="text" name="title_en"value="{{ $aboutUs == null ? '' : $aboutUs->title_en }}" placeholder="Title_en 1" class="form-control" id="title_en">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="short_description_en" class="form-label">Subtitle (English)</label>
                                            <input type="text" name="short_description_en" value="{{ $aboutUs == null ? '' : $aboutUs->short_description_en }}" placeholder="sub title 1" class="form-control" id="short_description_en">
                                        </div>
                                        <div class="col-12">
                                            <label for="description_en" class="form-label">Description (English)</label>
                                            <input type="text" name="description_en" value="{{ $aboutUs == null ? '' : $aboutUs->description_en }}" class="form-control" id="description_en" placeholder="Example: Lorem ipsum dolor sit amet consectetur adipisicing elit">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- office hours  !-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                office hours
                                <button class="btn btn-none p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#officehours" aria-expanded="false" aria-controls="officehours"><iconify-icon icon="ion:chevron-collapse"></iconify-icon> Toggle</button>
                            </h5>
                        </div>
                        <div class="card-body collapse" id="officehours">
                            <div class="example-container">
                                <div class="example-content">
                                    <form action="{{ route('companyManagement.office-hours.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Senin</th>
                                                <th scope="col">Selasa</th>
                                                <th scope="col">Rabu</th>
                                                <th scope="col">Kamis</th>
                                                <th scope="col">Jumat</th>
                                                <th scope="col">Sabtu</th>
                                                <th scope="col">Minggu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <th scope="row">Masuk Kerja</th>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="senin"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[0]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="selasa"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[1]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="rabu"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[2]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="kamis"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[3]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="jumat"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[4]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="sabtu"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[5]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" name="minggu"
                                                            @if (count($officeHours) > 0)
                                                                {{ ($officeHours[6]->status == 1) ? 'checked' : '' }}
                                                            @endif>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <th scope="row">Jam Kerja</th>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[0]->time}}@endif" name="seninHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[1]->time}}@endif" name="selasaHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[2]->time}}@endif" name="rabuHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[3]->time}}@endif" name="kamisHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[4]->time}}@endif" name="jumatHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[5]->time}}@endif" name="sabtuHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[6]->time}}@endif" name="mingguHours" placeholder="example: 10.00 - 17:00">
                                                    </td>
                                                </tr>
                                                <tr>
                                                <th scope="row">Catatan</th>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[0]->note}}@endif" name="seninNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[1]->note}}@endif" name="selasaNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[2]->note}}@endif" name="rabuNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[3]->note}}@endif" name="kamisNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[4]->note}}@endif" name="jumatNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[5]->note}}@endif" name="sabtuNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="@if(count($officeHours) > 0){{$officeHours[6]->note}}@endif" name="mingguNote" placeholder="example: Libur tanggal merah">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-12">
                                            <button type="submit" class="btn @if(\Request::query('type') == 'edit') btn-warning @else btn-primary @endif">@if(\Request::query('type') == 'edit') Update @else Save @endif</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- achievement  !-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                achievement
                                <button class="btn btn-none p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#achievement" aria-expanded="false" aria-controls="achievement"><iconify-icon icon="ion:chevron-collapse"></iconify-icon> Toggle</button>
                            </h5>
                        </div>
                        <div class="card-body collapse" id="achievement">
                            <div class="example-container">
                                <div class="example-content">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm saveButtonAchievement" data-bs-toggle="modal" data-bs-target="#achievementModal">
                                        Add achievement
                                    </button>
                                    <table class="display nowrap" style="width:100%" id="tableAchievement">
                                        <thead>
                                            <tr>
                                                <th scope="col"><iconify-icon icon="jam:cogs"></iconify-icon></th>
                                                <th scope="col">Nama Pencapaian</th>
                                                <th scope="col">Jumlah Pencapaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="achievementModal" tabindex="-1" aria-labelledby="achievementModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form id="submitAchievement">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="achievementModalLabel">Add achievement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div id="errAchievement"></div>
                                        <div class="modal-body">
                                            <input type="hidden" name="typeAchievement" id="typeAchievement" class="typeAchievement">
                                            <input type="text" name="name" class="form-control name form-control-rounded" placeholder="Nama Pencapaian">
                                            <input type="text" name="number" class="form-control number form-control-rounded mt-4" placeholder="Jumlah Pencapaian" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="saveAchievement">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- company members  !-->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Company Members
                                <button class="btn btn-none p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#company_members" aria-expanded="false" aria-controls="company_members"><iconify-icon icon="ion:chevron-collapse"></iconify-icon> Toggle</button>
                            </h5>
                        </div>
                        <div class="card-body collapse" id="company_members">
                            <div class="example-container">
                                <div class="example-content">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm saveButtonMember" data-bs-toggle="modal" data-bs-target="#memberModal">
                                        Add members
                                    </button>
                                    <table class="display nowrap" style="width:100%" id="tableCompanyMembers">
                                    <thead>
                                        <tr>
                                            <th scope="col"><iconify-icon icon="jam:cogs"></iconify-icon></th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">email</th>
                                            <th scope="col">Nomer Handphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form id="submitMember" class="g-3" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="memberModalLabel">Add Member</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div id="errMember"></div>
                                            <div class="modal-body mt-0 pt-3 row">
                                                <input type="hidden" name="typeMember" id="typeMember" class="typeMember">
                                                <div class="col-md-12">
                                                    <div class="avartar">
                                                        <label for="" class="text-center mx-auto d-block">Photo Member <span class="fontSize-8 text-warning">(*jpg,png,jpeg)</span> <br><span class="fontSize-8 text-info">*Best size 200px x 200px</span></label>
                                                        <div class="d-flex justify-content-center">
                                                            <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResult" alt="" width="100">
                                                        </div>
                                                        <div class="avartar-picker">
                                                            <input id="upload" class="input-btn mx-auto d-block photo" id="photo"  name="photo" type="file" onchange="readURL(this);" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <input type="text" class="form-control first_name" name="first_name" placeholder="First Name">
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <input type="text" class="form-control last_name" name="last_name" placeholder="Last Name">
                                                </div>
                                                <div class="col-md-12 mt-4">
                                                    <input type="text" class="form-control title" name="title" placeholder="Jabatan">
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <input type="email" class="form-control email" name="email" placeholder="Email">
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <input type="text" class="form-control mobile_phone" name="mobile_phone" placeholder="Nomer Handphone">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="saveMember">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('companyManagement.about-us.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="avartar mt-5 ">
                                                <label for="" class="text-center">Logo header</label>
                                                <div class="">
                                                    @if ($aboutUs->logo != null)
                                                        <img src="{{ asset('assets/images/aboutUs/'.$aboutUs->logo) }}" id="resultPictureCompany" alt="" width="100">
                                                    @else
                                                        <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="resultPictureCompany" alt="" width="100">
                                                    @endif
                                                </div>

                                                <div class="avartar-picker mt-5">
                                                    <input accept="image/*" id="pictureCompany" class="input-btn"  name="pict" type="file" onchange="readURLCompany(this);" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="avartar mt-5 ">
                                                <label for="" class="text-center">Logo Footer</label>
                                                <div class="">
                                                    @if ($aboutUs->logo_white != null)
                                                        <img src="{{ asset('assets/images/aboutUs/'.$aboutUs->logo_white) }}" id="imageResultLogo" alt="" width="100">
                                                    @else
                                                        <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResultLogo" alt="" width="100">
                                                    @endif
                                                </div>

                                                <div class="avartar-picker mt-5">
                                                    <input accept="image/*" id="uploadLogo" class="input-btn"  name="logo" type="file" onchange="readLogoURL(this);" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="avartar mt-5 ">
                                                <label for="" class="text-center ">Favicon</label>
                                                <div class="">
                                                    @if ($aboutUs->favicon != null)
                                                        <img src="{{ asset('assets/images/aboutUs/'.$aboutUs->favicon) }}" id="imageResultFavicon" alt="" width="100">
                                                    @else
                                                        <img src="{{ asset('assets/cms/images/noImage.jpg') }}" id="imageResultFavicon" alt="" width="100">
                                                    @endif
                                                </div>

                                                <div class="avartar-picker mt-5">
                                                    <input accept="image/*" id="uploadFavicon" class="input-btn"  name="favicon" type="file" onchange="readFaviconURL(this);" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                        <div class="form-group mt-2">
                                            <button class="btn btn-primary btn-md">Save</button>
                                        </div>
                                </form>
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
    <script>

        $(document).ready(function() {
            // datatable
            var table = $('#tableAchievement').DataTable({
                "initComplete": function (settings, json) {
                    $("#tableAchievement").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
                'processing' : true,
                'deferRender'  : true,
                'dom': 'Bfrtip',
                'ajax': {
                        'url': '{{ route('companyManagement.achievement.index') }}',
                    },
                'columns': [
                    {data: 'action', name: 'action', orderable:false, searching:false},
                    {data: 'name', name: 'name', orderable:false, searching:true},
                    {data: 'number', name: 'number', orderable:true, searching:false},
                ],
                language: {
                    'processing' : '<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div><p class="text-white bg-dark">Memuat data, Harap tunggu yaa..</p>',
                    'zeroRecords' : 'Data not found'
                },
            }).columns.adjust().draw();
            var tableMembers = $('#tableCompanyMembers').DataTable({
                "initComplete": function (settings, json) {
                    $("#tableCompanyMembers").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
                'processing' : true,
                'deferRender'  : true,
                'dom': 'Bfrtip',
                'ajax': {
                        'url': '{{ route('companyManagement.company-members.index') }}',
                    },
                'columns': [
                    {data: 'action', name: 'action', orderable:false, searching:false},
                    {data: 'name', name: 'name', orderable:true, searching:true},
                    {data: 'photo', name: 'photo', orderable:false, searching:false},
                    {data: 'title', name: 'title', orderable:false, searching:false},
                    {data: 'email', name: 'email', orderable:true, searching:true},
                    {data: 'mobile_phone', name: 'mobile_phone', orderable:false, searching:true},
                ],
                language: {
                    'processing' : '<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div><p class="text-white bg-dark">Memuat data, Harap tunggu yaa..</p>',
                    'zeroRecords' : 'Data not found'
                },
            }).columns.adjust().draw();
            // edit achievement
            var idAchievement;
            $(document).on('click','.editAchievement',function(){
                idAchievement = $(this).attr("id");
                $('#achievementModal').modal('show');
                var url = "{{ route('companyManagement.achievement.show', ':id') }}"
                url = url.replace(':id',idAchievement);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        $('.typeAchievement').val('edit');
                        $('.name').val(response.data.name);
                        $('.number').val(response.data.number);
                    }
                });
            })
            // save achievement
            $(document).on('click','.saveButtonAchievement', function() {
                $('.typeAchievement').val('save');
                $('.name').val('');
                $('.number').val('');
            })
            // delete achievement
            $(document).on('click','.deleteAchievement',function() {
                Swal.fire({
                    title: 'Yakin hapus data?',
                    showCancelButton: true,
                    confirmButtonText: 'Iya',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('companyManagement.achievement.destroy',':id') }}"
                        id = $(this).attr("id");
                        url = url.replace(':id',id)
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                '_token' : '{{ csrf_token() }}'
                            },
                            dataType: "json",
                            success: function (response) {
                                console.log(response);
                                Swal.fire('Berhasil dihapus', '', 'success')
                                $('#tableAchievement').DataTable().ajax.reload();
                            }
                        });
                    }
                })
            })
            // submit data achievement
            $('#submitAchievement').submit(function (e) {
                e.preventDefault();
                var typeAchievement = $('.typeAchievement').val();
                var editUrl = "{{ route('companyManagement.achievement.update',':idAchievement') }}"
                editUrl = editUrl.replace(':idAchievement',idAchievement);
                var method = (typeAchievement == 'save') ? 'post' : 'put'
                var url = (typeAchievement == 'save') ? '{{ route('companyManagement.achievement.store') }}' : editUrl
                var data = $('#submitAchievement').serializeArray();

                $.ajax({
                    type: method,
                    url: url,
                    data: {
                        '_token' : '{{ csrf_token() }}',
                        'data' : data
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#saveAchievement').text('loading...');
                    },
                    success: function (response) {
                        $('#errAchievement').removeClass('alert alert-danger mx-5');
                        $('#errAchievement').text('');
                        $('#saveAchievement').text('save');
                        $('#achievementModal').modal('hide');
                        $('#tableAchievement').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        var err = eval("(" + xhr.responseText + ")");
                        $('#errAchievement').addClass('alert alert-danger mx-5');
                        $('#errAchievement').text(err.message);
                        $('#saveAchievement').text('save');
                    }
                });

            });

            // edit member
            var idMember;
            $(document).on('click','.editCompanyMember',function(){
                idMember = $(this).attr("id");
                $('#memberModal').modal('show');
                var url = "{{ route('companyManagement.company-members.show', ':id') }}"
                url = url.replace(':id',idMember);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        var image = "{{ asset('assets/images/companyMembers/:img') }}",
                        image = image.replace(':img',response.data.file)
                        $('.typeMember').val('edit');
                        $('#imageResult').attr('src',image);
                        $('.first_name').val(response.data.first_name);
                        $('.last_name').val(response.data.last_name);
                        $('.title').val(response.data.title);
                        $('.email').val(response.data.email);
                        $('.mobile_phone').val(response.data.mobile_phone);
                    }
                });
            })
            // save member
            $(document).on('click','.saveButtonMember', function() {
                $('.typeMember').val('save');
                $('#imageResult').attr('src',"{{ asset('assets/cms/images/noImage.jpg') }}");
                $('.first_name').val('');
                $('.last_name').val('');
                $('.title').val('');
                $('.email').val('');
                $('.mobile_phone').val('');
            })
            // delete member
            $(document).on('click','.deleteCompanyMember',function() {
                Swal.fire({
                    title: 'Yakin hapus data?',
                    showCancelButton: true,
                    confirmButtonText: 'Iya',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('companyManagement.company-members.destroy',':id') }}"
                        id = $(this).attr("id");
                        url = url.replace(':id',id)
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: {
                                '_token' : '{{ csrf_token() }}'
                            },
                            dataType: "json",
                            success: function (response) {
                                console.log(response);
                                Swal.fire('Berhasil dihapus', '', 'success')
                                $('#tableCompanyMembers').DataTable().ajax.reload();
                            }
                        });
                    }
                })
            })
            // submit data member
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#submitMember').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var typeMember = $('.typeMember').val();
                (typeMember == 'save') ? formData.append('_method', 'POST') : formData.append('_method', 'PATCH');
                var editUrl = "{{ route('companyManagement.company-members.update',':idMember') }}"
                editUrl = editUrl.replace(':idMember',idMember);
                var method = (typeMember == 'save') ? 'post' : 'put'
                var url = (typeMember == 'save') ? '{{ route('companyManagement.company-members.store') }}' : editUrl
                $.ajax({
                    type: 'post',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#saveMember').text('loading...');
                    },
                    success: function (response) {
                        $('#errMember').removeClass('alert alert-danger mx-5');
                        $('#errMember').text('');
                        $('#saveMember').text('save');
                        $('#memberModal').modal('hide');
                        $('#tableCompanyMembers').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        var err = eval("(" + xhr.responseText + ")");
                        $('#errMember').addClass('alert alert-danger mx-5');
                        $('#errMember').text(err.message);
                        $('#saveMember').text('save');
                    }
                });

            });
            // select2
            $('.country').select2({
                placeholder: "Select a nation",
                allowClear: true
            });

            // preview image picture company
            pictureCompany.onchange = evt => {
            const [file] = pictureCompany.files
                if (file) {
                    resultPictureCompany.src = URL.createObjectURL(file)
                }
            }
            // preview image picture logo company
            uploadLogo.onchange = ul => {
                const [file] = uploadLogo.files
                if (file) {
                    imageResultLogo.src = URL.createObjectURL(file)
                }
            }

            // preview image picture favicon company
            uploadFavicon.onchange = uf => {
                const[file] = uploadFavicon.files
                if (file) {
                    imageResultFavicon.src = URL.createObjectURL(file)
                }
            }
        });
    </script>
@endpush
