@extends('layouts.app_admin')

@section('content')
<div class="row">
    @php
    if(!$products->isEmpty()) {
    @endphp
    @foreach ($products as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card card-cascade narrower hm-zoom">
            <div class="view overlay hm-white-slight">
                <img src="{{asset('storage/'.$product->image)}}" class="img-fluid" alt="{{__('admin_pages.no_choosed_image')}}">
                <a>
                    <div class="mask"></div>
                </a>
            </div>
            <div class="card-body text-center no-padding">
                <h4 class="card-title"><strong><a href="">{{$product->name}}</a></strong></h4>
                <p class="card-text">
                    {{strip_tags($product->description)}}
                </p>
                <div class="card-footer">
                    <div class="text-center price">{{$product->price}}</div>
                    <span class="right">
                        <a href="{{ lang_url('admin/edit/pruduct/'.$product->id) }}" class="btn btn-secondary btn-sm">
                            {{__('admin_pages.edit')}}
                        </a>
                        <a href="{{ lang_url('admin/delete/product/'.$product->id) }}" data-my-message="{{__('admin_pages.are_u_sure_delete')}}" class="btn btn-secondary btn-sm confirm">
                            {{__('admin_pages.delete')}}
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @php
    } else {
    @endphp
    <div class="col-xs-12">
        <div class="alert alert-success">{{__('admin_pages.no_product_results')}}</div>
    </div>
    @php
    }
    @endphp
</div>
{{ $products->links() }}
@endsection