@extends('cms.template.main')
@section('title','Dashboard admin Tour planning')
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Trip Request</h1>
                <span>Semua Trip Request yang diminta oleh user.</span>
                <br>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="category" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>destination_request</th>
                                <th>departure_date</th>
                                <th>duration_trip</th>
                                <th>number_of_participant</th>
                                {{-- <th>currency</th> --}}
                                {{-- <th>budget_trip</th> --}}
                                <th>note</th>
                                <th>status</th>
                                <th>approval</th>
                                <th>first_name</th>
                                <th>last_name</th>
                                <th>email</th>
                                <th>code_phone</th>
                                <th>phone_number</th>
                                <th>hear_about_us</th>
                                <th>Created At</th>
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
            var table = $('#category').DataTable({
                "initComplete": function (settings, json) {  
                    $("#category").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
                },
                'processing' : true,
                'deferRender'  : true,
                'dom': 'Bfrtip',
                'ajax': {
                        'url': '#',
                    },
                'columns': [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'destination_request', name: 'destination_request', orderable:false, searching:false},
                    {data: 'departure_date', name: 'departure_date', orderable:false, searching:false},
                    {data: 'duration_trip', name: 'duration_trip', orderable:false, searching:false},
                    {data: 'number_of_participant', name: 'number_of_participant', orderable:false, searching:false},
                    {data: 'note', name: 'note', orderable:false, searching:false},
                    {data: 'status', name: 'status', orderable:false, searching:false},
                    {data: 'approval', name: 'approval', orderable:false, searching:false},
                    {data: 'first_name', name: 'first_name', orderable:false, searching:false},
                    {data: 'last_name', name: 'last_name', orderable:false, searching:false},
                    {data: 'email', name: 'email', orderable:false, searching:false},
                    {data: 'code_phone', name: 'code_phone', orderable:false, searching:false},
                    {data: 'phone_number', name: 'phone_number', orderable:false, searching:false},
                    {data: 'hear_about_us', name: 'hear_about_us', orderable:false, searching:false},
                    {data: 'created_at', name: 'created_at',orderable:false, searching:false},
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
                    url:'/master-data/category/'+idhapus,
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
                        $('#category').DataTable().ajax.reload();
                    }
                });
            });

        });
    </script>
@endpush