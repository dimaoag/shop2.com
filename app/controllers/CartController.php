<?php
namespace app\controllers;

use app\models\Cart;

class CartController extends AppController {

    public function addAction(){
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $modId = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;

        if ($id){
            $product = \R::findOne('product', 'id = ?', [$id]);
            if (!$product){
                return false;
            }
            if ($modId){
                $mod = \R::findOne('modification', 'id = ? AND product_id = ?', [$modId, $id]);
            }
        }

        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();

    }


    // show cart after click header icon cart
    public function showAction(){
        $this->loadView('cart_modal');
    }


    // delete items from cart
    public function deleteAction(){
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        if (isset($_SESSION['cart'][$id])){
            $cart = new Cart();
            $cart->deleteItem($id);
        }
        if ($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();

    }

    // clear cart
    public function clearAction(){
        unset($_SESSION['cart']);
        unset($_SESSION['cart_qty']);
        unset($_SESSION['cart_sum']);
        unset($_SESSION['cart_currency']);
        $this->loadView('cart_modal');

    }




}