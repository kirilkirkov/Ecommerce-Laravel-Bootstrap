<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Auth;

class UsersController extends Controller
{

    public function index()
    {
        return view('admin.users', ['page_title_lang' => Lang::get('admin_pages.users')]);
    }
    
    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}
