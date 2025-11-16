<div class="modal fade" id="deleteContratoModal{{ $contrato->id }}" tabindex="-1"
    aria-labelledby="deleteContratoModalLabel{{ $contrato->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title text-light" id="deleteContratoModalLabel{{ $contrato->id }}">
                    <spam class="">
                        <i class="fas fa-times"></i>
                    </spam>
                    Deletar permanentemente este Contrato <i>'{{ $contrato->codigo }}'</i>
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('contrato.destroy', $contrato->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')

                <div class="card-body card rounded-0 m-0 border">
                    <!-- Alerta de confirmação -->
                    <div class="alert alert-danger d-flex align-items-start" role="alert">
                        <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                        <div class="text-start">
                            <strong>Confirmação necessária:</strong> Ao **eliminar este contrato**:
                            <ul class="mb-1">
                                <li>O contrato será **excluído permanentemente**;</li>
                                <li>O trabalhador deixará de estar vinculado a este contrato;</li>
                                <li>O empregador deixará de assumir quaisquer obrigações relacionadas a este contrato;
                                </li>
                                <li>Todos os registros vinculados ao contrato serão perdidos (cláusulas, observações,
                                    histórico, etc.).</li>
                            </ul>
                            <strong>Atenção:</strong> Esta ação é <span class="text-danger fw-bold">irreversível</span>.
                            Certifique-se de que deseja realmente deletar este contrato antes de prosseguir.
                        </div>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>

                    <button type="submit" class="btn btn-active">
                        <i class="bi bi-save me-1"></i> Confirmar
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
