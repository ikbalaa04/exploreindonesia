@extends('cms.template.main')
@section('title','Dashboard admin testimonies')
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>testimonies</h1>
                <span>List testimonies, yang akan ditampilkan dihalaman depan</span>
                <br>
                <a href="{{ route('websiteManagement.testimony.create') }}?type=add" class="">
                    <i class="fa-solid fa-circle-plus fa-2xl" style="color: #02c061;"> <span style="font-size: 14px">Add testimonies</span></i>
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
                    <table id="testimonies" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Name</th>
                                <th>File testimonies</th>
                                <th>Occupation</th>
                                <th>website</th>
                                <th>rating</th>
                                <th>Testimony</th>
                                <th>Position</th>
                                <th>Status</th>
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
            var table = $('#testimonies').DataTable({
                "initComplete": function (settings, json) {  
                    $("#testimonies").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
                    {data: 'name', name: 'name'},
                    {data: 'file', name: 'file', orderable:false, searching:false},
                    {data: 'title', name: 'title', orderable:false, searching:false},
                    {data: 'website', name: 'website', orderable:false, searching:false},
                    {data: 'rating', name: 'rating', orderable:false, searching:false},
                    {data: 'description', name: 'description', orderable:false, searching:false},
                    {data: 'position', name: 'position', orderable:false, searching:false},
                    {data: 'status', name: 'status', orderable:false, searching:false},
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
                    url:'/website-management/testimony/'+idhapus,
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
                        $('#testimonies').DataTable().ajax.reload();
                    }
                });
            });

        });
    </script>
@endpush