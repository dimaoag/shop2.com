<?php
namespace shop2;


class Db
{
    use TSingletone;

    protected function __construct()
    {
        $db = require_once CONFIG . '/db_config.php';
    }

}