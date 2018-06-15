<?php
namespace app\controllers\admin;

use app\models\AppModel;
use app\models\User;
use shop2\base\Controller;

class AdminController extends Controller {

    public $layout = 'admin_layout';

    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        if (!User::isAdmin() && $route['action'] != 'login-admin'){
            redirect(ADMIN . '/user/login-admin');
        }
    }


}