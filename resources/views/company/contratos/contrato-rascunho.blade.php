@extends('layouts.company-main')

@section('title', 'Contrato ' . $contrato->codigo . ' - PontoFy - Gestão de Recursos Humanos')

@section('content')
    <main class="container-fluid py-1 px-lg-5">
        <section class="page-inner">
            {{-- === CONTEÚDO DO CONTRATO === --}}
            <div class="card shadow-sm border-0 pt-3 rounded-0" style="margin-top: 4.5rem;">
                <div class="card-body p-4 pt-2  bg-white">
                    @include('company.erros.valida_erros')
                    {{-- Cabeçalho do Contrato --}}
                    @php
                        use App\Models\Contrato;
                        $partes = Contrato::tipoParte($contrato->tipo_contrato);
                    @endphp


                    <div class="mb-3 text-center">
                        @if ($contrato->status === 'rascunho')
                            <div class="card shadow mb-3">
                                <div
                                    class="card-header d-flex justify-content-between align-items-center bg-warning text-light rounded-0">
                                    <!-- Título à esquerda -->
                                    <h4 class="mb-0">RASCUNHO</h4>

                                    <!-- CTA Voltar à direita -->
                                    <a href="{{ route('colaborador.show', $contrato->colaborador->id) }}"
                                        class="btn btn-light btn-sm">
                                        <i class="fas fa-reply"></i> Voltar
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Título do Contrato -->
                        <h3 class="h4 fw-bold text-uppercase text-active mb-0">
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
                            <h3 class="h4 text-center"><strong>CLAÚSULAS</strong></h3>
                            <div class="card rounded-0 p-2 m-2">
                                <form action="{{ route('contrato.clausulas.destroy.multiple', $contrato->id) }}"
                                    method="POST" id="formDeleteMultiple">
                                    @csrf
                                    @method('DELETE')

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold text-dark mb-0">Cláusulas do Contrato</h6>

                                        <button type="submit" class="btn btn-danger btn-sm" id="btnDeleteSelected"
                                            disabled>
                                            <i class="bi bi-trash"></i> Remover Selecionadas
                                        </button>
                                    </div>


                                    <div class="contrato-doc">
                                        @foreach ($clausulas as $cc)
                                            <div
                                                class="border-start border-end border-2 border-active p-3 mb-3 bg-light rounded-0">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>

                                                        <label for="{{ $cc->id }}">CLÁUSULA {{ $loop->iteration }}ª
                                                            –
                                                            ({{ $cc->titulo_base }})
                                                        </label>
                                                    </div>
                                                    <input type="checkbox" name="clausulas[]" id="{{ $cc->id }}"
                                                        value="{{ $cc->id }}"
                                                        class="form-check-input clausula-checkbox me-2">
                                                </div>

                                                <p class="text-justify mb-0" style="line-height: 1.3;">
                                                    {{ $cc->pivot->conteudo_personalizado ?? $cc->conteudo }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>


                    {{-- === RODAPÉ === --}}
                    <div class="card py-2 border card-footer rounded-0 card-body text-center">
                        <div class="d-flex justify-content-center flex-wrap">

                            {{-- Visualizar PDF --}}
                            <div class="text-center m-2">
                                <a type="button" href="{{ route('contratos.pdf', $contrato->id) }}" class="btn-outline-active rounded-2">
                                    <i class="fas fa-file-pdf me-2"></i>
                                    VISUALIZAR PDF
                                </a>
                            </div>

                            {{-- Assinar Contrato --}}
                            <div class="m-2">
                                <button type="button" class="btn btn-active" data-bs-toggle="modal"
                                    data-bs-target="#assinarContratoModal{{ $contrato->id }}">
                                    <i class="fas fa-signature me-2"></i>
                                    ASSINAR CONTRATO
                                </button>
                                @include('company.contratos.manager.confirm-assinar')
                            </div>

                            {{-- Cancelar Contrato --}}
                            <div class="m-2">
                                <button type="button" class="btn bg-warning btn-active" data-bs-toggle="modal"
                                    data-bs-target="#cancelarContratoModal{{ $contrato->id }}">
                                    <i class="fas fa-ban me-2"></i>
                                    CANCELAR
                                </button>
                                @include('company.contratos.manager.confirm-cancelar')
                            </div>

                            {{-- Deletar Contrato --}}
                            <div class="m-2">
                                <button type="button" class="btn bg-danger btn-active" data-bs-toggle="modal"
                                    data-bs-target="#deleteContratoModal{{ $contrato->id }}">
                                    <i class="fas fa-trash-alt me-2"></i>
                                    DELETAR
                                </button>
                                @include('company.contratos.manager.confirm-delete')
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.clausula-checkbox');
            const btnDeleteSelected = document.getElementById('btnDeleteSelected');

            checkboxes.forEach(chk => {
                chk.addEventListener('change', () => {
                    const anyChecked = Array.from(checkboxes).some(c => c.checked);
                    btnDeleteSelected.disabled = !anyChecked;
                });
            });
        });
    </script>


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
            height: 60vh
        }
    </style>
@endsection
