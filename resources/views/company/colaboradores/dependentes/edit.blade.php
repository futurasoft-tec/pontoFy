{{-- MODAL EDITAR DEPENTE --}}
<div class="modal fade" id="editDependente{{ $dependente->id }}" tabindex="-1"
    aria-labelledby="editDependenteModalLabel{{ $dependente->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h4 class="modal-title" id="editDependenteModalLabel{{ $dependente->id }}">
                 <i class="fas fa-edit me-2"></i> Editar Dependente <i>'{{ $dependente->nome }}'</i>
                </h4>
                <i class="bi bi-pencil-square me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('dependente.update', $dependente->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                                placeholder="Fançone Tomas" value="{{ $dependente->nome }}" style="height: 40px;">
                        </div>

                        <!-- Parentesco -->
                        <div class="col-md-6 mb-3">
                            <label for="sexo" class="form-label fw-semibold">Sexo</label>
                            <select name="sexo" id="sexo" class="form-select rounded-1">
                                <option value="M" class="small"
                                    {{ old('sexo', $dependente->sexo) == 'M' ? 'selected' : '' }}>Masculino
                                </option>
                                <option value="F" class="small"
                                    {{ old('sexo', $dependente->sexo) == 'F' ? 'selected' : '' }}>Feminino
                                </option>
                                <option value="Outro" class="small"
                                    {{ old('sexo', $dependente->sexo) == 'Outro' ? 'selected' : '' }}>Outro
                                </option>
                            </select>
                        </div>

                        <!-- Parentesco -->
                        <div class="col-md-6 mb-3">
                            <label for="parentesco" class="form-label fw-semibold">Parentesco</label>
                            <select name="parentesco" id="parentesco" class="form-select rounded-1">
                                <option value="Filho"  class="small"
                                {{ old('parentesco', $dependente->parentesco) == 'Filho' ? 'selected' : '' }}>Filho</option>
                                <option value="Mãe"  class="small"
                                {{ old('parentesco', $dependente->parentesco) == 'Mãe' ? 'selected' : '' }}>Mãe</option>
                                <option value="Pai"  class="small"
                                {{ old('parentesco', $dependente->parentesco) == 'Pai' ? 'selected' : '' }}>Pai</option>
                                <option value="Irmão"  class="small"
                                {{ old('parentesco', $dependente->parentesco) == 'Irmão' ? 'selected' : '' }}>Irmão</option>
                                <option value="Avô"  class="small"
                                {{ old('parentesco', $dependente->parentesco) == 'Avô' ? 'selected' : '' }}>Avô</option>
                                <option value="Sobrinho"  class="small"
                                {{ old('parentesco', $dependente->parentesco) == 'Sobrinho' ? 'selected' : '' }}>Sobrinho</option>
                            </select>
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="col-md-6 mb-3">
                            <label for="data_nascimento" class="form-label fw-semibold">Data de
                                Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                                style="height: 40px;" value="{{ old('data_nascimento', $dependente->data_nascimento ? \Carbon\Carbon::parse($dependente->data_nascimento)->format('Y-m-d') : '') }}">
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