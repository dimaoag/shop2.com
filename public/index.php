<?php

require_once dirname(__DIR__) . "/config/init.php";
require_once LIBS . "/functions.php";
new \shop2\App();

debug(\shop2\App::$app->getProperties());