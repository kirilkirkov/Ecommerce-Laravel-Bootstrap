<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title>{{ config('app.name', 'Laravel') }}</title> 
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    </head>
    <body> 
        <div class="header">
            <div class="container">
                <div class="row top-part">
                    <div class="col-sm-3">
                        <a href="{{ lang_url('/') }}">
                            <img src="https://cdncloudcart.com/6070/logo/1_300x300.png?1488267690" class="img-responsive logo" alt=""> 
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <form class="search" action="" method="GET">
                            <input type="text" class="search-field" value="" placeholder="{{__('public_pages.search')}}">
                            <a href="javascript:void(0);" class="submit-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                        </form>
                    </div>
                    <div class="col-sm-3">
                        <div class="phone-call">
                            <img src="{{ asset('img/phone.png') }}" alt="">
                            <div class="right">
                                <p>{{__('public_pages.phone_order')}}</p>
                                <span>0885 681 058</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="user">
                            <a href="" class="login">
                                {{__('public_pages.login')}}
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-custom">
                <div class="container">
                    <button type="button" class="navbar-toggle collapsed show-right-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <a class="navbar-brand visible-xs" href="#">{{__('public_pages.menu')}}</a>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-center">
                            <li><a href="{{ lang_url('products') }}">{{__('public_pages.products')}}</a></li> 
                            <li><a href="{{ lang_url('bascet') }}">{{__('public_pages.bascet')}}</a></li>
                            <li><a href="{{ lang_url('contacts') }}">{{__('public_pages.contacts')}}</a></li> 
                        </ul>
                        <div class="nav navbar-nav navbar-right">
                            <div class="dropdown">
                                <button class="btn btn-lang dropdown-toggle" type="button" data-toggle="dropdown">
                                    {{ app()->getLocale() }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach(Config::get('app.locales') as $locale)
                                    <li><a href="{{url(getSameUrlInOtherLang($locale))}}">{{$locale}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        @yield('content')
        <footer>
            <div class="social">
                <a href=""><i class="fa fa-2x fa-facebook-official" aria-hidden="true"></i></a>
            </div>
            <div class="pages">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3">
                            <ul>
                                <li class="header">GMMB Solutions</li>
                                <li><a href="">About us</a></li>
                                <li><a href="">Firm info</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-rights">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            Copyright 2017 yourfarma.eu
                        </div>
                        <div class="col-sm-6">
                            При възникване на спор, свързан с покупка онлайн, можете да ползвате сайта ОРС
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="fast-order hidden-xs">
            <div class="inner">
                <h2>{{__('public_pages.fast_order')}}</h2>
                <form method="POST" id="go-fast-order" action="{{ lang_url('fast-order') }}">
                    <div class="form-group">
                        <label for="phone-user">{{__('public_pages.phone')}}</label>
                        <input type="text" class="form-control" placeholder="0888 888 888" id="phone-user">
                        <span class="error"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                    </div>
                    <div class="form-group">
                        <label for="names-user">{{__('public_pages.names')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('public_pages.name_and_family')}}" id="names-user">
                        <span class="error"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                    </div>
                    <p>{{__('public_pages.we_will_contact_u')}}</p>
                    <a href="javascript:void(0);" class="submit">
                        {{__('public_pages.fast_order')}}
                    </a>
                </form>
                <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
        </div>
        <a class="fast-order-btn visible-xs">
            {{__('public_pages.fast_order')}}
        </a>
        <div class="backdrop"></div>
        <div class="right-menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
            <a href="javascript:void(0);" class="close-xs-menu">{{__('public_pages.close_xs_menu')}}</a>
        </div> 
        <!-- Modal After buy now button -->
        <div class="modal fade" id="modalBuyBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h4>{{__('public_pages.success_add_to_cart')}}</h4>
                        <a href="{{lang_url('checkout')}}" class="go-buy">{{__('public_pages.go_buy')}}</a>
                        <hr>
                        <div class="continue-shopping">
                            <a href="javascript:void(0);" data-dismiss="modal">
                                {{__('public_pages.continue_shopping')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/jquery-ui-1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/public.js') }}" type="text/javascript"></script>
    </body>
</html>
