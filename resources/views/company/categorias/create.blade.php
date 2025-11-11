@extends('layouts.company-main')
@section('title', 'Nova Categoria Profissional - PontoFy - Gestão de Recursos Humanos')
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
                                <a href="{{ route('categorias.index') }}">Categorias</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('categoria.create') }}">Nova</a>
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
                <div class="card-header card bg-white border-bottom-0 text-activ rounded-top-1 ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-active"><strong>Criar nova categoria Profissional</strong></h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>

                {{-- Exibir erros validados --}}
                @include('company.erros.valida_erros')
                {{-- Fim Exibir erros validados --}}
                <div class="card card-body rounded-0 bg-white pb-5 pt-5">
                    <form action="{{ route('categoria.store') }}" method="POST">
                        @csrf

                        {{-- Identificação --}}
                        <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                        <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                        <div class="row">
                            <!-- Departamento -->
                            <div class="col-md-4 mb-3">
                                <label for="departamento_id" class="form-label fw-semibold">Departamento <span
                                        class="text-danger">*</span></label>
                                <select name="departamento_id" id="departamento_id" class="form-select rounded-1" required>
                                    <option value="" class="small">-- Selecionar --</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}" class="small">{{ $departamento->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Cargo -->
                            <div class="col-md-4 mb-3">
                                <label for="cargo_id" class="form-label fw-semibold">Cargo <span
                                        class="text-danger">*</span></label>
                                <select name="cargo_id" id="cargo_id" class="form-select rounded-1" required>
                                    <option value="" class="small">-- Selecionar --</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" class="small">{{ $cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Estado -->
                            <div class="col-md-4 mb-3">
                                <label for="estado" class="form-label fw-semibold">Estado</label>
                                <select name="estado" id="estado" class="form-select rounded-1">
                                    <option value="ativo" selected class="small">Ativo</option>
                                    <option value="inativo" class="small">Inativo</option>
                                </select>
                            </div>

                            <!-- Nome -->
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label fw-semibold">Nome <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nome" id="nome" class="form-control"
                                    placeholder="Ex.: Técnico de Limpeza" minlength="3" required
                                    value="{{ old('nome') }}">
                            </div>

                            <!-- Função -->
                            <div class="col-md-6 mb-3">
                                <label for="funcao" class="form-label fw-semibold">Função <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="funcao" id="funcao" class="form-control"
                                    placeholder="Ex.: Executar tarefas de limpeza e higienização" minlength="3" required
                                    value="{{ old('funcao') }}">
                            </div>

                            <!-- Descrição -->
                            <div class="col-md-12 mb-3">
                                <label for="descricao" class="form-label fw-semibold">Descrição</label>
                                <textarea name="descricao" id="descricao" class="form-control" rows="3"
                                    placeholder="Breve descrição da categoria (opcional)..."></textarea>
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
