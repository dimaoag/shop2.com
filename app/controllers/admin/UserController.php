<?php
namespace app\controllers\admin;


use app\models\User;
use shop2\libs\Pagination;

class UserController extends AdminController {

    public function loginAdminAction(){

        $this->layout = 'login_admin';

        if (!empty($_POST)){
            $user = new User();
            if ($user->login(true)){
                $_SESSION['success'] = 'Success!';
            } else {
                $_SESSION['errors'] = 'Error! Login or password incorrect.';
            }
            if (User::isAdmin()){
                redirect(ADMIN);
            } else {
                redirect();
            }
        }

    }


    public function indexAction(){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 2;
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::findAll('user', "LIMIT $start, $perpage");

        $this->setMeta('All users');
        $this->setData(compact('users', 'pagination', 'count'));
    }




    public function editAction(){
        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);



        $this->setMeta('Edit user profile');
        $this->setData(compact('user'));
    }




    public function ordersAction(){

        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` WHERE user_id = $user_id GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id`");

        $this->setMeta('Orders of user');
        $this->setData(compact('user', 'orders'));

    }

    public function viewAction(){

        $users = \R::findAll( 'user' );

        $this->setMeta('All users');
        $this->setData(compact('users'));
    }



}