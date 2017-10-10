<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Cart;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $products;

    /*
     * Get all products from cart
     * Get all products from database
     * Save all this to $products variable to be accessable from all controllers
     */

    public function __construct()
    {
        $cart = new Cart();
        $this->products = $cart->getCartProducts();
    }

}
