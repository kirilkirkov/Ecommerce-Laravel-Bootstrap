<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{__('admin_pages.login_form')}}</title>   
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" /> 
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/adminCustom.css') }}" rel="stylesheet" /> 
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" />
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons" rel="stylesheet" type="text/css" />
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    </head>
    <body>
        @yield('content')
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/bootbox.min.js') }}"></script>
        <script src="{{ asset('js/mdb.min.js') }}"></script>
        <script src="{{ asset('js/placeholders.min.js') }}"></script>
    </body>
</html>