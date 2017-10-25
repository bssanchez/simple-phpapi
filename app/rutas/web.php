<?php
if (!defined('API')):
    die('Nothing to do here ._.');
endif;

$router->map(array("GET", "POST"), "/",
    function () {
    return "<center><h1>API Works!</h1></center>";
});

/**
 * Ejemplo de rutas
 */

// Ruta simple
$router->get("/blog", function () {
    return "This is blog!";
});

// Ruta dirigida a un controlador/función específico
$router->get("/controlador", 'Controlador\ApiController@getPruebaControlador');

// Ruta con parámetro dirigida a un controlador/función específico
$router->get("/controlador/{param}", 'Controlador\ApiController@getPruebaControladorParam');

// Ruta dirigida a un controlador/función específico que llama el sistema de vistas
$router->get("/vista", 'Controlador\ApiController@getPruebaControladorVista');