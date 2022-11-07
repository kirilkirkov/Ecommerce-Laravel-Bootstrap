@extends('layouts.app_admin')

@section('content')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="folder" value="{{isset($product['product']->folder) ? $product['product']->folder : '0'}}">
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
                    @php $lKey = false; if($product !== null && $product['translations'] != null) { $lKey = array_search($locale, array_column($product['translations'], 'locale')); } @endphp
                    <input type="hidden" name="translation_order[]" value="{{$locale}}">
                    <div class="locale-container locale-container-{{$locale}}" @if ($currentLocale==$locale) style="display:block;" @endif>
                        <div class="md-form">
                            <i class="fa fa-font prefix grey-text"></i>
                            <input type="text" name="name[]" value="{{ $lKey !== false ? $product['translations'][$lKey]->name : '' }}" id="publishForm-name-{{$locale}}" class="form-control">
                            <label for="publishForm-name-{{$locale}}">{{__('admin_pages.product_name')}}({{$locale}})</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-pencil prefix grey-text"></i>
                            <textarea name="description[]" type="text" id="productDescr-{{$locale}}" class="md-textarea">{{ $lKey != false ? $product['translations'][$lKey]->description : '' }}</textarea>
                            <label for="productDescr-{{$locale}}">{{__('admin_pages.product_description')}}({{$locale}})</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-eur prefix grey-text"></i>
                            <input type="text" name="price[]" value="{{ $lKey !== false ? $product['translations'][$lKey]->price : '' }}" id="publishForm-price-{{$locale}}" class="form-control">
                            <label for="publishForm-price-{{$locale}}">{{__('admin_pages.product_price')}}({{$locale}})</label>
                        </div>
                    </div>
                    @endforeach
                    <div class="md-form">
                        <i class="fa fa-sort-numeric-desc prefix grey-text"></i>
                        <input type="text" name="quantity" value="{{isset($product['product']->quantity) ? $product['product']->quantity : ''}}" id="publishForm-quantity" class="form-control">
                        <label for="publishForm-quantity">{{__('admin_pages.quantity')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-sort prefix grey-text"></i>
                        <input type="text" name="order_position" value="{{isset($product['product']->order_position) ? $product['product']->order_position : ''}}" id="publishForm-position" class="form-control">
                        <label for="publishForm-position">{{__('admin_pages.order_position')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-link prefix grey-text"></i>
                        <input type="text" name="link_to" value="{{isset($product['product']->link_to) ? $product['product']->link_to : ''}}" id="publishForm-linkto" class="form-control">
                        <label for="publishForm-linkto">{{__('admin_pages.link_to')}}</label>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.choose_category')}}</label>
                        <div class="element-label-text bordered-div">
                            <select class="selectpicker" name="category_id" data-style="btn-secondary">
                                @foreach ($allCategories as $aCateg)
                                <option value="{{$aCateg->id}}" {{isset($product['product']->category_id) && $product['product']->category_id == $aCateg->id ? 'selected' : ''}}>{{$aCateg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.hidden_product')}}</label>
                        <div class="element-label-text bordered-div">
                            <input type="checkbox" class="switch-me" {{isset($product['product']->hidden) && $product['product']->hidden == 1 ? 'checked="checked"' : ''}} data-on-color="secondary" name="hidden">
                        </div>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.tags_product')}}</label>
                        <div class="element-label-text bordered-div">
                            <input type="text" data-role="tagsinput" value="{{isset($product['product']->tags) ? $product['product']->tags : ''}}" name="tags" class="form-control input-tags">
                        </div>
                    </div>
                    @php
                    if(isset($product['product']->image)) {
                    @endphp
                    <input type="hidden" value="{{$product['product']->image}}" name="old_image">
                    <div class="md-form">
                        <img src="{{asset('storage/'.$product['product']->image)}}" alt="{{__('admin_pages.no_choosed_image')}}" style="max-height: 300px;" class="img-thumbnail">
                    </div>
                    @php
                    }
                    @endphp
                    <div class="md-form clone-file-upload">
                        <label class="alone">{{__('admin_pages.cover_image')}}</label>
                        <div class="element-label-text">
                            <div class="upload-wrap">
                                <button type="button" class="btn btn-secondary">{{isset($product['product']->image) ? __('admin_pages.choose_new_cover_img') : __('admin_pages.choose_cover_img')}}</button>
                                <input type="file" name="cover_image" id="cover-upload" class="upload-btn">
                                <div class="file-name"></div>
                            </div>
                        </div>
                    </div>
                    @php
                    if(isset($product['product']->folder)) {
                    @endphp
                    <div class="md-form">
                        <div class="gallery-images">
                            @php
                            $dir = '../storage/app/public/moreImagesFolders/'.$product['product']->folder.'/';
                            if (is_dir($dir)) {
                            if ($dh = opendir($dir)) {
                            $i = 0;
                            while (($file = readdir($dh)) !== false) {
                            if (is_file($dir . $file)) {
                            @endphp
                            <div id="image-container-{{$i}}">
                                <img src="{{asset('storage/moreImagesFolders/'.$product['product']->folder.'/'.$file)}}" alt="{{__('admin_pages.no_choosed_image')}}" style="max-height: 300px;" class="img-thumbnail">
                                <a href="javascript:void(0);" onclick="removeGalleryImage('{{$product['product']->folder.'/'.$file}}', {{$i}})"><i class="material-icons">delete</i></a>
                            </div>
                            @php
                            $i++;
                            }
                            }
                            closedir($dh);
                            }
                            }
                            @endphp
                        </div>
                    </div>
                    @php
                    }
                    @endphp
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
<script src="{{ asset('js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
<script>
    $('.selectpicker').selectpicker();
    $('.switch-me').bootstrapSwitch();
    document.getElementById('cover-upload').onchange = function() {
        $('.upload-wrap .file-name').show().append(this.value);
    };

    function showMeNewImgUpload() {
        $('.clones').append('<div><input type="file" name="gallery_image[]" multiple></div>');
    }
    $('.input-tags').tagsinput({
        tagClass: function() {
            return 'label label-secondary';
        }
    });
</script>
@endsection