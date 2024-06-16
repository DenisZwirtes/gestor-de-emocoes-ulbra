<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\UtilitariosTest\UsuarioTestBuilder;

class AdminControllerTest extends TestCase
{
    private $usuarioAdmin;
    private $usuarioNormal;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuarioAdmin = (new UsuarioTestBuilder())
            ->comTipoUsuario('admin')
            ->salvar();

        $this->usuarioNormal = (new UsuarioTestBuilder())
        ->comTipoUsuario('normal')
        ->salvar();
    }

    protected function tearDown(): void
    {
        (new UsuarioTestBuilder($this->usuarioAdmin->email))->excluir();
        (new UsuarioTestBuilder($this->usuarioNormal->email))->excluir();
        parent::tearDown();
    }

    public function testUsuarioAdmin(): void
    {
        $loginData = [
            'nome' => $this->usuarioAdmin->nome,
            'email' => $this->usuarioAdmin->email,
            'senha' => $this->usuarioAdmin->senha,
        ];

        $this->post('/login-index', $loginData);
        $this->actingAs($this->usuarioAdmin);

        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

    public function testUsuarioNormal(): void
    {
        $loginData = [
            'nome' => $this->usuarioNormal->nome,
            'email' => $this->usuarioNormal->email,
            'senha' => $this->usuarioNormal->senha,
        ];

        $this->post('/login-index', $loginData);
        $this->actingAs($this->usuarioNormal);

        $response = $this->get('/admin');
        $response->assertStatus(401);
    }
}
