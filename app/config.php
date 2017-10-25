<?php
if (!defined('API')):
    die('Nothing to do here ._.');
endif;

$config = array();

/*
 * Configuración basada en Eloquent Manage/Capsule
 */
$config['database_config'] = array(
    'driver' => config('database_config.driver', 'mysql'),
    'host' => config('database_config.host', 'localhost'),
    'database' => config('database_config.database', ''),
    'username' => config('database_config.username', ''),
    'password' => config('database_config.password', ''),
    'charset' => config('database_config.charset', 'utf8'),
    'collation' => config('database_config.collation', 'utf8_unicode_ci'),
    'prefix' => config('database_config.prefix', ''),
);

/**
 * Salts y peppers keys para la APP
 */
$config['secure'] = array(
    'salthash' => config('secure.salthash', '$$$$KEYsaltHashSuperSegura$$$$')
);

/*
 * Configuración para el entorno del API
 */
$config['api_config'] = array(
    'display_errors' => config('api_config.display_errors', 'Off'),
    'error_reporting' => config('api_config.error_reporting', 0),
    'base_uri' => config('api_config.base_uri',
        str_replace(array($_SERVER['DOCUMENT_ROOT'], '/..'), '', API)),
    'url_front' => config('api_config.url_front', 'http://www.dominio.com'),
    'mode_errors_api' => 'html', // Accepta json, array, text y html
    'lang' => 'es_CO',
    'lang_sess' => 'apilang', // Key in session for lang
    'mantenimiento' => false,
    'timezone' => 'America/Bogota'
);

/*
 * Configuración para Carga de archivos
 */
$config['uploads'] = array(
    'uploads_dir' => 'uploads/',
    'max_size' => 15728640
);

/*
 * Configuración basaada en RainTPL 3 para manejo de vistas
 */
$config['views_config'] = array(
    "tpl_dir" => API.'/app/vistas/',
    "cache_dir" => API.'/cache/rain/',
    "remove_comments" => true,
    "debug" => true,
    'tpl_ext' => 'tpl',
    "auto_escape" => false,
    "entrypoint" => "app"
);


/**
 * Configuración para envíos de correo
 */
$config['mailer'] = array(
    'mail_type' => 'mail', // Can be [mail, sendmail, smtp]
    'mail_from_name' => 'FromName',
    'mail_from_email' => 'no-reply@apirest.dom',
    'smtp_server' => '', // Only required for SMTP mail_type
    'smtp_port' => 25, // Only required for SMTP mail_type
    'smtp_auth' => false, // Only required for SMTP mail_type
    'smtp_user' => '', // Only required for SMTP mail_type and smtp_auth = true
    'smtp_password' => '', // Only required for SMTP mail_type and smtp_auth = true
    'smtp_secure' => '', // Only required for SMTP mail_type [ssl, tls]
    'smtp_debug' => 0 // Only required for SMTP mail_type [0, 1, 2]
);


return $config;
