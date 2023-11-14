@extends('cms.template.main')
@section('title','Dashboard admin SubCategories')
@push('after-style')
    <style>
        .card {
            border: 0;
            border-radius: 0px;
            margin-bottom: 30px;
            -webkit-box-shadow: 0 2px 3px rgba(0,0,0,0.03);
            box-shadow: 0 2px 3px rgba(0,0,0,0.03);
            -webkit-transition: .5s;
            transition: .5s;
        }

        .padding {
            padding: 3rem !important
        }

        body {
            background-color: #f9f9fa
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }


        .card-header {
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            padding: 15px 20px;
            background-color: transparent;
            border-bottom: 1px solid rgba(77,82,89,0.07);
        }

        .card-header .card-title {
            padding: 0;
            border: none;
        }

        h4.card-title {
            font-size: 17px;
        }

        .card-header>*:last-child {
            margin-right: 0;
        }

        .card-header>* {
            margin-left: 8px;
            margin-right: 8px;
        }

        .btn-secondary {
            color: #4d5259 !important;
            background-color: #e4e7ea;
            border-color: #e4e7ea;
            color: #fff;
        }

        .btn-xs {
            font-size: 11px;
            padding: 2px 8px;
            line-height: 18px;
        }
        .btn-xs:hover{
            color:#fff !important;
        }

        .card-title {
            font-family: Roboto,sans-serif;
            font-weight: 300;
            line-height: 1.5;
            margin-bottom: 0;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(77,82,89,0.07);
        }

        .ps-container {
            position: relative;
            overflow: auto;
        }

        .ps-container {
            -ms-touch-action: auto;
            touch-action: auto;
            /* overflow: hidden!important; */
            -ms-overflow-style: none;
        }

        .media-chat {
            padding-right: 64px;
            margin-bottom: 0;
        }

        .media {
            padding: 5px 12px 0px 12px;
            -webkit-transition: background-color .2s linear;
            transition: background-color .2s linear;
        }

        .media .avatar {
            flex-shrink: 0;
        }

        .avatar {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            border-radius: 100%;
            background-color: #f5f6f7;
            color: #8b95a5;
            text-transform: uppercase;
        }

        .media-chat .media-body {
            -webkit-box-flex: initial;
            flex: initial;
            display: table;
        }

        .media-body {
            min-width: 0;
        }

        .media-chat .media-body p {
            position: relative;
            padding: 6px 8px;
            margin: 4px 0;
            background-color: #f5f6f7;
            border-radius: 3px;
            font-weight: 100;
            color:#9b9b9b;
        }

        .media>* {
            margin: 0 8px;
        }

        .media-chat .media-body p.meta {
            background-color: transparent !important;
            padding: 0;
            opacity: .8;
        }

        .media-meta-day {
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            margin-bottom: 0;
            color: #8b95a5;
            opacity: .8;
            font-weight: 400;
        }

        .media {
            padding: 5px 12px 0px 12px;
            -webkit-transition: background-color .2s linear;
            transition: background-color .2s linear;
        }

        .media-meta-day::before {
            margin-right: 16px;
        }

        .media-meta-day::before, .media-meta-day::after {
            content: '';
            -webkit-box-flex: 1;
            flex: 1 1;
            border-top: 1px solid #ebebeb;
        }

        .media-meta-day::after {
            content: '';
            -webkit-box-flex: 1;
            flex: 1 1;
            border-top: 1px solid #ebebeb;
        }

        .media-meta-day::after {
            margin-left: 16px;
        }

        .media-chat.media-chat-reverse {
            padding-right: 12px;
            padding-left: 64px;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: reverse;
            flex-direction: row-reverse;
        }

        .media-chat {
            padding-right: 64px;
            margin-bottom: 0;
        }

        .media {
            padding: 5px 12px 0px 12px;
            -webkit-transition: background-color .2s linear;
            transition: background-color .2s linear;
        }

        .media-chat.media-chat-reverse .media-body p {
            float: right;
            clear: right;
            background-color: #48b0f7;
            color: #fff;
        }

        .media-chat .media-body p {
            position: relative;
            padding: 6px 8px;
            margin: 4px 0;
            background-color: #f5f6f7;
            border-radius: 3px;
        }

        .border-light {
            border-color: #f1f2f3 !important;
        }

        .bt-1 {
            border-top: 1px solid #ebebeb !important;
        }

        .publisher {
            position: relative;
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            padding: 12px 20px;
            background-color: #f9fafb;
        }

        .publisher>*:first-child {
            margin-left: 0;
        }

        .publisher>* {
            margin: 0 8px;
        }

        .publisher-input {
            -webkit-box-flex: 1;
            flex-grow: 1;
            border: none;
            outline: none !important;
            background-color: transparent;
        }

        button, input, optgroup, select, textarea {
            font-family: Roboto,sans-serif;
            font-weight: 300;
        }

        .publisher-btn {
            background-color: transparent;
            border: none;
            color: #8b95a5;
            font-size: 16px;
            cursor: pointer;
            overflow: -moz-hidden-unscrollable;
            -webkit-transition: .2s linear;
            transition: .2s linear;
        }

        .file-group {
            position: relative;
            overflow: hidden;
        } 

        .publisher-btn {
            background-color: transparent;
            border: none;
            color: #cac7c7;
            font-size: 16px;
            cursor: pointer;
            overflow: -moz-hidden-unscrollable;
            -webkit-transition: .2s linear;
            transition: .2s linear;
        } 

        .file-group input[type="file"] {
            position: absolute;
            opacity: 0;
            z-index: -1; 
            width: 20px;
        }

        .text-info {
            color: #48b0f7 !important;
        }
    </style>
@endpush
@section('content')
@if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>chat</h1>
                <span>List chat, dari customer</span>
            </div>
           
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mt-4">
                    <div class="bg-white p-3">
                        <div>Chat</div>
                        @forelse ($listMessage as $key => $item)
                            <div class="d-flex align-items-center {{ $key < 1 ? 'mt-3' : '' }}">
                                <div class="flex-shrink-0">
                                    @if ($item->user != null)
                                        <img src="{{ asset('assets/web/img/indecon/noimage.png') }}" alt="..." width="40" height="40" class="img-fluid">
                                    @else 
                                        <img src="{{ ($item->user->file != null) ? asset('assets/images/user/'.$item->user->file) : asset('assets/cms/images/noImage.jpg') }}" alt="..." width="40" height="40" class="img-fluid">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3 fw-bold fontSize-12" style="color: #2F2F2F;font-weight: 500;line-height: normal;">
                                    <a href="{{ route('message.index') }}?to={{ $item->user_id ?? '' }}" class="text-dark" style="text-decoration: none">
                                        {{ $item->user->name ?? '-' }} 
                                    </a>
                                    @if($item->lastMessage->reply_by != null)<span><iconify-icon icon="carbon:dot-mark" style="color: #18a95e;"></iconify-icon></span>@endif
                                    <br>
                                    <span class="fontSize-10" style="color: #999;font-weight: 500;line-height: normal;">{{ substr($item->lastMessage->message,0,17) }} .......</span>
                                </div>
                            </div>
                        @empty
                            <div class="fontSize-10" style="color: #999;font-weight: 500;line-height: normal;">Belum ada chat dari siapapun, Sabar ya.. tunggu chat dari customer</div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-8 pe-0 mt-4">
                    @if ($user != null)
                        <div class="bg-white">
                            <div class="page-content page-container" id="page-content">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        @if ($user != null)
                                                            <img src="{{ asset('assets/web/img/indecon/noimage.png') }}" alt="..." width="40" height="40" class="img-fluid">
                                                        @else
                                                            <img src="{{ ($user->file != null) ? asset('assets/images/user/'.$user->file) : asset('assets/web/img/indecon/noimage.png') }}" alt="..." width="40" height="40" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 fw-bold fontSize-12" style="color: #2F2F2F;font-weight: 500;line-height: normal;">
                                                        {{ $user->name ?? '-' }}
                                                        <br>
                                                        {{-- <span class="fontSize-10" style="color: #999;font-weight: 500;line-height: normal;">Last online 12 minutes</span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="height:400px !important;">
                                                @if ($messages != null)
                                                    @forelse ($messages->message as $message)
                                                        <!-- pesan dari orang lain -->
                                                        @if ($message->from_id == \Request::query('to') ) 
                                                            <div class="media media-chat">
                                                                {{-- <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="..."> --}}
                                                                <div class="media-body">
                                                                    <p>{{ $message->message ?? '' }}</p>
                                                                    {{-- <p>How are you ...???</p>
                                                                    <p>What are you doing tomorrow?<br> Can we come up a bar?</p> --}}
                                                                    <p class="meta" style="font-size: 8px; color:#6d6d6d"><time datetime="2018">{{ $message->created_at }}</time></p>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="media media-meta-day">Today</div> --}}
                                                        @endif

                                                        <!-- pesan saya -->
                                                        @if ($message->from_id == Auth::user()->partner_id ) 
                                                            <div class="media media-chat media-chat-reverse">
                                                                <div class="media-body ms-auto">
                                                                    <p style="font-size:12px">{{ $message->message ?? '' }}</p>
                                                                    {{-- <p>How are you doing?</p>
                                                                    <p>Long .</p> --}}
                                                                    <p class="meta" style="font-size: 8px; color:#6d6d6d"><time datetime="2018">{{ $message->created_at }} (Reply By: {{ $message->reply_by ?? '' }})</time></p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                    <span id="appendFromDatabase"></span>
                                                    {{-- <span id="appendMessage"></span> --}}
                                                @endif


                                                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>

                                                <div class="publisher bt-1 border-light">
                                                    <img class="avatar avatar-xs" src="@if(Auth::user()->gender == 2) https://img.icons8.com/color/36/000000/administrator-female.png @else https://img.icons8.com/color/36/000000/administrator-male.png @endif" alt="...">
                                                    <input class="publisher-input message" id="message" type="text" placeholder="Write something">
                                                    <span class="publisher-btn file-group">
                                                    <iconify-icon icon="icons8:plus"></iconify-icon>
                                                    <input type="file">
                                                    </span>
                                                    <button type="button" class="publisher-btn text-info sendMessage" id="sendMessage" href="#" data-abc="true">
                                                        <iconify-icon icon="heroicons:paper-airplane-20-solid" style="color: #18a95e;"></iconify-icon>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
<!-- delete modal  -->
@include('cms.includes.delete')
@endsection

@push('after-script')
    <script type="text/javascript"> 
        $(document).ready(function () {
            // function autorefresh and load data every minutes 
            function refreshMessage() {
                $.ajax({
                    type: "get",
                    url: "{{ route('message.refresh') }}",
                    data: {
                        'from' : 'partner',
                        'from_id' : '{{ \Auth::user()->partner_id ?? '' }}',
                        'recipient_id' : '{{ \Request::query("to") ?? '' }}'
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.message != null) {
                            $('#appendFromDatabase').append(response.message);
                            // scrool to bottom when append new message 
                            var container = $('#chat-content');
                            container.scrollTop(container[0].scrollHeight);
                        }
                    }
                });
            }
            setInterval(refreshMessage,4000);
            refreshMessage();
            $('#message').keypress(function (e) { 
                var key = e.which
                if (key == 13) {
                    var val = $(this).val();
                    // save to database 
                    $.ajax({
                        type: "post",
                        url: "{{ route('message.send') }}",
                        data: {
                            '_token' : '{{ csrf_token() }}',
                            'message' : val,
                            'from' : 'partner',
                            'from_id' : '{{ \Auth::user()->partner_id ?? '' }}',
                            'recipient_id' : '{{ \Request::query("to") ?? '' }}'
                        },
                        dataType: "json",
                        success: function (response) {
                            var d = new Date();
                            var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                            // send to frontend 
                            $('#appendFromDatabase').append(
                                `
                                    <div class="media media-chat media-chat-reverse">
                                        <div class="media-body ms-auto">
                                            <p style="font-size:12px">`+val+`</p>
                                            <p class="meta" style="font-size: 8px; color:#6d6d6d"><time datetime="2018">`+strDate+`</time></p>
                                        </div>
                                    </div>
                                `
                            );
                            // scrool to bottom when append new message 
                            var container = $('#chat-content');
                            container.scrollTop(container[0].scrollHeight);
                        },
                        error: function(xhr) {
                            var err = eval("(" + xhr.responseText + ")");
                            Swal.fire(JSON.stringify(err.message));
                        }
                    });   
                    $(this).val('');
                }
            });
            $('#sendMessage').click(function (e) { 
                var val = $('#message').val();
                // save to database 
                $.ajax({
                    type: "post",
                    url: "{{ route('message.send') }}",
                    data: {
                        '_token' : '{{ csrf_token() }}',
                        'message' : val,
                        'from' : 'partner',
                        'from_id' : '{{ \Auth::user()->partner_id ?? '' }}',
                        'recipient_id' : '{{ \Request::query("to") ?? '' }}'
                    },
                    dataType: "json",
                    success: function (response) {
                        var d = new Date();
                        var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                        // send to frontend 
                        $('#appendFromDatabase').append(
                            `
                                <div class="media media-chat media-chat-reverse">
                                    <div class="media-body ms-auto">
                                        <p style="font-size:12px">`+val+`</p>
                                        <p class="meta" style="font-size: 8px; color:#6d6d6d"><time datetime="2018">`+strDate+`</time></p>
                                    </div>
                                </div>
                            `
                        );
                        // scrool to bottom when append new message 
                        var container = $('#chat-content');
                        container.scrollTop(container[0].scrollHeight);
                    },
                    error: function(xhr) {
                        var err = eval("(" + xhr.responseText + ")");
                        Swal.fire(JSON.stringify(err.message));
                    }
                });
                
                $('#message').val('');
            });
        });
    </script>
@endpush