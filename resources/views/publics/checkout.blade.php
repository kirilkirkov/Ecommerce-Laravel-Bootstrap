@extends('layouts.app_public')

@section('content')
<div class="checkout-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title">
                    <h2>{{__('public_pages.payment_type')}}</h2>
                </div>
                <div class="payment-types">
                    <div class="box-type active" data-radio-val="cash_on_delivery">
                        <img src="{{ asset('img/cash_on_deliv.png') }}" alt="econt" class="img-responsive">
                        <span>{{__('public_pages.cash_on_delivery')}}</span>
                    </div>
                </div>
                <div class="section-title">
                    <h2>{{__('public_pages.delivery_address')}}</h2>
                </div>
                <div id="errors" class="alert alert-danger"></div>
                <form method="POST" action="{{lang_url('checkout')}}" id="set-order"> 
                    {{ csrf_field() }}
                    <div class="radios">
                        <input type="radio" checked="" name="payment_type" value="cash_on_delivery">
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input class="form-control" name="first_name" value="" type="text" placeholder="{{__('public_pages.name')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" name="last_name" value="" type="text" placeholder="{{__('public_pages.family')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" name="email" value="" type="text" placeholder="{{__('public_pages.email_address')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" name="phone" value="" type="text" placeholder="{{__('public_pages.phone')}}">
                        </div>
                        <div class="form-group col-sm-12">
                            <textarea name="address" placeholder="{{__('public_pages.address')}}" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" name="city" value="" type="text" placeholder="{{__('public_pages.city')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <input class="form-control" name="post_code" value="" type="text" placeholder="{{__('public_pages.post_code')}}">
                        </div>
                        <div class="form-group col-sm-12">
                            <textarea class="form-control" placeholder="{{__('public_pages.notes')}}" name="notes" rows="3"></textarea>
                        </div>
                    </div>
                    @php
                    $sum = $sum_total = 0;
                    if(!empty($cartProducts)) {
                    $sum = 0;
                    @endphp
                    <div class="products-for-checkout">
                        <ul>
                            @foreach($cartProducts as $cartProduct)
                            @php
                            $sum_total += $cartProduct->num_added * (float)$cartProduct->price;
                            $sum = $cartProduct->num_added * (float)$cartProduct->price;
                            @endphp
                            <li>
                                <input name="id[]" value="{{$cartProduct->id}}" type="hidden">
                                <input name="quantity[]" value="{{$cartProduct->num_added}}" type="hidden">
                                <a href="{{lang_url($cartProduct->url)}}" class="link">                                        
                                    <img src="{{asset('storage/'.$cartProduct->image)}}" alt="">
                                    <div class="info">
                                        <span class="name">{{$cartProduct->name}}</span>
                                        <span class="price">
                                            {{$cartProduct->num_added}} x {{$cartProduct->price}} = {{$sum}}
                                        </span> 
                                    </div>
                                </a>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" onclick="removeQuantity({{$cartProduct->id}})" class="btn btn-default">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>
                                        <input type="text" name="quant" disabled="" class="form-control" value="{{$cartProduct->num_added}}">
                                        <span class="input-group-btn">
                                            <button type="button" onclick="addProduct({{$cartProduct->id}})" class="btn btn-default">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="removeProduct" onclick="removeProduct({{$cartProduct->id}})">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <div class="clearfix"></div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="final-total">{{__('public_pages.sum_for_pay')}} {{$sum_total}}</div>
                    </div>
                    <a href="javascript:void(0);" onclick="completeOrder()" class="green-btn">{{__('public_pages.complete_order')}}</a>
                    @php
                    } else {
                    @endphp 
                    <a href="{{lang_url('products')}}" class="green-btn">{{__('public_pages.first_need_add_products')}}</a>
                    @php 
                    }
                    @endphp
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
