@extends('layouts.app_public')

@section('content')
<div class="products-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 section-title">
                <h2>{{__('public_pages.all_products')}}</h2>
            </div>
            @foreach ($products as $product)
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="product">
                    <div class="img-container">
                        <a href="{{ lang_url($product->url) }}">
                            <img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}">
                        </a>
                    </div>
                    <a href="{{ lang_url($product->url) }}">
                        <h1>{{$product->name}}</h1>
                    </a>
                    <span class="price">{{$product->price}}</span>
                    @php
                    if($product->link_to != null) {
                    @endphp
                    <a href="{{lang_url($product->url)}}" class="buy-now">{{__('public_pages.buy')}}</a>
                    @php
                    } else {
                    @endphp
                    <a href="javascript:void(0);" data-product-id="{{$product->id}}" class="buy-now to-cart">{{__('public_pages.buy')}}</a>
                    @php
                    }
                    @endphp
                </div>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</div>
@endsection
