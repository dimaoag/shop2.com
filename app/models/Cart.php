<?php
namespace app\models;

use shop2\App;

// It's viewing cart
/*Array
(
    [1] => Array
        (
            [qty] => QTY
            [title] => NAME
            [price] => PRICE
            [img] => IMG
        )
    [10] => Array
        (
            [qty] => QTY
            [name] => NAME
            [price] => PRICE
            [img] => IMG
        )
    )
    [qty] => QTY,
    [sum] => SUM
*/

class Cart extends AppModel {


    /**
     * @param $product
     * @param int $qty
     * @param null $mod
     */
    public function addToCart($product, $qty = 1, $mod = null){
        if (!isset($_SESSION['cart_currency'])){
            $_SESSION['cart_currency'] = App::$app->getProperty('currency');
        }
        if ($mod){
            $cartProductId = "{$product->id}-{$mod->id}";
            $cartProductTitle = "{$product->title} ({$mod->title})";
            $cartProductPrice = $mod->price;
        } else {
            $cartProductId = $product->id;
            $cartProductTitle = $product->title;
            $cartProductPrice = $product->price;
        }
        if (isset($_SESSION['cart'][$cartProductId])){
            $_SESSION['cart'][$cartProductId]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$cartProductId] = [
                'qty' => $qty,
                'title' => $cartProductTitle,
                'alias' => $product->alias,
                'price' => $cartProductPrice * $_SESSION['cart_currency']['value'],
                'img' => $product->img,
            ];
        }
        $_SESSION['cart_qty'] = isset($_SESSION['cart_qty']) ? $_SESSION['cart_qty']+$qty : $qty;
        $_SESSION['cart_sum'] = isset($_SESSION['cart_sum']) ? $_SESSION['cart_sum']+($qty * ($cartProductPrice * $_SESSION['cart_currency']['value'])) : $qty * ($cartProductPrice * $_SESSION['cart_currency']['value']);

    }


    public function deleteItem($id){
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart_qty'] -= $qtyMinus;
        $_SESSION['cart_sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);
    }




    public static function converting($newCurrency){
        if (isset($_SESSION['cart_currency'])){
            // converting cart_sum
            if ($_SESSION['cart_currency']['base']){
                $_SESSION['cart_sum'] *=  $newCurrency->value;
            } else {
                $_SESSION['cart_sum'] = ($_SESSION['cart_sum'] / $_SESSION['cart_currency']['value']) * $newCurrency->value;
            }

            // converting price products
            foreach ($_SESSION['cart'] as $id => $item){
                if ($_SESSION['cart_currency']['base']){
                    $_SESSION['cart'][$id]['price'] *= $newCurrency->value;
                } else {
                    $_SESSION['cart'][$id]['price'] = ($_SESSION['cart'][$id]['price'] / $_SESSION['cart_currency']['value']) * $newCurrency->value;
                }
            }

            // set in session new currency
            foreach ($newCurrency as $key => $value){
                $_SESSION['cart_currency'][$key] = $value;
            }
        }








    }




}