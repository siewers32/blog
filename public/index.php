<?php
session_start();
include("../src/Models/Message.php");
include("../src/Controllers/BaseController.php");
include("../src/Controllers/MessageController.php");
include("../src/Models/User.php");
include("../src/Controllers/UserController.php");
include("../src/Controllers/AuthController.php");
include("../src/Container.php");
include("../src/View.php");

$c = new Container();

$conn = new PDO("mysql:host=localhost;port=3307;dbname=blog", "root", "root");
$c->add('db',$conn);

//layout
$view = new View("../src/Views/layout/layout.tpl");
//navbar
$view->add(':login', isset($_SESSION['user']) ? '<span>'.ucfirst($_SESSION['user']).'</span>':"<a href='index.php?controller=auth&action=login'>Login</a>");
$view->add(':logout', isset($_SESSION['user']) ? "<a href='index.php?controller=auth&action=logout'>Uitloggen</a>": "");
$view->add(':register', !isset($_SESSION['user']) ? "<a href='index.php?controller=auth&action=register'>Register</a>": "");

$c->add('view', $view);

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
