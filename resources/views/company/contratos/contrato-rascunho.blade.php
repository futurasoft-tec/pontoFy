@extends('layouts.company-main')

@section('title', 'Contrato ' . $contrato->codigo . ' - PontoFy - Gestão de Recursos Humanos')

@section('content')
    <main class="container-fluid py-1 px-lg-5">
        <section class="page-inner">

            {{-- === CONTEÚDO DO CONTRATO === --}}
            <div class="card shadow-sm border-0 pt-5" style="margin-top: 1rem;">
                <div class="card-body p-4 pt-2  bg-white">
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
                    <div class="mt-5 contrato-doc">
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



                                    @foreach ($clausulas as $cc)
                                        <div
                                            class="border-start border-end border-2 border-active p-3 mb-3 bg-light rounded-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>

                                                    <label for="{{ $cc->id }}">CLÁUSULA {{ $loop->iteration }}ª –
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
                                </form>
                            </div>

                            {{-- Assinaturas --}}
                            <div class="mt-5 pt-4">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-top pt-3">
                                            <p class="fw-600 text-dark mb-1">_______________________</p>
                                            <p class="text-muted small">{{ $partes['empregador'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="border-top pt-3">
                                            <p class="fw-600 text-dark mb-1">_______________________</p>
                                            <p class="text-muted small">{{ $partes['trabalhador'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- === RODAPÉ === --}}
                    <div class="card py-2 border card-footer rounded-0 card-body text-center">
                        <div class="text-center">
                           <a href="{{ route('contratos.pdf', $contrato->id) }}" type="submit" class="btn-active rounded-2">
                                    <i class="bi bi-pencil-square me-2"></i> Finalizar e Assinar Contrato
                                </a>
                        </div>

                    </div>
                    {{-- <div class="text-center mt-5 pt-4 border-top">
                        <p class="small text-muted mb-1">Documento gerado automaticamente pelo sistema
                            <strong>PontoFy</strong>.
                        </p>
                        <p class="small text-muted mb-0">© {{ date('Y') }} PontoFy - Gestão de Recursos Humanos</p>
                    </div> --}}

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
