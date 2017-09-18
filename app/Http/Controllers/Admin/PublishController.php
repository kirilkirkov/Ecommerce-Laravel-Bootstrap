<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;

class PublishController extends Controller
{

    public function index()
    {
        return view('admin.publish', ['page_title_lang' => Lang::get('admin_pages.publish')]);
    }

}
