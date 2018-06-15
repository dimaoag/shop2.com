<?php
namespace app\controllers\admin;


class MainController extends AdminController {

    public function indexAction(){


        $countOfUsers = \R::count('user');
        $countCategories = \R::count('category');
        $countProducts = \R::count('product');
        $countNewOrders = \R::count('order', "status = '0'");

        $this->setMeta('Dashboard');
        $this->setData(compact('countOfUsers', 'countNewOrders', 'countCategories', 'countProducts'));
    }
}