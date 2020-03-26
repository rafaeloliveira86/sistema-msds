<?php
$router = $di->getRouter();

//$router->setDefaultModule('admin');
//$router->setDefaultNamespace('Admin\Controllers');
//$router->setDefaultController('index');
//$router->setDefaultAction('index');

/*$router->setDefaults([
    'controller' => 'index',
    'action' => 'index',
]);*/

//Rota Default
$router->setDefaults(['controller' => 'Auth', 'action' => 'index']);

//Erro 404
$router->notFound(['controller' => 'User', 'action' => 'notFound']);

//Authenticate
$router->add('/login', ['controller' => 'Auth', 'action' => 'login']);
$router->add('/logout', ['controller' => 'Auth', 'action' => 'logout']);
$router->add('/create', ['controller' => 'Auth', 'action' => 'create']);
//User
$router->add('/select', ['controller' => 'User', 'action' => 'select']);
$router->add('/update', ['controller' => 'User', 'action' => 'update']);
$router->add('/delete', ['controller' => 'User', 'action' => 'delete']);
$router->add('/delete/update', ['controller' => 'User', 'action' => 'deleteupdate']);

//Show Modal
$router->add('/showmodal', ['controller' => 'User', 'action' => 'showmodal']);

$router->handle($_SERVER['REQUEST_URI']);