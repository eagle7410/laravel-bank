@extends('layouts.admin-lte')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard

                </div>
                <div class="panel-body">
                    @if (session('action'))
                        <div class="alert alert-success">
                            {{ session('action') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
