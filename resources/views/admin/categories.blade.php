@extends('layouts.app_admin')

@section('content')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" /> 
<div class="card card-cascade narrower categories"> 
    <div class="view gradient-card-header purple-gradient table-name narrower d-flex justify-content-center align-items-center">
        <div class="left-btns">
            <button class="btn btn-outline-white btn-rounded btn-sm px-2 waves-effect waves-light" type="button" data-toggle="modal" data-target="#modalAddEditCategory">
                <i class="fa fa-plus mt-0"></i>
            </button>
            <button class="btn btn-outline-white btn-rounded btn-sm px-2 waves-effect waves-light" type="button" onclick="editSelectedCategory()">
                <i class="fa fa-pencil mt-0"></i>
            </button>
        </div>
        <a class="white-text mx-3 header-txt" href="">{{__('admin_pages.manage_categories')}}</a>
        <div class="right-btns">
            <button class="btn btn-outline-white btn-rounded btn-sm px-2 waves-effect waves-light" type="button" onclick="deleteSelectedCategory()">
                <i class="fa fa-trash mt-0"></i>
            </button>
        </div>
    </div> 
    <div class="table-responsive px-4"> 
        <table class="table table-hover table-responsive mb-0"> 
            <thead>
                <tr>
                    @php
                    if(!isset($_GET['type']) || $_GET['type'] == 'asc'){
                    $type='desc';
                    }else {
                    $type='asc';
                    } 
                    @endphp
                    <th scope="row"><input type="checkbox" id="checkAll"></th>
                    <th class="th-lg">
                        <a href="?order_by=name&type={{$type}}" class="text-secondary">{{__('admin_pages.category_name')}} 
                            @if ($type == 'desc' && isset($_GET['order_by']) && $_GET['order_by'] == 'name')<i class="fa fa-sort-asc ml-1"></i> 
                            @elseif ($type == 'asc' && isset($_GET['order_by']) && $_GET['order_by'] == 'name') <i class="fa fa-sort-desc ml-1"></i>
                            @elseif (!isset($_GET['order_by']) || $_GET['order_by'] != 'name') <i class="fa fa-sort ml-1"></i> @endif
                        </a>
                    </th>
                    <th class="th-lg">
                        <a href="?order_by=parent&type={{$type}}" class="text-secondary">{{__('admin_pages.category_parent')}}
                            @if ($type == 'desc' && isset($_GET['order_by']) && $_GET['order_by'] == 'parent')<i class="fa fa-sort-asc ml-1"></i> 
                            @elseif ($type == 'asc' && isset($_GET['order_by']) && $_GET['order_by'] == 'parent') <i class="fa fa-sort-desc ml-1"></i>
                            @elseif (!isset($_GET['order_by']) || $_GET['order_by'] != 'parent') <i class="fa fa-sort ml-1"></i> @endif
                        </a>
                    </th>
                    <th class="th-lg text-right">
                        <a href='?order_by=position&type={{$type}}' class="text-secondary">{{__('admin_pages.category_position')}}
                            @if ($type == 'desc' && isset($_GET['order_by']) && $_GET['order_by'] == 'position')<i class="fa fa-sort-asc ml-1"></i> 
                            @elseif ($type == 'asc' && isset($_GET['order_by']) && $_GET['order_by'] == 'position') <i class="fa fa-sort-desc ml-1"></i>
                            @elseif (!isset($_GET['order_by']) || $_GET['order_by'] != 'position') <i class="fa fa-sort ml-1"></i> @endif
                        </a>
                    </th> 
                </tr>
            </thead> 
            <tbody>
                @php 
                if(!$categories->isEmpty()) {
                @endphp
                @foreach ($categories as $categ) 
                <tr>
                    <th scope="row">
                        <input type="checkbox" name="category_id[]" value="{{$categ->id}}">
                    </th>
                    <td>{{$categ->name}}</td>
                    <td>{{$categ->parent}}</td>
                    <td class="text-right">{{$categ->position}}</td> 
                </tr> 
                @endforeach
                @php 
                } else {
                @endphp
                <tr>
                    <td colspan="4">{{__('admin_pages.no_categories_found')}}</td>
                </tr>
                @php 
                }
                @endphp
            </tbody>   
        </table>
    </div>
    <hr class="my-0">
    {{ $categories->links() }}
</div> 
<div class="modal fade" id="modalAddEditCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header bg-secondary white-text">
                <h4 class="title"><i class="fa fa-pencil"></i> {{__('admin_pages.add_edit_category')}}</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body mb-0">
                    <div class="md-form available-translations">
                        <span>{{__('admin_pages.choose_locale')}}</span>
                        @foreach ($locales as $locale)
                        <button type="button" data-locale-change="{{$locale}}" class="btn btn-outline-secondary waves-effect locale-change @if ($currentLocale == $locale) active @endif">{{$locale}}</button>
                        @endforeach
                    </div>
                    @foreach ($locales as $locale)
                    @php $lKey = false; if($category !== null && $category['translations'] != null) { $lKey = array_search($locale, array_column($category['translations'], 'locale')); } @endphp
                    <input type="hidden" name="translation_order[]" value="{{$locale}}">
                    <div class="locale-container locale-container-{{$locale}}" @if ($currentLocale == $locale) style="display:block;" @endif>
                         <div class="md-form form-sm">
                            <i class="fa fa-star prefix"></i>
                            <input type="text" id="category_name-{{$locale}}" value="{{ $lKey !== false ? $category['translations'][$lKey]->name : '' }}" name="name[]" class="form-control">
                            <label for="category_name-{{$locale}}">{{__('admin_pages.category_name')}}({{$locale}})</label>
                        </div>
                    </div>
                    @endforeach    
                    <div class="md-form form-sm">
                        <i class="fa fa-undo prefix"></i>
                        <div class="picker-left">
                            <select class="selectpicker" name="parent" id="category_parent" data-style="btn-secondary">
                                <option value="0" selected="">{{__('admin_pages.none_selected')}}</option>
                                @foreach ($allCategories as $aCateg) 
                                <option value="{{$aCateg->id}}">{{$aCateg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="category_parent">{{__('admin_pages.category_parent')}}</label>
                    </div>
                    <div class="md-form form-sm">
                        <i class="fa fa-sort prefix"></i>
                        <input type="text" id="category_position" name="position" value="{{isset($category['category']->position) ? $category['category']->position : '0'}}" class="form-control">
                        <label for="category_position">{{__('admin_pages.category_position')}}</label>
                    </div>
                    <div class="text-center mt-1-half">
                        <button class="btn btn-secondary mb-2">{{__('admin_pages.save')}}</button>
                    </div> 
                </div>
            </form>
        </div> 
    </div>
</div> 
<script src="{{ asset('js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script>
$('.selectpicker').selectpicker();
@php
    if (isset($_GET['edit'])) {
@endphp
    $(document).ready(function(){
        $('#modalAddEditCategory').modal('show');
    });
    $("#modalAddEditCategory").on("hidden.bs.modal", function () {
        window.location.href = "{{ lang_url('admin/categories') }}";
    });
@php
    }
@endphp
</script>
@endsection
