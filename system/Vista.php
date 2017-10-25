<?php
/*
  |--------------------------------------------------------------------------
  | Viewer APP
  |--------------------------------------------------------------------------
  |
  | Sistema de renderizado de plantillas
  |
 */

namespace System;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use Rain\Tpl;
use Spyc;

/**
 * Clase para el renderizado de vistas usando la librería RainTPL 3
 *
 * @author Grafikamos <info@grafikamos.com>
 */
class Vista extends Tpl
{
    private $lang             = '';
    private $controlador      = null;
    private $templateFilePath = '';

    public function __construct($controlador = null, $lang = null)
    {
        $tpl_config             = Config::get('views_config');
        $tpl_config['base_url'] = Config::get('api_config.url_front').'/';

        unset($tpl_config['entrypoint']);

        $this->lang        = ($lang !== null) ? $lang : Config::get('api_config.lang');
        $this->controlador = $controlador;

        $this->configure($tpl_config);
    }

    /**
     * Función para renderizar la vista
     *
     * @param string $contenido Contenido interno asignado a la variable {$contenido_vista}
     * @param string $templateFilePath Ruta para renderizar vista distinta a la asignada en el config
     * @param boolean $returnString true si se quiere que retorne el contenido HTML o false para imprimir
     * @return string
     */
    public function render($contenido, $templateFilePath = null,
                           $returnString = false)
    {
        $this->preloadData();
        $this->templateFilePath = ($templateFilePath === null) ? $this->templateFilePath
                : $templateFilePath;

        $this->assign('contenido_vista', $contenido);

        if ($returnString) {
            return $this->draw($this->templateFilePath, $returnString);
        }

        if (isset($_SESSION['with']) && !is_null($_SESSION['with'])) {
            $this->assign($_SESSION['with']);
            unset($_SESSION['with']);
        }

        $this->draw($this->templateFilePath);
    }

    /**
     * Precarga de datos esenciales para la aplicación en las vistas:
     * - controlador ( controlador asignado como constante en el controlador actual )
     * - request ( request [ base_url, actual_url, base_uri, actual_uri ] )
     * - apivars ( todas las variables asignadas )
     * - lenguaje ( lmod -> por módulo, lapp -> aplicación en general )
     */
    private function preloadData()
    {
        $lmod = file_exists(API.'/app/lenguaje/'.$this->lang.'/'.$this->controlador.'.yml')
                ? Spyc::YAMLLoad(API.'/app/lenguaje/'.$this->lang.'/'.$this->controlador.'.yml')
                : array();
        $lapp = file_exists(API.'/app/lenguaje/'.$this->lang.'/global.yml') ? Spyc::YAMLLoad(API.'/app/lenguaje/'.$this->lang.'/app.yml')
                : array();

        $this->assign('controlador', $this->controlador);
        $this->assign('lmod', $lmod);
        $this->assign('lapp', $lapp);
        $this->assign('get', filter_input_array(INPUT_GET));

        $this->assign('request', request());

        $this->templateFilePath = Config::get('views_config.entrypoint');
        $this->assign('apivars', json_encode($this->var));
    }
}