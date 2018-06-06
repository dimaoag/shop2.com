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





}