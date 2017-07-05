<?php
/*
 * API REST Modular para proyectos full stack con Angular 2
 *
 * @autor:   Brandon Sanchez
 * @license: Licencia MIT, Es libre de usar este código como desee
 *           Para saber mas de esta licencia puede dirigirse a
 *           https://opensource.org/licenses/MIT
 */
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
error_reporting(-1);

if (!defined('API')):
    define('API', __DIR__);
endif;

require_once API.'/vendor/autoload.php';
require_once API.'/app/Util.php';
use App\Config;

if (isset(Config::$api_config) && isset(Config::$api_config['display_errors'])) {
    ini_set('display_errors', Config::$api_config['display_errors']);
    error_reporting(
        isset(Config::$api_config['error_reporting']) ?
            Config::$api_config['error_reporting'] : 0
    );
} else {
    ini_set('display_errors', 'Off');
    error_reporting(0);
}

$router = null;

use App\Loader;
$api = new Loader();
$api->Run();
