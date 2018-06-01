<?php
namespace app\controllers;

use shop2\App;
use shop2\Cache;


class MainController extends AppController
{
    //public $layout = 'test';

    public function indexAction(){
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product', "hit = '1' AND status = '1' LIMIT 8");
        $this->setMeta('Home', 'Description', 'Keywords');
        $this->setData(compact('brands', 'hits'));
        
    }

}