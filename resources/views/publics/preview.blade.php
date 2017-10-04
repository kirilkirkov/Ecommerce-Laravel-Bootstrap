@extends('layouts.app_public')

@section('content')
<div class="product-preview">
    <div class="container">
        <div class="row">
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
                <a href="{{$product->category_id}}">{{$product->category_name}}</a>
            </div>
        </div>
    </div>
</div>
@endsection
