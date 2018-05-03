<?php
namespace shop2\base;


use shop2\Db;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];


    public function __construct()
    {
        Db::instance();
    }


}