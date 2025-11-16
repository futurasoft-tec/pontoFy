<div class="modal fade" id="cancelarContratoModal{{ $contrato->id }}" tabindex="-1"
    aria-labelledby="cancelarContratoModalLabel{{ $contrato->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title text-light" id="cancelarContratoModalLabel{{ $contrato->id }}">
                    <spam class="">
                        <i class="fas fa-times"></i>
                    </spam>
                    Cancelar este Contrato <i>'{{ $contrato->codigo }}'</i>
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('contrato.cancelar', $contrato->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body card rounded-0 m-0 border">
                    <!-- Alerta de confirmação -->
                    <div class="alert alert-warning d-flex align-items-start" role="alert">
                        <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                        <div class="text-start">
                            <strong>Confirmação necessária:</strong> Ao rescindir este contrato:
                            <ul class="mb-1">
                                <li>O contrato será encerrado imediatamente;</li>
                                <li>O trabalhador deixará de prestar serviços;</li>
                                <li>O empregador deixa de assumir obrigações laborais;</li>
                                <li>Os direitos finais do trabalhador deverão ser processados (férias, subsídios,
                                    remunerações, etc.).</li>
                            </ul>
                            Esta ação é <strong>irreversível</strong>. Confirme que deseja prosseguir.
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
