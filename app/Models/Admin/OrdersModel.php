<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;

class OrdersModel extends Model
{

    private $post;

    public function getOrders()
    {
        $products = DB::table('orders')
                ->select(DB::raw('orders.*, orders.id as orderId, orders_clients.*'))
                ->join('orders_clients', 'orders_clients.for_order', '=', 'orders.id')
                ->paginate(10);
        return $products;
    }

    public function setNewStatus($post)
    {
        $this->post = $post;
        DB::table('orders')
                ->where('id', $this->post['order_id'])
                ->update([
                    'status' => $this->post['order_value']
        ]);
    }

}
