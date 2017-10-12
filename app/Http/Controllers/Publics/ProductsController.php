<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ProductsModel;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts($request);
        $categores = $productsModel->getCategories();

        function buildTree(array $elements, $parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element) {
                if ($element->parent == $parentId) {
                    $children = buildTree($elements, $element->id);
                    if ($children) {
                        $element->children = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }

        $tree = buildTree($categores);
        return view('publics.products', [
            'products' => $products,
            'cartProducts' => $this->products,
            'categories' => $tree,
            'selectedCategory' => $request->category
        ]);
    }

    public function productPreview(Request $request)
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->getProduct($request->id);
        if ($product == null) {
            abort(404);
        }
        return view('publics.preview', [
            'product' => $product,
            'cartProducts' => $this->products
        ]);
    }

}
