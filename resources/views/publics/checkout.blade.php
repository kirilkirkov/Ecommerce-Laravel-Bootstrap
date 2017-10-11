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
                    <div class="box-type" data-radio-val="econt">
                        <img src="{{ asset('img/cash_on_deliv.png') }}" alt="econt" class="img-responsive">
                        <span>{{__('public_pages.cash_on_delivery')}}</span>
                    </div>
                    <div class="radios">
                        <input type="radio" name="payment_type" value="cash_on_delivery">
                    </div>
                </div>
                <div class="section-title">
                    <h2>{{__('public_pages.delivery_address')}}</h2>
                </div>
                <div id="errors" class="alert alert-danger"></div>
                <form method="POST" id="set-order">
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
                    <a href="javascript:void(0);" onclick="completeOrder()" class="green-btn">{{__('public_pages.complete_order')}}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
