@extends('layouts.app_public')

@section('content')
<div class="product-preview">
    <div class="container">
        <div class="row first-part">
            <div class="col-sm-6">
                <div class="product-title visible-xs">
                    <h1>{{$product->name}}</h1>
                </div>
                <img src="{{asset('storage/'.$product->image)}}" alt="" class="img-responsive img-thumbnail">
            </div>
            <div class="col-sm-6">
                <div class="product-title hidden-xs">
                    <h1>{{$product->name}}</h1>
                </div>
                <div class="category">
                    <span>{{__('public_pages.category_name')}}</span>
                    <a href="{{$product->category_id}}">{{$product->category_name}}</a>
                </div>
                <div class="price">
                    <span class="detail">{{$product->price}}</span>
                    @if ($product->quantity > 0)
                    <span class="label label-success">{{__('public_pages.in_stock')}}</span>
                    @else
                    <span class="label label-danger">{{__('public_pages.out_of_stock')}}</span>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="buy">
                    <div class="quantity">
                        <span>{{__('public_pages.quantity')}}</span>
                        <input type="text" class="field" name="quantity" value="1">
                    </div>
                    <a href="javascript:void(0);" data-product-id="{{$product->id}}" class="buy-now">
                        {{__('public_pages.buy')}}
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h3>{{__('public_pages.details')}}</h3>
                <div class="details">
                    {{$product->description}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
