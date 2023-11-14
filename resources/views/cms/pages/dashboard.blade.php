@extends('cms.template.main')
@section('title','Dashboard')
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- admin dashboard -->
        @if (Auth::user()->user_type == 'admin')
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Active Users</span>
                                <span class="widget-stats-amount">
                                    <div id="appendUser"></div>
                                </span>
                                {{-- <span class="widget-stats-info">790 unique this month</span> --}}
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 12%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                Selamat Datang {{ Auth::user()->name ?? '' }}
            </div>
        @endif
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
        $(document).ready(function () {
           $.ajax({
            type: "get",
            url: "{{ route('userCount') }}",
            dataType: "json",
            beforeSend: function()
            {
                $('#appendUser').append(
                    `
                    <iconify-icon icon="line-md:loading-loop" id="loadingUser"></iconify-icon>
                    `
                )
            },
            success: function (response) {
                $('#loadingUser').remove();
                $('#appendUser').text(response.data);
            }
           });
        });
    </script>
@endpush