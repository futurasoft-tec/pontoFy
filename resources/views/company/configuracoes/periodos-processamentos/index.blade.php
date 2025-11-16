@extends('layouts.company-main')
@section('title', 'Períodos de Processamentos - PontoFy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1">Períodos de Processamentos</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('periodos.index') }}">Períodos</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">Lista</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('cargo.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                        data-bs-target="#createPeriodosProcessamentosModal">
                        <i class="fas fa-plus-square"></i>
                        <span class="d-none d-sm-inline-block ms-2">Novo Périodo</span>
                    </a>

                    {{-- Modal create --}}
                    @include('company.configuracoes.periodos-processamentos.create')
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
                    @if ($periodos->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4 ">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">Nenhum Nível Hierárquico Criado</h5>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-active rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#createPeriodosProcessamentosModal">
                                    <i class="ri-user-add-line me-2"></i>Criar Novo Período </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table DataTable table-hover table-striped align-middle mb-0 small">
                                <thead class="bg-light text-uppercase text-muted small">
                                    <tr>
                                        <th class="py-2">Mês</th>
                                        <th class="py-2">Ano</th>
                                        <th class="py-2 text-center">Período</th>
                                        <th class="py-2 text-center">Status</th>
                                        <th class="py-2 text-end">Registado em</th>
                                        <th class="py-2 text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($periodos as $periodo)
                                        <tr>
                                            {{-- Mês --}}
                                            <td class="py-2 fw-semibold text-dark"
                                            style="text-transform:capitalize;">
                                                {{ \Carbon\Carbon::create()->month($periodo->mes)->translatedFormat('F') }}
                                            </td>

                                            {{-- Ano --}}
                                            <td class="py-2">{{ $periodo->ano }}</td>

                                            {{-- Período --}}
                                            <td class="py-2 text-center">
                                                {{ \Carbon\Carbon::parse($periodo->data_inicio)->format('d/m/Y') }}
                                                <span class="text-muted">até</span>
                                                {{ \Carbon\Carbon::parse($periodo->data_fim)->format('d/m/Y') }}
                                            </td>

                                            {{-- Status com cor e ícone --}}
                                            <td class="py-2 text-center">
                                                @switch($periodo->status)
                                                    @case('aberto')
                                                        <span class="border-0 badge bg-success-subtle text-success px-3 py-1">
                                                            <i class="bi bi-unlock me-1"></i> Aberto
                                                        </span>
                                                    @break

                                                    @case('fechado')
                                                        <span class="border-0 badge bg-warning-subtle text-warning px-3 py-1">
                                                            <i class="bi bi-lock me-1"></i> Fechado
                                                        </span>
                                                    @break

                                                    @case('processado')
                                                        <span class="border-0 badge bg-primary-subtle text-primary px-3 py-1">
                                                            <i class="bi bi-check-circle me-1"></i> Processado
                                                        </span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="border-0 badge bg-secondary-subtle text-secondary px-3 py-1">Desconhecido</span>
                                                @endswitch
                                            </td>

                                            {{-- Data de registo --}}
                                            <td class="py-2 text-end text-muted">
                                                {{ optional($periodo->created_at)->format('d/m/Y') }}
                                            </td>

                                            {{-- Ações --}}
                                            <td class="py-2 text-end">
                                                <a href="{{ route('periodo.edit', $periodo->id) }}"
                                                    class="text-active me-2" data-bs-toggle="modal"
                                                    data-bs-target="#editPeriodoModal{{ $periodo->id }}"
                                                    title="Editar período">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="{{ route('periodo.show', $periodo->id) }}" class="text-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deletePeriodoModal{{ $periodo->id }}"
                                                    title="Eliminar período">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- Modais --}}
                                        @include('company.configuracoes.periodos-processamentos.delete-confirme')
                                        @include('company.configuracoes.periodos-processamentos.edit', [
                                            'periodo' => $periodo,
                                        ])
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Nenhum período de processamento registado.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                            <!--Paginacao-->
                            <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                                <div>
                                    <small>
                                        Exibindo <strong>{{ $periodos->count() }}</strong> de
                                        <strong>{{ $periodos->total() }}</strong> registro
                                    </small>
                                </div>

                                <div>
                                    {{ $periodos->links('paginacao.pagination') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </section>


            </section>


            <script>
                $(document).ready(function() {
                    $('.table').DataTable({
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-PT.json'
                        },
                        pageLength: 10,
                        order: [
                            [1, 'desc'],
                            [0, 'desc']
                        ],
                        responsive: true
                    });
                });
            </script>





        </main>

    @endsection
