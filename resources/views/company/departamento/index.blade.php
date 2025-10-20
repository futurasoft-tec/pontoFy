@extends('layouts.company-main')
@section('title', 'Departamento - PontoFy - Gestão de Recursos Humanos')
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
                                <a href="">Lista</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('departamento.create') }}" class="btn-active btn-round">
                        <i class="fas fa-plus-square"></i>
                        <span class="d-none d-sm-inline-block ms-2">Novo</span>
                    </a>
                </div>
            </div>
            <!--fim header-->



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
                    @if ($departamentos->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4 ">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">Nenhum Departamento Criado</h5>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('departamento.create') }}" class="btn btn-active rounded-pill">
                                    <i class="ri-user-add-line me-2"></i>Criar Novo Departamento
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
                                        <th class="py-1"><b>Data de Registo</b></th>
                                        <th class="py-1"><b>Estado</b></th>
                                        <th class="py-1 text-end"><b>Acções</b></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($departamentos as $dep)
                                        <tr>
                                            <td class="py-1 small">
                                                @if ($dep->status === 'ativo')
                                                    <a href="" class="text-active">
                                                        {{ $dep->id }}
                                                    </a>
                                                @else
                                                    <a href="" class="text-danger">
                                                        {{ $dep->id }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="py-1 small">
                                                <span>
                                                    @if ($dep->status === 'ativo')
                                                        <a href="" class="text-active">
                                                            {{ $dep->nome }}
                                                        </a>
                                                    @else
                                                        <a href="" class="text-danger">
                                                            {{ $dep->nome }}
                                                        </a>
                                                    @endif
                                                </span>
                                            </td>

                                            <td class="py-1 small">
                                                @if ($dep->status === 'ativo')
                                                    <a href="" class="text-active">
                                                    {{ optional($dep->created_at)->format('d/m/Y') }}
                                                    </a>
                                                @else
                                                    <a href="" class="text-danger">
                                                        {{ optional($dep->created_at)->format('d/m/Y')}}
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="py-1 small">
                                                <span style="text-transform:capitalize">
                                                    @if ($dep->status === 'ativo')
                                                        <a href="" class="text-active">
                                                            {{ $dep->status }}
                                                        </a>
                                                    @else
                                                        <a href="" class="text-danger">
                                                            {{ $dep->status }}
                                                        </a>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="py-1 small text-end">
                                                <a href="{{ route('departamento.edit', $dep->id) }}"
                                                    class="text-active me-2">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('departamento.show', $dep->id) }}"
                                                    class="text-active ms-2">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Paginacao-->
                        <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                            <div>
                                <small>
                                    Exibindo <strong>{{ $departamentos->count() }}</strong> de
                                    <strong>{{ $departamentos->total() }}</strong> registro
                                </small>
                            </div>

                            <div>
                                {{ $departamentos->links('paginacao.pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
            </section>


        </section>
    </main>

@endsection
