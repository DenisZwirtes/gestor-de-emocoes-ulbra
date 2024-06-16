<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaginaInicialController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\GerenciarController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/auth-login', [LoginController::class, 'loginShow'])->name('authlogin');
Route::post('/login-index', [LoginController::class, 'login'])->name('login');
Route::post('/login-cadastro-usuario', [LoginController::class, 'cadastrarUsuario'])->name('cadastroUsuarioLogin');
Route::get('/link-cadastro-usuario', [LoginController::class, 'linkCadastroUsuario'])->name('linkCadastroUsuario');

Route::middleware(['check.usuario'])->group(function () {
Route::get('/login-mensagem', [LoginController::class, 'loginIndexMensagem'])->name('loginIndexMensagem');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/inicio', [PaginaInicialController::class, 'login'])->name('paginaInicial');
Route::get('/upload-foto', [FotoController::class, 'mostrarFormulario'])->name('mostrarFormulario');
Route::post('/upload-foto', [FotoController::class, 'uploadFoto'])->name('uploadFoto');
Route::post('/upload-foto-perfil', [FotoController::class, 'uploadFoto'])->name('uploadFoto');
Route::get('/perfil', [PerfilController::class,'index'])->name('opcaoPerfil');
Route::post('/salvar-perfil', [PerfilController::class,'salvarPerfil'])->name('salvarPerfil');
Route::get('/status', [StatusController::class,'getStatus'])->name('opcaoStatus');
Route::post('/verificar-status', [StatusController::class,'getStatus'])->name('verificarStatus');
Route::get('/gerenciar', [GerenciarController::class,'index'])->name('opcaoGerenciar');
Route::post('/gerenciar-area', [GerenciarController::class,'gerenciarArea'])->name('opcaoGerenciarArea');
});

Route::middleware(['check.admin'])->group(function () {
Route::get('/admin', [AdminController::class, 'index'])->name('opcaoMensagemAdmin');
Route::get('/viewEditarMensagem/{grupo_mensagem?}', [AdminController::class, 'redirecionarViewEditarMensagem'])->name('viewEditarMensagem');
Route::get('/viewInserirMensagem', [AdminController::class, 'redirecionarViewInserirMensagem'])->name('viewInserirMensagem');
Route::post('/admin-editar', [AdminController::class, 'editarMensagem'])->name('editarMensagem');
Route::post('/admin-inserir', [AdminController::class, 'inserirMensagem'])->name('inserirMensagem');
Route::get('/admin-excluir/{grupoMensagem?}', [AdminController::class, 'excluirMensagem'])->name('excluirMensagem');
});

Route::get('/admin/erro-autorizacao', function () {
    return view('admin.erroAutorizacao')->with('erroAutorizacao', 'Você não está autorizado para acessar esta página!');
})->name('admin.erroAutorizacao');





