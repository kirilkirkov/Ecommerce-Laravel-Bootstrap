<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\CheckoutModel;
use Lang;
use App\Cart;

class CheckoutController extends Controller
{

    public function index()
    {
        return view('publics.checkout', [
            'cartProducts' => $this->products
        ]);
    }

    public function setOrder(Request $request)
    {
        $post = $request->all();
        $checkoutModel = new CheckoutModel();
        $checkoutModel->setOrder($post);
        $cart = new Cart();
        $cart->clearCart();
        return redirect(lang_url('/'))->with(['msg' => Lang::get('public_pages.order_accepted'), 'result' => true]);
    }

}
