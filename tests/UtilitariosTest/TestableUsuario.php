<?php

namespace Tests\UtilitariosTest;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use App\Models\Usuario;

class TestableUsuario extends Usuario implements AuthenticatableContract
{
    use Authenticatable;
}
