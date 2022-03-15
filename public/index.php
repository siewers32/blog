<?php
session_start();
include("../src/Models/Message.php");
include("../src/Controllers/BaseController.php");
include("../src/Controllers/HomeController.php");
include("../src/Controllers/MessageController.php");
include("../src/Models/User.php");
include("../src/Controllers/UserController.php");
include("../src/Controllers/AuthController.php");
include("../src/Container.php");
include("../src/View.php");
include("../src/Auth.php");

$c = new Container();

$pdo = new PDO("mysql:host=localhost;port=3307;dbname=blog", "root", "root");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$c->add('db',$pdo);

//layout
$view = new View("../src/Views/layout/layout.tpl");
$c->add('view', $view);

//authentication
$c->add('auth', new Auth());

$controllers = [
    'HomeController',
    'UserController',
    'AuthController'
];


$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']).'Controller': 'HomeController';
$action = isset($_GET['action']) && in_array($_GET['action'], get_class_methods($controller)) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id']: 0;

$controllerObj = new $controller($c);

call_user_func_array(array($controllerObj, $action), array($id));
