<?php

define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require(ROOT . 'core/database.php');
require(ROOT . 'core/model.php');
require(ROOT . 'core/controller.php');


$params = explode('/', $_GET['p']);
$controller = (isset($params[0])) && (strlen($params[0]) != 0) ? $params[0] : 'presentation';
$action = (isset($params[1])) && (strlen($params[1]) != 0) ? $params[1] : 'index';



if (file_exists('controllers/' . $controller . '.php'))
{
    require('controllers/' . $controller . '.php');
    $controller = new $controller();
    if (method_exists($controller, $action))
    {
        unset($params[0]);
        unset($params[1]);
        call_user_func_array(array($controller, $action), $params);
    }
    else
    {
        echo "erreur 404";
    }
}
else
{
    echo "erreur 404";
}
?>