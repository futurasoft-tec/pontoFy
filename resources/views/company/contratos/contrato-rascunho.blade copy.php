@extends('layouts.company-main')

@section('title', 'Contrato ' . $contrato->codigo . ' - PontoFy - Gestão de Recursos Humanos')

@section('content')
    <main class="container-fluid py-4 px-lg-5">
        <section class="page-inner">

            {{-- === CONTEÚDO DO CONTRATO === --}}
            <div class="card shadow-sm border-0 pt-5" style="margin-top: 3rem;">
                <div class="card-body p-5 contrato-doc bg-white">
                    {{-- Cabeçalho do Contrato --}}
                    @php
                        use App\Models\Contrato;
                        $partes = Contrato::tipoParte($contrato->tipo_contrato);
                    @endphp


                    <div class="mb-3 text-center">
                        <!-- Título do Contrato -->
                        <h3 class="fw-bold text-uppercase text-active mb-0">
                            <strong>
                                {{ \App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato] ?? $contrato->tipo_contrato }}
                            </strong>
                        </h3>

                        <h4 class="h5 mt-0 p-0">
                            <i>{{ $contrato->codigo }}</i>
                        </h4>
                    </div>

                    <!-- Identificação das Partes -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-uppercase text-active mb-2">ENTRE</h5>
                        <p class="lh-base text-justify">
                            <strong class="text-uppercase">{{ $contrato->colaborador->team->name }}</strong>,
                            com sede na Província de Luanda, Município e Bairro Ramiros, Estrada EN-100,
                            Administração Municipal de Belas, Casa s/n.º, Zona B, junto à Administração
                            Municipal de Belas, titular do NIF: 5002641178, registada na Conservatória de
                            Registo Comercial de Luanda sob o número 29.637-25, neste acto representada
                            pelos Senhores <strong>JOSÉ FILIPE TOMÁS</strong> e <strong>ARMANDO FRANCISCO BANGE</strong>,
                            na qualidade de Representantes Legais, adiante designada por “{{ $partes['empregador'] }}”.
                        </p>

                        <h5 class="fw-bold text-uppercase text-active mt-4 mb-2">E</h5>
                        <p class="lh-base text-justify">
                            <strong class="text-uppercase">{{ $contrato->colaborador->nome_completo }}</strong>,
                            portador do Bilhete de Identidade nº {{ $contrato->colaborador->numero_doc_id }},
                            emitido em {{ $contrato->colaborador->data_emissao_doc?->format('d/m/Y') ?? '---' }},
                            residente em {{ $contrato->colaborador->pais }},
                            @if ($contrato->colaborador->provincia)
                                {{ $contrato->colaborador->provincia }}
                            @else
                                {{ $contrato->colaborador->cidade_estrangeira }}
                            @endif,
                            Rua/Bairro {{ $contrato->colaborador->endereco }},
                            adiante designado por “{{ $partes['trabalhador'] }}”.
                        </p>

                        <p class="mt-4 lh-base text-justify">
                            É celebrado o presente
                            <strong>{{ strtolower(\App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato]) }}</strong>,
                            que se rege supletivamente pelas disposições da
                            @if (str_starts_with($contrato->tipo_contrato, 'trabalho_'))
                                <strong>Lei Geral do Trabalho</strong>,
                            @else
                                <strong>disposições do Código Civil</strong>,
                            @endif
                            respectiva legislação complementar, regulamento interno e pelas cláusulas seguintes:
                        </p>
                    </div>

                    {{-- === CLÁUSULAS === --}}
                    <div class="mt-5">
                        @if ($clausulas->isEmpty())
                            <div class="text-center py-5 border">
                                <i class="bi bi-exclamation-circle text-muted display-5 mb-3"></i>
                                <h5 class="text-muted">Nenhuma cláusula adicionada a este contrato.</h5>
                                <a href="{{ route('add.clausulas', $contrato->id) }}"
                                    class="btn btn-active mt-3 rounded-2">
                                    <i class="bi bi-plus-lg me-1"></i> Adicionar Cláusulas ao Contrato
                                </a>
                            </div>
                        @else
                            @foreach ($clausulas as $cc)
                                <div class="border-start border-3 border-active p-3 py-3 mb-3 bg-light rounded-1">
                                    <h5 class="fw-bold text-active mb-2 text-uppercase">
                                        <strong>CLAUSULA 
                                            {{ $loop->iteration }}ª –
                                            ({{ $cc->titulo_base }})
                                        </strong>
                                    </h5>
                                    <p class="text-justify mb-0" style="line-height: 1.2;">
                                        {{ $cc->conteudo }}
                                    </p>
                                    {{-- Acções de riscos --}}
                                    <div class="text-end mt-1">
                                        <a href="" class="text-danger me-2"
                                            data-bs-toggle="modal" data-bs-target="#deleteNivelModal{{ $cc->id }}">
                                            <i class="fas fa-trash"></i>
                                            Remover
                                        </a>
                                    </div>
                                </div>

                                {{-- Include Modal Remover clausulas ao contrato --}}
                                @include('company.contratos.remove-clausula-contrato')
                            @endforeach
                        @endif
                    </div>

                    {{-- === RODAPÉ === --}}
                    <div class="text-center mt-5 pt-4 border-top">
                        <p class="small text-muted mb-1">Documento gerado automaticamente pelo sistema
                            <strong>PontoFy</strong>.
                        </p>
                        <p class="small text-muted mb-0">© {{ date('Y') }} PontoFy - Gestão de Recursos Humanos</p>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <style>
        .text-active {
            color: #003e46 !important;
        }

        .border-active {
            border-color: #003e46 !important;
        }

        .btn-active {
            background-color: #003e46;
            color: #fff;
            border: none;
        }

        .btn-active:hover {
            background-color: #003e46;
            color: #fff;
        }

        .contrato-doc {
            font-size: 0.95rem;
            line-height: 1.7;
            color: #2f2f2f;
            text-align: justify;
            overflow: scroll;
            height: 100vh
        }
    </style>
@endsection
