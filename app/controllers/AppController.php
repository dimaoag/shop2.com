<?php
namespace app\controllers;

use app\models\AppModel;
use shop2\App;
use shop2\base\Controller;
use app\widgets\currency\Currency;
use shop2\Cache;


class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('currencies', Currency::getCurrencies());
        App::$app->setProperty('currency' ,Currency::getCurrency(App::$app->getProperty('currencies')));
        App::$app->setProperty('categories', self::cacheCategory());
    }


    /**
     * @return array
     */
    public static function cacheCategory(){
        $cache = Cache::instance();
        $categories = $cache->get('categories');
        if (!$categories){
            $categories = \R::getAssoc("SELECT * FROM category");
            $cache->set('categories', $categories);
        }
        return $categories;
    }


}