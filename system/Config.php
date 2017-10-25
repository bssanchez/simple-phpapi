<?php
/*
  |--------------------------------------------------------------------------
  | Config APP
  |--------------------------------------------------------------------------
  |
  | Función para cargar y distribuir los datos de configuración
  |
 */

namespace System;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

class Config
{

    /**
     * Obtener valor de configuracion por ruta llamada a través del $key
     *
     * @param string $key Ruta del dato de la configuración separado por puntos
     * @return mixed
     */
    public static function get($key = null)
    {
        $config = require API.'/app/config.php';
        
        if (is_null($key)) {
            return $config;
        }

        $data      = $config;
        $key_route = explode('.', $key);

        foreach ($key_route as $kr) {
            $data = isset($data[$kr]) ? $data[$kr] : null;
        }

        return $data;
    }
}