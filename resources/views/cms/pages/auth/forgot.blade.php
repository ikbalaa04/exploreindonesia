
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
    <title>Company - Halaman Lupa Password</title>

    <!-- Styles -->
    @include('cms.includes.style')
    
</head>
<body>
    <div class="app app-auth-lock-screen align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="index.html">Company</a>
            </div>
            <p class="auth-description">Please fill your valid email, to reset your password.</p>
             @if(session('success'))
                <div class="alert alert-success alert-sm">
                </button> {{session('success')}}</div>
            @endif
            @if(session('gagal'))
                <div class="alert alert-danger alert-sm">
                </button> {{session('gagal')}}</div>
            @endif
            <form action="{{ route('postForgotPassword') }}" method="post">
                @csrf
                <div class="auth-credentials m-b-xxl">
                    <label for="signInEmail" class="form-label">Email address</label>
                    <input type="email" name="email" value="{{ old('email') ?? '' }}" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@company.com" required>

                </div>
                <div class="auth-submit">
                    <button class="btn btn-warning">Send OTP to Reset Password</button>
                    <a href="{{ route('login') }}" class="auth-forgot-password float-end">Back to login?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Javascripts -->
    @include('cms.includes.script')
</body>
</html>