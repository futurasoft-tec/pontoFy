<?php

use Illuminate\Support\Facades\Route;
use App\Services\RedirectUserService;
use App\Http\Controllers\{
    // PainelAdminControllerController,
    PainelClienteController,



    // Departamentos
    DepartamentoController,
    // Cargos
    CargoController,
    // Niveis de Hierqrquia
    NiveisHierarquicoController,
    // Categorias Profissionais
    CategoriaController,
};



// ======================REDIRECCIONAMENTO CORRETO PARA DASHBOARDD========================
// === DASHBOARD REDIRECT ===
Route::middleware(['auth'])->get('/dashboard', function (RedirectUserService $redirectUserService) {
    return $redirectUserService->handle();
})->name('dashboard');

Route::middleware(['auth'])->get('/', function (RedirectUserService $redirectUserService) {
    return $redirectUserService->handle();
});

// === DASHBOARDS ESPECÍFICOS ===
Route::middleware(['auth'])->get('/system/dashboard', function () {
    return view('system.painel.dashboard');
})->name('system.dashboard');

Route::middleware(['auth'])->get('/company/dashboard', function () {
    return view('company.painel.dashboard');
})->name('company.dashboard');









// ROUTAS DOS UTILIZADORES (COMPANY_CLIENTES)
Route::middleware(['auth'])
    ->prefix('app')
    ->group(function () {
    
    // Acesso ao painel do cliente (apenas company_admin)
   Route::get('/dashboard', [PainelClienteController::class, 'index'])
        ->middleware('can:company_admin_acesso')
        ->name('company.dashboard');
    

    // =================DEPARTAMENTOS================
    Route::middleware(['auth', 'can:company_gestaoDepartamentos'])->group(function () {
        Route::get('departamentos/list', [DepartamentoController:: class, 'index'])->name('departamentos.index');
        Route::get('departamento/create', [DepartamentoController:: class, 'create'])->name('departamento.create');
        Route::post('departamento/store', [DepartamentoController:: class, 'store'])->name('departamento.store');
        Route::get('departamento/{id}/edit', [DepartamentoController:: class, 'edit'])->name('departamento.edit');
        Route::put('update/{id}', [DepartamentoController:: class, 'update'])->name('departamento.update');
        Route::get('departamento/{id}/details', [DepartamentoController:: class, 'show'])->name('departamento.show');
        Route::delete('departamento/{id}/delete', [DepartamentoController:: class, 'destroy'])->name('departamento.destroy');
    });



    // ======================CARGOS======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('cargos/list', [CargoController:: class, 'index'])->name('cargos.index');
        Route::get('cargo/create', [CargoController::class, 'create'])->name('cargo.create');
        Route::post('cargo/store', [CargoController:: class, 'store'])->name('cargo.store');
        Route::get('cargo/{id}/details', [CargoController:: class,'show'])->name('cargo.show');
        Route::get('cargo/{id}/edit', [CargoController:: class,'edit'])->name('cargo.edit');
        Route::put('cargo/{id}/update', [CargoController:: class,'update'])->name('cargo.update');
        Route::delete('cargo/{id}/delete', [CargoController:: class,'destroy'])->name('cargo.destroy');
    });


    // ======================NIVEIS======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('nivel/list', [NiveisHierarquicoController:: class, 'index'])->name('niveis.index');
        Route::get('nivel/create', [NiveisHierarquicoController::class, 'create'])->name('nivel.create');
        Route::post('nivel/store', [NiveisHierarquicoController:: class, 'store'])->name('nivel.store');
        Route::get('nivel/{id}/details', [NiveisHierarquicoController:: class,'show'])->name('nivel.show');
        Route::get('nivel/{id}/edit', [NiveisHierarquicoController:: class,'edit'])->name('nivel.edit');
        Route::put('nivel/{id}/update', [NiveisHierarquicoController:: class,'update'])->name('nivel.update');
        Route::delete('nivel/{id}/delete', [NiveisHierarquicoController:: class,'destroy'])->name('nivel.destroy');
    });



     // ======================CATEGORIAS PROFISSIONAIS======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('categorias/list', [CategoriaController:: class, 'index'])->name('categorias.index');
        Route::get('categoria/create', [CategoriaController::class, 'create'])->name('categoria.create');
        Route::post('categoria/store', [CategoriaController:: class, 'store'])->name('categoria.store');
        Route::get('categoria/{id}/details', [CategoriaController:: class,'show'])->name('categoria.show');
        Route::get('categoria/{id}/edit', [CategoriaController:: class,'edit'])->name('categoria.edit');
        Route::put('categoria/{id}/update', [CategoriaController:: class,'update'])->name('categoria.update');
        Route::delete('categoria/{id}/delete', [CategoriaController:: class,'destroy'])->name('categoria.destroy');
    });

});













// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
