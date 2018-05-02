<?php
namespace app\controllers;

use shop2\App;
use shop2\Cache;


class MainController extends AppController
{
    //public $layout = 'test';

    public function indexAction(){
        $brands = \R::find('brand', 'LIMIT 3');
        $this->setMeta('Home', 'Description', 'Keywords');
        $this->setData(compact('brands'));

    }

}