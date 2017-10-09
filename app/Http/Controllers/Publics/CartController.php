<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;

/*
 * Used most of all for ajax requests
 */
class CartController extends Controller
{

    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function addProduct(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $post = $request->all();

        $this->cart->addProduct($post['id']);
    }

}
