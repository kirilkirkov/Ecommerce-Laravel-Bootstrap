@extends('layouts.app_public')

@section('content')
<div class="home-page">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active">
                <a href="">
                    <img src="{{asset('storage/carousel/slider222b.jpg')}}" alt="Los Angeles">
                </a>
            </div>
            <div class="item">
                <a href="">
                    <img src="{{asset('storage/carousel/slider333b.jpg')}}" alt="Chicago">
                </a>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <div class="row promo">
            <div class="col-xs-12 products-title">
                <h2>{{__('public_pages.promo_products')}}</h2>
            </div>
            @foreach ($promoProducts as $promoProduct)
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="product">
                    <div class="img-container">
                        <a href="{{ lang_url($promoProduct->url) }}" class="buy-product">
                            <img src="{{asset('storage/'.$promoProduct->image)}}" alt="{{$promoProduct->name}}">
                        </a>
                    </div>
                    <a href="{{ lang_url($promoProduct->url) }}" class="buy-product">
                        <h1>{{$promoProduct->name}}</h1>
                    </a>
                    <span class="price">{{$promoProduct->price}}</span>
                    <a href="javascript:void(0);" class="buy-product buy-now">{{__('public_pages.buy')}}</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12 products-title">
                <h2>{{__('public_pages.most_selled')}}</h2>
            </div>
            @foreach ($mostSelledProducts as $mostSelledProduct)
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="product">
                    <div class="img-container">
                        <a href="" class="buy-product">
                            <img src="{{asset('storage/'.$mostSelledProduct->image)}}" alt="{{$mostSelledProduct->name}}">
                        </a>
                    </div>
                    <a href="" class="buy-product">
                        <h1>{{$mostSelledProduct->name}}</h1>
                    </a>
                    <span class="price">{{$mostSelledProduct->price}}</span>
                    <a href="" class="buy-product buy-now">{{__('public_pages.buy')}}</a>
                </div>
            </div>
            @endforeach
        </div> 
    </div>
</div>
@endsection
