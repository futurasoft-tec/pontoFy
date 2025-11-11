<!-- Modal de Criação periodos -->
<div class="modal fade" id="createRubricaModal" tabindex="-1" aria-labelledby="createRubricaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createRubricaModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>
                    Criar nova Rubricas de processamento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário para criar Rubrica -->
            <form action="{{ route('rubrica.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <!-- Código -->
                        <div class="col-md-4 mb-3">
                            <label for="codigo" class="form-label fw-semibold">Código</label>
                            <input type="text" name="codigo" id="codigo" class="form-control"
                                placeholder="Ex: SAL_BASE" required value="{{ old('codigo') }}">
                        </div>

                        <!-- Nome -->
                        <div class="col-md-4 mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control"
                                placeholder="Ex: Salário Base" required value="{{ old('nome') }}">
                        </div>

                        <!-- Tipo -->
                        <div class="col-md-4 mb-3">
                            <label for="tipo" class="form-label fw-semibold">Tipo</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">Selecione...</option>
                                <option value="vencimento" {{ old('tipo') === 'vencimento' ? 'selected' : '' }}>
                                    Vencimento</option>
                                <option value="desconto" {{ old('tipo') === 'desconto' ? 'selected' : '' }}>Desconto
                                </option>
                            </select>
                        </div>

                        <!-- Base de cálculo -->
                        <div class="col-md-4 mb-3">
                            <label for="base_calculo" class="form-label fw-semibold">Base de Cálculo</label>
                            <select name="base_calculo" id="base_calculo" class="form-select" required>
                                <option value="fixo" {{ old('base_calculo', 'fixo') === 'fixo' ? 'selected' : '' }}>
                                    Fixo</option>
                                <option value="percentual" {{ old('base_calculo') === 'percentual' ? 'selected' : '' }}>
                                    Percentual</option>
                                <option value="formula" {{ old('base_calculo') === 'formula' ? 'selected' : '' }}>
                                    Fórmula</option>
                            </select>
                        </div>

                        <!-- Valor -->
                        <div class="col-md-4 mb-3">
                            <label for="valor" class="form-label fw-semibold">Valor</label>
                            <input type="number" step="0.01" name="valor" id="valor" class="form-control"
                                placeholder="Ex: 150000" required value="{{ old('valor') }}">
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const baseSelect = document.getElementById('base_calculo');
                                const valorInput = document.getElementById('valor');
                                const formulaInput = document.getElementById('formula');

                                function updateFields() {
                                    switch (baseSelect.value) {
                                        case 'fixo':
                                            valorInput.placeholder = 'Ex: 150000';
                                            valorInput.step = '0.01';
                                            valorInput.disabled = false;
                                            formulaInput.disabled = true; // desabilita fórmula
                                            break;
                                        case 'percentual':
                                            valorInput.placeholder = 'Ex: 0%';
                                            valorInput.step = '0.01';
                                            valorInput.disabled = false;
                                            formulaInput.disabled = true; // desabilita fórmula
                                            break;
                                        case 'formula':
                                            valorInput.placeholder = 'Não aplicável';
                                            valorInput.value = '';
                                            valorInput.disabled = true;
                                            formulaInput.disabled = false; // habilita fórmula
                                            break;
                                    }
                                }

                                // Atualiza ao carregar a página
                                updateFields();

                                // Atualiza ao mudar a seleção
                                baseSelect.addEventListener('change', updateFields);
                            });
                        </script>


                        <!-- Fórmula (opcional) -->
                        <div class="col-md-4 mb-3">
                            <label for="formula" class="form-label fw-semibold">Fórmula (opcional)</label>
                            <input type="text" name="formula" id="formula" class="form-control"
                                value="{{ old('formula', 'HORA_EXTRA*500') }}">
                            <small id="formulaAlert" class="text-danger d-none">
                                Caracteres inválidos detectados! Apenas números (0-9), operadores (+ - * /), parênteses
                                (), ponto decimal ., letras maiúsculas (A-Z), underline _ e espaços são permitidos.
                            </small>
                            {{-- Validar valores aceites --}}

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const formulaInput = document.getElementById('formula');
                                    const alertEl = document.getElementById('formulaAlert');

                                    formulaInput.addEventListener('input', function() {
                                        // Regex para permitir apenas números, operadores, parênteses, ponto, letras maiúsculas, underscore e espaços
                                        const regex = /^[0-9+\-*/()._A-Z\s]*$/;

                                        if (!regex.test(this.value)) {
                                            // Remove caracteres inválidos
                                            this.value = this.value.replace(/[^0-9+\-*/()._A-Z\s]/g, '');
                                            // Mostra alerta
                                            alertEl.classList.remove('d-none');
                                        } else {
                                            // Esconde alerta se estiver válido
                                            alertEl.classList.add('d-none');
                                        }
                                    });
                                });
                            </script>
                        </div>

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
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
