<?php

namespace app\models;


use shop2\App;

class Product extends AppModel {


    protected $LatestViewedProducts = 3;


    /**
     * @param $alias
     * @return NULL|\RedBeanPHP\OODBBean
     */
    public function getProductByAlias($alias){
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        return $product;
    }


    /**
     * @param $id
     */
    public function setRecentlyViewed($id){

        $recentlyViewed = $this->getAllRecentlyViewed();

        if (!$recentlyViewed){
                setcookie('recentlyViewed', $id , time()+3600*24, '/');
        } else {
            $recentlyViewed = explode('.', $recentlyViewed);
            if (!in_array($id, $recentlyViewed)){
                $recentlyViewed[] = $id;
                $recentlyViewed = implode('.', $recentlyViewed);
                setcookie('recentlyViewed', $recentlyViewed , time()+3600*24, '/');
            }
        }
    }




    /**
     * @return array|bool
     */
    public function getRecentlyViewed(){

        if (!empty($_COOKIE['recentlyViewed'])){
            $recentlyViewed = $_COOKIE['recentlyViewed'];
            $recentlyViewed = explode('.', $recentlyViewed);

            if (count($recentlyViewed) > $this->LatestViewedProducts){
                $recentlyViewed = array_slice($recentlyViewed, -$this->LatestViewedProducts, $this->LatestViewedProducts, true);
            }

            $recentlyViewedProducts = [];

            foreach ($recentlyViewed as $item){
                $recentlyViewedProducts[] = \R::findOne('product', 'id = ?', [$item]);
            }

            return $recentlyViewedProducts;
        }
        return false;
    }


    /**
     * @param $product_id
     * @return array
     */
    public function getGallery($product_id){
        $gallery = \R::findAll('gallery', 'product_id = ?', [$product_id]);
        return $gallery;
    }



    /**
     * @return bool
     */
    public function getAllRecentlyViewed(){
        if (!empty($_COOKIE['recentlyViewed'])){
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }


    /**
     * @param $product_id
     * @return array
     */
    public function getRelatedProducts($product_id){
        $relatedProducts = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product_id]);
        return $relatedProducts;
    }

    public function getModProductByColor($product_id){
        $modProductByColor = \R::findAll('modification', 'product_id = ?', [$product_id]);
        return $modProductByColor;
    }

}