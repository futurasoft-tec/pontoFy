{{-- MODAL ADICIONAR DEPENDENTE --}}
<!-- Modal de Criação de Nível Hierárquico -->
<div class="modal fade" id="createDocumentoModal" tabindex="-1" aria-labelledby="createDocumentoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-ls modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h5 class="modal-title" id="createDocumentoModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Adicionar Novo Documento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <!-- Formulário -->
            <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- team do usuário autenticado --}}
                <input type="hidden" name="team_id" value="{{ Auth::user()->currentTeam->id }}">
                {{-- usuário autenticado --}}
                <input type="hidden" name="criado_por" value="{{ Auth::user()->id }}">

                {{-- ColaboradorID --}}
                <input type="hidden" name="colaborador_id" value="{{ $colaborador->id }}">

                <div class="modal-body">
                    <div class="row">
                        <!-- Tipo de Documento -->
                        <div class="col-md-12 mb-1">
                            <label for="tipo_documento" class="form-label fw-semibold">Tipo de Documento</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-select rounded-1"
                                style="height: 50px;">
                                <option value="Bilhete de Identidade" selected class="small">Bilhete de Identidade
                                </option>
                                <option value="NIF" selected class="small">NIF</option>
                                <option value="Atestado Médico" selected class="small">Atestado Médico</option>
                                <option value="Curriculum Vitae" selected class="small">Curriculum Vitae</option>
                            </select>
                        </div>

                        <!-- Arquivo de Documento -->
                        <div class="col-md-12 mb-1">
                            <div class="upload-container border" id="uploadBox">
                                <input type="file" name="caminho_arquivo" id="caminho_arquivo"
                                    accept=".jpg,.jpeg,.png,.pdf"hidden>

                                <div class="upload-area" onclick="document.getElementById('caminho_arquivo').click()">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <p class="upload-text">Clique ou arraste o Documento aqui</p>
                                    <small class="upload-hint">Formatos aceites: JPG, PNG, PDF (máx. 2MB)</small>
                                </div>

                                <div class="file-info" id="fileInfo" style="display: none;">
                                    <i class="fas fa-file-alt"></i>
                                    <span id="fileName"></span>
                                    <button type="button" class="remove-btn" onclick="removerFicheiro()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Observacoes --}}
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tipo_documento" class="form-label fw-semibold">Observações</label>
                                <textarea name="observacoes" id="observacoes" cols="30" rows="3" class="form-control"></textarea>
                            </div>
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




{{-- ESTILIZAR FICHEIRO DOCUMENTO --}}
<style>
    .upload-container {
        margin-top: 16px;
        margin-bottom: 20px;
        text-align: center;
    }

    .upload-area {
        border: 2px dashed var(--primary-light);
        background: #f8f9ff;
        border-radius: 12px;
        padding: 28px;
        cursor: pointer;
        transition: var(--transition);
    }

    .upload-area:hover {
        background: #eef0ff;
        border-color: var(--primary);
        transform: scale(1.01);
    }

    .upload-icon {
        font-size: 32px;
        color: var(--primary);
        margin-bottom: 8px;
        animation: float 2.5s ease-in-out infinite;
    }

    .upload-text {
        font-weight: 600;
        color: var(--text);
    }

    .upload-hint {
        font-size: 13px;
        color: var(--text-light);
    }

    @keyframes float {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .file-info {
        background: #eef2ff;
        border: 1px solid var(--primary-light);
        border-radius: 10px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        box-shadow: var(--shadow);
    }

    .file-info i {
        color: var(--primary-dark);
        font-size: 18px;
        margin-right: 8px;
    }

    #fileName {
        font-weight: 600;
        color: var(--primary-dark);
        flex-grow: 1;
        text-align: left;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .remove-btn {
        background: transparent;
        border: none;
        color: var(--muted);
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
    }

    .remove-btn:hover {
        color: #ef4444;
    }
</style>

<script>
    const input = document.getElementById('caminho_arquivo');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const uploadBox = document.getElementById('uploadBox');

    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileName.textContent = this.files[0].name;
            fileInfo.style.display = 'flex';
            uploadBox.querySelector('.upload-area').style.display = 'none';
        }
    });

    function removerFicheiro() {
        input.value = '';
        fileInfo.style.display = 'none';
        uploadBox.querySelector('.upload-area').style.display = 'block';
    }
</script>
