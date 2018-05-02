<?php
namespace app\controllers;

use app\models\AppModel;
use shop2\App;
use shop2\base\Controller;
use app\widgets\currency\Currency;


class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        setcookie('currency', 'EUR', time() + 3600*24*7, '/');
        App::$app->setProperty('currencies', Currency::getCurrencies());
        App::$app->setProperty('currency' ,Currency::getCurrency(App::$app->getProperty('currencies')));
        debug(App::$app->getProperties());
    }
}