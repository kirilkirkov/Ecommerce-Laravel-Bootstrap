<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Config;
use App\Models\Admin\PublishModel;

class PublishController extends Controller
{

    public function index()
    {
        return view('admin.publish', [
            'page_title_lang' => Lang::get('admin_pages.publish'),
            'locales' => Config::get('app.locales'),
            'currentLocale' => app()->getLocale()
        ]);
    }

    public function setProduct(Request $request)
    {
        $publishModel = new PublishModel();
        $result = $publishModel->setProduct($request->all());
        return redirect(lang_url('admin/publish'))->with(['msg' => $result['msg'], 'result' => $result['result']]);
    }

}
