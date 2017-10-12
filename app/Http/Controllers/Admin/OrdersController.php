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
        $fastOrders = $ordersModel->getFastOrders();
        return view('admin.orders', [
            'page_title_lang' => Lang::get('admin_pages.orders'),
            'orders' => $orders,
            'fastOrders' => $fastOrders,
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

    public function markFastOrder(Request $request)
    {
        if (isset($request->id) && (int) $request->id > 0) {
            $ordersModel = new OrdersModel();
            $ordersModel->setFastOrderAsViewed($request->id);
            return redirect(lang_url('admin/orders'))->with(['msg' => Lang::get('admin_pages.fast_order_marked'), 'result' => true]);
        } else {
            abort(404);
        }
    }

}
