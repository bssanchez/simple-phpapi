<?php

namespace Controlador;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

/**
 * Controlador base del que pueden o no extender los  controladores de la aplicación
 *
 * @author Grafikamos <info@grafikamos.com>
 */
abstract class BaseController
{
    protected $vista    = null;
    protected $lenguaje = null;

    public function __construct()
    {
        $controlador = defined('static::CONTROLADOR') ? static::CONTROLADOR : null;
        /**
         * Cargar vista en la variable
         */
        $this->vista = new \System\Vista($controlador, $this->lenguaje);
    }
}