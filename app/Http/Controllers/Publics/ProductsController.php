<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ProductsModel;
use Lang;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts($request);
        $categores = $productsModel->getCategories();
        if ($request->category != null) {
            $categoryName = $productsModel->getCategoryName($request->category);
        }

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
            'selectedCategory' => $request->category,
            'head_title' => $request->category == null ? Lang::get('seo.title_products') : $categoryName[0],
            'head_description' => $request->category == null ? Lang::get('soe.descr_products') : Lang::get('seo.descr_products_category') . $categoryName[0],
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
            'cartProducts' => $this->products,
            'head_title' => mb_strlen($product->name) > 70 ? str_limit($product->name, 70) : $product->name,
            'head_description' => mb_strlen($product->description) > 160 ? str_limit($product->description, 160) : $product->description
        ]);
    }

}
