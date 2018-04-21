<?php

require_once dirname(__DIR__) . "/config/init.php";
require_once LIBS . "/functions.php";
new \shop2\App();

throw new Exception('Page not found', 500);