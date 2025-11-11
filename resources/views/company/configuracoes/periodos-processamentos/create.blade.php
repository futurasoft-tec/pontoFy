<!-- Modal de Criação periodos -->
<div class="modal fade" id="createPeriodosProcessamentosModal" tabindex="-1"
    aria-labelledby="createPeriodosProcessamentosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createPeriodosProcessamentosModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>
                    Criar novo período de processamento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('periodo.store') }}" method="POST">
                @csrf

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Mês -->
                        <div class="col-md-6 mb-3">
                            <label for="mes" class="form-label fw-semibold">Mês</label>
                            <select name="mes" id="mes" class="form-select rounded-1">
                                <option value="">Selecione...</option>
                                <option value="1">Janeiro</option>
                                <option value="2">Fevereiro</option>
                                <option value="3">Março</option>
                                <option value="4">Abril</option>
                                <option value="5">Maio</option>
                                <option value="6">Junho</option>
                                <option value="7">Julho</option>
                                <option value="8">Agosto</option>
                                <option value="9">Setembro</option>
                                <option value="10">Outubro</option>
                                <option value="11">Novembro</option>
                                <option value="12">Dezembro</option>
                            </select>
                        </div>

                        <!-- Ano -->
                        <div class="col-md-6 mb-1">
                            <label for="ano" class="form-label fw-semibold">Ano</label>
                            <select name="ano" id="ano" class="form-select rounded-1">
                                <option value="">Selecione...</option>
                                @php
                                    $anoAtual = now()->year;
                                @endphp

                                @for ($y = $anoAtual - 5; $y <= $anoAtual; $y++)
                                    <option value="{{ $y }}" {{ $y == $anoAtual ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor

                            </select>
                        </div>

                        <!-- Data início -->
                        <div class="col-md-6 mb-0">
                            {{-- <label for="data_inicio" class="form-label fw-semibold border-0">Data Início</label> --}}
                            <input hidden type="date" name="data_inicio" id="data_inicio" class="form-control"
                            readonly>
                            <input hidden type="date" name="data_fim" id="data_fim" class="form-control border-0" readonly>
                        </div>

                        <!-- Preview automático -->
                        <div class="col-12 mb-3">
                            <div id="previewPeriodo" class="alert alert-danger py-2 small text-center d-none"></div>
                        </div>

                        <!-- Descrição -->
                        <div class="col-md-12 mb-3">
                            <label for="observacoes" class="form-label fw-semibold">Descrição</label>
                            <textarea name="observacoes" id="observacoes" class="form-control" rows="3" placeholder="Descrição opcional..."></textarea>
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

            <!-- Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const mesSelect = document.getElementById('mes');
                    const anoSelect = document.getElementById('ano');
                    const dataInicio = document.getElementById('data_inicio');
                    const dataFim = document.getElementById('data_fim');
                    const preview = document.getElementById('previewPeriodo');

                    function atualizarPreview() {
                        const mes = parseInt(mesSelect.value);
                        const ano = parseInt(anoSelect.value);

                        if (!mes || !ano) {
                            preview.classList.add('d-none');
                            return;
                        }

                        const primeiroDia = new Date(ano, mes - 1, 1);
                        const ultimoDia = new Date(ano, mes, 0); // dia 0 do próximo mês = último dia do mês atual

                        const formatarData = (d) => {
                            const dia = String(d.getDate()).padStart(2, '0');
                            const mes = String(d.getMonth() + 1).padStart(2, '0');
                            return `${dia}/${mes}/${d.getFullYear()}`;
                        };

                        // Preencher campos de data automaticamente
                        dataInicio.value = primeiroDia.toISOString().split('T')[0];
                        dataFim.value = ultimoDia.toISOString().split('T')[0];

                        // Mostrar preview
                        preview.textContent = `Período: ${formatarData(primeiroDia)} a ${formatarData(ultimoDia)}`;
                        preview.classList.remove('d-none');
                    }

                    mesSelect.addEventListener('change', atualizarPreview);
                    anoSelect.addEventListener('change', atualizarPreview);
                });
            </script>

        </div>
    </div>
</div>
