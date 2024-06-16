<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PaginaInicialController extends BaseController
{
    public function login()
    {
        return view('paginaInicial'); 
    }
}
