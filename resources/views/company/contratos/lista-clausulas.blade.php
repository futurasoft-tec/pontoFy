<div id="clausulas-container" class="clausula-item p-2 border mb-2 "
    data-titulo_base="{{ strtolower($clausula->titulo_base) }}" data-conteudo="{{ strtolower($clausula->conteudo) }}">
    <div class="d-flex align-items-start gap-3">
        <div class="form-check mt-1">
            <input class="form-check-input clausula-checkbox" type="checkbox" name="clausula_id[]"
                value="{{ $clausula->id }}" id="clausula_id{{ $clausula->id }}">
        </div>
        <div class="flex-grow-1">
            <strong>
                <label class="form-check-label fw-500 text-dark cursor-pointer d-block mb-1"
                    for="clausula_id{{ $clausula->id }}">
                    {{ $clausula->titulo_base }}
                </label>
            </strong>
            <p class="text-muted small mb-2 clausula-preview">
                {{ Str::limit($clausula->conteudo, 120) }}
            </p>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex gap-1 ms-auto">

                    <a href="" class="text-active me-2 p-1" data-bs-toggle="modal"
                        data-bs-target="#modalDetalheClausula{{ $clausula->id }}">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a class=" p-1 edit-clausula text-active " data-id="{{ $clausula->id }}"
                        data-titulo_base="{{ $clausula->titulo_base }}" data-conteudo="{{ $clausula->conteudo }}"
                        data-bs-toggle="modal" data-bs-target="#editClausulaModal">
                        <i class="fas fa-edit"></i>
                    </a>

                    {{-- Exibir botao delete para o team que criou a clausula --}}

                </div>
            </div>
        </div>
    </div>
</div>

@include('company.contratos.details-clausula')
