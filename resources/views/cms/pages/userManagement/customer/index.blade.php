@extends('cms.template.main')
@section('title','Dashboard admin customers')
@section('content')
@if (Auth::user()->user_type == 'admin')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>customer</h1>
                <span>List customer</span>
                <br>
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
                    <table id="customer" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>No. Hp</th>
                                <th>Picture</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Twitter</th>
                                <th>Facebook</th>
                                <th>Instagram</th>
                                <th>Website</th>
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
            var table = $('#customer').DataTable({
                "initComplete": function (settings, json) {  
                    $("#customer").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
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
                    {data: 'name', name: 'name',orderable:false, searching:false},
                    {data: 'email', name: 'email',orderable:false, searching:false},
                    {data: 'mobile_phone', name: 'mobile_phone',orderable:false, searching:false},
                    {data: 'file', name: 'file',orderable:false, searching:false},
                    {data: 'address', name: 'address',orderable:false, searching:false},
                    {data: 'gender', name: 'gender',orderable:false, searching:false},
                    {data: 'birth_date', name: 'birth_date',orderable:false, searching:false},
                    {data: 'twitter', name: 'twitter',orderable:false, searching:false},
                    {data: 'facebook', name: 'facebook',orderable:false, searching:false},
                    {data: 'instagram', name: 'instagram',orderable:false, searching:false},
                    {data: 'website', name: 'website',orderable:false, searching:false},
                ],
                language: {
                    'processing' : '<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div><p class="text-white bg-dark">Memuat data, Harap tunggu yaa..</p>',
                    'zeroRecords' : 'Data not found'
                },
            }).columns.adjust().draw();
            
            // delete 
            var idhapus;
            $(document).on('click','.delete',function(){
                $('#modal_delete').modal('show');
                idhapus = $(this).attr("id");
            })
            $('#delete_button').click(function(){
                $('#delete_button').text('delete');
                $.ajax({
                    type: 'DELETE',
                    url:'/userManagement/'+idhapus,
                    data:{
                        'id': idhapus,
                        '_token': '{{ csrf_token() }}',
                        '_method' : 'post'
                    },
                    beforeSend:function()
                    {
                        $('#delete_button').text('delete...');
                    },
                    success:function(data)
                    {
                        $('#modal_delete').modal('hide');
                        $('#delete_button').text('Delete');
                        $('#UserManagement').DataTable().ajax.reload();
                    }
                });
            });
            // active 
            var idhapus;
            $(document).on('click','.aktif',function(){
                $('#modal_active').modal('show');
                idhapus = $(this).attr("id");
            })
            $('#active_button').click(function(){
                $('#active_button').text('active');
                $.ajax({
                    type: 'POST',
                    url:'/userManagement/active/'+idhapus,
                    data:{
                        'id': idhapus,
                        '_token': '{{ csrf_token() }}',
                    },
                    beforeSend:function()
                    {
                        $('#active_button').text('loading...');
                    },
                    success:function(data)
                    {
                        $('#modal_active').modal('hide');
                        $('#active_button').text('active');
                        $('#UserManagement').DataTable().ajax.reload();
                    }
                });
            });

        });
    </script>
@endpush