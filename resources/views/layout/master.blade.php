<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ $title }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/material-dashboard.css?v=1.2.1') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/demo.css" rel="stylesheet') }}" />

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @stack('css');
</head>

<body>
    <div class="wrapper">
        @include('layout.sidebar')
        <div class="main-panel">
            @include('layout.header')
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        @if (session()->has('success'))
                            <h3 class="alert alert-success">{{ session()->get('success') }}</h3>
                        @endif
                    </div>
                    @yield('content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('/assets/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>


@stack('js');

</html>
