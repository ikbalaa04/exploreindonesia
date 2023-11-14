
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
    <title>Indecon - Halaman Register</title>

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
            <p class="auth-description fontSize-40">Sign up</p>

            @if(session('success'))
                <div class="alert alert-success alert-sm">
                </button> {{session('success')}}</div>
            @endif
            @if(session('gagal'))
                <div class="alert alert-danger alert-sm">
                </button> {{session('gagal')}}</div>
            @endif
            <form action="{{ route('admin.register') }}" method="post">
                @csrf
                <div class="auth-credentials mt-5 pt-2 row">
                    <div class="col-12">
                        <label for="signInEmail" class="form-label">Enter your email address</label>
                        <input type="email" name="email" value="{{ old('email') ?? '' }}" class="form-control border-blue m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@company.com" required>
                    </div>
                    <div class="col-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') ?? '' }}" class="form-control m-b-md" id="name" aria-describedby="name" placeholder="Fill your name" required>
                    </div>
                    <div class="col-6">
                        <label for="mobile_phone" class="form-label">Contact Number</label>
                        <input type="text" name="mobile_phone" value="{{ old('mobile_phone') ?? '' }}" class="form-control m-b-md" id="mobile_phone" aria-describedby="mobile_phone" placeholder="Contact Number" required>
                    </div>
                    <div class="col-10">
                        <label for="signInPassword" class="form-label">Enter your Password</label>
                        <input name="password" type="password" value="{{ old('password') ?? '' }}"  class="form-control" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    </div>
                </div>
           
                <div class="mt-4">
                    <div class="row">
                        <div class="text-softDark fontSize-12 col-sm-6">
                            No Account ?
                            <br>
                            <a href="{{ route('login') }}" class="text-yellow" style="text-decoration: none">Sign in</a>
                        </div>
                        <div class="col-sm-6 text-right mt-2">
                            <button class="btn btn-primar bg-yellow text-white text-center p-signIn">Sign Up</button>
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