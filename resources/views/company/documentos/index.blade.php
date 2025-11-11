<section class="card-body">
    <!--Lista dos dependentes-->
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <h4 class="h4 text-active">
            Documentos
        </h4>
        <div class="ms-md-autoA py-2A py-md-0A mt-0">
            <a href="{{ route('colaborador.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                data-bs-target="#createDocumentoModal">
                <i class="fas fa-plus-square"></i>
                <span class="d-none d-sm-inline-block ms-2">Novo-Documento</span>
            </a>
        </div>
    </div>

    @include('company.documentos.create')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if ($documentos->isEmpty())
                    <div class="p-5">
                        <div class="text-acitve text-center">
                            <div class="mb-4 ">
                                <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                            </div>
                            <h5 class="fw-normal mb-3">Nenhum Documento Adicionando</h5>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('categoria.create') }}" class="btn btn-active rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#createDocumentoModal">
                                <i class="ri-user-add-line me-2"></i>Adicionar Novo Documento
                                para {{ $colaborador->nome_completo }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover mb-0 small table-sm align-middle">
                            <thead>
                                <tr>
                                    <th class="py-1"><b>ID</b></th>
                                    <th class="py-1"><b>Tipo de Documento</b></th>
                                    {{-- <th class="py-1 text-center"><b>Documento</b></th> --}}
                                    <th class="py-1 text-center"><b>Data de Registro</b></th>
                                    <th class="py-1 text-end"><b>Acções</b></th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($documentos as $doc)
                                    <tr>
                                        <td class="py-1 small">
                                            {{ $doc->id }}
                                        </td>
                                        <td class="py-1 small">
                                            {{ $doc->tipo_documento ?? 'NA' }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            {{ $doc->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="py-1 small text-end">
                                            @if ($doc->caminho_arquivo)
                                                <a href="{{ asset('storage/' . $doc->caminho_arquivo) }}"
                                                    target="_blank">
                                                    <i class="fas fa-cloud-download-alt me-2"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">
                                                    N/A
                                                </span>
                                            @endif

                                            <a href="" class="text-active me-2 ms-2" data-bs-toggle="modal"
                                                data-bs-target="#editDocumentoModal{{ $doc->id }}">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <a href="" class="text-danger me-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteDocumentoModal{{ $doc->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>



                                    {{-- ===========MODAIS=============== --}}
                                    @include('company.documentos.edit')
                                    @include('company.documentos.delete-confirme')
                                    {{-- ===============MODAIS=========== --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--Paginacao-->
                    <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                        <div>
                            <small>
                                Exibindo <strong>{{ $documentos->count() }}</strong> de
                                <strong>{{ $documentos->total() }}</strong> registro
                            </small>
                        </div>

                        <div>
                            {{ $documentos->links('paginacao.pagination') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
