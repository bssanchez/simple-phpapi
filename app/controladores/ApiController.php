<?php

namespace Controlador;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use Controlador\BaseController;

/**
 * Controlador de ejemplo
 *
 * @author Grafikamos <info@grafikamos.com>
 */
class ApiController extends BaseController
{
    const CONTROLADOR = 'api';

    /**
     * Prueba simple de uso de controlador en las rutas
     * 
     * @return string
     */
    public function getPruebaControlador()
    {
        return 'Controlador works!';
    }

    /**
     * Prueba de uso de controlador con parámetro en las rutas
     *
     * @param string $param
     * @return string
     */
    public function getPruebaControladorParam($param)
    {
        return 'Controlador con parámetro '.$param.' works!';
    }

    /**
     * 
     */
    public function getPruebaControladorVista()
    {
        $this->vista->render('api/vista');
    }
}