<!-- Modal de Criação de Nível Hierárquico -->
<div class="modal fade" id="createNivelHierarquicoModal" tabindex="-1" aria-labelledby="createNivelHierarquicoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createNivelHierarquicoModalLabel">
                    <i class="bi bi-plus-circle me-2"></i> Adicionar Novo Nível Hierárquico
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('nivel.store') }}" method="POST">
                @csrf

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col-md-6 mb-3">
                            <label for="nome_create" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" id="nome_create" class="form-control"
                                placeholder="Ex: Diretor, Coordenador..." required>
                        </div>

                        <!-- Código -->
                        <div class="col-md-3 mb-3">
                            <label for="codigo_create" class="form-label fw-semibold">Código</label>
                            <input type="text" name="codigo" id="codigo_create" class="form-control"
                                placeholder="Ex: N1, N2...">
                        </div>

                        <!-- Prioridade -->
                        <div class="col-md-3 mb-3">
                            <label for="prioridade_create" class="form-label fw-semibold">Prioridade</label>
                            <input type="number" name="prioridade" id="prioridade_create" class="form-control"
                                value="1" min="1">
                        </div>

                        <!-- Descrição -->
                        <div class="col-md-12 mb-3">
                            <label for="descricao_create" class="form-label fw-semibold">Descrição</label>
                            <textarea name="descricao" id="descricao_create" class="form-control" rows="3"
                                placeholder="Descrição opcional..."></textarea>
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
