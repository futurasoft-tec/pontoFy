@extends('layouts.company-main')
@section('title', 'Novo Departamento - PONTO-RH - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1">Departamentos</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('departamentos.index') }}">Departamento</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('departamento.create') }}">Novo</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('departamentos.index') }}" class="btn-danger btn btn-round">
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
                        <h5 class="mb-0 text-active"><strong>Criar novo Departamento</strong></h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>
                <div class="card card-body rounded-0 bg-white pb-5 pt-5">

                    <!--Validacao dos dados-->
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center gap-3 p-3 mb-2 rounded-2" role="alert"
                            aria-live="assertive">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-alert-triangle flex-shrink-0"
                                aria-hidden="true">
                                <path
                                    d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                                </path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>

                            <div class="d-flex flex-column gap-2">
                                @foreach ($errors->all() as $error)
                                    <div class="d-flex align-items-center gap-2 text-danger-emphasis">
                                        <span class="badge bg-danger bg-opacity-25 px-2 py-1">!</span>
                                        <span class="text-break">{{ $error }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    <style>
                        .alert-danger {
                            background: linear-gradient(15deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.15) 100%);
                            border-left: 4px solid #dc3545;
                            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
                        }
                    </style>
                    <!--fim Exibir erros personalizado--->

                    <form action="{{ route('departamento.store') }}" method="POST">
                        @csrf
                        {{-- team do usuario autenticado --}}
                        <input type="hidden" name="team_id" id="team_id" value="{{ Auth::user()->currentTeam->id }}">
                        {{--  usuario autenticado --}}
                        <input type="hidden" name="criado_por" id="criado_por" value="{{ Auth::user()->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nome" class="mb-2">Nome: <span class="text-danger">*</span> </label>
                                    <input type="text" name="nome" id="nome" class="form-control"
                                        placeholder="Ex.: Recursos Humanos" minlength="4" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Descrição:</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control"
                                        placeholder="Breve descrição do departamento">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button class="btn-active" type="submit">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </section>


        </section>
    </main>

@endsection
