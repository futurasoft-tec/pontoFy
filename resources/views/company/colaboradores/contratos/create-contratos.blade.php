{{-- MODAL ADICIONAR DEPENDENTE --}}
<!-- Modal de Criação de Nível Hierárquico -->
<div class="modal fade" id="createContratoModal" tabindex="-1" aria-labelledby="createContratoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createContratoModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Adicionar Novo Contrato
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('contrato.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                {{-- ColaboradorID --}}
                <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Tipo de Contrato -->
                        <div class="col-md-4 mb-3">
                            <label for="tipo_contrato" class="form-label fw-semibold">Tipo de Contrato</label>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-select rounded-1" required>
                                <option value="" disabled
                                    {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == '' ? 'selected' : '' }}>
                                    Selecione o tipo de contrato
                                </option>

                                <optgroup label="Contratos de Trabalho (Lei Geral do Trabalho)">
                                    @foreach (['trabalho_indeterminado', 'trabalho_determinado', 'trabalho_estagio', 'trabalho_parcial', 'trabalho_teletrabalho', 'trabalho_domicilio', 'trabalho_experiencia', 'trabalho_substituicao', 'trabalho_sazonal', 'trabalho_formacao'] as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == $tipo ? 'selected' : '' }}>
                                            {{ \App\Models\Contrato::TIPOS_CONTRATO[$tipo] }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Contratos de Prestação de Serviços (Código Civil)">
                                    @foreach (['servico_prestacao', 'servico_consultoria', 'servico_representacao', 'servico_mandato', 'servico_empreitada'] as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == $tipo ? 'selected' : '' }}>
                                            {{ \App\Models\Contrato::TIPOS_CONTRATO[$tipo] }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>


                        <!-- Data de Início -->
                        <div class="col-md-4 mb-3">
                            <label for="data_inicio" class="form-label fw-semibold">Data de Início: <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control" required>
                        </div>

                        <!-- Data de Fim -->
                        <div class="col-md-4 mb-3">
                            <label for="data_fim" class="form-label fw-semibold">Data de Fim: <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control" required>
                        </div>

                        <!-- Script de validação -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const dataInicio = document.getElementById('data_inicio');
                                const dataFim = document.getElementById('data_fim');

                                function validarDatas() {
                                    const inicio = new Date(dataInicio.value);
                                    const fim = new Date(dataFim.value);

                                    if (dataInicio.value && dataFim.value && fim < inicio) {
                                        alert('A data de fim não pode ser inferior à data de início.');
                                        dataFim.value = ''; // limpa o campo inválido
                                        dataFim.focus();
                                    }
                                }

                                dataInicio.addEventListener('change', validarDatas);
                                dataFim.addEventListener('change', validarDatas);
                            });
                        </script>

                        <!-- Período de Experiência -->
                        <div class="col-md-4 mb-3">
                            <label for="periodo_experiencia" class="form-label fw-semibold">
                                Período de Experiência
                            </label>
                            <select name="periodo_experiencia" id="periodo_experiencia" class="form-select rounded-1">
                                <option value="">Selecionar...</option>

                                <!-- Contrato por Tempo Determinado -->
                                <option value="30" {{ old('periodo_experiencia') == '30' ? 'selected' : '' }}>
                                    30 Dias (Máximo - Contrato de Trabalho por Tempo Determinado)
                                </option>

                                <!-- Contrato por Tempo Indeterminado -->
                                <option value="60" {{ old('periodo_experiencia') == '60' ? 'selected' : '' }}>
                                    60 Dias (Padrão - Contrato de Trabalho por Tempo Indeterminado)
                                </option>

                                <option value="120" {{ old('periodo_experiencia') == '120' ? 'selected' : '' }}>
                                    120 Dias (Acordo Escrito - Funções Técnicas/Responsabilidade)
                                </option>

                                <option value="180" {{ old('periodo_experiencia') == '180' ? 'selected' : '' }}>
                                    180 Dias (Funções de Direção ou Chefia)
                                </option>
                            </select>
                        </div>



                        <!--Salario Base -->
                        <div class="col-md-4 mb-3">
                            <label for="salario_base" class="form-label fw-semibold">Salário Base: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="salario_base" id="salario_base" class="form-control"
                                minlength="3" required min="0" placeholder="00.000">
                        </div>

                        <!--Fução -->
                        <div class="col-md-4 mb-3">
                            <label for="funcao" class="form-label fw-semibold">Função: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="funcao" id="funcao" class="form-control" minlength="3"
                                required min="0" value="{{ $colaborador->cargo->nome }}"
                                readonly>
                        </div>

                        {{-- Observacoes --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tipo_documento" class="form-label fw-semibold">Observações</label>
                                <textarea name="observacoes" id="observacoes" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-active">
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- ESTILIZAR FICHEIRO DOCUMENTO --}}
<style>
    .upload-container {
        margin-top: 16px;
        margin-bottom: 20px;
        text-align: center;
    }

    .upload-area {
        border: 2px dashed var(--primary-light);
        background: #f8f9ff;
        border-radius: 12px;
        padding: 28px;
        cursor: pointer;
        transition: var(--transition);
    }

    .upload-area:hover {
        background: #eef0ff;
        border-color: var(--primary);
        transform: scale(1.01);
    }

    .upload-icon {
        font-size: 32px;
        color: var(--primary);
        margin-bottom: 8px;
        animation: float 2.5s ease-in-out infinite;
    }

    .upload-text {
        font-weight: 600;
        color: var(--text);
    }

    .upload-hint {
        font-size: 13px;
        color: var(--text-light);
    }

    @keyframes float {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .file-info {
        background: #eef2ff;
        border: 1px solid var(--primary-light);
        border-radius: 10px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        box-shadow: var(--shadow);
    }

    .file-info i {
        color: var(--primary-dark);
        font-size: 18px;
        margin-right: 8px;
    }

    #fileName {
        font-weight: 600;
        color: var(--primary-dark);
        flex-grow: 1;
        text-align: left;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .remove-btn {
        background: transparent;
        border: none;
        color: var(--muted);
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
    }

    .remove-btn:hover {
        color: #ef4444;
    }
</style>

<script>
    const input = document.getElementById('caminho_arquivo');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const uploadBox = document.getElementById('uploadBox');

    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileName.textContent = this.files[0].name;
            fileInfo.style.display = 'flex';
            uploadBox.querySelector('.upload-area').style.display = 'none';
        }
    });

    function removerFicheiro() {
        input.value = '';
        fileInfo.style.display = 'none';
        uploadBox.querySelector('.upload-area').style.display = 'block';
    }
</script>
