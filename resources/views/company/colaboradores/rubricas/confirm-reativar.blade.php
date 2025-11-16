{{-- ===============MODAIS=========== --}}
<div class="modal fade" id="reativarRubricaModal{{ $rubrica->pivot->id }}" tabindex="-1"
    aria-labelledby="reativarRubricaModalLabel{{ $rubrica->pivot->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h4 class="modal-title" id="reativarRubricaModalLabel{{ $rubrica->pivot->id }}">
                    <i class="fas fa-edit me-2"></i> Reativar Rubrica <i>'{{ $rubrica->nome }}'</i>
                </h4>
                <i class="bi bi-pencil-square me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário para reativar -->
            <form action="{{ route('rubricaColaborador.reativar', $rubrica->pivot->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="status" value="ativo">

                <div class="modal-body">
                    <div class="alert alert-success d-flex align-items-start" role="alert">
                        <i class="fas fa-check-circle me-2 mt-1"></i>
                        <div>
                            <strong>Confirmação necessária:</strong> Ao reativar esta rubrica:
                            <ul class="mb-1">
                                <li>Ela voltará a ser aplicada ao colaborador;</li>
                                <li>Os cálculos futuros que dependem desta rubrica serão incluídos novamente;</li>
                                <li>Os dados anteriores permanecem intactos.</li>
                            </ul>
                            Esta ação é <strong>reversível</strong>, caso precise desativar novamente.
                        </div>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-power-off me-1"></i> Reativar Rubrica
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
