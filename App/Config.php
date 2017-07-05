<?php

namespace App;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

class Config
{
    /*
     * Config based in Eloquent Manage/Capsule
     */
    public static $database_config = array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => '',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    );

     /*
     * Config for API enviroment
     *
     * @var static array
     */
    public static $api_config = array(
        'display_errors' => 'On',
        'error_reporting' => -1,
        'base_uri' => '/php-api',
        'url_front' => 'http://localhost/php-api/',
        'mode_errors_api' => 'html' // Accepts json, array, text and html
    );

}