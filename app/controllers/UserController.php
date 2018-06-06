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
            } else {
                $user->hashPassword();
                if ($user->save('user')){
                    $_SESSION['success'] = 'Success! You are registered.';
                } else {
                    $_SESSION['errors'] = 'Error. Try again.';
                }
            }
            redirect();
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