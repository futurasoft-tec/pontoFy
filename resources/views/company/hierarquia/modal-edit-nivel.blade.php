<!-- Modal de Edição de Nível Hierárquico -->
<div class="modal fade" id="editNivelModal{{ $nivel->id }}" tabindex="-1"
    aria-labelledby="editNivelModalLabel{{ $nivel->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="editNivelModalLabel{{ $nivel->id }}">
                    <i class="bi bi-pencil-square me-2"></i> Editar Nível Hierárquico
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('nivel.update', $nivel->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- team do usuario autenticado --}}
                <input type="hidden" name="team_id" id="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{--  usuario autenticado --}}
                <input type="hidden" name="criado_por" id="criado_por" value="{{ Auth::user()->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col-md-6 mb-3">
                            <label for="nome_{{ $nivel->id }}" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" id="nome_{{ $nivel->id }}" class="form-control"
                                value="{{ old('nome', $nivel->nome) }}" required>
                        </div>

                        <!-- Código -->
                        <div class="col-md-3 mb-3">
                            <label for="codigo_{{ $nivel->id }}" class="form-label fw-semibold">Código</label>
                            <input type="text" name="codigo" id="codigo_{{ $nivel->id }}" class="form-control"
                                value="{{ old('codigo', $nivel->codigo) }}">
                        </div>

                        <!-- Prioridade -->
                        <div class="col-md-3 mb-3">
                            <label for="prioridade_{{ $nivel->id }}"
                                class="form-label fw-semibold">Prioridade</label>
                            <input type="number" name="prioridade" id="prioridade_{{ $nivel->id }}"
                                class="form-control" value="{{ old('prioridade', $nivel->prioridade) }}"
                                min="1">
                        </div>

                        <!-- Descrição -->
                        <div class="col-md-12 mb-3">
                            <label for="descricao_{{ $nivel->id }}" class="form-label fw-semibold">Descrição</label>
                            <textarea name="descricao" id="descricao_{{ $nivel->id }}" class="form-control" rows="3"
                                placeholder="Descrição opcional...">{{ old('descricao', $nivel->descricao) }}</textarea>
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
