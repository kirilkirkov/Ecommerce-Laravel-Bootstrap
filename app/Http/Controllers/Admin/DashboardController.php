<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard', ['page_title_lang' => Lang::get('admin_pages.dashboard')]);
    }

}
