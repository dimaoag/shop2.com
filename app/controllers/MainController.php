<?php
namespace app\controllers;

use shop2\App;



class MainController extends AppController
{
    //public $layout = 'test';

    public function indexAction(){
        //$this->layout = 'test';
        //$this->meta['title'] = 'Home';
        //$this->setMeta('Home', 'Description', 'Keywords');
        //$this->setMeta(App::$app->getProperty('shop_name'), 'Description', 'Keywords');
        //$this->setData(['name' => 'Dima', 'age' => 25]);
        $name = 'John';
        $age = 25;
        $cities = ['London', 'Madrid', 'Paris'];
        $posts = \R::findAll('test');
        $this->setData(compact('name', 'age', 'cities', 'posts'));


    }

}