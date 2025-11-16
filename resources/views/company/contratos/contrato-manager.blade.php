@extends('layouts.company-main')
@section('title', $contrato->codigo . ' - PontoFy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="p-2 d-flex align-items-center justify-content-between border pe-3 ps-3 bg-white shadow-sm">
                <div>
                    <h3 class="fw-bold mb-1">Contrato</h3>
                    <nav>
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" class="text-active"> {{ $contrato->codigo ?? 'NA' }} </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-active">{{ $contrato->colaborador->nome_completo }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="ms-md-autoA py-2A py-md-0 mt-0">
                    <a href="{{ route('colaborador.show', $contrato->colaborador->id) }}" class="btn btn-sm btn-danger me-1"
                        title="Voltar">
                        <i class="fas fa-reply me-1"></i>
                        Voltar
                    </a>
                    <a href="{{ route('contratos.pdf', $contrato->id) }}"
                        class="me-1 
                        btn btn-dark btn-sm " title="Baixar PDF" target="_blank">
                        <i class="fas fa-download me-1"></i>
                        Download
                    </a>
                    @if ($contrato->status === 'ativo')
                        <a href="#" class="btn btn-warning btn-sm me-2" title="Rescindir Contrato"
                            data-bs-toggle="modal" data-bs-target="#rescindirContratoModal{{ $contrato->id }}">
                            <i class="fas fa-times me-1"></i>
                            Rescindir
                        </a>
                        @include('company.contratos.manager.confirm-rescindir')
                    @endif

                </div>
            </div>
            <!--fim header-->


            @include('company.erros.valida_erros')

            {{-- CONTEUDOS --}}
            <section class="mt-2 rounded-0">
                {{-- Detalhe do contrato --}}
                <div class="card-body rounded-0 mb-0 border-bottm bg-white p-4 small border border">
                    <h4 class="h5 text-active">
                        <strong>Detalhe do Contrato</strong>
                    </h4>
                    <strong>Tipo:</strong>
                    {{ \App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato] ?? $contrato->tipo_contrato }}
                    <br>
                    <strong>Código: </strong> {{ $contrato->codigo ?? '_' }} <br>
                    <strong>Data de Início:</strong>
                    {{ $contrato->data_inicio->format('m/d/Y') }} <br>
                    <strong>Data de Início:</strong>
                    {{ $contrato->data_fim->format('m/d/Y') ?? '_' }} <br>
                    <strong>Período de Experiência:</strong>
                    {{ $contrato->periodo_experiencia ?? '_' }} Dias

                </div>
                {{-- Documento estilo Word --}}
                <section class="p-0 page-inner">
                    <div class="card rounded-0 card-body p-4 pt-5 pb-5 shadow-sm border bg-white body-contrato">
                        {{-- Cabeçalho --}}
                        @php
                            $partes = \App\Models\Contrato::tipoParte($contrato->tipo_contrato);
                        @endphp
                        <div class="text-center mb-5">
                            <h1 class="h3 fw-bold text-active mb-1" style="text-transform: uppercase;">
                                @if ($contrato->status === 'ativo')
                                @else
                                    <strong style="color: red; text-align:center;">
                                        ESTADO DO CONTRATO:
                                        "{{ $contrato->status }}"
                                    </strong> <br>
                                @endif
                                <strong>
                                    {{ \App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato] ?? $contrato->tipo_contrato }}
                                </strong>
                            </h1>
                            <span class="text-muted">{{ $contrato->codigo }}</span>
                        </div>

                        {{-- Identificação das partes --}}
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <h6 class="text-active fw-bold">
                                            <strong>ENTRE</strong>
                                        </h6>
                                        <p class="text-justify">
                                            <strong
                                                class="text-uppercase">{{ $contrato->colaborador->team->name }}</strong>,
                                            com sede em
                                            <span>
                                                @if ($contrato->team->provincia)
                                                    {{ $contrato->team->provincia }},
                                                @else
                                                    {{ $contrato->team->cidade }}
                                                @endif
                                                Município de
                                                {{ $contrato->team->municipio }},
                                                Bairro
                                                {{ $contrato->team->bairro }},
                                                Rua/Zona
                                                {{ $contrato->team->endereco }},
                                            </span> titular do NIF:
                                            <strong>{{ $contrato->team->nif ?? '000000000' }}</strong> , neste acto
                                            representada
                                            pelo (a) (s) Senhor (a) (s)
                                            <strong
                                                style="text-transform: uppercase;">{{ $contrato->team->user->name }}</strong>,
                                            na qualidade de Representantes Legais, adiante designada por
                                            “<strong>{{ $partes['empregador'] }}</strong>”.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="">
                                        <h6 class="text-active fw-bold">E</h6>
                                        <p class="text-justify">
                                            <strong
                                                class="text-uppercase">{{ $contrato->colaborador->nome_completo }}</strong>,
                                            portador do Bilhete de Identidade nº
                                            {{ $contrato->colaborador->numero_doc_id }},
                                            emitido em
                                            {{ $contrato->colaborador->data_emissao_doc?->format('d/m/Y') ?? '---' }},
                                            residente em {{ $contrato->colaborador->pais }},
                                            @if ($contrato->colaborador->provincia)
                                                {{ $contrato->colaborador->provincia }}
                                            @else
                                                {{ $contrato->colaborador->cidade_estrangeira }}
                                            @endif,
                                            Rua/Bairro {{ $contrato->colaborador->endereco }},
                                            adiante designado por “<strong>{{ $partes['trabalhador'] }}</strong>”.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                É celebrado o presente
                                <strong
                                    style="text-transform: uppercase;">{{ strtolower(\App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato]) }}</strong>,
                                que se rege pelas disposições da
                                @if (str_starts_with($contrato->tipo_contrato, 'trabalho_'))
                                    <strong>Lei Geral do Trabalho</strong>
                                @else
                                    <strong>Código Civil</strong>
                                @endif,
                                legislação complementar, regulamento interno e pelas cláusulas seguintes:
                            </div>
                        </div>

                        {{-- Cláusulas --}}
                        <div class="mb-5 text-center">
                            <h5 class="h4 text-center fw-bold text-active mb-1">
                                Cláusulas do Contrato
                            </h5>
                            @forelse($contrato->clausulas as $index => $clausula)
                                <div class="mb-3 border-bottom" style="transition:0.2s;">
                                    <h5 class="fw-bold text-active mb-1">
                                        Cláusula {{ $index + 1 }}ª
                                        ({{ $clausula->titulo_base ?? 'Sem Título' }})
                                    </h5>
                                    <p class="mb-0 text-justify">{{ $clausula->conteudo }}</p>
                                </div>
                            @empty
                                <p class="text-muted"><em>Não há cláusulas associadas a este contrato.</em></p>
                            @endforelse
                        </div>
                        @if ($contrato->status === 'rescindido')
                            <div class="alert alert-danger">
                                <h4 class="h5 mb-0" style="text-transform: uppercase;">
                                    <strong>Atenção: Este contrato encontra-se{{ $contrato->status }}</strong>.
                                </h4>
                                <strong>
                                    Data da Rescisão:
                                    {{ \Carbon\Carbon::parse($contrato->data_rescisao)->format('d/m/Y') }}
                                </strong> <br>
                                <strong>Rescindido por:</strong>
                                {{ $contrato->recisor->name ?? 'NA' }}
                                <br>
                                Motivo da Rescisão: <em>{{ $contrato->motivo_rescisao }}</em>
                            </div>
                        @endif

                        {{-- Assinaturas --}}
                        <div class="d-flex justify-content-around mt-5">
                            <p class="small" style="font-size: 11px;">
                                Documento assinado electronicamente em
                                <strong>
                                    {{ \Carbon\Carbon::parse($contrato->data_assinatura)->format('d/m/Y') }}
                                </strong>
                                com código <strong>{{ $contrato->codigo_assinatura ?? 'NA' }}</strong>
                            </p>
                        </div>

                    </div>
                </section>


                <style>
                    .body-contrato {
                        overflow: scroll;
                        height: 100vh;
                        padding: 1.5rem 0;
                        text-align: justify;
                        font-size: 13px;
                    }


                    .btn-toolbar .btn {
                        min-width: 40px;
                    }
                </style>

            </section>


        </section>
    </main>

@endsection
