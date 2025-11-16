{{-- MODAL CONFIRMAR ASSINATURA --}}
<div class="modal fade" id="assinarContratoModal{{ $contrato->id }}" tabindex="-1"
    aria-labelledby="assinarContratoModalLabel{{ $contrato->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-0">

            <!-- Cabeçalho -->
            <div class="card card-header bg-active text-center rounded-0">
                <h4 class="h5 modal-title text-light" id="assinarContratoModalLabel{{ $contrato->id }}">
                    CONFIRMAR ASSINATURA DO CONTRATO {{ $contrato->codigo }}
                </h4>
                {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button> --}}
            </div>

            <!-- Formulário -->
            <form action="{{ route('contrato.assinar', $contrato->id) }}" method="POST" enctype="multipart/form-data"
                class="">
                @csrf
                @method('PUT')

                <div class="m-3 card card-body border rounded-0" style="text-align: justify;">
                    <p><strong>Confirmação de Assinatura:</strong> Ao assinar este contrato, você confirma que leu e
                        concorda com todas as cláusulas e condições estabelecidas no documento.</p>

                    <p>Após a assinatura, o contrato passa a ter validade legal e todas as partes envolvidas ficam
                        vinculadas aos seus direitos e deveres. Certifique-se de que todas as informações estão corretas
                        antes de prosseguir.</p>

                    <p>Esta ação é <strong>irreversível</strong> e será registrada eletronicamente para efeitos legais.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-active">
                        <i class="bi bi-save me-1"></i>
                        CONFIRMAR ASSINATURA
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
