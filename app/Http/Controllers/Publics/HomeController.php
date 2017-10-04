<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\HomeModel;

class HomeController extends Controller
{

    public function index()
    {
        $homeModel = new HomeModel();
        $vipProducts = $homeModel->getVipProducts();
        $mostSelledProducts = $homeModel->getMostSelledProducts();
        return view('publics.home', [
            'vipProducts' => $vipProducts,
            'mostSelledProducts' => $mostSelledProducts
        ]);
    }

}
