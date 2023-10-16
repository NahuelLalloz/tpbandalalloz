<?php
require_once 'app/controllers/streamingcontrollers.php';
require_once 'app/controllers/pelicontrollers.php';

require_once 'app/controllers/logincontrollers.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home';


if (!empty($_GET['action']))
    $action = $_GET['action'];



$params = explode('/', $action);


switch ($params[0]) {
    case 'auth':
        $controller = new LoginController();
        $controller->checkLogin();
    case 'login':
        $controller = new LoginController();
        $controller->showLogin();
        break;
    case 'logout':
        $controller = new LoginController();
        $controller->logout();
        break;
    case 'home':
        $peliController = new PeliController();
        $peliController->showPeli();
        $streamingController = new StreamingController();
        $streamingController->showStreaming();
        break;
    case 'agregar':
       
        $controller = new PeliController();
        $controller->addPeli();
        break;

    case 'viewPeli':
        
        $controller = new PeliController();
        $controller->showPeliDetalle($params[1],$params[1] );
        break;
    case 'viewServicio':
        $controller = new StreamingController();
        $controller->showStreamDetalle($params[1]);
        break;
    case 'agregar':
        $controller = new PeliController();
        $controller->addPeli();
        break;
    case 'agregarServicio':
        $controller = new StreamingController();
        $controller->addServicio();
        break;
    case 'delete':
        $controller = new PeliController();
        $controller->deletePeli($params[1]);
        break;
    case 'deleteServicio':
        $controller = new StreamingController();
        $controller->deleteServicio($params[1]);
        break;
    case 'updateServicio':

        $controller = new StreamingController();
        $controller->updateServicio($params[1]);
        break;
    case 'updatePeli':

        $controller = new PeliController();
        $controller->updatePeli();
        break;

    default:
        echo ('404 Page not found');
        break;
}
