@extends('layouts.app_public')

@section('content')
<div class="product-preview">
    <div class="container">
        <div class="row first-part">
            <div class="col-sm-6">
                <div class="product-title visible-xs">
                    <h1>{{$product->name}}</h1>
                </div>
                <div id="inner-slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}" data-num="0" class="img-responsive img-thumbnail" alt="{{$product->name}}">
                        </div>
                        @php
                        if (!empty($gallery)) {
                            $i = 1;
                            foreach ($gallery as $image) {
                                @endphp
                                <div class="item">
                                    <img src="{{$image}}"  data-num="{{$i}}" class="img-responsive img-thumbnail" alt="{{$product->name}}">
                                </div>
                                @php
                                $i++;
                            }
                        }
                        @endphp
                    </div>
                    <div class="controls">
                        <a class="left carousel-control" href="#inner-slider" role="button" data-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </a>
                        <a class="right carousel-control" href="#inner-slider" role="button" data-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="row hidden-xs">
                    <div class="col-xs-4 col-sm-6 col-md-4 text-center">
                        <a data-target="#inner-slider" class="active" data-slide-to="0" href="javascript:void(0)">
                            <img src="{{asset('storage/'.$product->image)}}" class="img-thumbnail" alt="">
                        </a>
                    </div>
                    @php
                    if (!empty($gallery)) {
                        $i = 1;
                        foreach ($gallery as $image) {
                            @endphp
                            <div class="col-xs-4 col-sm-6 col-md-4 text-center">
                                <a data-target="#inner-slider" data-slide-to="{{$i}}" href="javascript:void(0)">
                                    <img src="{{$image}}" class="img-thumbnail" alt="">
                                </a>
                            </div>
                            @php
                            $i++;
                        }
                    }
                    @endphp
                </div>
            </div>
            <div class="col-sm-6">
                <div class="product-title hidden-xs">
                    <h1>{{$product->name}}</h1>
                </div>
                <div class="category">
                    <span>{{__('public_pages.category_name')}}</span>
                    <a href="{{ lang_url('category/'.$product->category_url) }}" title="{{__('public_pages.category_name')}} {{$product->category_name}}">{{$product->category_name}}</a>
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
                    @php
                    if($product->link_to != null) {
                    @endphp
                    <a href="{{ $product->link_to }}" class="buy-now">{{__('public_pages.buy')}}</a>
                    @php
                    } else {
                    @endphp 
                    <a href="javascript:void(0);" data-product-id="{{$product->id}}" class="buy-now to-cart">
                        {{__('public_pages.buy')}}
                    </a>
                    @php
                    }
                    @endphp
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
