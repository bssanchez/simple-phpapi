<?php
/*
  |--------------------------------------------------------------------------
  | Routes APP
  |--------------------------------------------------------------------------
  |
  | Mapeo de todas las rutas de la aplicación: https://github.com/miladrahimi/phprouter
  |
 */
if (!defined('API')):
    die('Nothing to do here ._.');
endif;

$rutas = array_diff(scandir(API.'/app/rutas/'), array('.', '..', 'index.html', '.gitkeep'));

foreach ($rutas as $ruta) {
    require_once API.'/app/rutas/'.$ruta;
}