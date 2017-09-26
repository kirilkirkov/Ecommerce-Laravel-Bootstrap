<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\PublishModel;
use Lang;

class ProductsCategoryController extends Controller
{

    public function index()
    {
        return view('admin.products', ['page_title_lang' => Lang::get('admin_pages.products_list')]);
    }

}
