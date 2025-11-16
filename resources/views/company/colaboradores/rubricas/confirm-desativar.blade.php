{{-- ===============MODAIS=========== --}}
<div class="modal fade" id="desativarRubricaModal{{ $rubrica->pivot->id }}" tabindex="-1"
    aria-labelledby="desativarRubricaModalLabel{{ $rubrica->pivot->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h4 class="modal-title" id="desativarRubricaModalLabel{{ $rubrica->pivot->id }}">
                    <i class="fas fa-edit me-2"></i> Desabilitar Rubrica <i>'{{ $rubrica->nome }}'</i>
                </h4>
                <i class="bi bi-pencil-square me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('rubricaColaborador.desativar', $rubrica->pivot->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="status" value="inativo">

                <div class="modal-body">
                    <div class="alert alert-warning d-flex align-items-start" role="alert">
                        <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                        <div>
                            <strong>Confirmação necessária:</strong> Ao desativar esta rubrica:
                            <ul class="mb-1">
                                <li>Ela não será mais aplicada ao colaborador;</li>
                                <li>Os cálculos futuros que dependem desta rubrica serão desconsiderados;</li>
                                <li>Você poderá reativá-la posteriormente, se necessário.</li>
                            </ul>
                            Esta ação <strong>não deleta</strong> a rubrica, apenas altera seu status para
                            <em>inativo</em>.
                        </div>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-active bg-warning">
                        <i class="fas fa-ban me-1"></i> Desativar Rubrica
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
