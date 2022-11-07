<?php

namespace App;

use App\Models\Publics\ProductsModel;

/**
 * This class manage shopping cart of users
 *
 * @author kiro
 */
class Cart
{
    /*
     * 1 month expire time
     */

    private $cookieExpTime = 2678400;
    public $countProducts = 0;

    public function addProduct($id, $quantity)
    {
        $productsModel = new ProductsModel();
        if (!isset($_SESSION['laraCart'])) {
            $_SESSION['laraCart'] = array();
        }
        for ($i = 1; $i <= $quantity; $i++) {
            $_SESSION['laraCart'][] = (int) $id;
        }
        setcookie('laraCart', serialize($_SESSION['laraCart']), $this->cookieExpTime);
    }

    public function removeProductQuantity($id)
    { 
        if (($key = array_search($id, $_SESSION['laraCart'])) !== false) {
            unset($_SESSION['laraCart'][$key]);
        }
    }

    public function removeProduct($id)
    {
        $count = count(array_keys($_SESSION['laraCart'], $id));
        $i = 1;
        do {
            if (($key = array_search($id, $_SESSION['laraCart'])) !== false) {
                unset($_SESSION['laraCart'][$key]);
            }
            $i++;
        } while ($i <= $count);
        setcookie('laraCart', serialize($_SESSION['laraCart']), $this->cookieExpTime);
    }

    public function clearCart()
    {
        unset($_SESSION['laraCart']);
        setcookie('laraCart', null, -1, '/');
    }

    private function getCartProductsIds()
    {
        $products = array();
        if (!isset($_SESSION['laraCart']) || empty($_SESSION['laraCart'])) {
            if (isset($_COOKIE['laraCart']) && $_COOKIE['laraCart'] == null && !empty($_COOKIE['laraCart'])) {
                $_SESSION['laraCart'] = unserialize($_COOKIE['laraCart']);
            }
        } else {
            $products = $_SESSION['laraCart'];
        }
        return $products;
    }

    public function getCartProducts()
    {
        $productsModel = new ProductsModel();

        $products_ids = $this->getCartProductsIds();
        $unique_ids = array_unique($products_ids);

        $products = [];
        if (!empty($products_ids)) {
            $products = $productsModel->getProductsWithIds($unique_ids);
            foreach ($products as &$product) {
                $counts = array_count_values($products_ids);
                $numAddedToCart = $counts[$product->id];
                $product->num_added = $numAddedToCart;
            }
        }
        $this->countProducts = count($products);
        return $products;
    }

    public function getCartHtmlWithProducts()
    {
        $products = $this->getCartProducts();

        $sum = 0;
        if (!empty($products)) {
            $sum = 0;
            ob_start();
            include '../resources/views/publics/cartHtml.php';
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } else {
            return $products;
        }
    }

    public function getCartHtmlWithProductsForCheckoutPage()
    {
        $products = $this->getCartProducts();

        $sum = 0;
        if (!empty($products)) {
            $sum = 0;
            ob_start();
            include '../resources/views/publics/cartHtmlForCheckoutPage.php';
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } else {
            return $products;
        }
    }

}
