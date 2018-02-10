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
     user-email="{{auth()->user()->email}}"
     user-name="{{auth()->user()->name_first()}}"
     user-surname="{{auth()->user()->name_last()}}"
     user-member="{{auth()->user()->member()}}"
     user-post="{{auth()->user()->post()}}"
     user-id="{{auth()->user()->id}}"
     user-notices="{{auth()->user()->notifications}}"
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
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

@role('employee')
    <script type="text/javascript" src="{{asset('js/app_employee.js')}}"></script>
@else
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
@endrole

</body>
</html>
