{{-- MODAL EDITAR DEPENTE --}}
<!-- Modal de Edição de Nível Hierárquico -->
<div class="modal fade" id="rescindirContratoModal{{ $contrato->id }}" tabindex="-1"
    aria-labelledby="rescindirContratoModalLabel{{ $contrato->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title text-light" id="rescindirContratoModalLabel{{ $contrato->id }}">
                    <spam class="">
                        <i class="fas fa-times"></i>
                    </spam>
                    Rescindir este Contrato <i>'{{ $contrato->codigo }}'</i>
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('contrato.rescindir', $contrato->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body card rounded-0 m-0 border">
                    <!-- Parágrafo de alerta -->
                    <div class="alert alert-danger d-flex align-items-start" role="alert">
                        <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                        <div>
                            <strong>Atenção — Rescisão de Contrato:</strong> A rescisão contratual é um ato legal que
                            produz efeitos
                            imediatos nos direitos e deveres das partes, conforme a Lei Geral do Trabalho de Angola (Lei
                            n.º 7/15).
                            <br><br>
                            Após concluir esta ação:
                            <ul class="mb-1">
                                <li>o contrato será encerrado de forma definitiva;</li>
                                <li>o trabalhador deixa de prestar serviços e o empregador deixa de assumir obrigações
                                    laborais;</li>
                                <li>devem ser processados os direitos finais do trabalhador (férias vencidas, subsídios,
                                    remunerações e demais compensações legalmente devidas);</li>
                                <li>ficará registado o motivo da rescisão, a data e o responsável pela ação.</li>
                            </ul>
                            Confirme que está autorizado e que os dados inseridos estão corretos, pois esta operação não
                            pode ser revertida.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motivo_rescisao" class="form-label fw-bold">Motivo da Rescisão <span
                                class="text-danger">*</span></label>
                        <textarea name="motivo_rescisao" id="motivo_rescisao" rows="4" class="form-control"
                            placeholder="Descreva o motivo da rescisão do contrato..." required></textarea>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>

                    <button type="submit" class="btn btn-active">
                        <i class="bi bi-save me-1"></i> Confirmar Rescisão
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
