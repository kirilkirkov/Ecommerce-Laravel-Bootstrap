@extends('layouts.app_admin')

@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
<link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet">
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form>
            <div class="card">
                <div class="card-body"> 
                    <div class="form-header btn-secondary">
                        <h3>
                            {{__('admin_pages.publish_your_products')}}
                        </h3>
                    </div> 
                    <div class="md-form">
                        <i class="fa fa-font prefix grey-text"></i>
                        <input type="text" id="publishForm-name" class="form-control">
                        <label for="publishForm-name">{{__('admin_pages.product_name')}}</label>
                    </div> 
                    <div class="md-form">
                        <i class="fa fa-pencil prefix grey-text"></i>
                        <textarea type="text" id="form8" class="md-textarea"></textarea>
                        <label for="form8">{{__('admin_pages.product_description')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-sort-numeric-desc prefix grey-text"></i>
                        <input type="text" id="publishForm-name" class="form-control">
                        <label for="publishForm-name">{{__('admin_pages.quantity')}}</label>
                    </div>
                    <div class="md-form">
                        <i class="fa fa-sort prefix grey-text"></i>
                        <input type="text" id="publishForm-name" class="form-control">
                        <label for="publishForm-name">{{__('admin_pages.order_position')}}</label>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.choose_category')}}</label>
                        <div class="element-label-text bordered-div">
                            <select class="selectpicker" data-style="btn-secondary">
                                <option>Mustard</option>
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
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.image')}}</label>
                        <div class="element-label-text">
                            <div class="upload-wrap">
                                <button type="button" class="btn btn-secondary btn-upload-design">{{__('admin_pages.choose_file')}}</button>
                                <input type="file" name="file_to_up" id="file-upload" class="upload-btn">
                                <div class="file-name"></div>
                            </div>
                        </div>
                    </div>
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
document.getElementById("file-upload").onchange = function () { 
    $('.upload-wrap .file-name').show().append(this.value);
};
</script>
@endsection
