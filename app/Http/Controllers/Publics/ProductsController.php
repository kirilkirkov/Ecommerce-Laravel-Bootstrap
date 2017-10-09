<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ProductsModel;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts($request);
        return view('publics.products', [
            'products' => $products,
            'cartProducts' => $this->products
        ]);
    }

    public function productPreview(Request $request)
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->getProduct($request->id);
        if ($product == null) {
            abort(404);
        }
        return view('publics.preview', [
            'product' => $product,
            'cartProducts' => $this->products
        ]);
    }

}
