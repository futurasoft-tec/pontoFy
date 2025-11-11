<!-- Modal de Criação de Nível Hierárquico -->
<div class="modal fade" id="createClausulaModal" tabindex="-1" aria-labelledby="createClausulaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createClausulaModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Adicionar Novo Dependente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('clausula.store') }}" method="POST">
                @csrf

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                <div class="modal-body p-3">
                    <div class="mb-3">
                        <label for="" class="mb-2">Clausulas para Contratos de:</label>
                        <select name="tipo" id="tipo" class="form-select rounded-1" style="height: 45px;">
                            <option value="">Selecionar...</option>
                            <!-- Contrato por Tempo Determinado -->
                            <option value="trabalho" {{ old('trabalho') == 'trabalho' ? 'selected' : '' }}>
                                Trabalho
                            </option>
                            <option value="servico_prestacao"
                                {{ old('servico_prestacao') == 'servico_prestacao' ? 'selected' : '' }}>
                                Prestação de Serviços
                            </option>
                            <option value="servico_consultoria"
                                {{ old('servico_consultoria') == 'servico_consultoria' ? 'selected' : '' }}>
                                Consultorias
                            </option>
                            <option value="servico_representacao"
                                {{ old('servico_representacao') == 'servico_representacao' ? 'selected' : '' }}>
                                Serviços de Representação
                            </option>
                            <option value="servico_mandato"
                                {{ old('servico_mandato') == 'servico_mandato' ? 'selected' : '' }}>
                                Serviços de Mandatos
                            </option>
                            <option value="servico_empreitada"
                                {{ old('servico_empreitada') == 'servico_empreitada' ? 'selected' : '' }}>
                                Serviços de Empreitadas
                            </option>

                            <option value="servico_agencia"
                                {{ old('servico_agencia') == 'servico_agencia' ? 'selected' : '' }}>
                                Agenciamento/Agência
                            </option>
                            <option value="servico_mediacao"
                                {{ old('servico_mediacao') == 'servico_mediacao' ? 'selected' : '' }}>
                                Serviços de Mediação
                            </option>
                            <option value="geral" {{ old('geral') == 'geral' ? 'selected' : '' }}>
                                Uso Geral
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-500 text-dark small">Título da Clausula</label>
                        <input type="text" name="titulo" class="form-control rounded-2 border"
                            placeholder="Duração do Contrato" required>

                        <p class="text-danger mt-1" style="font-size: 12px;">
                           <strong>ATT:</strong> Adiciona o Titulo sem usar <strong>"Cláusula 1.ª"</strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-500 text-dark small">Conteúdo</label>
                        <textarea name="conteudo" rows="5" class="form-control rounded-2 border"
                            placeholder="Digite o texto completo da cláusula..." style="line-height: 1.6;" required></textarea>
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
