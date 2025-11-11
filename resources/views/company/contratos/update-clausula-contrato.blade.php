{{-- Modal: Visualizar Cláusula --}}<!-- Modal Editar Cláusula -->
<div class="modal fade" id="modalEditarClausula" tabindex="-1" aria-labelledby="modalEditarClausulaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createClausulaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Personalizar Clausula
                    <strong>"{{ $clausula->titulo_base }}"</strong>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <form id="formEditarClausula" method="POST" action="{{ route('clausula.store') }}">
                @csrf
                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">
                <input type="hidden" name="tipo" value="{{ $clausula->tipo }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="mb-2">Clausulas para Contratos de:</label>
                        @php
                            $tipoSelecionado = strtolower(old('tipo', $contrato->tipo ?? ''));
                        @endphp
                        <label for="tipo" class="mb-2">Cláusulas para Contratos de:</label>
                        <select name="tipo" id="tipo" class="form-select rounded-1" style="height: 45px;">
                            <option value="trabalho" {{ $tipoSelecionado == 'trabalho' ? 'selected' : '' }}>Trabalho
                            </option>
                            <option value="servico_prestacao"
                                {{ $tipoSelecionado == 'servico_prestacao' ? 'selected' : '' }}>Prestação de Serviços
                            </option>
                            <option value="servico_consultoria"
                                {{ $tipoSelecionado == 'servico_consultoria' ? 'selected' : '' }}>Consultorias</option>
                            <option value="servico_representacao"
                                {{ $tipoSelecionado == 'servico_representacao' ? 'selected' : '' }}>Serviços de
                                Representação</option>
                            <option value="servico_mandato"
                                {{ $tipoSelecionado == 'servico_mandato' ? 'selected' : '' }}>Serviços de Mandatos
                            </option>
                            <option value="servico_empreitada"
                                {{ $tipoSelecionado == 'servico_empreitada' ? 'selected' : '' }}>Serviços de
                                Empreitadas</option>
                            <option value="servico_agencia"
                                {{ $tipoSelecionado == 'servico_agencia' ? 'selected' : '' }}>Agenciamento/Agência
                            </option>
                            <option value="servico_mediacao"
                                {{ $tipoSelecionado == 'servico_mediacao' ? 'selected' : '' }}>Serviços de Mediação
                            </option>
                            <option value="geral" {{ $tipoSelecionado == 'geral' ? 'selected' : '' }}>Uso Geral
                            </option>
                        </select>


                    </div>
                    <div class="mb-3">
                        <label for="edit_titulo_base" class="form-label">Título Base</label>
                        <input type="text" class="form-control" id="edit_titulo_base" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_conteudo" class="form-label">Conteúdo</label>
                        <textarea class="form-control" id="edit_conteudo" name="conteudo" rows="5" required></textarea>
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


<script>
    document.querySelectorAll('.edit-clausula').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const tituloBase = this.dataset.titulo_base;
            const conteudo = this.dataset.conteudo;

            const form = document.getElementById('formEditarClausula');
            const action = form.getAttribute('action').replace('__ID__', id);
            form.setAttribute('action', action);

            // preencher campos do modal
            document.getElementById('edit_titulo_base').value = tituloBase;
            document.getElementById('edit_conteudo').value = conteudo;

            // abrir modal
            const modal = new bootstrap.Modal(document.getElementById('modalEditarClausula'));
            modal.show();
        });
    });
</script>
