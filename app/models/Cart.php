<?php
namespace app\models;

use shop2\App;

class Cart extends AppModel {

    public function addToCart($product, $qty = 1, $mod = null){
        echo 'Cart model Modal';
    }


}