<?php
namespace app\models\admin;

class User extends \app\models\User{

    public $attributes = [
        'id' => '',
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
        'role' => ''
    ];


    public $rules = [
        'required' => [
            ['login'],
            ['name'],
            ['email'],
            ['role'],
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['login', 4],
            ['name', 4]
        ],

    ];




    /**
     * @return bool
     */
    public function isUnique(){
        $user =  \R::findOne('user', '(login = ? OR email = ?) AND id <> ?', [$this->attributes['login'], $this->attributes['email'], $this->attributes['id']]);
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


}