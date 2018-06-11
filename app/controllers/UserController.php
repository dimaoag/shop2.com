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
                if ($user->login()) {
                    $_SESSION['success'] = 'Success!';
                } else {
                $_SESSION['errors'][] = 'Error. Try again.';
                }
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
            } else {
                $_SESSION['errors'][] = 'Error! Login or password incorrect.';
            }
            redirect();
        }

        $this->setMeta('Log In');
    }



    public function logoutAction(){
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        if (isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
            unset($_SESSION['cart_qty']);
            unset($_SESSION['cart_sum']);
            unset($_SESSION['cart_currency']);
        }
        redirect();
    }



    public function cabinetAction(){

    }

}