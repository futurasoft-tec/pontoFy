{{-- MODAL ADICIONAR RUBRICAS AO COLABORADOR --}}
<div class="modal fade" id="addRubricaModal" tabindex="-1" aria-labelledby="addRubricaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="addRubricaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Adicionar Novas Rubricas ao Colaborador
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('rubricaColaborador.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Tipo de Contrato -->
                        <div class="col-md-4 mb-3">
                            <label for="rubrica_id" class="form-label fw-semibold">Tipo de Contrato</label>
                            @if (isset($rubricas) && count($rubricas))
                                <select name="rubrica_id" id="rubrica_id" class="form-select rounded-1" required>
                                    @foreach ($rubricas as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <p class="p-0 m-0 small" style="font-size: 11px;">Nenhuma rubrica disponível</p>
                                <a href="{{ route('rubrica.create') }}" class="text-active mt-1"
                                    data-bs-toggle="modal" data-bs-target="#createRubricaModal">
                                    <i class="fas fa-plus-square"></i>
                                    <span class="d-none d-sm-inline-block ms-2">Adicionar Rubrica</span>
                                </a>
                            @endif

                        </div>

                        
                        <!-- Data de Início -->
                        <div class="col-md-4 mb-3">
                            <label for="eh_automatica" class="form-label fw-semibold">Automática?</label>
                            <select name="eh_automatica" id="eh_automatica" class="form-select rounded-1" required>
                                <option value="1">
                                    Sim
                                </option>
                                <option value="0">
                                    Não
                                </option>
                            </select>
                        </div>

                        <!-- Data de Fim -->
                        <div class="col-md-4 mb-3">
                            <label for="valor_customizado" class="form-label fw-semibold">Valor: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="valor_customizado" id="valor_customizado" class="form-control"
                                min="0" placeholder="0.000,00">
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
