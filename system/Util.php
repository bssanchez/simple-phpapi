<?php
/*
  |--------------------------------------------------------------------------
  | Utils APP
  |--------------------------------------------------------------------------
  |
  | Funciones de biblioteca para uso en la aplicación
  |
 */
if (!defined('API')):
    die('Nothing to do here ._.');
endif;

/**
 * Imprimir datos preformateados con print_r
 * 
 * @param mixed $var Variable a imprimir
 * @param boolean $exit Detener al impimir
 */
function __P($var, $exit = true)
{
    echo '<pre>';
    print_r($var);

    if ($exit) {
        die('</pre>');
    }

    echo '</pre>';
}

/**
 * Dump datos preformateados con var_dump
 *
 * @param mixed $var Variable a imprimir
 * @param boolean $exit Detener al impimir
 */
function __V($var, $exit = true)
{
    echo '<pre>';
    var_dump($var);

    if ($exit) {
        die('</pre>');
    }

    echo '</pre>';
}

/**
 * Redireccionar al path especificado
 *
 * @param string $path path al cuál se desea acceder
 * @param mixed $with Datos que deben estar al momento de redireccionar
 */
function redirect($path, $with = null)
{
    $url = System\Config::get('api_config.url_front');
    $url = rtrim($url, '/');

    $_SESSION['with'] = $with;

    header('Location: '.$url.$path);
    exit;
}

/**
 * Obtener URLs y URIs comunes para usos comunes
 * 
 * @return array
 */
function request()
{
    $config   = System\Config::get('api_config');
    $base_uri = ($config['base_uri'] == '/') ? '' : $config['base_uri'];

    return array(
        'base_url' => rtrim(System\Config::get('api_config.url_front'), '/'),
        'actual_url' => (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
        'base_uri' => System\Config::get('api_config.base_uri'),
        'actual_uri' => str_replace($base_uri, '', $_SERVER['REQUEST_URI'])
    );
}

/**
 * Genera array con los datos formateados para jquery datatables
 *
 * @param mixed $records Lista de registros en array
 * @param int $draw Variable que define la cantidad de veces que se ha llamado la función
 * @param int $total Cantidad de registros totales
 * 
 * @return string/json 
 */
function datatables($records, $draw, $total)
{
    $rtn = array(
        "draw" => (int) $draw,
        "recordsTotal" => $total,
        "recordsFiltered" => count($records),
        'data' => $records
    );

    return json_encode($rtn);
}

/**
 * Genera un UUID único para manejo de ids en forma de texto
 *
 * @return string
 */
function getUUID()
{
    $tmpUUID = md5(uniqid(rand(), true));

    $UUID = substr($tmpUUID, 0, 8).'-'.substr($tmpUUID, 8, 4).'-'
        .substr($tmpUUID, 12, 4).'-'.substr($tmpUUID, 16, 4).'-'
        .substr($tmpUUID, 20);

    return $UUID;
}

/**
 * Método de hasheo para la aplicación
 * 
 * @param string $contrasenia texto a hashear
 * @param boolean $plain si el texto viene plano, falso en md5
 * @return string
 */
function __Hash($contrasenia, $plain = true)
{
    if ($plain) {
        $contrasenia = md5($contrasenia);
    }
    return sha1(base64_encode($contrasenia.App\Config::$secure['salthash']));
}

/**
 * Retorna variables enviadas en el cuerpo de una petición INPUT
 *
 * @param boolean $json Si los datos vienen en json
 * @return mixed datos formateados
 */
function __INPUT($json = true)
{
    $input = null;
    $fgc   = file_get_contents('php://input');
    if (!empty($fgc)) {
        $input = $json ? json_decode($fgc) : $fgc;
    }

    return $input;
}

/**
 * Obtener configuración del archivo .config
 *
 * @param string $key Ruta del dato de la configuración separado por puntos
 * @param mixed $default Datos por default en caso de no existir
 * @return mixed variable value
 */
function config($key, $default = null)
{
    $data = $default;
    if (file_exists(API.'/.config') && !empty($key)) {
        $data      = Spyc::YAMLLoad(API.'/.config');
        $key_route = explode('.', $key);

        foreach ($key_route as $kr) {
            $data = isset($data[$kr]) ? $data[$kr] : $default;
        }
    }

    return $data;
}
