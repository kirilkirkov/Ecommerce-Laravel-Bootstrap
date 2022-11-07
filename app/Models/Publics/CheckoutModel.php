<?php

namespace App\Models\Publics;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CheckoutModel extends Model
{

    private $post;

    public function setOrder($post)
    {
        $products = [];
        $i = 0;
        foreach ($post['id'] as $product_id) {
            $products[] = [
                'id' => $product_id,
                'quantity' => $post['quantity'][$i]
            ];
            $i++;
        }
        $this->post = $post;
        $this->post['products'] = $products;
        $order_id = DB::table('orders')->max('order_id');
        $this->post['order_id'] = $order_id + 1;
        DB::transaction(function () {
            $id = DB::table('orders')->insertGetId([
                'order_id' => $this->post['order_id'],
                'type' => $this->post['payment_type'],
                'products' => serialize($this->post['products']),
                'time_created' => now(),
            ]);
            DB::table('orders_clients')->insert([
                'for_order' => $id,
                'first_name' => htmlspecialchars(trim($this->post['first_name'])),
                'last_name' => htmlspecialchars(trim($this->post['last_name'])),
                'email' => htmlspecialchars(trim($this->post['email'])),
                'phone' => htmlspecialchars(trim($this->post['phone'])),
                'address' => htmlspecialchars(trim($this->post['address'])),
                'city' => htmlspecialchars(trim($this->post['city'])),
                'post_code' => htmlspecialchars(trim($this->post['post_code'])),
                'notes' => htmlspecialchars(trim($this->post['notes'])),
            ]);
        });
    }

    public function setFastOrder($post)
    {
        $this->post = $post;
        DB::table('fast_orders')->insert([
            'phone' => $this->post['fast_phone'],
            'names' => $this->post['fast_names'],
            'time_created' => now(),
        ]);
    }

}
