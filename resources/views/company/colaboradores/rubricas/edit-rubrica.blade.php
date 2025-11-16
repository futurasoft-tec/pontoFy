{{-- MODAL EDITAR RUBRICA --}}
<div class="modal fade" id="editRubricaModal{{ $rubrica->pivot->id }}" tabindex="-1"
    aria-labelledby="editRubricaModalLabel{{ $rubrica->pivot->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h4 class="modal-title" id="editRubricaModalLabel{{ $rubrica->pivot->id }}">
                    <i class="fas fa-edit me-2"></i> Editar Rubrica <i>'{{ $rubrica->nome }}'</i>
                </h4>
                <i class="bi bi-pencil-square me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('rubricaColaborador.update', $rubrica->pivot->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}">
                <div class="modal-body">
                    <div class="row">
                        <!-- Tipo de Rubrica -->
                        <div class="col-md-4 mb-3">
                            <label for="rubrica_id" class="form-label fw-semibold">Tipo de Rubrica</label>
                            @php
                                // Valor selecionado: primeiro old(), depois tenta rubrica->rubrica_id (pivot), depois rubrica->id (se estiver a passar um Rubrica)
                                $selected = old('rubrica_id', null);
                                if (is_null($selected) && isset($rubrica)) {
                                    // se $rubrica for RubricaColaborador tem rubrica_id
                                    $selected = $rubrica->rubrica_id ?? ($rubrica->id ?? null);
                                }
                            @endphp

                            <select name="rubrica_id" id="rubrica_id" class="form-select rounded-1" required>
                                @if (isset($rubricas) && count($rubricas))
                                    @foreach ($rubricas as $r)
                                        <option value="{{ $r->id }}" {{ $selected == $r->id ? 'selected' : '' }}>
                                            {{ $r->nome }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">Nenhuma rubrica disponível</option>
                                @endif
                            </select>


                        </div>

                        <!-- Automática -->
                        <div class="col-md-4 mb-3">
                            <label for="eh_automatica" class="form-label fw-semibold">Automática?</label>
                            <select name="eh_automatica" id="eh_automatica" class="form-select rounded-1">
                                <option value="1"
                                    {{ optional($rubrica->pivot)->eh_automatica == 1 ? 'selected' : '' }}>Sim</option>
                                <option value="0"
                                    {{ optional($rubrica->pivot)->eh_automatica == 0 ? 'selected' : '' }}>Não</option>
                            </select>
                        </div>

                        <!-- Valor -->
                        <div class="col-md-4 mb-3">
                            <label for="valor_customizado" class="form-label fw-semibold">Valor: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="valor_customizado" id="valor_customizado" class="form-control"
                                min="0" step="0.01"
                                value="{{ $rubrica->pivot->valor_customizado ?? $rubrica->valor }}"
                                style="height: 40px;">
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
        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
