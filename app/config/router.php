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
$router->setDefaults(['controller' => 'User', 'action' => 'index']);

//Erro 404
//$router->notFound(['controller' => 'User', 'action' => 'notFound']);

//User
$router->add('/login', ['controller' => 'User', 'action' => 'login']);
$router->add('/create', ['controller' => 'User', 'action' => 'create']);
$router->add('/select', ['controller' => 'User', 'action' => 'select']);
$router->add('/update', ['controller' => 'User', 'action' => 'update']);
$router->add('/delete', ['controller' => 'User', 'action' => 'delete']);

$router->handle($_SERVER['REQUEST_URI']);