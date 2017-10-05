<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Config;
use App\Models\Admin\CarouselModel;
use Storage;

class CarouselController extends Controller
{

    public function index()
    {
        $carouselModel = new CarouselModel();
        $sliders = $carouselModel->getSliders();
        return view('admin.carousel', [
            'page_title_lang' => Lang::get('admin_pages.carousel'),
            'locales' => Config::get('app.locales'),
            'currentLocale' => app()->getLocale(),
            'sliders' => $sliders
        ]);
    }

    public function setSlider(Request $request)
    {
        $carouselModel = new CarouselModel();
        $result = $carouselModel->setNewSlider($request->all());
        return redirect(lang_url('admin/carousel'))->with(['msg' => $result['msg'], 'result' => $result['result']]);
    }

    public function deleteSlider(Request $request)
    {
        if (isset($request->id) && (int) $request->id > 0) {
            $carouselModel = new CarouselModel();
            $carouselModel->deleteSlider($request->id);
            return redirect(lang_url('admin/carousel'))->with(['msg' => Lang::get('admin_pages.slider_is_deleted'), 'result' => true]);
        } else {
            abort(404);
        }
    }

}
