<?php
namespace app\controllers;


use app\models\User;

class UserController extends AppController {

    public function signupAction(){
        if (!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data)){
                $user->getErrors();
                redirect();
            } else {
                $_SESSION['success'] = 'Success! You are registered.';
            }
        }


        $this->setMeta('Registration');
    }

    public function loginAction(){

    }

    public function logoutAction(){

    }

    public function cabinetAction(){

    }

}