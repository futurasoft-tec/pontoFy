@extends('layouts.company-main')
@section('title', 'Contratos - PontoFy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1">Contratos</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="">Lista</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('colaboradores.index') }}" class="btn-active btn-round" data-bs-toggle="modal"
                        data-bs-target="#createContratoModal">
                        <i class="fas fa-plus-square"></i>
                        <span class="d-none d-sm-inline-block ms-2">Novo</span>
                    </a>
                </div>
            </div>
            <!--fim header-->


            <div class="card card-body mb-3 mt-0 rounded-0">
                {{-- Exibir erros validados --}}
                @include('company.erros.valida_erros')
                <h5 class="mb-1 text-active">
                    <strong>Filtrar</strong>
                </h5>
                <form action="" method="GET">
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="searchColaborador" class="small" style="font-size: 10px;">Buscar
                                    Colaborador</label>
                                <br>
                                <select name="searchColaborador" id="" class="form-select form-select-sm">
                                    <option value="">Todos Colaboradores</option>
                                    @foreach ($colaboradores as $colab)
                                        <option value="{{ $colab->id }}" class="small">{{ $colab->nome_completo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="searchCode" class="small" style="font-size: 10px;">Nº do Contrato</label>
                                <input type="number" id="searchCode" name="searchCode" placeholder="0000000001"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="seacrhDataStart" class="small" style="font-size: 10px;">Data Inicial</label>
                                <input type="date" id="seacrhDataStart" name="seacrhDataStart"
                                    placeholder="Procurar por Nome" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="seacrhDataEnd" class="small" style="font-size: 10px;">Data Final</label>
                                <input type="date" id="seacrhDataEnd" name="seacrhDataEnd"
                                    placeholder="Procurar por Nome" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="text-end pt-3 pb-3">
                        <a href="{{ route('contratos.index') }}" class="btn btn-outline-active me-2">
                            Limpar
                        </a>
                        <button type="submit" class="btn btn-active">
                            Aplicar
                        </button>
                    </div>
                </form>
            </div>



            {{-- ULTIMOS PROCESSAMENTOS --}}
            <section class="mt-3 rounded-0">
                <div class="card-header card bg-white border-bottom-0 text-activ rounded-top-1 ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-active"><strong>Lista</strong></h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>
                <div class="card card-body rounded-0 bg-white">
                    @if ($contratos->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4 ">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">Nenhum Departamento Criado</h5>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-active rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#createContratoModal">
                                    <i class="ri-user-add-line me-2"></i>Criar Novo Contrato
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover mb-0 small table-sm align-middle">
                                <thead class="">
                                    <tr>
                                        <th class="py-1"> <b>Código</b> </th>
                                        <th class="py-1"><b>Colaborador</b></th>
                                        <th class="py-1 text-end"><b>Status</b></th>
                                        <th class="py-1 text-end"><b>Data de Início</b></th>
                                        <th class="py-1 text-center"><b>Data de Fim</b></th>
                                        <th class="py-1 text-center"><b>Salário Base</b></th>
                                        <th class="py-1 text-end" style="width: 100px;"><b>Acções</b></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($contratos as $contrato)
                                        <tr>
                                            <td class="py-1 small">
                                                {{ $contrato->codigo }}
                                            </td>
                                            <td class="py-1 small">
                                                <a href="{{ route('colaborador.show', $contrato->id) }}">
                                                    {{ $contrato->colaborador->nome_completo }}
                                                </a>
                                            </td>
                                            <td class="py-1 small text-center">
                                                {{ $contrato->status }}
                                            </td>
                                            <td class="py-1 small text-center">
                                                {{ $contrato->data_inicio->format('d/m/Y') }}
                                            </td>
                                            <td class="py-1 small text-center">
                                                {{ $contrato->data_fim->format('d/m/Y') }}
                                            </td>
                                            <td class="py-1 small text-end">
                                                {{ number_format($contrato->salario_base, 2, ',', '.') }}
                                            </td>
                                            <td class="py-1 small text-end">
                                                @if ($contrato->status === 'rascunho')
                                                    <a href="{{ route('contrato.edit', $contrato->id) }}"
                                                        class="text-primary me-2" data-bs-toggle="modal"
                                                        data-bs-target="#editContratoModal{{ $contrato->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- Vizualizar Rascunho --}}
                                                    <a href="{{ route('contrato.rascunho', $contrato->id) }}"
                                                        class="text-active me-2">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    {{-- Adicionar clausulas ao contrato --}}
                                                    <a href="{{ route('add.clausulas', $contrato->id) }}"
                                                        class="text-active me-2">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('contrato.show', $contrato->id) }}"
                                                        class="text-active me-2">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @include('company.colaboradores.contratos.edit-contato')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Paginacao-->
                        <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                            <div>
                                <small>
                                    Exibindo <strong>{{ $contratos->count() }}</strong> de
                                    <strong>{{ $contratos->total() }}</strong> registro
                                </small>
                            </div>

                            <div>
                                {{ $contratos->links('paginacao.pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
            </section>


        </section>



        {{-- MODAL CRIAR NOVO CONTRATO --}}
        <div class="modal fade" id="createContratoModal" tabindex="-1" aria-labelledby="createContratoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-3">

                    <!-- Cabeçalho -->
                    <div class="modal-header bg-active text-white">
                        <h5 class="modal-title" id="createContratoModalLabel">
                            <i class="fas fa-plus-circle me-2"></i> Adicionar Novo Contrato
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Fechar"></button>
                    </div>

                    <!-- Formulário -->
                    <form action="{{ route('contrato.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- team do usuário autenticado --}}
                        <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                        {{-- usuário autenticado --}}
                        <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                        {{-- ColaboradorID --}}
                        {{-- <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}"> --}}

                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label for="colaborador_id" class="form-label fw-semibold">Colaborador</label>
                                    <select name="colaborador_id" id="colaborador_id" class="form-select rounded-1"
                                        style="height: 45px;" required>
                                        <option value="">
                                            Selecione Colaborador
                                        </option>
                                        @foreach ($colaboradores as $colaborador)
                                            <option value="{{ $colaborador->id }}">
                                                {{ $colaborador->nome_completo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tipo de Contrato -->
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_contrato" class="form-label fw-semibold">Tipo de Contrato</label>
                                    <select name="tipo_contrato" id="tipo_contrato" class="form-select rounded-1"
                                        style="height: 45px;" required>
                                        <option value="" disabled
                                            {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == '' ? 'selected' : '' }}>
                                            Selecione o tipo de contrato
                                        </option>

                                        <optgroup label="Contratos de Trabalho (Lei Geral do Trabalho)">
                                            @foreach (['trabalho_indeterminado', 'trabalho_determinado', 'trabalho_estagio', 'trabalho_parcial', 'trabalho_teletrabalho', 'trabalho_domicilio', 'trabalho_experiencia', 'trabalho_substituicao', 'trabalho_sazonal', 'trabalho_formacao'] as $tipo)
                                                <option value="{{ $tipo }}"
                                                    {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == $tipo ? 'selected' : '' }}>
                                                    {{ \App\Models\Contrato::TIPOS_CONTRATO[$tipo] }}
                                                </option>
                                            @endforeach
                                        </optgroup>

                                        <optgroup label="Contratos de Prestação de Serviços (Código Civil)">
                                            @foreach (['servico_prestacao', 'servico_consultoria', 'servico_representacao', 'servico_mandato', 'servico_empreitada'] as $tipo)
                                                <option value="{{ $tipo }}"
                                                    {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == $tipo ? 'selected' : '' }}>
                                                    {{ \App\Models\Contrato::TIPOS_CONTRATO[$tipo] }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>


                                <!-- Data de Início -->
                                <div class="col-md-4 mb-3">
                                    <label for="data_inicio" class="form-label fw-semibold">Data de Início: <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="data_inicio" id="data_inicio" class="form-control"
                                        required>
                                </div>

                                <!-- Data de Fim -->
                                <div class="col-md-4 mb-3">
                                    <label for="data_fim" class="form-label fw-semibold">Data de Fim: <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="data_fim" id="data_fim" class="form-control" required>
                                </div>

                                <!-- Script de validação -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dataInicio = document.getElementById('data_inicio');
                                        const dataFim = document.getElementById('data_fim');

                                        function validarDatas() {
                                            const inicio = new Date(dataInicio.value);
                                            const fim = new Date(dataFim.value);

                                            if (dataInicio.value && dataFim.value && fim < inicio) {
                                                alert('A data de fim não pode ser inferior à data de início.');
                                                dataFim.value = ''; // limpa o campo inválido
                                                dataFim.focus();
                                            }
                                        }

                                        dataInicio.addEventListener('change', validarDatas);
                                        dataFim.addEventListener('change', validarDatas);
                                    });
                                </script>

                                <!-- Período de Experiência -->
                                <div class="col-md-6 mb-3">
                                    <label for="periodo_experiencia" class="form-label fw-semibold">
                                        Período de Experiência
                                    </label>
                                    <select name="periodo_experiencia" id="periodo_experiencia"
                                        class="form-select rounded-1" style="height: 45px;">
                                        <option value="">Selecionar...</option>

                                        <!-- Contrato por Tempo Determinado -->
                                        <option value="30" {{ old('periodo_experiencia') == '30' ? 'selected' : '' }}>
                                            30 Dias (Máximo - Contrato de Trabalho por Tempo Determinado)
                                        </option>

                                        <!-- Contrato por Tempo Indeterminado -->
                                        <option value="60" {{ old('periodo_experiencia') == '60' ? 'selected' : '' }}>
                                            60 Dias (Padrão - Contrato de Trabalho por Tempo Indeterminado)
                                        </option>

                                        <option value="120"
                                            {{ old('periodo_experiencia') == '120' ? 'selected' : '' }}>
                                            120 Dias (Acordo Escrito - Funções Técnicas/Responsabilidade)
                                        </option>

                                        <option value="180"
                                            {{ old('periodo_experiencia') == '180' ? 'selected' : '' }}>
                                            180 Dias (Funções de Direção ou Chefia)
                                        </option>
                                    </select>
                                </div>



                                <!--Salario Base -->
                                <div class="col-md-6 mb-3">
                                    <label for="salario_base" class="form-label fw-semibold">Salário Base: <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="salario_base" id="salario_base" class="form-control"
                                        minlength="3" required min="0" placeholder="00.000">
                                </div>

                                {{-- Observacoes --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="tipo_documento" class="form-label fw-semibold">Observações</label>
                                        <textarea name="observacoes" id="observacoes" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rodapé -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-active">
                                <i class="bi bi-save me-1"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        {{-- ESTILIZAR FICHEIRO DOCUMENTO --}}
        <style>
            .upload-container {
                margin-top: 16px;
                margin-bottom: 20px;
                text-align: center;
            }

            .upload-area {
                border: 2px dashed var(--primary-light);
                background: #f8f9ff;
                border-radius: 12px;
                padding: 28px;
                cursor: pointer;
                transition: var(--transition);
            }

            .upload-area:hover {
                background: #eef0ff;
                border-color: var(--primary);
                transform: scale(1.01);
            }

            .upload-icon {
                font-size: 32px;
                color: var(--primary);
                margin-bottom: 8px;
                animation: float 2.5s ease-in-out infinite;
            }

            .upload-text {
                font-weight: 600;
                color: var(--text);
            }

            .upload-hint {
                font-size: 13px;
                color: var(--text-light);
            }

            @keyframes float {
                0% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-6px);
                }

                100% {
                    transform: translateY(0);
                }
            }

            .file-info {
                background: #eef2ff;
                border: 1px solid var(--primary-light);
                border-radius: 10px;
                padding: 12px 16px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 12px;
                box-shadow: var(--shadow);
            }

            .file-info i {
                color: var(--primary-dark);
                font-size: 18px;
                margin-right: 8px;
            }

            #fileName {
                font-weight: 600;
                color: var(--primary-dark);
                flex-grow: 1;
                text-align: left;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .remove-btn {
                background: transparent;
                border: none;
                color: var(--muted);
                font-size: 16px;
                cursor: pointer;
                transition: var(--transition);
            }

            .remove-btn:hover {
                color: #ef4444;
            }
        </style>

        <script>
            const input = document.getElementById('caminho_arquivo');
            const fileInfo = document.getElementById('fileInfo');
            const fileName = document.getElementById('fileName');
            const uploadBox = document.getElementById('uploadBox');

            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;
                    fileInfo.style.display = 'flex';
                    uploadBox.querySelector('.upload-area').style.display = 'none';
                }
            });

            function removerFicheiro() {
                input.value = '';
                fileInfo.style.display = 'none';
                uploadBox.querySelector('.upload-area').style.display = 'block';
            }
        </script>

    </main>

@endsection
