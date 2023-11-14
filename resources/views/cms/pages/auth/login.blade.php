
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Indecon, the best adventure in the world">
    <meta name="keywords" content="travel,adventure,experience,indecon">
    <meta name="author" content="Developer Indecon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title -->
    <title>Indecon - Halaman Login</title>

    <!-- Styles -->
    @include('cms.includes.style')
    
</head>
<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="{{ route('web.home') }}" class="fontSize-14">Ready for Adventure</a>
            </div>
            <p class="auth-description fontSize-40">Sign in</p>
            <a href="{{ '/auth/redirect' }}" class="btn btn-block fontSize-16 bg-softBlue w-100 text-blue my-2 mt-5"><iconify-icon icon="flat-color-icons:google"></iconify-icon> Sign in with Google</a>
             @if(session('success'))
                <div class="alert alert-success alert-sm">
                </button> {{session('success')}}</div>
            @endif
            @if(session('gagal'))
                <div class="alert alert-danger alert-sm">
                </button> {{session('gagal')}}</div>
            @endif
            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="auth-credentials mt-4">
                    <label for="signInEmail" class="form-label">Enter your username or email address</label>
                    <input type="email" name="email" value="{{ old('email') ?? '' }}" class="form-control border-blue m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@company.com" required>

                    <label for="signInPassword" class="form-label">Enter your Password</label>
                    <input name="password" type="password" value="{{ old('password') ?? '' }}"  class="form-control border-blue" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>
                <div class="auth-submit">
                    <a href="{{ route('forgotPassword') }}" class="auth-forgot-password fontSize-12 float-end text-softDark" style="text-decoration: none">Forgot password</a>
                </div>
                <div class="clear">
                    <div class="row">
                        <div class="text-softDark fontSize-12 col-sm-6">
                            No Account ?
                            <br>
                            <a href="{{ route('register') }}" class="text-yellow" style="text-decoration: none">Sign up</a>
                        </div>
                        <div class="col-sm-6 text-right mt-2">
                            <button class="btn btn-primar bg-yellow text-white text-center p-signIn">Sign In</button>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <div class="divider"></div>
            <div class="auth-alts">
                <a href="#" class="auth-alts-google"></a>
                <a href="#" class="auth-alts-facebook"></a>
                <a href="#" class="auth-alts-twitter"></a>
            </div> --}}
        </div>
    </div>
    <!-- Javascripts -->
    @include('cms.includes.script')
</body>
</html>