@extends('layouts.company-main')
@section('title', 'Historico - ' . $colaborador->nome_completo . ' - ' . 'PontoFy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1">Colaboradores</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('colaboradores.index') }}">Colaboradores</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Detalhe</a>
                            </li>

                            <li class="breadcrumb-item">
                                #{{ $colaborador->id }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex ms-md-autoA py-2 py-md-0 mt-0">
                    <a href="{{ route('colaboradores.index') }}" class="btn-outline-active rounded-1">
                        <i class="fas fa-reply"></i>
                        <span class="d-none d-sm-inline-block">Voltar</span>
                    </a>
                    <a href="{{ route('colaborador.edit', $colaborador->id) }}" class="btn-outline-active rounded-1 ms-1">
                        <i class="fas fa-edit"></i>
                        <span class="d-none d-sm-inline-block">Editar</span>
                    </a>
                    <button class="btn btn btn-danger  ms-1 rounded-1" style="padding: 0.7rem; auto" data-bs-toggle="modal"
                        data-bs-target="#deleteConfirmModal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <!--fim header-->


            {{-- Exibir erros validados --}}
            @include('company.erros.valida_erros')

            {{-- DETALHES --}}
            <section class="mt-3 rounded-0">
                <div class="col-md-12">
                    <div class="card-header mb-0">
                        <h4 class="card-active mb-0">Ficha do Colaborador</h4>
                    </div>
                    <div class="mt-0 rounded-1">
                        <div class="card-body pt-0">
                            <ul class="nav nav-tabs nav-line nav-color-secondary" id="line-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active pt-0 pb-0 me-3" id="line-dados-tab" data-bs-toggle="pill" href="#line-dados"
                                        role="tab" aria-controls="pills-dados" aria-selected="true">Dados</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pt-0 pb-0 me-3" id="line-categ-profissionais-tab" data-bs-toggle="pill"
                                        href="#line-categ-profissionais" role="tab"
                                        aria-controls="pills-categ-profissionais" aria-selected="false">Categoria</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pt-0 pb-0 me-3" id="line-documentos-tab" data-bs-toggle="pill"
                                        href="#line-documentos" role="tab" aria-controls="pills-documentos"
                                        aria-selected="false">Documentos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pt-0 pb-0 me-3" id="line-contratos-tab" data-bs-toggle="pill"
                                        href="#line-contratos" role="tab" aria-controls="pills-contratos"
                                        aria-selected="false">Contratos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pt-0 pb-0 me-3" id="line-dependentes-tab" data-bs-toggle="pill"
                                        href="#line-dependentes" role="tab" aria-controls="pills-dependentes"
                                        aria-selected="false">Depedentes</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pt-0 pb-0 me-3" id="line-financeiro-tab" data-bs-toggle="pill"
                                        href="#line-financeiro" role="tab" aria-controls="pills-financeiro"
                                        aria-selected="false">Financeiro</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link pt-0 pb-0 me-3" id="line-assiduidade-tab" data-bs-toggle="pill"
                                        href="#line-assiduidade" role="tab" aria-controls="pills-assiduidade"
                                        aria-selected="false">Assiduidade</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-3 mb-3" id="line-tabContent">
                                <!--Dados Pessoais-->
                                <div class="tab-pane fade show active" id="line-dados" role="tabpanel"
                                    aria-labelledby="line-dados-tab">
                                    @include('company.colaboradores.gestao.dados-pessoais')
                                </div>

                                <!--Categorias-->
                                <div class="tab-pane fade" id="line-categ-profissionais" role="tabpanel"
                                    aria-labelledby="line-categ-profissionais-tab">
                                    <div class="card mt-0 rounded-0">
                                        <div class="card-body">
                                            @include('company.colaboradores.gestao.categoria-profissional')
                                        </div>
                                    </div>
                                </div>

                                <!--Documentos-->
                                <div class="tab-pane fade" id="line-documentos" role="tabpanel"
                                    aria-labelledby="line-documentos-tab">
                                    <div class="card mt-0 rounded-0">
                                        <div class="card-body">
                                            @include('company.documentos.index')
                                        </div>
                                    </div>
                                </div>

                                <!--Contratos-->
                                <div class="tab-pane fade" id="line-contratos" role="tabpanel"
                                    aria-labelledby="line-contratos-tab">
                                    <div class="card mt-0 rounded-0">
                                        <div class="card-body">
                                            @include('company.colaboradores.contratos.lista-contratos')
                                        </div>
                                    </div>
                                </div>

                                <!--Dependentes-->
                                <div class="tab-pane fade" id="line-dependentes" role="tabpanel"
                                    aria-labelledby="line-dependentes-tab">
                                    @include('company.colaboradores.dependentes.index')
                                </div>

                                <!--Financeiro-->
                                <div class="tab-pane fade" id="line-financeiro" role="tabpanel"
                                    aria-labelledby="line-financeiro-tab">
                                    @include('company.colaboradores.financeiro.index')
                                </div>

                                <!--Assiduidade-->
                                <div class="tab-pane fade" id="line-assiduidade" role="tabpanel"
                                    aria-labelledby="line-assiduidade-tab">
                                    <div class="card mt-0 rounded-0">
                                        <div class="card-body">
                                            @include('company.colaboradores.gestao.assiduidade')
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </section>



            <!-- Modal de Confirmação de Eliminação -->
            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-danger text-white border-0">
                            <h5 class="modal-title" id="deleteConfirmLabel">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmação de Exclusão
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Fechar"></button>
                        </div>

                        <div class="modal-body text-center py-4">
                            <i class="bi bi-trash3 text-danger display-5 mb-3"></i>
                            <h5 class="mb-3">Tem certeza que deseja eliminar este registo?</h5>
                            <p class="text-muted mb-0">Esta ação não poderá ser desfeita.Será removido permanentemente.</p>
                        </div>

                        <div class="modal-footer justify-content-center border-0 pb-4">
                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </button>

                            <form method="POST" action="{{ route('colaborador.destroy', $colaborador->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4">
                                    <i class="bi bi-trash me-1"></i> Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL EXLUIR --}}
    </main>

@endsection
