<?php

/*
  |--------------------------------------------------------------------------
  | Routes APP
  |--------------------------------------------------------------------------
  |
  | all routes mapping of the API: https://github.com/miladrahimi/phprouter
  |
 */
if (!defined('API')):
    die('Nothing to do here ._.');
endif;


$router->get("/", function () {
    return "API Works!";
});


$router->get("/blog", function () {
    return "This is blog!";
});

$router->get("/controlador", 'Controlador\Api@PruebaControlador');


$router->get("/data/{id}", 'Controlador\Api@GetData');