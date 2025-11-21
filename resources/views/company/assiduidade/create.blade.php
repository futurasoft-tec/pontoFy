{{-- MODAL CRIAR ASSIDUIDADE --}}
<div class="modal fade" id="createAssiduidadeModal" tabindex="-1" aria-labelledby="createAssiduidadeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createAssiduidadeModalLabel">
                    <i class="fas fa-fingerprint me-2"></i>
                    Adicionar Registro de Ponto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('assiduidade.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="team_id" value="{{ auth()->user()->currentTeam->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Colaborador -->
                        <div class="col-md-4 mb-3">
                            <label for="colaborador_id" class="form-label fw-semibold">Colaborador <span
                                    class="text-danger">*</span></label>
                            <select name="colaborador_id" id="colaborador_id" class="form-select rounded-1" required>
                                @foreach ($colaboradores as $c)
                                    <option value="{{ $c->id }}">{{ $c->nome_completo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Data -->
                        <div class="col-md-4 mb-3">
                            <label for="data" class="form-label fw-semibold">Data <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="data" id="data" class="form-control" required>
                        </div>

                        <!-- Escala -->
                        <div class="col-md-4 mb-3">
                            <label for="escala_id" class="form-label fw-semibold">Escala</label>
                            <select name="escala_id" id="escala_id" class="form-select rounded-1">
                                <option value="">Nenhuma</option>
                                @foreach ($escalas as $e)
                                    <option value="{{ $e->id }}">
                                        {{ $e->colaborador->nome_completo ?? '' }} - {{ $e->data->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select name="status" id="statusSelect" class="form-select rounded-1">
                                @foreach (['presente', 'falta', 'feriado', 'licenca', 'home_office'] as $status)
                                    <option value="{{ $status }}">{{ ucfirst(str_replace('_', ' ', $status)) }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Indicadores visuais do status -->
                            <div class="mt-2 d-flex flex-wrap gap-2 text-center justif">
                                <span class="status-badge status-presente">
                                    <i class="bi bi-check-circle me-1"></i> Presente
                                </span>
                                <span class="status-badge status-falta">
                                    <i class="bi bi-x-circle me-1"></i> Falta
                                </span>
                                <span class="status-badge status-feriado">
                                    <i class="bi bi-balloon me-1"></i> Feriado
                                </span>
                                <span class="status-badge status-licenca">
                                    <i class="bi bi-file-earmark-medical me-1"></i> Licença
                                </span>
                                <span class="status-badge status-home_office">
                                    <i class="bi bi-house me-1"></i> Home Office
                                </span>
                            </div>
                        </div>
                    </div>


                    <!-- Seção: Horários (condicional) -->
                    <section id="pontoCampos" class="form-section">
                        <h5 class="section-title">
                            <i class="bi bi-clock me-2"></i>Registro de Horários
                        </h5>
                        <div class="horarios mb-2 time-inputs">
                            <div class="row">
                                <!-- Horas Entrada/Saída -->
                                <div class="col-md-6 mb-3">
                                    <label for="hora_entrada" class="form-label fw-semibold">Hora Entrada</label>
                                    <input type="time" name="hora_entrada" id="hora_entrada" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="hora_saida" class="form-label fw-semibold">Hora Saída</label>
                                    <input type="time" name="hora_saida" id="hora_saida" class="form-control">
                                </div>

                                <!-- Pausa Almoço -->
                                <div class="col-md-6 mb-3">
                                    <label for="hora_inicio_almoco" class="form-label fw-semibold">Início Almoço</label>
                                    <input type="time" name="hora_inicio_almoco" id="hora_inicio_almoco"
                                        class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="hora_fim_almoco" class="form-label fw-semibold">Fim Almoço</label>
                                    <input type="time" name="hora_fim_almoco" id="hora_fim_almoco"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </section>



                    <!-- Observações -->
                    <div class="mb-3">
                        <label for="observacoes" class="form-label fw-semibold">Observações</label>
                        <textarea name="observacoes" id="observacoes" class="form-control" rows="2"></textarea>
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


<style>
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-presente {
        background-color: rgba(74, 222, 128, 0.15);
        color: #166534;
    }

    .status-falta {
        background-color: rgba(248, 113, 113, 0.15);
        color: #991b1b;
    }

    .status-feriado {
        background-color: rgba(251, 191, 36, 0.15);
        color: #92400e;
    }

    .status-licenca {
        background-color: rgba(76, 201, 240, 0.15);
        color: #1e40af;
    }

    .status-home_office {
        background-color: rgba(168, 85, 247, 0.15);
        color: #7e22ce;
    }

    .time-inputs {
        background-color: rgba(67, 97, 238, 0.05);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        border: 1px dashed rgba(67, 97, 238, 0.3);
    }
</style>


<script>
    // Controle de visibilidade dos campos de horário
    document.getElementById("statusSelect").addEventListener("change", function() {
        const pontoCampos = document.getElementById("pontoCampos");
        if (this.value === "presente" || this.value === "home_office") {
            pontoCampos.style.display = "block";
        } else {
            pontoCampos.style.display = "none";
        }
    });

    // Inicialização: verificar status ao carregar a página
    document.addEventListener("DOMContentLoaded", function() {
        const statusSelect = document.getElementById("statusSelect");
        const pontoCampos = document.getElementById("pontoCampos");

        // Verificar o valor inicial
        if (statusSelect.value !== "presente" && statusSelect.value !== "home_office") {
            pontoCampos.style.display = "none";
        }
    });
</script>
