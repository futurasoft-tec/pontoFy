<!-- Modal de Edição de Nível Hierárquico -->
<div class="modal fade" id="editPeriodoModal{{ $periodo->id }}" tabindex="-1"
    aria-labelledby="editPeriodoModalLabel{{ $periodo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="editPeriodoModalLabel{{ $periodo->id }}">
                    <i class="bi bi-pencil-square me-2"></i> Editar Período de Processamento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('periodo.update', $periodo->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Mês -->
                        <div class="col-md-6 mb-3">
                            <label for="mes" class="form-label fw-semibold">Mês</label>
                            <select name="mes" id="mes{{ $periodo->id }}" class="form-select rounded-1">
                                <option value="">Selecione...</option>
                                @foreach ([
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
    ] as $num => $nome)
                                    <option value="{{ $num }}" {{ $periodo->mes == $num ? 'selected' : '' }}>
                                        {{ $nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ano -->
                        <div class="col-md-6 mb-1">
                            <label for="ano" class="form-label fw-semibold">Ano</label>
                            <select name="ano" id="ano{{ $periodo->id }}" class="form-select rounded-1">
                                @php $anoAtual = now()->year; @endphp
                                @for ($y = $anoAtual - 5; $y <= $anoAtual; $y++)
                                    <option value="{{ $y }}" {{ $periodo->ano == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Data início -->
                        <div class="col-md-6 mb-0">
                            {{-- <label for="data_inicio" class="form-label fw-semibold border-0">Data Início</label> --}}
                            <input hidden type="date" name="data_inicio" id="data_inicio{{ $periodo->id }}"
                                value="{{ $periodo->data_inicio }}">
                            <input hidden type="date" name="data_fim" id="data_fim{{ $periodo->id }}"
                                value="{{ $periodo->data_fim }}">
                        </div>

                        <!-- Preview automático -->
                        <div class="col-12 mb-3">
                            <div id="previewPeriodo{{ $periodo->id }}"
                                class="alert alert-danger py-2 small text-center">
                                Período: {{ \Carbon\Carbon::parse($periodo->data_inicio)->format('d/m/Y') }} a
                                {{ \Carbon\Carbon::parse($periodo->data_fim)->format('d/m/Y') }}
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="col-md-12 mb-3">
                            <label for="observacoes" class="form-label fw-semibold">Descrição</label>
                            <textarea name="observacoes" id="observacoes{{ $periodo->id }}" class="form-control" rows="3"
                                placeholder="Descrição opcional...">{{ $periodo->observacoes }}</textarea>
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
                    const id = '{{ $periodo->id }}';
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
