<?php

namespace Controlador;

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