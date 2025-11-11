<!-- Modal de Edição de Nível Hierárquico -->
<div class="modal fade" id="modalDetalheClausula{{ $clausula->id }}" tabindex="-1"
    aria-labelledby="modalDetalheClausulaLabel{{ $clausula->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="modalDetalheClausulaLabel{{ $clausula->id }}">
                    <i class="bi bi-pencil-square me-2"></i>
                    <strong>Clausula: </strong> {{ $clausula->titulo_base }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
               <h4 class="text-active mt-1">{{ $clausula->titulo_base }}</h4>
               <p>{{ $clausula->conteudo }}</p>
            </div>

            <!-- Rodapé -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Fechar
                </button>

                 <button type="button" class="btn btn-active border" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Entendi
                </button>
            </div>
        </div>
    </div>
</div>
