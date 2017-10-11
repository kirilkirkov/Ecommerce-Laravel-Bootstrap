<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ProductsModel;
use App\Models\Publics\HomeModel;

class CheckoutController extends Controller
{

    public function index()
    {
        $productsModel = new ProductsModel();
        $homeModel = new HomeModel();
        $promoProducts = $productsModel->getProductsWithTags(['promo']);
        $mostSelledProducts = $productsModel->getMostSelledProducts();
        $carousel = $homeModel->getCarouselSliders();
        return view('publics.checkout', [
            'promoProducts' => $promoProducts,
            'mostSelledProducts' => $mostSelledProducts,
            'carousel' => $carousel,
            'cartProducts' => $this->products
        ]);
    }

}
