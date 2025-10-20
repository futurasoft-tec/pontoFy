@extends('layouts.company-main')
@section('title', 'Detalhe ' . $departamento->nome)
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
                                <a href="{{ route('departamento.create') }}">Detalhe</a>
                            </li>

                            <li class="breadcrumb-item">
                                #{{ $departamento->id }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex ms-md-autoA py-2 py-md-0 mt-0">
                    <a href="{{ route('departamentos.index') }}" class="btn-outline-active rounded-1">
                        <i class="fas fa-reply"></i>
                        <span class="d-none d-sm-inline-block">Voltar</span>
                    </a>

                    <button class="btn btn btn-danger  ms-1 rounded-1" style="padding: 0.7rem; auto" data-bs-toggle="modal"
                        data-bs-target="#deleteConfirmModal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <!--fim header-->



            {{-- DETALHES --}}
            <section class="mt-3 rounded-0">
                <div class="card-header card bg-white border-bottom-0 text-activ rounded-top-1 pt-2 pb-2 ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-active"><strong>Detalhe do Departamento:</strong></h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>
                <div class="card card-body rounded-0 bg-white pb-4 pt-4">
                    <strong>Nome:</strong> {{ $departamento->nome }} <br>
                    <strong>Descrição:</strong> {{ $departamento->descricao }} <br>
                    <strong>Data do Cadastro:</strong> {{ $departamento->created_at->format('d/m/Y') }} <br>
                    <strong>Estado:</strong> {{ $departamento->status }}
                </div>
            </section>


            {{-- LISTA DOS CALABORADORES --}}
            <section class="mt-3 rounded-0">
                <div class="card-header card bg-white border-bottom-0 text-activ rounded-top-1 pt-2 pb-2 ">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-active"><strong>Colaboradores:</strong></h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>
                <div class="card card-body rounded-0 bg-white">
                    @if ($departamento->colaboradores->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4 ">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">Não existe colaborador para este departamento</h5>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('departamento.create') }}" class="btn btn-active rounded-pill">
                                    <i class="ri-user-add-line me-2"></i>Adicionar Colaborador a Departamento
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover mb-0 small table-sm align-middle">
                                <thead class="">
                                    <tr>
                                        <th class="py-1"> <b>ID</b> </th>
                                        <th class="py-1"><b>Nome</b></th>
                                        <th class="py-1"><b>Cargo</b></th>
                                        <th class="py-1"><b>Data de Admissão</b></th>
                                        <th class="py-1"><b>Estado</b></th>
                                        <th class="py-1 text-end"><b>Acções</b></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($departamento->colaboradores as $colaborador)
                                        <tr>
                                            <td class="py-1 small">
                                                #{{ $colaborador->id }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ $colaborador->nome_completo }}
                                            </td>

                                            <td class="py-1 small">
                                                {{ $colaborador->cargo_id }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ $colaborador->data_admissao }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ $colaborador->status }}
                                            </td>
                                            <td class="py-1 small text-end">
                                                <a href="{{-- route('departamento.edit', $dep->id) --}}" class="text-active me-2">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="{{-- route('departamento.show', $dep->id) --}}" class="text-active ms-2">
                                                    <i class="far fa-eye"></i>
                                                </a>

                                                <a href="" class="text-danger ms-2">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Paginacao-->
                        {{-- <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                            <div>
                                <small>
                                    Exibindo <strong>{{ count() }}</strong> de
                                    <strong>{{ total() }}</strong> registro
                                </small>
                            </div>

                            <div>
                                {{ links('paginacao.pagination') }}
                            </div>
                        </div> --}}

                    @endif
                </div>
            </section>


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

                        <form method="POST" action="{{ route('departamento.destroy', $departamento->id) }}">
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
