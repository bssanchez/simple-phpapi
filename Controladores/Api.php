<?php

namespace Controlador;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

class Api
{
    public function PruebaControlador()
    {
        return 'Controllers works!';
    }

    public function GetData($id) {
        return 'Get Post with ID: ' . $id . ' works!';
    }
}