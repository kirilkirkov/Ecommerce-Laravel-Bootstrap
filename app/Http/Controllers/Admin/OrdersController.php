<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use App\Models\Admin\OrdersModel;
use App\Models\Publics\ProductsModel;

class OrdersController extends Controller
{

    public function index(Request $request)
    {
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getOrders();
        return view('admin.orders', [
            'page_title_lang' => Lang::get('admin_pages.orders'),
            'orders' => $orders,
            'controller' => $this
        ]);
    }

    public function changeStatus(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $post = $request->all();
        $ordersModel = new OrdersModel();
        $ordersModel->setNewStatus($post);
    }

    public function getProductInfo($id)
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->getProduct($id);
        return $product;
    }

}
