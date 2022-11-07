<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Config;
use App\Models\Admin\PublishModel;
use App\Models\Admin\CategoriesModel;
use Storage;

class PublishController extends Controller
{

    public function index(Request $request)
    {
        $productInfo = null;
        $categoriesModel = new CategoriesModel();
        if (isset($request->number) && (int) $request->number > 0) {
            $publishModel = new PublishModel();
            $productInfo = $publishModel->getProductInfo($request->number);
            if ($productInfo['product'] == null) {
                abort(404);
            }
        }
        $allCategories = $categoriesModel->getAllCategories();
        return view('admin.publish', [
            'page_title_lang' => Lang::get('admin_pages.publish'),
            'locales' => Config::get('app.locales'),
            'currentLocale' => app()->getLocale(),
            'product' => $productInfo,
            'allCategories' => $allCategories
        ]);
    }

    public function setProduct(Request $request)
    {
        $publishModel = new PublishModel();
        if (isset($request->number) && $request->number > 0) {
            $result = $publishModel->updateProduct($request->all(), $request->number);
        } else {
            $result = $publishModel->setProduct($request->all());
        }
        return redirect(lang_url('admin/publish'))->with(['msg' => $result['msg'], 'result' => $result['result']]);
    }

    public function removeGalleryImage(Request $request)
    {
        $post = $request->all();
        $image = $post['image'];
        $result = Storage::delete('public/moreImagesFolders/' . $image);
        if ($result === true) {
            return '1';
        }
        return '0';
    }
}
