
<!-- Modal de Criação de Nível Hierárquico -->
<div class="modal fade" id="createDependenteModal" tabindex="-1" aria-labelledby="createDependenteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createDependenteModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Adicionar Novo Dependente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('dependente.store') }}" method="POST">
                @csrf

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                {{-- ColaboradorID --}}
                <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label fw-semibold">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control"
                                placeholder="Fançone Tomas" required value="{{ old('nome') }}"
                                style="height: 40px;">
                        </div>

                        <!-- Parentesco -->
                        <div class="col-md-6 mb-3">
                            <label for="sexo" class="form-label fw-semibold">Sexo</label>
                            <select name="sexo" id="sexo" class="form-select rounded-1">
                                <option value="M" selected class="small">Masculino</option>
                                <option value="Filho" selected class="small">Feminino</option>
                                <option value="Outros" selected class="small">Outros</option>
                            </select>
                        </div>

                        <!-- Parentesco -->
                        <div class="col-md-6 mb-3">
                            <label for="parentesco" class="form-label fw-semibold">Parentesco</label>
                            <select name="parentesco" id="parentesco" class="form-select rounded-1">
                                <option value="Filho" selected class="small">Filho</option>
                                <option value="Mãe" selected class="small">Mãe</option>
                                <option value="Pai" selected class="small">Pai</option>
                                <option value="Irmão" selected class="small">Irmão</option>
                                <option value="Avô" selected class="small">Avô</option>
                                <option value="Sobrinho" selected class="small">Sobrinho</option>
                            </select>
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="col-md-6 mb-3">
                            <label for="data_nascimento" class="form-label fw-semibold">Data de Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                            style="height: 40px;">
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