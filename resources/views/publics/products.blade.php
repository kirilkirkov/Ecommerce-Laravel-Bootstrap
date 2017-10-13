@extends('layouts.app_public')

@section('content')
<div class="products-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="categories">
                    <h2>{{__('public_pages.categories')}}</h2>
                    @php 
                    function loop_tree($treeArr, $is_recursion = false, $selectedCategory)
                    { 
                    @endphp
                    <ul class="{{$is_recursion === true ? 'children' : 'parent' }}">
                        @php
                        foreach ($treeArr as $tree) {
                        $children = false;
                        if (isset($tree->children) && !empty($tree->children)) {
                        $children = true;
                        }
                        @endphp
                        <li class="{{ isset($selectedCategory) && $selectedCategory == $tree->url ? 'active' : ''}}"> 
                            <a href="{{ lang_url('category/'.$tree->url) }}">
                                {{$tree->name}}
                            </a>
                            @php if ($children === true) {
                            @endphp
                            <span>
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </span>
                            @php }
                            if ($children === true) {
                            loop_tree($tree->children, true, $selectedCategory);
                            } else {
                            @endphp
                        </li>
                        @php
                        }
                        }
                        @endphp
                    </ul>
                    @php
                    if ($is_recursion === true) {
                    @endphp
                    </li>
                    @php
                    }
                    }
                    @endphp
                    @php
                    loop_tree($categories, false, $selectedCategory);
                    @endphp
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-xs-12 section-title">
                        <h2>{{__('public_pages.all_products')}}</h2>
                    </div>
                    @php
                    if(!$products->isEmpty()) {
                    @endphp
                    @foreach ($products as $product)
                    <div class="col-xs-6 col-md-4">
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
                    @php
                    } else {
                    @endphp 
                    <div class="col-xs-12">
                        <div class="alert alert-danger">{{__('public_pages.no_products')}}</div>
                    </div>
                    @php
                    }
                    @endphp
                    {{ $products->links() }}
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection