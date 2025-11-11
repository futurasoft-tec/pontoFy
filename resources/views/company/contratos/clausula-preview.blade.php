<section class="border rounded-2 shadow-sm bg-white">
    <div class="card border-0 h-100">
        <!-- Header -->
        <div class="card-header border-bottom p-3 d-flex justify-content-between align-items-center">
            <h6 class="fw-semibold text-dark mb-0">Pré-visualização do Contrato</h6>
            {{-- <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-active rounded-1 p-2" style="font-size: 0.75rem;">
                    <i class="bi bi-download me-1"></i> Download
                </button>
                <button class="btn btn-sm btn-outline-active rounded-1 p-2" style="font-size: 0.75rem;">
                    <i class="fas fa-print me-1"></i> Imprimir
                </button>
            </div> --}}
        </div>

        <!-- Body -->
        <div class="card-body p-3" style="max-height: 700px; overflow-y: auto;">
            <div class="contrato-preview p-4 border rounded-2 shadow-sm bg-light">
                {{-- Cabeçalho do Contrato --}}
                @php
                    use App\Models\Contrato;
                    $partes = Contrato::tipoParte($contrato->tipo_contrato);
                @endphp

                <!-- Título do Contrato -->
                <h3 class="fw-bold text-uppercase text-center text-active mb-4">
                    {{ \App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato] ?? $contrato->tipo_contrato }}
                </h3>

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

                    <p class="mt-3 lh-base text-justify">
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

                {{-- Cláusulas do Contrato --}}
                <div id="clausulas-container" class="mb-4">
                    <div class="text-center py-5 border border-dashed rounded-2 bg-white">
                        <i class="bi bi-file-text display-4 opacity-25 mb-2"></i>
                        <p class="mb-0 text-muted">Selecione cláusulas para visualizar o contrato</p>
                    </div>
                </div>

                {{-- Assinaturas --}}
                <div class="mt-5 pt-4 border-top">
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
            </div>
        </div>
    </div>
</section>
