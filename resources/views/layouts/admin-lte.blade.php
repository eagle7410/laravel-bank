<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--custom css here -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div id="app" class="wrapper"
     app-name="{{config('app.name', 'Laravel')}}"
     user-avatar-src="{{asset('images/usr/boxed-bg.jpg')}}"
     user-name="Alexander"
     user-surname="Pierce"
     csrf-token="{{csrf_token()}}"
     logout-action="{{ route('logout') }}"
>

    <header_main></header_main>

    <left_column></left_column>

    <div class="content-wrapper">
        <content_header></content_header>

        <section class="content">
            <router-view></router-view>
        </section>
    </div>

    <footer_main></footer_main>

</div>

<!-- custom js here -->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>
