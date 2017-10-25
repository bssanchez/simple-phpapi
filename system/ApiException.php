<?php
/*
  |--------------------------------------------------------------------------
  | Exception APP
  |--------------------------------------------------------------------------
  |
  | Manejo de excepciones de la aplicación
  |
 */

namespace System;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use Exception;

/**
 * Clase para el manejo de excepciones
 *
 * @author Grafikamos <info@grafikamos.com>
 */
class ApiException extends Exception
{

    /**
     * Obtener Excepción en forma de array
     *
     * @return array
     */
    public function GetArrayFormat()
    {
        return array(
            'error' => 1,
            'codigo' => $this->getCode(),
            'mensaje' => $this->getMessage(),
            'trace' => $this->getTraceAsString(),
            'linea' => sprintf('File: %s line %s', $this->getFile(),
                $this->getLine())
        );
    }

    /**
     * Obtener Excepción en formato JSON
     *
     * @return string/json
     */
    public function GetJsonFormat()
    {
        return json_encode($this->GetArrayFormat());
    }
    /*
      |--------------------------------------------------------------------------
      | Get Exception HTML
      |--------------------------------------------------------------------------
      |
      | Get exception in HTML fromat
      | @return string
     */

    /**
     * Obtener Excepción en formato HTML
     *
     * @return string/html
     */
    public function GetHtmlFormat()
    {
        return sprintf(
            '<strong>Error %s: </strong> %s <br><pre>%s</pre><br>(File %s in line %s)',
            $this->getCode(), $this->getMessage(), $this->getTraceAsString(),
            $this->getFile(), $this->getLine()
        );
    }

    /**
     * Obtener Excepción en formato TEXTO
     *
     * @return string
     */
    public function GetTextFormat()
    {
        return sprintf(
            'Error %s: %s (%s) File %s in line %s', $this->getCode(),
            $this->getMessage(), $this->getTraceAsString(), $this->getFile(),
            $this->getLine()
        );
    }

    /**
     * Retorna las excepciones según esté asignado en el archivo de configuración
     *
     * @return mixed
     */
    public function GetFormatted()
    {
        switch (Config::get('api_config.mode_errors_api')) {
            case 'array':
                return $this->GetArrayFormat();
            case 'json':
                return $this->GetJsonFormat();
            case 'text':
                return $this->GetTextFormat();
            case 'html':
            default:
                return $this->GetHtmlFormat();
        }
    }
}