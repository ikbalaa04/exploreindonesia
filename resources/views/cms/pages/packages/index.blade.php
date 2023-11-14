@extends('cms.template.main')
@section('title','Dashboard admin Packages')
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>packages</h1>
                <span>List tour packages, yang akan ditampilkan dihalaman depan</span>
                <br>
                <a href="{{ route('masterData.packages.create') }}?type=add" class="">
                    <i class="fa-solid fa-circle-plus fa-2xl" style="color: #02c061;"> <span style="font-size: 14px">Add packages</span></i>
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
            <div class="card">
                <div class="card-body">
                    <table id="packet" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>status</th>
                                {{-- <th>zone</th> --}}
                                <th>categories</th>
                                <th>partner</th>
                                <th>province</th>
                                <th>available</th>
                                <th>price</th>
                                {{-- <th>different prices for tourists</th> --}}
                                <th>title idn</th>
                                <th>title en</th>
                                <th>short description idn</th>
                                <th>short description en</th>
                                <th>description idn</th>
                                <th>description en</th>
                                <th>min ticket</th>
                                <th>max ticket</th>
                                <th>Duration Of Tour</th>
                                {{-- <th>slug</th> --}}
                                <th>tag</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
<!-- delete modal  -->
@include('cms.includes.delete')
@endsection

@push('after-script')
    <script type="text/javascript"> 
        $(document).ready(function() {
            var table = $('#packet').DataTable({
                "initComplete": function (settings, json) {  
                    $("#packet").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
                },
                'processing' : true,
                'deferRender'  : true,
                'dom': 'Bfrtip',
                'ajax': {
                        'url': '#',
                    },
                'columns': [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'action', name: 'action', orderable:false, searching:false},
                    {data: 'status', name: 'status', orderable:false, searching:false},
                    // {data: 'zone_id', name: 'zone_id', orderable:false, searching:false},
                    {data: 'categories', name: 'categories', orderable:false, searching:false},
                    {data: 'partner', name: 'partner', orderable:false, searching:false},
                    {data: 'province', name: 'province', orderable:false, searching:false},
                    {data: 'available_id', name: 'available_id', orderable:false, searching:false},
                    {data: 'price', name: 'price', orderable:false, searching:false},
                    // {data: 'different_prices_for_tourists', name: 'different_prices_for_tourists', orderable:false, searching:false},
                    {data: 'title_idn', name: 'title_idn', orderable:false, searching:false},
                    {data: 'title_en', name: 'title_en', orderable:false, searching:false},
                    {data: 'short_description_idn', name: 'short_description_idn', orderable:false, searching:false},
                    {data: 'short_description_en', name: 'short_description_en', orderable:false, searching:false},
                    {data: 'description_idn', name: 'description_idn', orderable:false, searching:false},
                    {data: 'description_en', name: 'description_en', orderable:false, searching:false},
                    {data: 'min_ticket', name: 'min_ticket', orderable:false, searching:false},
                    {data: 'max_ticket', name: 'max_ticket', orderable:false, searching:false},
                    {data: 'length_of_vacation', name: 'length_of_vacation', orderable:false, searching:false},
                    // {data: 'slug', name: 'slug', orderable:false, searching:false},
                    {data: 'tag', name: 'tag', orderable:false, searching:false},
                    {data: 'created_by', name: 'created_by',orderable:false, searching:false},
                    {data: 'updated_by', name: 'updated_by',orderable:false, searching:false},
                ],
                language: {
                    'processing' : '<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div><p class="text-white bg-dark">Memuat data, Harap tunggu yaa..</p>',
                    'zeroRecords' : 'Data not found'
                },
            }).columns.adjust().draw();
            
            // deletePermanent 
            var idhapus;
            $(document).on('click','.deletePermanent',function(){
                $('#modal_deletePermanent').modal('show');
                idhapus = $(this).attr("id");
            })
            $('#deletePermanent_button').click(function(){
                $('#deletePermanent_button').text('Delete');
                $.ajax({
                    type: 'POST',
                    url:'/master-data/packages/'+idhapus,
                    data:{
                        'id': idhapus,
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}',
                    },
                    beforeSend:function()
                    {
                        $('#deletePermanent_button').text('loading...');
                    },
                    success:function(data)
                    {
                        $('#modal_deletePermanent').modal('hide');
                        $('#deletePermanent_button').text('deletePermanent');
                        $('#packet').DataTable().ajax.reload();
                    }
                });
            });

        });
    </script>
@endpush