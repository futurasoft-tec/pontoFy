{{-- MODAL EDITAR DEPENTE --}}
<!-- Modal de Edição de Nível Hierárquico -->
<div class="modal fade" id="editContratoModal{{ $contrato->id }}" tabindex="-1"
    aria-labelledby="editContratoModalLabel{{ $contrato->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h4 class="modal-title" id="editContratoModalLabel{{ $contrato->id }}">
                    <i class="fas fa-edit me-2"></i> Editar Dependente <i>'{{ $contrato->codigo }}'</i>
                </h4>
                <i class="bi bi-pencil-square me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('contrato.update', $contrato->id) }}" method="POST" enctype="multipart/form-data"
                class="text-end">
                @csrf
                @method('PUT')

                {{-- Team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">

                {{-- Usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                {{-- Colaborador ID --}}
                <input type="hidden" name="colaborador_id" value="{{ $contrato->colaborador->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Tipo de Contrato -->

                        <!-- Tipo de Contrato -->
                        <div class="col-md-4 mb-3">
                            <label for="tipo_contrato" class="form-label fw-semibold">Tipo de Contrato</label>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-select rounded-1"
                                style="height: 45px;">
                                <option value="" disabled
                                    {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == '' ? 'selected' : '' }}>
                                    Selecione o tipo de contrato
                                </option>
                                <!-- Contratos de Trabalho -->
                                <optgroup label="Contratos de Trabalho (Lei Geral do Trabalho)">
                                    @foreach (['trabalho_indeterminado', 'trabalho_determinado', 'trabalho_estagio', 'trabalho_parcial', 'trabalho_teletrabalho', 'trabalho_domicilio', 'trabalho_experiencia', 'trabalho_substituicao', 'trabalho_sazonal', 'trabalho_formacao'] as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == $tipo ? 'selected' : '' }}>
                                            {{ \App\Models\Contrato::TIPOS_CONTRATO[$tipo] }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Contratos de Prestação de Serviços (Código Civil)">
                                    @foreach (['servico_prestacao', 'servico_consultoria', 'servico_representacao', 'servico_mandato', 'servico_empreitada'] as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ old('tipo_contrato', $contrato->tipo_contrato ?? '') == $tipo ? 'selected' : '' }}>
                                            {{ \App\Models\Contrato::TIPOS_CONTRATO[$tipo] }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>


                        <!-- Data de Início -->
                        <div class="col-md-4 mb-3">
                            <label for="data_inicio" class="form-label fw-semibold">Data de Início: <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control"
                                style="height: 40px;"
                                value="{{ old('data_inicio', $contrato->data_inicio ? \Carbon\Carbon::parse($contrato->data_inicio)->format('Y-m-d') : '') }}"
                                required>
                        </div>

                        <!-- Data de Fim -->
                        <div class="col-md-4 mb-3">
                            <label for="data_fim" class="form-label fw-semibold">Data de Fim:</label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control"
                                style="height: 40px;"
                                value="{{ old('data_fim', $contrato->data_fim ? \Carbon\Carbon::parse($contrato->data_fim)->format('Y-m-d') : '') }}">
                        </div>

                        <!-- Período de Experiência -->
                        <div class="col-md-4 mb-3">
                            <label for="periodo_experiencia" class="form-label fw-semibold">
                                Período de Experiência
                            </label>
                            <select name="periodo_experiencia" id="periodo_experiencia" class="form-select rounded-1"
                                style="height: 45px;">
                                <option value="">Selecionar...</option>

                                <!-- Contrato por Tempo Determinado -->
                                <option value="30"
                                    {{ old('periodo_experiencia', $contrato->periodo_experiencia) == '30' ? 'selected' : '' }}>
                                    30 Dias (Máximo - Contrato de Trabalho por Tempo Determinado)
                                </option>

                                <!-- Contrato por Tempo Indeterminado -->
                                <option value="60"
                                    {{ old('periodo_experiencia', $contrato->periodo_experiencia) == '60' ? 'selected' : '' }}>
                                    60 Dias (Padrão - Contrato de Trabalho por Tempo Indeterminado)
                                </option>

                                <option value="120"
                                    {{ old('periodo_experiencia', $contrato->periodo_experiencia) == '120' ? 'selected' : '' }}>
                                    120 Dias (Acordo Escrito - Funções Técnicas/Responsabilidade)
                                </option>

                                <option value="180"
                                    {{ old('periodo_experiencia', $contrato->periodo_experiencia) == '180' ? 'selected' : '' }}>
                                    180 Dias (Funções de Direção ou Chefia)
                                </option>
                            </select>
                        </div>


                        <!-- Salário Base -->
                        <div class="col-md-4 mb-3">
                            <label for="salario_base" class="form-label fw-semibold">Salário Base: <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="salario_base" id="salario_base" class="form-control"
                                style="height: 40px;" min="0" required
                                value="{{ old('salario_base', $contrato->salario_base) }}">
                        </div>

                        <!-- Função -->
                        <div class="col-md-4 mb-3">
                            <label for="funcao" class="form-label fw-semibold">Função: <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="funcao" id="funcao" class="form-control"
                                style="height: 40px;" minlength="3" required
                                value="{{ old('funcao', $contrato->funcao ?? $contrato->colaborador->cargo->nome) }}">
                        </div>

                        <!-- Observações -->
                        <div class="col-md-12">
                            <label for="observacoes" class="form-label fw-semibold">Observações</label>
                            <textarea name="observacoes" id="observacoes" cols="30" rows="3" class="form-control">{{ old('observacoes', $contrato->observacoes) }}</textarea>
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
{{-- ===============MODAIS=========== --}}
