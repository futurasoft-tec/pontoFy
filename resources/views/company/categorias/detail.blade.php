@extends('layouts.company-main')
@section('title', 'Detalhe ' . $categoria->nome)
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
                                <a href="#">Detalhe</a>
                            </li>

                            <li class="breadcrumb-item">
                                #{{ $categoria->id }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex ms-md-autoA py-2 py-md-0 mt-0">
                    <a href="{{ route('categorias.index') }}" class="btn-outline-active rounded-1">
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
                        <h5 class="mb-0 text-active"><strong>Detalhe da Categoria:</strong></h5>
                    </div>
                </div>
                <div class="card card-body rounded-0 bg-white pb-4 pt-4">
                    <strong>Nome:</strong> {{ $categoria->nome }} <br>
                    <strong>Função:</strong> {{ $categoria->funcao }} <br>
                    <strong>Cargo:</strong> {{ $categoria->cargo->nome }} <br>
                    <strong>Departamento:</strong> {{ $categoria->departamento->nome }} <br>
                    <strong>Descrição:</strong> {{ $categoria->descricao ?? '—' }} <br>
                    <strong>Data do Cadastro:</strong> {{ $categoria->created_at->format('d/m/Y') }} <br>
                    <strong>Estado:</strong> {{ ucfirst($categoria->estado) }}
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

                        <form method="POST" action="{{ route('categoria.destroy', $categoria->id) }}">
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
