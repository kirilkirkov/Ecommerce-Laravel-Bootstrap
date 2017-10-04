<?php

namespace App\Models\Publics;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{

    public function getVipProducts()
    {
        $products = DB::table('products')
                ->where('vip', '=', 1)
                ->where('hidden', '=', 0)
                ->where('locale', '=', app()->getLocale())
                ->join('products_translations', 'products_translations.for_id', '=', 'products.id')
                ->get();
        return $products;
    }

    public function getMostSelledProducts()
    {
        $products = DB::table('products')
                ->where('vip', '=', 0)
                ->where('hidden', '=', 0)
                ->where('locale', '=', app()->getLocale())
                ->join('products_translations', 'products_translations.for_id', '=', 'products.id')
                ->orderBy('procurements', 'desc')
                ->limit(10)
                ->get();
        return $products;
    }

}
