@extends('layouts.company-main')
@section('title', 'Niveis de Hierarquia - PontoFy - Gestão de Recursos Humanos')
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
                                <a href="{{ route('niveis.index') }}">Níveis</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">Lista</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('cargo.create') }}" class="btn-active btn-round"
                    data-bs-toggle="modal" data-bs-target="#createNivelModal">
                        <i class="fas fa-plus-square"></i>
                        <span class="d-none d-sm-inline-block ms-2">Novo</span>
                    </a>

                    {{-- Modal create --}}
                     @include('company.hierarquia.modal-creat-nivel')
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
                    @if ($niveisHierarquicos->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4 ">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">Nenhum Cargo/Função Criado</h5>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-active rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#createNivelModal">
                                    <i class="ri-user-add-line me-2"></i>Criar Novo Nível </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover mb-0 small table-sm align-middle">
                                <thead class="">
                                    <tr>
                                        <th class="py-1"> <b>ID</b> </th>
                                        <th class="py-1"><b>Nome</b></th>
                                        <th class="py-1"><b>Códigos</b></th>
                                        <th class="py-1 text-center"><b>Prioridade</b></th>
                                        <th class="py-1"><b>Data de Registo</b></th>
                                        <th class="py-1 text-end"><b>Acções</b></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($niveisHierarquicos as $nivel)
                                        <tr>
                                            <td class="py-1 small">
                                                {{ $nivel->id }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ $nivel->nome }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ $nivel->codigo }}
                                            </td>

                                            <td class="py-1 small text-center">
                                                {{ $nivel->prioridade }}
                                            </td>

                                            <td class="py-1 small">
                                                <div>{{ optional($nivel->created_at)->format('d/m/Y') }}</div>
                                            </td>

                                            {{-- <td class="py-1 small">
                                            </td> --}}
                                            <td class="py-1 small text-end">
                                                <a href="{{ route('nivel.edit', $nivel->id) }}" class="text-active me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editNivelModal{{ $nivel->id }}">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('nivel.show', $nivel->id) }}" class="text-danger me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteNivelModal{{ $nivel->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        {{-- MODAL DELETAR REGISTRO --}}
                                        @include('company.hierarquia.modal-delete-nivel', [
                                            'nivel' => $nivel,
                                        ])
                                        {{-- MODAL EDITAR --}}
                                        @include('company.hierarquia.modal-edit-nivel', [
                                            'nivel' => $nivel,
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Paginacao-->
                        <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                            <div>
                                <small>
                                    Exibindo <strong>{{ $niveisHierarquicos->count() }}</strong> de
                                    <strong>{{ $niveisHierarquicos->total() }}</strong> registro
                                </small>
                            </div>

                            <div>
                                {{ $niveisHierarquicos->links('paginacao.pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
            </section>


        </section>







    </main>

@endsection
