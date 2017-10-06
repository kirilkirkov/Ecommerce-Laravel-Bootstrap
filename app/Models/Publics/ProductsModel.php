<?php

namespace App\Models\Publics;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{

    public function getProducts()
    {
        $products = DB::table('products')
                ->orderBy('order_position', 'asc')
                ->where('hidden', '=', 0)
                ->where('locale', '=', app()->getLocale())
                ->join('products_translations', 'products_translations.for_id', '=', 'products.id')
                ->paginate(12);
        return $products;
    }

    public function getProduct($id)
    {
        $product = DB::table('products')
                ->select(DB::raw('products.*, products_translations.*, categories_translations.name as category_name, categories_translations.id as category_id'))
                ->where('products.id', '=', $id)
                ->where('products_translations.locale', '=', app()->getLocale())
                ->where('categories_translations.locale', '=', app()->getLocale())
                ->join('products_translations', 'products_translations.for_id', '=', 'products.id')
                ->join('categories_translations', 'categories_translations.for_id', '=', 'products.category_id')
                ->first();
        return $product;
    }

    public function getProductsWithTags($arrayTags)
    {
        $products = DB::table('products')
                ->whereIn('tags', $arrayTags)
                ->where('hidden', '=', 0)
                ->where('locale', '=', app()->getLocale())
                ->join('products_translations', 'products_translations.for_id', '=', 'products.id')
                ->limit(8)
                ->get();
        return $products;
    }

    public function getMostSelledProducts()
    {
        $products = DB::table('products')
                ->where('hidden', '=', 0)
                ->where('locale', '=', app()->getLocale())
                ->join('products_translations', 'products_translations.for_id', '=', 'products.id')
                ->orderBy('procurements', 'desc')
                ->limit(8)
                ->get();
        return $products;
    }

}
