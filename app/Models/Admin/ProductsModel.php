<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use Config;

class ProductsModel extends Model
{

    private $defaultLang;
    private $id;

    public function __construct()
    {
        $this->defaultLang = Config::get('app.defaultLocale');
    }

    public function getProducts($request)
    {
        $search = $request->input('search');
        $products = DB::table('products')
                ->select(DB::raw('products.*, products_translations.name, products_translations.description, products_translations.price'))
                ->where('products_translations.locale', $this->defaultLang)
                ->when($search, function ($query) use ($search) {
                    return $query->where('products_translations.name', 'LIKE', "%$search%");
                })
                ->join('products_translations', 'products.id', '=', 'products_translations.for_id')
                ->paginate(12);
        return $products;
    }

    public function deleteProduct($id)
    {
        $this->id = $id;
        DB::transaction(function () {
            DB::table('products')->where('id', $this->id)->delete();
            DB::table('products_translations')->where('for_id', $this->id)->delete();
        });
    }

}
