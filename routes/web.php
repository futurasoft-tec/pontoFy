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
    // Colaboradores
    ColaboradoreController,
    DependenteController,
    DocumentoController,
    ContratoController,
    ClausulaContratoController,
    ClausulaController,
    PeriodosProcessamentoController,
    ConfiguracaoController,
    PoliticaPrivacidadeController,
    TermoController,
    RubricaController,
    FolhasSalarioController,
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




// =========PAGINA PUBLICA=========
// Politicas de Privacidade
Route::get('institucional/politica-de-prinvacidade', 
        [PoliticaPrivacidadeController::class, 'politicaPrivacidade'])
        ->name('politica.privacidade');

Route::get('institucional/termos-e-condicoes', 
        [TermoController::class, 'termosCondicoes'])
        ->name('termos.condicoes');




// ROUTAS DOS UTILIZADORES (COMPANY_CLIENTES)
Route::middleware(['auth', 'verified'])
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



    // ======================COLABORADORES======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('colaboradores/list', [ColaboradoreController:: class, 'index'])->name('colaboradores.index');
        Route::get('colaborador/create', [ColaboradoreController::class, 'create'])->name('colaborador.create');
        Route::post('colaborador/store', [ColaboradoreController:: class, 'store'])->name('colaborador.store');
        Route::get('colaborador/{id}/details', [ColaboradoreController:: class,'show'])->name('colaborador.show');
        Route::get('colaborador/{id}/edit', [ColaboradoreController:: class,'edit'])->name('colaborador.edit');
        Route::put('colaborador/{id}/update', [ColaboradoreController:: class,'update'])->name('colaborador.update');
        Route::delete('colaborador/{id}/delete', [ColaboradoreController:: class,'destroy'])->name('colaborador.destroy');
    });

    // ======================DEPENDENTE======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('dependentes/list', [DependenteController:: class, 'index'])->name('dependentes.index');
        Route::get('dependente/create', [DependenteController::class, 'create'])->name('dependente.create');
        Route::post('dependente/store', [DependenteController:: class, 'store'])->name('dependente.store');
        Route::get('dependente/{id}/details', [DependenteController:: class,'show'])->name('dependente.show');
        Route::get('dependente/{id}/edit', [DependenteController:: class,'edit'])->name('dependente.edit');
        Route::put('dependente/{id}/update', [DependenteController:: class,'update'])->name('dependente.update');
        Route::delete('dependente/{id}/delete', [DependenteController:: class,'destroy'])->name('dependente.destroy');
    });


    // ======================DOCUMENTOS======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('documentos/list', [DocumentoController:: class, 'index'])->name('documentos.index');
        Route::get('documento/create', [DocumentoController::class, 'create'])->name('documento.create');
        Route::post('documento/store', [DocumentoController:: class, 'store'])->name('documento.store');
        Route::get('documento/{id}/details', [DocumentoController:: class,'show'])->name('documento.show');
        Route::get('documento/{id}/edit', [DocumentoController:: class,'edit'])->name('documento.edit');
        Route::put('documento/{id}/update', [DocumentoController:: class,'update'])->name('documento.update');
        Route::delete('documento/{id}/delete', [DocumentoController:: class,'destroy'])->name('documento.destroy');
    });


    // ======================CONTRATOS======================
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('contratos/list', [ContratoController:: class, 'index'])->name('contratos.index');
        Route::get('contrato/create', [ContratoController::class, 'create'])->name('contrato.create');
        Route::post('contrato/store', [ContratoController:: class, 'store'])->name('contrato.store');
        Route::get('contrato/contrato-rascunho/{id}', [ContratoController:: class,'show'])->name('contrato.show');
        Route::get('contrato/{id}/add-clausulas', [ContratoController:: class,'addClausulas'])->name('add.clausulas');
        // Adicionar Clausulas ao Contrato
        Route::post('add-clausula-contrato/store', [ClausulaContratoController:: class, 'store'])->name('add-clausula-contrato.store');

        // Editar Clausula do Contrato especifico
        Route::put('/contratos/{contrato}/clausulas/{clausulaContrato}', [ClausulaContratoController::class, 'update'])
        ->name('clausula-contrato.update');



        Route::get('contrato/{id}/edit', [ContratoController:: class,'edit'])->name('contrato.edit');
        Route::put('contrato/{id}/update', [ContratoController:: class,'update'])->name('contrato.update');
     
        // Remoção  múltipla de Clausulas ao ocntrato especifico
        Route::delete('/contratos/{contrato}/clausulas', [ClausulaContratoController::class, 'destroyMultiple'])
        ->name('contrato.clausulas.destroy.multiple');

        // Converter contrato em PDF
        Route::get('/contratos/{id}/pdf', [ContratoController::class, 'gerarPdf'])->name('contratos.pdf');
       

        Route::delete('contrato/{id}/delete', [ContratoController:: class,'destroy'])->name('contrato.destroy');
    });



    // =======CLAUSULAS PERSONALIZADAS========
    Route::middleware(['auth', 'can:company_gestaoColaboradores'])->group(function(){
        Route::get('clausulas/list', [ClausulaController:: class, 'index'])->name('clausulas.index');
        Route::get('clausula/create', [ClausulaController::class, 'create'])->name('clausula.create');
        Route::post('clausula/store', [ClausulaController:: class, 'store'])->name('clausula.store');
        Route::get('clausula/{id}/details', [ClausulaController:: class,'show'])->name('clausula.show');
        Route::get('clausula/{id}/edit', [ClausulaController:: class,'edit'])->name('clausula.edit');
        Route::put('clausula/{id}/update', [ClausulaController:: class,'update'])->name('clausula.update');
        Route::delete('clausula/{id}/delete', [ClausulaController::class,'destroy'])->name('clausula.destroy');
    });


     // =======DEFINICAO DAS RUBRICAS========
    Route::middleware(['auth', 'can:company_admin_acesso'])->group(function(){
        Route::get('rubricas/list', [RubricaController:: class, 'index'])->name('rubricas.index');
        Route::get('rubrica/create', [RubricaController::class, 'create'])->name('rubrica.create');
        Route::post('rubrica/store', [RubricaController:: class, 'store'])->name('rubrica.store');
        Route::get('rubrica/{id}/details', [RubricaController:: class,'show'])->name('rubrica.show');
        Route::get('rubrica/{id}/edit', [RubricaController:: class,'edit'])->name('rubrica.edit');
        Route::put('rubrica/{id}/update', [RubricaController:: class,'update'])->name('rubrica.update');
        Route::delete('rubrica/{id}/delete', [RubricaController::class,'destroy'])->name('rubrica.destroy');
    });



    // =========== PERÍODOS DE PROCESSAMENTOS ===========
    Route::middleware(['auth', 'can:company_admin_acesso'])->group(function(){
        Route::get('periodos/list', [PeriodosProcessamentoController:: class, 'index'])->name('periodos.index');
        Route::get('periodo/create', [PeriodosProcessamentoController::class, 'create'])->name('periodo.create');
        Route::post('periodo/store', [PeriodosProcessamentoController:: class, 'store'])->name('periodo.store');
        Route::get('periodo/{id}/details', [PeriodosProcessamentoController:: class,'show'])->name('periodo.show');
        Route::get('periodo/{id}/edit', [PeriodosProcessamentoController:: class,'edit'])->name('periodo.edit');
        Route::put('periodo/{id}/update', [PeriodosProcessamentoController:: class,'update'])->name('periodo.update');
        Route::delete('periodo/{id}/delete', [PeriodosProcessamentoController::class,'destroy'])->name('periodo.destroy');
    });


    // =========== FOLHAS DE SALARIOS ===========
    Route::middleware(['auth', 'can:company_admin_acesso'])->group(function(){
        Route::get('folhas-de-salarios/list', [FolhasSalarioController:: class, 'index'])->name('salarios.index');
        Route::get('folha-de-salario/create', [FolhasSalarioController::class, 'create'])->name('salario.create');
        Route::post('folha-de-salario/store', [FolhasSalarioController:: class, 'store'])->name('salario.store');
        Route::get('folha-de-salario/{id}/details', [FolhasSalarioController:: class,'show'])->name('salario.show');
        Route::get('folha-de-salario/{id}/edit', [FolhasSalarioController:: class,'edit'])->name('salario.edit');
        Route::put('folha-de-salario/{id}/update', [FolhasSalarioController:: class,'update'])->name('salario.update');
        Route::delete('folha-de-salario/{id}/delete', [FolhasSalarioController::class,'destroy'])->name('salario.destroy');
    });














































    // =======CONFIGURACOES DO SYSTEMA========
    Route::middleware(['auth', 'can:company_admin_acesso'])->group(function(){
        Route::get('configuracoes/index', [ConfiguracaoController:: class, 'index'])->name('configuracoes.index');
        // Redifinir configuracoes
        Route::delete('clausula/{id}/delete', [ConfiguracaoController:: class,'destroy'])->name('clausula.destroy');
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
