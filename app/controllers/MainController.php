<?php
namespace app\controllers;

use shop2\App;
use shop2\Cache;


class MainController extends AppController
{
    //public $layout = 'test';

    public function indexAction(){
        $this->setMeta('Home', 'Description', 'Keywords');

    }

}