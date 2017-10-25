<?php
/*
  |--------------------------------------------------------------------------
  | Loader APP
  |--------------------------------------------------------------------------
  |
  | Carga todas las librerías y ejecuta la aplicación
  |
 */

namespace System;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use Illuminate\Database\Capsule\Manager as Capsule;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use MiladRahimi\PHPRouter\Router;
use Exception;

/**
 * Clase que carga y ejecuta toda la aplicación
 *
 * @author Grafikamos <info@grafikamos.com>
 */
class Loader
{

    /**
     * Inicializa la base de datos si es necesario hacer uso de ella
     */
    private function BootDatabase()
    {
        $capsule = new Capsule;
        $capsule->addConnection(Config::get('database_config'));

        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }

    /**
     * A través del sistema de rutas ejecuta las acciones requeridas
     */
    public function Run()
    {
        // Create brand new Router instance
        $router = new Router(Config::get('api_config.base_uri'));
        
        try {
            if (!is_null(Config::get('database_config')) && !is_null(Config::get('database_config.database'))
                && !empty(Config::get('database_config.database'))) {
                $this->BootDatabase();
            }

            require_once API.'/system/Routes.php';
            $router->dispatch();
        } catch (Exception $e) {
            $data = new ApiException($e->getMessage(), $e->getCode(),
                $e->getPrevious());
            $router->publish($data->GetFormatted());
        }
    }
}