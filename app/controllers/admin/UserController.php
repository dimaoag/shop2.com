<?php
namespace app\controllers\admin;


use app\models\admin\User;
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

    //delete users > delete orders(cascade) > delete order_products

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

        if (!empty($_POST)){
            $id = $this->getRequestId(false);
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->attributes['password']){
                unset($user->attributes['password']);
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }

            if (!$user->validate($data) || !$user->isUnique()){
                $user->getErrors();
                redirect();
            }
            if ($user->update('user', $id)){
                $_SESSION['success'] = 'Data is saved';
            }
            redirect();
        }

        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);

        $this->setMeta('Edit user profile');
        $this->setData(compact('user'));
    }


    public function addAction(){

        $this->setMeta('Add new user');
    }



    public function ordersAction(){
        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);
        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` WHERE user_id = $user_id GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id`");

        $this->setMeta('Orders of user');
        $this->setData(compact('user', 'orders'));
    }


    public function deleteAction(){
        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);
        \R::trash($user);
        $_SESSION['success'] = 'User is deleted';
        redirect();
    }



}