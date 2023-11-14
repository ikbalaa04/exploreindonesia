<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Dashboard Indecon">
    <meta name="keywords" content="admin,dashboard,Indecon,borneo,kalimantan,travel">
    <meta name="author" content="mrh">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/web/img/favicons/mstile-150x150.png') }}">
    <meta name="description" content="Indecon, the best adventure in the world">
    <meta name="keywords" content="travel,adventure,experience,indecon">
    <meta name="author" content="Developer Indecon">
    <meta name="theme-color" content="#FFAD0D">
    <meta name="google-site-verification" content="C3RdiBjJ2jFaQ7Vqr2Yx2Zpa_4xnazahM4GDm30_pCc" />
    @stack('share')

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Indecon - @yield('title')</title>

    <!-- Styles -->
    @stack('before-style')
    @include('web.includes.style')
    @stack('after-style')

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <!-- Styles -->
        @include('web.includes.navbar')


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        @yield('banner')
        <!-- <section> close ============================-->
        <!-- ============================================-->

        <!-- content -->
        @yield('content')





    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    @include('web.includes.footer')
    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    @stack('before-script')
    @include('web.includes.script')
    @stack('after-script')
  </body>

</html>
