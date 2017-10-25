<?php
/*
  |--------------------------------------------------------------------------
  | PHP SIMPLE API
  |--------------------------------------------------------------------------
  |
  | API REST Modular para proyectos web SPA
  | @autor:     Brandon Sanchez
  | @uri:       https://www.grafikamos.com
  | @license:   Licencia MIT, Es libre de usar este código como desee
  |             Para saber mas de esta licencia puede dirigirse a
  |             https://opensource.org/licenses/MIT
  |
 */


/*
 * Habilitar cross origin si es necesario
 *
 * header("Access-Control-Allow-Origin: *");
 * header('Access-Control-Allow-Credentials: true');
 */

error_reporting(-1);
session_start();
if (!defined('API')):
    define('API', __DIR__ . '/..');
endif;

require_once API.'/vendor/autoload.php';
require_once API.'/system/Util.php';

/**
 * Cargar configuraciones generales
 */
use System\Config;

/**
 * Definir zona horaria
 */
date_default_timezone_set(Config::get('api_config.timezone'));

/**
 * Reporte de errores
 */
if (!is_null(Config::get('api_config.display_errors'))) {
    ini_set('display_errors', Config::get('api_config.display_errors'));
    error_reporting(
        !is_null(Config::get('api_config.error_reporting')) ?
            Config::get('api_config.error_reporting') : 0
    );
} else {
    ini_set('display_errors', 'Off');
    error_reporting(0);
}

/*
 * Carga de la aplicación
 */
use System\Loader;

/**
 * Crear nuevo objeto de aplicación e iniciar
 */
$api = new Loader();
$api->Run();
