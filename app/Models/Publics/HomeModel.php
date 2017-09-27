<?php

namespace App\Models\Publics;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{

    protected $table = 'brands';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getBrands()
    {
        $brands = DB::table('brands')->get();
        return $brands;
    }

}
