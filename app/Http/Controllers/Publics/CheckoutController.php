<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    public function index()
    {
        return view('publics.checkout', [
            'cartProducts' => $this->products
        ]);
    }

    public function setOrder()
    {
        
    }

}
