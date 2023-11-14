
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="mrh">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title -->
    <title>Company - Halaman Tidak ditemukan</title>

    <!-- Styles -->
    @include('cms.includes.style')
    
</head>
<body>
    <div class="app app-error align-content-stretch d-flex flex-wrap">
        <div class="app-error-info">
            <h5>Oops!</h5>
            <span>It seems that the page you are looking for no longer exists.<br>
                We will try our best to fix this soon.</span>
            <a href="{{ route('cms.dashboard') }}" class="btn btn-dark">Go to dashboard</a>
        </div>
        <div class="app-error-background"></div>
    </div>
    <!-- Javascripts -->
    @include('cms.includes.script')
</body>
</html>