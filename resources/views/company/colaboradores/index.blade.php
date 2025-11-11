@extends('layouts.company-main')
@section('title', 'Lista de Colaboradores - PontoFy - Gestão de Recursos Humanos')
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
                                <a href="#">Colaboradores</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Lista</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('colaborador.create') }}" class="btn-active btn-round">
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
                        <h5 class="mb-0 text-active"><strong>Lista de Caolaboradores</strong></h5>
                        {{-- <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a> --}}
                    </div>
                </div>

                <!--Filtragem-->

            <div class="card card-body mb-3 mt-0 rounded-0">
                <h5 class="mb-1 text-active">
                    <strong>Filtrar</strong>
                </h5>
                <form action="" method="GET">
                    @csrf 

                    <div class="row">
                        <div class="col-md-3">
                            <label for="nome" class="small" style="font-size: 10px;">Buscar por Nome</label>
                            <input type="text" id="search" name="search"
                            placeholder="... João Filipe Tomás" class="form-control form-control-sm  " style="height: 35px">
                        </div>

                         <div class="col-md-3">
                            <label for="nome" class="small" style="font-size: 10px;">Nº do Processo</label>
                            <input type="number" id="searchCode" name="searchCode"
                            placeholder="0000000001" class="form-control form-control-sm  " style="height: 35px">
                        </div>

                         <div class="col-md-3">
                            <label for="nome" class="small" style="font-size: 10px;">Nº do Documento</label>
                            <input type="text" id="searchDocId" name="searchDocId"
                            placeholder="Procurar por Nome" class="form-control form-control-sm  " style="height: 35px">
                        </div>

                        <div class="col-md-3">
                            <label for="nome" class="small" style="font-size: 10px;">Data Admissão</label>
                            <input type="date" id="seacrhData" name="seacrhData"
                            placeholder="Procurar por Nome" class="form-control form-control-sm  " style="height: 35px">
                        </div>
                    </div>

                    <div class="text-end pt-3 pb-3">
                        <a href="{{ route('colaboradores.index') }}" class="btn btn-outline-active me-2">
                            Limpar
                        </a>
                        <button type="submit" class="btn btn-active">
                            Aplicar
                        </button>
                    </div>
                </form>
            </div>





                <div class="card card-body rounded-0 bg-white">
                    @if ($colaboradores->isEmpty())
                        <div class="p-5">
                            <div class="text-acitve text-center">
                                <div class="mb-4 ">
                                    <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                                </div>
                                <h5 class="fw-normal mb-3">Nenhuma Colaborador Criado</h5>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('colaborador.create') }}" class="btn btn-active rounded-pill">
                                    <i class="ri-user-add-line me-2"></i>Adiconar Novo Colaborador
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive"
                        style="overflow: scroll; height: 100vh">
                            <table 
                                class="display table table-striped table-hover mb-0 small table-sm align-middle colaboradores"
                                style="position: sticky; top: 0; z-index: 1;">
                                <thead>
                                    <tr>
                                        <th class="py-1"><b>Nº Processo</b></th>
                                        <th class="py-1"><b>INSS nº</b></th>
                                        <th class="py-1 w-100"><b>Nome Completo</b></th>
                                        <th class="py-1"><b>Tipo de Documento</b></th>
                                        <th class="py-1"><b>Nº de Documento</b></th>
                                        <th class="py-1"><b>Departamento</b></th>
                                        <th class="py-1"><b>Cargo</b></th>
                                        <th class="py-1"><b>Data de Admissão</b></th>
                                        <th class="py-1"><b>Estado</b></th>
                                        <th class="py-1 text-end w-50"><b>Acções Rápidas </b></th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($colaboradores as $colab)
                                        <tr>
                                            <td class="py-1 small">
                                                <a href="{{ route('colaborador.show', $colab->id) }}">
                                                    {{ $colab->codigo ?? '00000' }}
                                                </a>
                                            </td>
                                            <td class="py-1 small">
                                                <a href="{{ route('colaborador.show', $colab->id) }}">{{ $colab->numero_inss }}</a>
                                            </td>
                                            <td class="py-1 small w-100" style="text-transform:uppercase;">
                                                <a href="{{ route('colaborador.show', $colab->id) }}">
                                                    {{ $colab->nome_completo }}
                                                </a>
                                            </td>
                                            <td class="py-1 small">
                                                {{ $colab->tipo_documento ?? '-' }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ $colab->numero_doc_id}}
                                            </td>
                                            <td class="py-1 small">
                                                {{ Str::limit($colab->departamento->nome, 10) }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ Str::limit($colab->cargo->nome, 15) }}
                                            </td>
                                            <td class="py-1 small">
                                                {{ \Carbon\Carbon::parse($colab->data_admissao)->format('d/m/Y') }}
                                            </td>
                                            <td class="py-1 small">
                                                <span style="text-transform:capitalize">
                                                    {{ $colab->status }}
                                                </span>
                                            </td>
                                            <td class="py-1 small text-end w-50">
                                                <a href="{{ route('colaborador.edit', $colab->id) }}"
                                                    class="text-active me-2">
                                                    <i class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('colaborador.show', $colab->id) }}"
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
                                    Exibindo <strong>{{ $colaboradores->count() }}</strong> de
                                    <strong>{{ $colaboradores->total() }}</strong> registro
                                </small>
                            </div>

                            <div>
                                {{ $colaboradores->links('paginacao.pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
            </section>


        </section>
    </main>

@endsection
