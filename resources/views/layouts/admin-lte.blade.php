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
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--custom css here -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div id="app" class="wrapper">

    <header_main
            app-name="{{config('app.name', 'Laravel')}}"
            user-avatar-src="{{asset('images/usr/boxed-bg.jpg')}}"
            user-name="Alexander"
            user-surname="Pierce"
            csrf-token="{{csrf_token()}}"
            logout-action="{{ route('logout') }}"
    ></header_main>

    <!-- =============================================== -->

    <left_column
            img-src="{{asset('images/usr/boxed-bg.jpg')}}"
            user-name="Alexander"
            user-surname="Pierce"
    ></left_column>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pace page
                <small>Loading example</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Pace page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Title</h3>
                </div>
                <div class="box-body">
                    Pace loading works automatically on page. You can still implement it with ajax requests by adding
                    this js:
                    <br/><code>$(document).ajaxStart(function() { Pace.restart(); });</code>
                    <br/>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                                <i class="fa fa-spin fa-refresh"></i>&nbsp; Get External Content
                            </button>
                        </div>
                    </div>
                    <div class="ajax-content">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer_main></footer_main>

</div>
<!-- ./wrapper -->
<!-- custom js here -->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>
