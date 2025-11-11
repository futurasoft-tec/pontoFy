@extends('layouts.company-main')
@section('title', 'Períodos de Processamentos - PontoFy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1">Rubricas</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('rubricas.index') }}">Rubricas</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">Lista</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('rubrica.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                        data-bs-target="#createRubricaModal">
                        <i class="fas fa-plus-square"></i>
                        <span class="d-none d-sm-inline-block ms-2">Nova Rubrica</span>
                    </a>

                    {{-- Modal create --}}
                    @include('company.rubricas.create')
                </div>
            </div>
            <!--fim header-->


            <!--Validacao dos dados-->
            @include('company.erros.valida_erros')
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
                    @if ($rubricas->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">
                                    Nenhuma Rubrica foi criada.
                                </h5>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-active rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#createRubricaModal">
                                    <i class="ri-user-add-line me-2"></i>Criar Nova Rubrica
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table DataTable table-hover table-striped align-middle mb-0 small">
                                <thead class="bg-light text-uppercase text-muted small">
                                    <tr>
                                        <th class="py-2">Código</th>
                                        <th class="py-2">Nome</th>
                                        <th class="py-2">Tipo</th>
                                        <th class="py-2 text-center">Base de Cálculo</th>
                                        <th class="py-2 text-center">Tributável</th>
                                        <th class="py-2 text-end">Registado em</th>
                                        <th class="py-2 text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rubricas as $rubrica)
                                        <tr>
                                            {{-- Código --}}
                                            <td class="py-2 fw-semibold text-dark">{{ $rubrica->codigo }}</td>

                                            {{-- Nome --}}
                                            <td class="py-2">{{ $rubrica->nome }}</td>

                                            {{-- Tipo --}}
                                            <td class="py-2">{{ ucfirst($rubrica->tipo) }}</td>

                                            {{-- Base de Cálculo --}}
                                            <td class="py-2 text-center">{{ ucfirst($rubrica->base_calculo) }}</td>

                                            {{-- Tributável --}}
                                            <td class="py-2 text-center">
                                                @if ($rubrica->is_tributavel)
                                                    <span class="badge bg-success-subtle text-success px-3 py-1">Sim</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary-subtle text-secondary px-3 py-1">Não</span>
                                                @endif
                                            </td>

                                            {{-- Data de registo --}}
                                            <td class="py-2 text-end text-muted">
                                                {{ optional($rubrica->created_at)->format('d/m/Y') }}</td>

                                            {{-- Ações --}}
                                            <td class="py-2 text-end">
                                                <a href="#" class="text-active me-2" data-bs-toggle="modal"
                                                    data-bs-target="#editRubricadoModal{{ $rubrica->id }}"
                                                    title="Editar Rubrica">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="#" class="text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRubricaModal{{ $rubrica->id }}"
                                                    title="Eliminar Rubrica">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- Modais de editar/excluir rubrica --}}
                                        @include('company.rubricas.edit', ['rubrica' => $rubrica])
                                        {{-- @include('company.rubricas.delete', ['rubrica' => $rubrica]) --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginação -->
                        <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                            <div>
                                <small>
                                    Exibindo <strong>{{ $rubricas->count() }}</strong> de
                                    <strong>{{ $rubricas->total() }}</strong> rubricas
                                </small>
                            </div>

                            <div>
                                {{ $rubricas->links('paginacao.pagination') }}
                            </div>
                        </div>
                    @endif

                </div>
            </section>
        </section>

    </main>

@endsection
