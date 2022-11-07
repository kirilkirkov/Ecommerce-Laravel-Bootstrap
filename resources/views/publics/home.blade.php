@extends('layouts.app_public')

@section('content')

<div class="home-page">

    @if(count($carousel))
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @php
                $i=0;
                @endphp
                @foreach($carousel as $slide)
                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="{{ $i == 0 ? 'active' : ''}}"></li>
                @php
                $i++;
                @endphp
                @endforeach
            </ol>
            <div class="carousel-inner">
                @php
                $i=0;
                @endphp
                @foreach($carousel as $slide)
                <div class="item {{ $i == 0 ? 'active' : ''}}">
                    <a href="{{$slide->link}}">
                        <img src="{{asset('storage/'.$slide->image)}}" alt="">
                    </a>
                </div>
                @php
                $i++;
                @endphp
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
        </div>
    @endif

    <div class="container">

        @if(is_array($carousel) && count($carousel))
            <div class="row promo">
                <div class="col-xs-12 section-title">
                    <h2>{{__('public_pages.promo_products')}}</h2>
                </div>
                @foreach ($promoProducts as $promoProduct)
                <div class="col-xs-6 col-sm-4 col-md-3 product-container">
                    <div class="product">
                        <div class="img-container">
                            <a href="{{ lang_url($promoProduct->url) }}">
                                <img src="{{asset('storage/'.$promoProduct->image)}}" alt="{{$promoProduct->name}}">
                            </a>
                        </div>
                        <a href="{{ lang_url($promoProduct->url) }}">
                            <h1>{{$promoProduct->name}}</h1>
                        </a>
                        <span class="price">{{$promoProduct->price}}</span>
                        @php
                        if($promoProduct->link_to != null) {
                        @endphp
                            <a href="{{lang_url($promoProduct->url)}}" class="buy-now" title="{{$promoProduct->name}}">{{__('public_pages.buy')}}</a>
                        @php
                        } else {
                        @endphp
                            <a href="javascript:void(0);" data-product-id="{{$promoProduct->id}}" class="buy-now to-cart">{{__('public_pages.buy')}}</a>
                        @php
                        }
                        @endphp
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <div class="row {{ !count($carousel) ? "mt-4" : "" }}">
            <div class="col-xs-12 section-title">
                <h2>{{__('public_pages.most_selled')}}</h2>
            </div>
            @foreach ($mostSelledProducts as $mostSelledProduct)
            <div class="col-xs-6 col-sm-4 col-md-3 product-container">
                <div class="product">
                    <div class="img-container">
                        <a href="{{ lang_url($mostSelledProduct->url) }}">
                            <img src="{{asset('storage/'.$mostSelledProduct->image)}}" alt="{{$mostSelledProduct->name}}">
                        </a>
                    </div>
                    <a href="{{ lang_url($mostSelledProduct->url) }}">
                        <h1>{{$mostSelledProduct->name}}</h1>
                    </a>
                    <span class="price">{{$mostSelledProduct->price}}</span>
                    @php
                    if($mostSelledProduct->link_to != null) {
                    @endphp
                    <a href="{{lang_url($mostSelledProduct->url)}}" class="buy-now" title="{{$mostSelledProduct->name}}">{{__('public_pages.buy')}}</a>
                    @php
                    } else {
                    @endphp
                    <a href="javascript:void(0);" data-product-id="{{$mostSelledProduct->id}}" class="buy-now to-cart">{{__('public_pages.buy')}}</a>
                    @php
                    }
                    @endphp
                </div>
            </div>
            @endforeach

            @if(!count($carousel))
                {{__('public_pages.no_products')}}
            @endif
        </div>
    </div>
</div>
@endsection