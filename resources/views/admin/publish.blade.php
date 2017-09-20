@extends('layouts.app_admin')

@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
<link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet">
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="" method="POST" enctype="multipart/form-data"> 
            {{ csrf_field() }}
            <div class="card">
                <div class="card-body"> 
                    <div class="form-header btn-secondary">
                        <h3>
                            {{__('admin_pages.publish_your_products')}}
                        </h3>
                    </div>
                    <div class="md-form available-translations">
                        <span>{{__('admin_pages.choose_locale')}}</span>
                        @foreach ($locales as $locale)
                        <button type="button" data-locale-change="{{$locale}}" class="btn btn-outline-secondary waves-effect locale-change @if ($currentLocale == $locale) active @endif">{{$locale}}</button>
                        @endforeach
                    </div>
                    <hr>
                    @foreach ($locales as $locale)
                    <input type="hidden" name="translation_order[]" value="{{$locale}}">
                    <div class="locale-container locale-container-{{$locale}}" @if ($currentLocale == $locale) style="display:block;" @endif>
                         <div class="md-form">
                            <i class="fa fa-font prefix grey-text"></i>
                            <input type="text" name="name[]" id="publishForm-name-{{$locale}}" class="form-control">
                            <label for="publishForm-name-{{$locale}}">{{__('admin_pages.product_name')}}({{$locale}})</label>
                        </div>  
                        <div class="md-form">
                            <i class="fa fa-pencil prefix grey-text"></i>
                            <textarea name="description[]" type="text" id="productDescr-{{$locale}}" class="md-textarea"></textarea>
                            <label for="productDescr-{{$locale}}">{{__('admin_pages.product_description')}}({{$locale}})</label>
                        </div>
                    </div>
                    @endforeach
                    <div class="md-form">
                        <i class="fa fa-sort-numeric-desc prefix grey-text"></i>
                        <input type="text" name="quantity" id="publishForm-name" class="form-control">
                        <label for="publishForm-name">{{__('admin_pages.quantity')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-sort prefix grey-text"></i>
                        <input type="text" name="order_position" id="publishForm-name" class="form-control">
                        <label for="publishForm-name">{{__('admin_pages.order_position')}}</label>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.choose_category')}}</label>
                        <div class="element-label-text bordered-div">
                            <select class="selectpicker" name="category_id" data-style="btn-secondary">
                                <option value="4" selected="">Mustard</option>
                                <option>Ketchup</option>
                                <option>Barbecue</option>
                            </select>
                        </div>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.hidden_product')}}</label>
                        <div class="element-label-text bordered-div">
                            <input type="checkbox" class="switch-me" data-on-color="secondary" name="hidden"> 
                        </div>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.vip_product')}}</label>
                        <div class="element-label-text bordered-div">
                            <input type="checkbox" class="switch-me" data-on-color="secondary" name="vip"> 
                        </div>
                    </div>
                    <div class="md-form clone-file-upload">
                        <label class="alone">{{__('admin_pages.cover_image')}}</label>
                        <div class="element-label-text">
                            <div class="upload-wrap">
                                <button type="button" class="btn btn-secondary btn-upload-design">{{__('admin_pages.choose_file')}}</button>
                                <input type="file" name="cover_image" id="cover-upload" class="upload-btn">
                                <div class="file-name"></div>
                            </div>
                        </div>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.gallery_images')}}</label>
                        <div class="element-label-text">
                            <button type="button" class="btn btn-secondary" onclick="showMeNewImgUpload()"><i class="fa fa-plus" aria-hidden="true"></i> {{__('admin_pages.add_gallery_image')}}</button>
                        </div>
                    </div>
                    <div class="clones"></div>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-secondary waves-effect waves-light">{{__('admin_pages.save')}}</button>
                    </div> 
                </div>   
            </div> 
        </form>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="{{ asset('js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script>
$('.selectpicker').selectpicker();
$('.switch-me').bootstrapSwitch();
document.getElementById('cover-upload').onchange = function () {
    $('.upload-wrap .file-name').show().append(this.value);
};
function showMeNewImgUpload() {
$('.clones').append('<div><input type="file" name="gallery_image[]" multiple></div>');
}
</script>
@endsection
