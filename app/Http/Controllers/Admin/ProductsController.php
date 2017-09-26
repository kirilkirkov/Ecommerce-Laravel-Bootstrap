<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProductsModel;
use Lang;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts($request);
        return view('admin.products', [
            'page_title_lang' => Lang::get('admin_pages.products_list'),
            'products' => $products
        ]);
    }

    public function deleteProduct(Request $request)
    {
        if (isset($request->number) && (int) $request->number > 0) {
            $productsModel = new ProductsModel();
            $productsModel->deleteProduct($request->number);
            return redirect(lang_url('admin/products'))->with(['msg' => Lang::get('admin_pages.product_is_deleted'), 'result' => true]);
        } else {
            abort(404);
        }
    }

}
