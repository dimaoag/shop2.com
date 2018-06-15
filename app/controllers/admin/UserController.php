<?php
namespace app\controllers\admin;


use app\models\User;

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




    public function viewAction(){

        $users = \R::findAll( 'user' );

        $this->setMeta('All users');
        $this->setData(compact('users'));
    }



}