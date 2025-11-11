<!-- Modal de Edição de Nível Hierárquico -->
<div class="modal fade" id="editRubricadoModal{{ $rubrica->id }}" tabindex="-1"
    aria-labelledby="editRubricadoModalModalLabel{{ $rubrica->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="editRubricadoModalModalLabel{{ $rubrica->id }}">
                    <i class="bi bi-pencil-square me-2"></i> Editar Período de Processamento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('rubrica.update', $rubrica->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <!-- Código -->
                        <div class="col-md-4 mb-3">
                            <label for="codigo" class="form-label fw-semibold">Código</label>
                            <input type="text" name="codigo" id="codigo" class="form-control"
                                placeholder="Ex: SAL_BASE" required value="{{ old('codigo', $rubrica->codigo) }}"
                                style="height: 40px;">
                        </div>

                        <!-- Nome -->
                        <div class="col-md-4 mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control"
                                placeholder="Ex: Salário Base" required value="{{ old('nome', $rubrica->nome) }}"
                                style="height: 40px;">
                        </div>

                        <!-- Tipo -->
                        <div class="col-md-4 mb-3">
                            <label for="tipo" class="form-label fw-semibold">Tipo</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="vencimento"
                                    {{ old('tipo', $rubrica->tipo) === 'vencimento' ? 'selected' : '' }}>
                                    Vencimento
                                </option>
                                <option value="desconto"
                                    {{ old('tipo', $rubrica->tipo) === 'desconto' ? 'selected' : '' }}>
                                    Desconto
                                </option>
                            </select>
                        </div>

                        <!-- Base de cálculo -->
                        <div class="col-md-4 mb-3">
                            <label for="base_calculo" class="form-label fw-semibold">Base de Cálculo</label>
                            <select name="base_calculo" id="base_calculo" class="form-select" required>
                                <option value="fixo"
                                    {{ old('base_calculo', $rubrica->base_calculo) === 'fixo' ? 'selected' : '' }}>Fixo
                                </option>
                                <option value="percentual"
                                    {{ old('base_calculo', $rubrica->base_calculo) === 'percentual' ? 'selected' : '' }}>
                                    Percentual</option>
                                <option value="formula"
                                    {{ old('base_calculo', $rubrica->base_calculo) === 'formula' ? 'selected' : '' }}>
                                    Fórmula</option>
                            </select>
                        </div>

                        <!-- Valor -->
                        <div class="col-md-4 mb-3">
                            <label for="valor" class="form-label fw-semibold">Valor</label>
                            <input type="number" step="0.01" name="valor" id="valor" class="form-control"
                                placeholder="Ex: 150000" value="{{ old('valor', $rubrica->valor) }}"
                                style="height: 40px;">
                        </div>

                        <!-- Fórmula -->
                        <div class="col-md-4 mb-3">
                            <label for="formula" class="form-label fw-semibold">Fórmula (opcional)</label>
                            <input type="text" name="formula" id="formula" class="form-control"
                                value="{{ old('formula', $rubrica->formula) }}"
                                style="height: 40px;">
                            <small id="formulaAlert" class="text-danger d-none">
                                Caracteres inválidos detectados! Apenas números (0-9), operadores (+ - * /), parênteses
                                (), ponto decimal ., letras maiúsculas (A-Z), underline _ e espaços são permitidos.
                            </small>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const baseSelect = document.getElementById('base_calculo');
                                const valorInput = document.getElementById('valor');
                                const formulaInput = document.getElementById('formula');
                                const alertEl = document.getElementById('formulaAlert');

                                // Função que alterna habilitação dos campos
                                function updateFields() {
                                    switch (baseSelect.value) {
                                        case 'fixo':
                                            valorInput.placeholder = 'Ex: 150000';
                                            valorInput.disabled = false;
                                            formulaInput.disabled = true;
                                            break;
                                        case 'percentual':
                                            valorInput.placeholder = 'Ex: 0%';
                                            valorInput.disabled = false;
                                            formulaInput.disabled = true;
                                            break;
                                        case 'formula':
                                            valorInput.placeholder = 'Não aplicável';
                                            valorInput.value = '';
                                            valorInput.disabled = true;
                                            formulaInput.disabled = false;
                                            break;
                                    }
                                }

                                // Executa ao carregar
                                updateFields();

                                // Executa ao mudar base de cálculo
                                baseSelect.addEventListener('change', updateFields);

                                // Validação da fórmula
                                formulaInput.addEventListener('input', function() {
                                    const regex = /^[0-9+\-*/()._A-Z\s]*$/;
                                    if (!regex.test(this.value)) {
                                        this.value = this.value.replace(/[^0-9+\-*/()._A-Z\s]/g, '');
                                        alertEl.classList.remove('d-none');
                                    } else {
                                        alertEl.classList.add('d-none');
                                    }
                                });
                            });
                        </script>

                        <!-- Descrição -->
                        <div class="col-12 mb-3">
                            <label for="descricao" class="form-label fw-semibold">Descrição</label>
                            <textarea name="descricao" id="descricao" class="form-control" rows="2" placeholder="Descrição opcional..."></textarea>
                        </div>

                        <!-- Tributável (opcional, default true) -->
                        <div class="col-md-4 mb-3">
                            <label for="is_tributavel" class="form-label fw-semibold">Tributável</label>
                            <select name="is_tributavel" id="is_tributavel" class="form-select">
                                <option value="1" {{ old('is_tributavel', '1') == '1' ? 'selected' : '' }}>Sim
                                </option>
                                <option value="0" {{ old('is_tributavel') == '0' ? 'selected' : '' }}>Não
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-active">
                        <i class="bi bi-save me-1"></i> Guardar Alterações
                    </button>
                </div>
            </form>

            <!-- Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const id = '{{ $rubrica->id }}';
                    const mesSelect = document.getElementById('mes' + id);
                    const anoSelect = document.getElementById('ano' + id);
                    const dataInicio = document.getElementById('data_inicio' + id);
                    const dataFim = document.getElementById('data_fim' + id);
                    const preview = document.getElementById('previewPeriodo' + id);

                    function atualizarPreview() {
                        const mes = parseInt(mesSelect.value);
                        const ano = parseInt(anoSelect.value);

                        if (!mes || !ano) return;

                        const primeiroDia = new Date(ano, mes - 1, 1);
                        const ultimoDia = new Date(ano, mes, 0);
                        const formatarData = d =>
                            `${String(d.getDate()).padStart(2, '0')}/${String(d.getMonth() + 1).padStart(2, '0')}/${d.getFullYear()}`;

                        dataInicio.value = primeiroDia.toISOString().split('T')[0];
                        dataFim.value = ultimoDia.toISOString().split('T')[0];

                        preview.textContent = `Período: ${formatarData(primeiroDia)} a ${formatarData(ultimoDia)}`;
                    }

                    mesSelect.addEventListener('change', atualizarPreview);
                    anoSelect.addEventListener('change', atualizarPreview);
                });
            </script>
        </div>
    </div>
</div>
