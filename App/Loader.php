<?php

namespace App;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

/* Remove if not required -> */

use Illuminate\Database\Capsule\Manager as Capsule;
// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use MiladRahimi\PHPRouter\Router;
use Exception;

/*
  |--------------------------------------------------------------------------
  | Loader APP
  |--------------------------------------------------------------------------
  |
  | Load all libraries and boot the application
  |
 */

class Loader
{
    /*
      |--------------------------------------------------------------------------
      | Run database
      |--------------------------------------------------------------------------
      |
      | Use Eloquent ORM for database management.
      |
     */

    private function BootDatabase()
    {
        $capsule = new Capsule;
        $capsule->addConnection(Config::$database_config);

        $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
    /*
      |--------------------------------------------------------------------------
      | Run routing
      |--------------------------------------------------------------------------
      |
      | Use Klein PHP for routing services.
      |
     */

    public function Run()
    {
        // Create brand new Router instance
        $router = new Router(Config::$api_config['base_uri']);
        try {
            if (isset(Config::$database_config) && isset(Config::$database_config['database']{1})) {
                $this->BootDatabase();
            }

            require_once API.'/app/Routes.php';
            $router->dispatch();
        } catch (Exception $e) {
            $data = new ApiException($e->getMessage(), $e->getCode(),
                $e->getPrevious());
            $router->publish($data->GetFormatted());
        }
    }
}