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


    /**
     * @param $data
     */
    public function load($data){
        foreach ($this->attributes as $name => $value){
            if (isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }


}