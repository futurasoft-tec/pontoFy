@include('company.erros.valida_erros')

@csrf
{{-- Layout Principal --}}
<div class="row g-4">
    {{-- Sidebar de Cláusulas --}}
    <div class="">

        {{-- Barra de Ações --}}
        {{-- Lista de Cláusulas --}}

        <div class="card border-0 shadow-sm">
            {{-- MENU CLASUSLAS --}}
            <div class="card rounded-0 border-0">
                <div class="card-header border p-3 d-flex justify-content-between align-items-center">
                    <h5 class="h6 fw-semibold text-dark mb-0">
                        <strong>Selecione as Clausulas</strong>
                    </h5>

                    <button class="btn-sm btn-active rounded-1" data-bs-toggle="modal"
                        data-bs-target="#createClausulaModal">
                        <i class="fas fa-plus"></i>
                        Nova Clausula
                    </button>
                </div>
                <p class="small p-1 text-center" style="font-size: 11px;">
                    Selecione as clausulas por tipo de contratos
                </p>



                <form action="{{ route('add-clausula-contrato.store') }}" method="POST" id="clausulasForm">
                    @csrf
                    <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                    <div class="card-body p-2 pt-0 mt-0">
                        <ul class="border-top table-responsive justify-content-center nav nav-pills nav-secondary"
                            id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-minhas-tab" data-bs-toggle="pill"
                                    href="#pills-minhas" role="tab" aria-controls="pills-minhas"
                                    aria-selected="true">Minhas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-trabalho-tab" data-bs-toggle="pill" href="#pills-trabalho"
                                    role="tab" aria-controls="pills-trabalho" aria-selected="false">Trabalho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-servicos-tab" data-bs-toggle="pill" href="#pills-servicos"
                                    role="tab" aria-controls="pills-servicos" aria-selected="false">Serviços</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-outros-tab" data-bs-toggle="pill" href="#pills-outros"
                                    role="tab" aria-controls="pills-outros" aria-selected="false">Outras</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-0 " id="pills-tabContent">
                            {{-- CLAUSULAS DO TEAM AUTENTICADO --}}
                            <div class="tab-pane fade show active" id="pills-minhas" role="tabpanel"
                                aria-labelledby="pills-minhas-tab">
                                <h3 class="h5 mt-3 text-center"><strong>Minhas Clausulas</strong></h3>
                                <div class="border card card-body rounded-0 clausulas-list"
                                    style="max-height: 600px; overflow-y: auto;">
                                    @if ($minhasClausulas->isEmpty())
                                        {{-- Mensagem Lista vazia --}}
                                        @include('company.contratos.mensagem-vazio')
                                    @else
                                        @foreach ($minhasClausulas as $clausula)
                                            {{-- Lista das clausulas --}}
                                            @include('company.contratos.lista-clausulas')
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            {{-- CLAUSULAS PARA CONTRATOS DE TRABALHO --}}
                            <div class="tab-pane fade" id="pills-trabalho" role="tabpanel"
                                aria-labelledby="pills-trabalho-tab">
                                <h3 class="h5 mt-3 text-center">Clausulas para Contratos de trabalho</h3>
                                <div class="border card card-body rounded-0 clausulas-list"
                                    style="max-height: 600px; overflow-y: auto;">
                                    @if ($clausulasTrabalho->isEmpty())
                                        {{-- Mensagem Lista vazia --}}
                                        @include('company.contratos.mensagem-vazio')
                                    @else
                                        @foreach ($clausulasTrabalho as $clausula)
                                            {{-- Lista das clausulas --}}
                                            @include('company.contratos.lista-clausulas')
                                        @endforeach
                                    @endif
                                </div>
                            </div>


                            {{-- CLAUSULAS PARA CONTRATOS DEICOS --}}
                            <div class="tab-pane fade" id="pills-servicos" role="tabpanel"
                                aria-labelledby="pills-servicos-tab">
                                <div class="border card card-body rounded-0 clausulas-list"
                                    style="max-height: 600px; overflow-y: auto;" class="clausulas-list">
                                    <h3 class="h5 mt-3 text-center">Clausulas para Contratos de Serviços</h3>
                                    @if ($clausulasServicos->isEmpty())
                                        {{-- Mensagem Lista vazia --}}
                                        @include('company.contratos.mensagem-vazio')
                                    @else
                                        @foreach ($clausulasServicos as $clausula)
                                            {{-- Lista das clausulas --}}
                                            @include('company.contratos.lista-clausulas')
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            {{-- CLAUSULAS PARA OUTROS TIPOS DE CONTRATOS --}}
                            <div class="tab-pane fade" id="pills-outros" role="tabpanel"
                                aria-labelledby="pills-outros-tab">
                                <div class="clausulas-list border card card-body rounded-0 clausulas-list"
                                    style="max-height: 600px; overflow-y: auto;">
                                    <h3 class="h5">Outras Clausulas</h3>
                                    @if ($OutrasClausulas->isEmpty())
                                        {{-- Mensagem Lista vazia --}}
                                        @include('company.contratos.mensagem-vazio')
                                    @else
                                        @foreach ($OutrasClausulas as $clausula)
                                            {{-- Lista das clausulas --}}
                                            @include('company.contratos.lista-clausulas')
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light border-top text-center">
                        <button type="submit" class="btn btn-active  rounded-2">
                            <i class="bi bi-check-lg me-2"></i>AConfirmar Cláusulas Selecionadas
                        </button>
                    </div>
                </form>
            </div>
            {{-- FIM MENU CLAUSULAS --}}
        </div>

    </div>
</div>




{{-- ICNLUDE MODAL EDITAR CLAUSULA AO CONTRATO --}}
@include('company.contratos.update-clausula-contrato')

{{-- INCLUDE MODAL DETALHES CLAUSULAS --}}
@include('company.contratos.details-clausula')
{{-- INCLUDE MODAL CREATE CLAUSULA --}}
@include('company.contratos.create-clausulas')

<style>
    .fw-600 {
        font-weight: 600;
    }

    .fw-700 {
        font-weight: 700;
    }

    .space-y-3>*+* {
        margin-top: 0.75rem;
    }

    .clausula-item {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .clausula-item:hover {
        background-color: #f8fafc;
    }

    .clausula-item:last-child {
        border-bottom: none !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .contrato-preview {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.7;
        color: #334155;
    }

    .clausula-contrato {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .clausula-contrato:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .mb-8 {
        margin-bottom: 2rem;
    }

    .mt-8 {
        margin-top: 2rem;
    }

    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
</style>
