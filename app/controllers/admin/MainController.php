<?php
namespace app\controllers\admin;


class MainController extends AdminController {

    public function indexAction(){


        $countOfUsers = \R::count('user');


        $this->setMeta('Dashboard');
        $this->setData(compact('countOfUsers'));
    }
}