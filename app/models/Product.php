<?php

namespace app\models;


use shop2\App;

class Product extends AppModel {


    protected $LatestViewedProducts = 3;





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
                debug($recentlyViewed);
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
     * @return bool
     */
    public function getAllRecentlyViewed(){
        if (!empty($_COOKIE['recentlyViewed'])){
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }



}