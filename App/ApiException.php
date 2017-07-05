<?php

namespace App;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use Exception;

/**
 * Description of ApiException
 *
 * @author Grafikamos <info@grafikamos.com>
 */
class ApiException extends Exception
{
    /*
      |--------------------------------------------------------------------------
      | Get Exception ARRAY
      |--------------------------------------------------------------------------
      |
      | Get exception in ARRAY fromat
      | @return array
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

    /*
      |--------------------------------------------------------------------------
      | Get Exception JSON
      |--------------------------------------------------------------------------
      |
      | Get exception in JSON fromat
      | @return string
     */
    public function GetJsonFormat() {
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
    public function GetHtmlFormat() {
        return sprintf(
            '<strong>Error %s: </strong> %s <br><pre>%s</pre><br>(File %s in line %s)', 
            $this->getCode(),
            $this->getMessage(),
            $this->getTraceAsString(),
            $this->getFile(),
            $this->getLine()
        );
    }

    /*
      |--------------------------------------------------------------------------
      | Get Exception TEXT
      |--------------------------------------------------------------------------
      |
      | Get exception in TEXT fromat
      | @return string
     */
    public function GetTextFormat() {
        return sprintf(
            'Error %s: %s (%s) File %s in line %s', 
            $this->getCode(),
            $this->getMessage(),
            $this->getTraceAsString(),
            $this->getFile(),
            $this->getLine()
        );
    }

    public function GetFormatted() {
      switch (Config::$api_config['mode_errors_api']) {
        case 'array':
            return $this->GetArrayFormat();
            break;
        case 'json':
            return $this->GetJsonFormat();
            break;
        case 'text':
            return $this->GetTextFormat();
            break;
        case 'html':
        default:
            return $this->GetHtmlFormat();
            break;
        }
    }
}