@extends('layouts.company-main')
@section('title', 'Assiduidades - PontoFy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">

            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1">Assiduidades</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Assiduidades</a></li>
                            <li class="breadcrumb-item"><a href="">Lista</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-md-autoA py-2A py-md-0A mt-0">
                    <a href="{{ route('assiduidade.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                        data-bs-target="#createAssiduidadeModal">
                        <i class="fas fa-plus-square"></i>
                        <span class="d-none d-sm-inline-block ms-2">Novo Registo</span>
                    </a>
                    @include('company.assiduidade.create')
                </div>
            </div>
            <!--fim header-->

            {{-- Lista Assiduidades --}}
            <section class="mt-3 rounded-0">
                <div class="card-header card bg-white border-bottom-0 text-activ rounded-top-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-active"><strong>Lista de Registos</strong></h5>
                    </div>
                </div>
                <div class="card card-body rounded-0 bg-white">
                    @if ($assiduidades->isEmpty())
                        <div class="p-5 text-center">
                            <div class="mb-4">
                                <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                            </div>
                            <h5 class="fw-normal mb-3">Nenhum registo de assiduidade encontrado</h5>
                            <a href="{{ route('assiduidade.create') }}" class="btn btn-active rounded-pill">
                                <i class="ri-user-add-line me-2"></i>Adicionar Novo Registo
                            </a>
                        </div>
                    @else
                        <div class="table-responsive" style="overflow-x:auto;">
                            <table class="display table table-striped table-hover mb-0 small table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th class="py-1"><b>ID</b></th>
                                        <th class="py-1"><b>Colaborador</b></th>
                                        <th class="py-1"><b>Período Processado</b></th>
                                        <th class="py-1"><b>Data</b></th>
                                        <th class="py-1 text-center"><b>H. Entrada</b></th>
                                        <th class="py-1 text-center"><b>H. Saída</b></th>
                                        <th class="py-1 text-center"><b>Início Almoço</b></th>
                                        <th class="py-1 text-center"><b>Fim Almoço</b></th>
                                        <th class="py-1 text-center"><b>Horas Trabalhadas</b></th>
                                        <th class="py-1 text-center"><b>H. Extras</b></th>
                                        <th class="py-1 text-center"><b>Atraso (min)</b></th>
                                        <th class="py-1 text-center"><b>Status</b></th>
                                        <th class="py-1 text-end"><b>Ações</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assiduidades as $assiduidade)
                                        <tr>
                                            <td class="py-1 small">{{ $assiduidade->id }}</td>

                                            <td class="py-1 small">{{ $assiduidade->criadoPor->name ?? 'NA' }}</td>
                                            <td class="py-1 small">
                                                {{ $assiduidade->periodo->mes ?? '-' }} /
                                                {{ $assiduidade->periodo->ano ?? '-' }}
                                            </td>
                                            <td class="py-1 small">{{ $assiduidade->data->format('d/m/Y') }}</td>
                                            <td class="py-1 text-center small">
                                                {{ $assiduidade->hora_entrada ? \Carbon\Carbon::parse($assiduidade->hora_entrada)->format('H:i') : '-' }}
                                            </td>
                                            <td class="py-1 text-center small">
                                                {{ $assiduidade->hora_saida ? \Carbon\Carbon::parse($assiduidade->hora_saida)->format('H:i') : '-' }}
                                            </td>
                                            <td class="py-1 text-center small">
                                                {{ $assiduidade->hora_inicio_almoco ? \Carbon\Carbon::parse($assiduidade->hora_inicio_almoco)->format('H:i') : '-' }}
                                            </td>
                                            <td class="py-1 text-center small">
                                                {{ $assiduidade->hora_fim_almoco ? \Carbon\Carbon::parse($assiduidade->hora_fim_almoco)->format('H:i') : '-' }}
                                            </td>

                                            <td class="py-1 text-center small">{{ $assiduidade->horas_trabalhadas ?? 0 }}
                                            </td>
                                            <td class="py-1 text-center small">{{ $assiduidade->horas_extras ?? 0 }}</td>
                                            <td class="py-1 text-center small">{{ $assiduidade->atraso_minutos ?? 0 }}m</td>
                                            <td class="py-1 text-center small text-capitalize">{{ $assiduidade->status }}
                                            </td>
                                            <td class="py-1 small text-end">
                                                <a href="{{ route('assiduidade.edit', $assiduidade->id) }}"
                                                    class="text-active me-2">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a href="{{ route('assiduidade.show', $assiduidade->id) }}"
                                                    class="text-active ms-2">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{-- Paginação --}}
                        <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                            <div>
                                <small>
                                    Exibindo <strong>{{ $assiduidades->count() }}</strong> de
                                    <strong>{{ $assiduidades->total() ?? $assiduidades->count() }}</strong> registro(s)
                                </small>
                            </div>

                            <div>
                                {{ $assiduidades->links('paginacao.pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </section>
    </main>

@endsection
