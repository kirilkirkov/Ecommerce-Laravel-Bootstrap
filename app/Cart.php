<?php

namespace App;

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

    public function addProduct($id, $quantity)
    {
        if (!isset($_SESSION['laraCart'])) {
            $_SESSION['laraCart'] = array();
        }
        for ($i = 0; $i <= $quantity; $i++) { 
            $_SESSION['laraCart'][] = (int) $id;
        }
        setcookie('laraCart', serialize($_SESSION['laraCart']), $this->cookieExpTime);
    }

    public function removeProductQuantity()
    {
        
    }

    public function removeProduct()
    {
        
    }

    public function clearCart()
    {
        unset($_SESSION['laraCart']);
        setcookie('laraCart', null, -1, '/');
    }

    public function getCartProducts()
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

}
