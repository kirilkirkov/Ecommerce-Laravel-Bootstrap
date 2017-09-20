<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>   
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" /> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/css/mdb.min.css" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" /> 
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-2 left-side">
                            <div class="menu-logo">
                                <a href="">
                                    {{__('admin_pages.admin_panel')}}
                                </a>
                            </div>
                            <ul class="nav">
                                <li>
                                    <a href="{{ lang_url('admin') }}" class="btn waves-effect waves-light">
                                        <i class="material-icons">dashboard</i>
                                        <p>{{__('admin_pages.dashboard')}}</p>
                                    </a> 
                                </li>
                                <li>
                                    <a href="{{ lang_url('admin/publish') }}" class="btn waves-effect waves-light">
                                        <i class="material-icons">add_circle_outline</i>
                                        <p>{{__('admin_pages.publish')}}</p>
                                    </a> 
                                </li>
                                <li>
                                    <a href="dashboard.html" class="btn waves-effect waves-light">
                                        <i class="material-icons">list</i>
                                        <p>{{__('admin_pages.products')}}</p>
                                    </a> 
                                </li>
                                <li>
                                    <a href="dashboard.html" class="btn waves-effect waves-light">
                                        <i class="material-icons">shopping_basket</i>
                                        <p>{{__('admin_pages.orders')}}</p>
                                    </a> 
                                </li>
                                <li>
                                    <a href="dashboard.html" class="btn waves-effect waves-light">
                                        <i class="material-icons">group</i>
                                        <p>{{__('admin_pages.users')}}</p>
                                    </a> 
                                </li>
                                <li class="bottom">
                                    <a href="https://github.com/kirilkirkov" target="_blank" class="btn waves-effect waves-light">
                                        <i class="material-icons">code</i>
                                        <p>GET SOURCE</p>
                                    </a> 
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2 right-side">
                            <nav class="navbar">
                                <div class="navbar-header">
                                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                        <i class="fa fa-lg fa-bars"></i>
                                    </button>
                                    <a class="navbar-brand" href="#">{{$page_title_lang}}</a>
                                </div>
                                <div id="navbar" class="collapse navbar-collapse"> 
                                    <ul class="nav navbar-nav navbar-right">
                                        <li>
                                            <a href="#"> 
                                                {{ __('admin_pages.logout') }}
                                            </a>
                                        </li>
                                    </ul>
                                    <form class="navbar-form navbar-right nav-bar-search" role="search">
                                        <div class="form-group is-empty">
                                            <input class="form-control" placeholder="{{ __('admin_pages.search_product') }}" type="text">
                                            <span class="material-input"></span>
                                            <span class="material-input"></span>
                                        </div>
                                        <button class="btn btn-white btn-round" type="submit">
                                            <i class="material-icons">search</i> 
                                        </button>
                                    </form>
                                </div>
                            </nav>
                            <div class="right-side-wrapper">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <footer>
                <div class="row"> 
                    <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
                        <ul class="nav">
                            <li>
                                <a href="">
                                    {{__('admin_pages.dashboard')}}
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    {{__('admin_pages.publish')}}
                                </a>
                            </li>
                            <li class="in-right">
                                <a href="https://github.com/kirilkirkov" target="_blank">
                                    Github <i class="fa fa-github" aria-hidden="true"></i> :: Kiril Kirkov
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
        @if (session('msg'))
        <div class="alert {{ session('result') === true ? "alert-success" : "alert-danger" }} alert-top">  
            @if (is_array(session('msg')))
            {!! implode('<br>',session('msg')) !!}
            @else
            {{session('msg')}}
            @endif
        </div>
        @endif
        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.2/js/mdb.min.js"></script>
        <script src="{{ asset('js/adm_cust.js') }}"></script> 
    </body>
</html>