<?php

require_once 'vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;

AppFactory::setContainer(new Container());
$app = AppFactory::create();
