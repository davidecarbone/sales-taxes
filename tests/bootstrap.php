<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;

AppFactory::setContainer(new Container());
$app = AppFactory::create();
