<?php
namespace app\controllers;


use app\models\User;

class UserController extends AppController {




    public function signupAction(){
        if (!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->isUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $user->hashPassword();
                $user->save('user');
                if (!isset($_POST['role'])){
                    if ($user->login()) {
                        redirect(PATH . '/user/cabinet');
                        $_SESSION['success'] = 'Success!';
                    } else {
                        $_SESSION['errors'][] = 'Error. Try again.';
                    }
                }
                $_SESSION['success'] = 'Success!';

            }
            redirect();
        }

        $this->setMeta('Registration');
    }





    public function loginAction(){
        if (!empty($_POST)){
            if (isset($_SESSION['cart'])){
                unset($_SESSION['cart']);
                unset($_SESSION['cart_qty']);
                unset($_SESSION['cart_sum']);
                unset($_SESSION['cart_currency']);
            }
            $user = new User();
            if ($user->login()){
                $_SESSION['success'] = 'Success!';
                redirect(PATH . '/user/cabinet');
            } else {
                $_SESSION['errors'] = 'Error! Login or password incorrect.';
            }
            redirect();
        }
        $this->setMeta('Log In');
    }



    public function logoutAction(){
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        if (isset($_SESSION['errors']) || $_SESSION['success']) {
            unset($_SESSION['errors']);
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
            unset($_SESSION['cart_qty']);
            unset($_SESSION['cart_sum']);
            unset($_SESSION['cart_currency']);
        }
        redirect();
    }



    public function cabinetAction(){
        if (!User::isAuth()) redirect();

        $this->setMeta('Cabinet');
    }


    public function editAction(){
        if (!User::isAuth()) redirect('/user/login');
        if (!empty($_POST)){
            $user = new \app\models\admin\User();
            $data = $_POST;
            $data['id'] = $_SESSION['user']['id'];
            $data['role'] = $_SESSION['user']['role'];
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
            if ($user->update('user', $_SESSION['user']['id'])){
                foreach ($user->attributes as $key => $value){
                    if ($key != 'password') $_SESSION['user'][$key] = $value;
                }
                $_SESSION['success'] = 'Data is saved';
            }
            redirect();
        }
        $this->setMeta('Edit profile');
    }

    public function ordersAction(){
        if (!User::isAuth()) redirect('/user/login');

        $user_id = $_SESSION['user']['id'];
        $orders = \R::findAll('order', "user_id = ?", [$user_id]);

        $this->setMeta('Orders of user');
        $this->setData(compact('orders'));
    }

}