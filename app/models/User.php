<?php
namespace app\models;


class User extends AppModel {


    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
    ];


    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['name'],
            ['email'],
            ['address']
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['login', 4],
            ['password', 6],
            ['name', 4]
        ],

    ];



    public function hashPassword(){
        $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
    }


    /**
     * @return bool
     */
    public function isUnique(){
        $user =  \R::findOne('user', 'login = ? OR email = ?', [$this->attributes['login'], $this->attributes['email']]);
        if ($user){
            if ($user->login == $this->attributes['login']){
                $this->errors['unique'][] = 'This login is already reserved';
            }
            if ($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'This email is already reserved';
            }
            return false;
        }
        return true;
    }


    /**
     * @param bool $isAdmin
     * @return bool
     */
    public function login($isAdmin = false){
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        if ($login && $password){
            if ($isAdmin){
                $user = \R::findOne('user', "login = ? AND role = 'admin'", [$login]);
            } else {
                $user = \R::findOne('user', "login = ?", [$login]);
            }
            if ($user){
                if (password_verify($password, $user->password)){
                    foreach ($user as $key => $value){
                        if ($key != 'password'){
                            $_SESSION['user'][$key] = $value;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * @return bool
     */
    public static function isAuth(){
        return isset($_SESSION['user']) ? true : false;
    }


    /**
     * @return bool
     */
    public static function isAdmin(){
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'){
            return true;
        }
        return false;
    }



}