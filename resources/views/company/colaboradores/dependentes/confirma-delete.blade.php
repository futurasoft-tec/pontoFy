{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteDependenteModal{{ $dependente->id }}" tabindex="-1"
    aria-labelledby="deleteDependenteModalLabel{{ $dependente->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title d-flex align-items-center gap-2"
                    id="deleteDependenteModalLabel{{ $dependente->id }}">
                    <i class="bi bi-exclamation-triangle-fill"></i> Confirmar Eliminação
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Tem certeza que deseja eliminar o nível
                    <strong>{{ $dependente->nome }}</strong>?
                </p>
                <p class="text-muted small mb-0">Esta ação é irreversível e removerá permanentemente
                    este registo.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancelar
                </button>
                <form action="{{ route('dependente.destroy', $dependente->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

