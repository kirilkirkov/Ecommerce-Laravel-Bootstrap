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

    public function getFastOrders()
    {
        $fastOrders = DB::table('fast_orders')
                        ->where('status', 0)
                        ->get()->toArray();
        return $fastOrders;
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

    public function getOrdersByMonth()
    {
        $result = DB::select('SELECT YEAR(FROM_UNIXTIME(UNIX_TIMESTAMP(time_created))) as year, MONTH(FROM_UNIXTIME(UNIX_TIMESTAMP(time_created))) as month, COUNT(id) as num FROM orders GROUP BY YEAR(FROM_UNIXTIME(UNIX_TIMESTAMP(time_created))), MONTH(FROM_UNIXTIME(UNIX_TIMESTAMP(time_created)))');
        $orders = array();
        $years = array();
        foreach ($result as $res) {
            if (!isset($orders[$res->year])) {
                for ($i = 1; $i <= 12; $i++) {
                    $orders[$res->year][$i] = 0;
                }
            }
            $years[] = $res->year;
            $orders[$res->year][$res->month] = $res->num;
        }
        return [
            'years' => array_unique($years),
            'orders' => $orders
        ];
    }

    public function setFastOrderAsViewed($id)
    {
        DB::table('fast_orders')
                ->where('id', $id)
                ->update([
                    'status' => 1
        ]);
    }

}
