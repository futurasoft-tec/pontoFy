@extends('layouts.company-main')
@section('title', 'Novo Colaborador - PontoFy - Gestão de Recursos Humanos')
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
                                <a href="{{ route('colaboradores.index') }}">Colabores</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Novo</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('categorias.index') }}" class="btn-danger btn btn-round">
                        <i class="fas fa-reply"></i>
                        <span class="d-none d-sm-inline-block ms-2">Voltar</span>
                    </a>
                </div>
            </div>
            <!--fim header-->


            {{-- ULTIMOS PROCESSAMENTOS --}}
            <section class="mt-3 rounded-0">
                <div class="card-header card bg-white border mb-3 text-activ rounded-top-1 ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-active">
                            <strong>Adicionar novo Colaborador</strong>
                        </h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>

                {{-- Exibir erros validados --}}
                @include('company.erros.valida_erros')
                
                {{-- Fim Exibir erros validados --}}
                <div class="">
                    <form action="{{ route('colaborador.store') }}" method="POST">
                        @csrf

                        {{-- Identificação --}}
                        <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                        <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                        <!---DADOS PESSOAIS--->
                        <h5 class="text-active mb-0"><strong>Dados Pessoais</strong></h5>
                        <div class="card rounded-1 p-3 mt-0 mb-3">
                            <div class="row">
                                <!-- Nome -->
                                <div class="col-md-6 mb-3">
                                    <label for="nome_completo" class="form-label fw-semibold">Nome Completo <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nome_completo" id="nome_completo" class="form-control"
                                        placeholder="Ex.: João Filipe Tomás" minlength="3" required
                                        value="{{ old('nome_completo') }}">
                                </div>

                                <!-- Data de Nacimento -->
                                <div class="col-md-6 mb-3">
                                    <label for="data_nascimento" class="form-label fw-semibold">Data de Nascimenoto <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                                        minlength="3" required>
                                </div>

                                <!-- Sexo -->
                                <div class="col-md-4 mb-3">
                                    <label for="genero" class="form-label fw-semibold">Sexo: <span
                                            class="text-danger">*</span></label>
                                    <select name="genero" id="genero" class="form-select rounded-1">
                                        <option value="M" class="small" selected>Masculino</option>
                                        <option value="F" class="small">Feminino</option>
                                        <option value="Outro" class="small">Outro</option>
                                        
                                    </select>
                                </div>


                                <!-- Estado Civil -->
                                <div class="col-md-4 mb-3">
                                    <label for="estado_civil" class="form-label fw-semibold">Estado Civil: <span
                                            class="text-danger">*</span></label>
                                    <select name="estado_civil" id="estado_civil"
                                        class="form-select rounded-1">
                                        <option value="Solteiro" class="small" selected>Solteiro/a</option>
                                        <option value="Casado" class="small">Casado/a</option>
                                        <option value="Divorsiada" class="small">Divorsiado/a</option>
                                        <option value="Viuvo" class="small">Viuvo</option>
                                    </select>
                                </div>

                                <!-- Nacionalidade -->
                                <div class="col-md-4 mb-3">
                                    <label for="nacionalidade" class="form-label fw-semibold">Nacionalidade: <span
                                            class="text-danger">*</span></label>
                                    <select name="nacionalidade" id="nacionalidade"
                                        class="form-select rounded-1">
                                        <option value="" class="small">Selecionar...</option>
                                        <option value="Angolano" class="small" selected>Angolana</option>
                                        <option value="Portuguesa" class="small">Portugues</option>
                                        <option value="Brasileira" class="small">Brasileira</option>
                                        <option value="Moçambicana" class="small">Moçambicana</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!---DADOS FISCAIS--->
                        <h5 class="text-active mb-0"><strong>Dados Fiscais</strong></h5>
                        <div class="card rounded-1 p-3 mt-0 mb-3">
                            <div class="row">

                                <!-- Tipo de Documento -->
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_documento" class="form-label fw-semibold">Tipo de Documento: <span
                                            class="text-danger">*</span></label>
                                    <select name="tipo_documento" id="tipo_documento"
                                        class="form-select rounded-1">
                                        <option value="" class="small">Selecionar...</option>
                                        <option value="BI" class="small" selected>Bilhete de Identidade</option>
                                        <option value="NIF" class="small">Número de Contribuinte</option>
                                        <option value="Passaporte" class="small">Passaporte</option>
                                        <option value="Cartão de Municipe" class="small">Cartão de Municípe</option>
                                    </select>
                                </div>


                                <!--Numero de BI-->
                                <div class="col-md-4 mb-3">
                                    <label for="numero_doc_id" class="form-label fw-semibold">Nº do Documento: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="numero_doc_id" id="numero_doc_id" class="form-control"
                                        placeholder="005XXX439300KS034" minlength="3" required
                                        value="{{ old('numero_doc_id') }}">
                                </div>


                                <!-- Data de Emissao BI -->
                                <div class="col-md-4 mb-3">
                                    <label for="data_emissao_doc" class="form-label fw-semibold">Data de Emissão: <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="data_emissao_doc" id="data_emissao_doc"
                                        class="form-control" minlength="3" required>
                                </div>

                                <!-- Data de Validade BI -->
                                <div class="col-md-4 mb-3">
                                    <label for="data_validade_doc" class="form-label fw-semibold">Data de Validade: <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="data_validade_doc" id="data_validade_doc"
                                        class="form-control" minlength="3" required>
                                </div>

                                <!--Numero de NIF-->
                                <div class="col-md-4 mb-3">
                                    <label for="nif" class="form-label fw-semibold">NIF:</label>
                                    <input type="text" name="nif" id="nif" class="form-control"
                                        placeholder="005XXX439300KS034" minlength="3" required
                                        value="{{ old('nif') }}">
                                    <small class="text-danger" style="font-size: 10px;">NIF, Número de Identificação 
                                        Fiscal <strong>(AGT)</strong></small>
                                </div>

                                <!--Numero de INSS-->
                                <div class="col-md-4 mb-3">
                                    <label for="numero_inss" class="form-label fw-semibold">Número INSS:</label>
                                    <input type="text" name="numero_inss" id="numero_inss" class="form-control"
                                        placeholder="000123456" minlength="3" required value="{{ old('numero_inss') }}">
                                    <small class="text-danger" style="font-size: 10px;">Número de Segurança Social
                                        <strong>(INSS)</strong></small>
                                </div>
                            </div>
                        </div>


                        <!---DADOS DE CONTACTOS E ENDERÇO--->
                        <h5 class="text-active mb-0"><strong>Dados Contactos</strong></h5>
                        <div class="card rounded-1 p-3 mt-0 mb-3">
                            <div class="row">
                                <!--Pais-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        @include('company.colaboradores.endereco.pais')
                                    </div>
                                </div>

                                <!--Cidade--->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        @include('company.colaboradores.endereco.provincia')
                                    </div>
                                </div>


                                <!--Endereco--->
                                <div class="col-md-4 mb-3">
                                    <label for="endereco" class="form-label fw-semibold">Endereço Complementar <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="endereco" id="endereco" class="form-control"
                                        placeholder="Ex.: Bairro Ramiros, Zona B" minlength="3" required
                                        value="{{ old('endereco') }}">
                                </div>


                                <!--Telefone--->
                                <div class="col-md-4 mb-3">
                                    <label for="telefone" class="form-label fw-semibold">Telefone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="telefone" id="telefone" class="form-control"
                                        placeholder="+244 900 000 000" minlength="3" required
                                        value="{{ old('telefone') }}">
                                </div>


                                <!--Email--->
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label fw-semibold">Email <span></label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="trabalhador@suaempresa.ao" minlength="3" required
                                        value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>


                        <!---DADOS DE CONTACTOS E ENDERÇO--->
                        <h5 class="text-active mb-0"><strong>Dados Laboral</strong></h5>
                        <div class="card rounded-1 p-3 mt-0 mb-3">
                            <div class="row">
                                <!-- Departamento -->
                                <div class="col-md-4 mb-3">
                                    <label for="departamento_id" class="form-label fw-semibold">Departamento <span
                                            class="text-danger">*</span></label>
                                    <select name="departamento_id" id="departamento_id"
                                        class="form-select rounded-1" required>
                                        <option value="" class="small">-- Selecionar --</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}" class="small">
                                                {{ $departamento->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Cargo -->
                                <div class="col-md-4 mb-3">
                                    <label for="cargo_id" class="form-label fw-semibold">Cargo <span
                                            class="text-danger">*</span></label>
                                    <select name="cargo_id" id="cargo_id" class="form-select rounded-1"
                                        required>
                                        <option value="" class="small">-- Selecionar --</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}" class="small">{{ $cargo->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Data de admissao -->
                                <div class="col-md-4 mb-3">
                                    <label for="data_admissao" class="form-label fw-semibold">Data de Admissão <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="data_admissao" id="data_admissao"
                                        class="form-control" minlength="3" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-active">
                                <i class="bi bi-save me-1"></i> Guardar
                            </button>
                        </div>
                    </form>

                </div>
            </section>


        </section>
    </main>

@endsection
