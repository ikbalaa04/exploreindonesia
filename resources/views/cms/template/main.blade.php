
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Dashboard Indecon">
    <meta name="keywords" content="admin,dashboard,Indecon,borneo,kalimantan,travel">
    <meta name="author" content="mrh">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>Company - @yield('title')</title>

    <!-- Styles -->
    @stack('before-style')
    @include('cms.includes.style')
    @stack('after-style')
    
</head>
<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        {{-- sidebar  --}}
        @include('cms.includes.sidebar')
        <div class="app-container">
            {{-- navbar  --}}
            @include('cms.includes.navbar')
            <div class="app-content">
                <div class="content-wrapper">
                    {{-- content  --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Javascripts -->
    @stack('before-script')
    @include('cms.includes.script')
    @stack('after-script')
    
</body>
</html>