<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Name Company</title>
</head>
<body>
    <div id="body" class="page-content container">
        <div class="page-header text-blue-d2">
            <h3 class="page-title text-secondary-d1">
                Reset Password akun anda di Name Company, {{ $data['email'] }}
            </h3>
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <img src="{{ asset('assets/cms/images/noImage.jpg') }}" alt="" width="200px">

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <div class="mt-4" style="margin-top: 30px">
                        <div>
                            <div class="text-secondary-d1 text-105" style="margin-bottom: 10px; margin-left:14px">Silahkan klik link dibawah ini untuk segera mereset password anda, <br> jika ini bukan anda silahkan lakukan perubahan password di menu profile pada akun anda</div>
                            <br>
                            <div style="margin:10px">
                                <a href="{{ $data['url'] }}" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0" style="text-decoration:none;background:#16c651;color:white;padding:10px;border-radius:5px">Reset Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>