<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ProductsModel;

class HomeController extends Controller
{

    public function index()
    {
        $productsModel = new ProductsModel();
        $promoProducts = $productsModel->getProductsWithTags(['promo']);
        $mostSelledProducts = $productsModel->getMostSelledProducts();
        return view('publics.home', [
            'promoProducts' => $promoProducts,
            'mostSelledProducts' => $mostSelledProducts
        ]);
    }

}
