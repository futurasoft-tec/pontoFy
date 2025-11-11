<section class="card-bodyA">
    <!--Lista dos dependentes-->
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <h4 class="h4 text-active">
            Contratos
        </h4>
        <div class="ms-md-autoA py-2A py-md-0A mt-0">
            <a href="{{ route('colaborador.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                data-bs-target="#createContratoModal">
                <i class="fas fa-plus-square"></i>
                <span class="d-none d-sm-inline-block ms-2">Novo-Contrato</span>
            </a>
        </div>
    </div>

    @include('company.colaboradores.contratos.create-contratos')

    <div class="card">
        <div class="card-body p-1">
            <div class="table-responsive">
                @if ($contratos->isEmpty())
                    <div class="p-5">
                        <div class="text-acitve text-center">
                            <div class="mb-4 ">
                                <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                            </div>
                            <h5 class="fw-normal mb-3">Nenhum Contrato Adicionando</h5>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('categoria.create') }}" class="btn btn-active rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#createContratoModal">
                                <i class="ri-user-add-line me-2"></i>Adicionar Novo Contrato
                                para {{ $colaborador->nome_completo }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 small table-sm align-middle">
                            <thead>
                                <tr>
                                    <th class="py-1"><b>Código</b></th>
                                    <th class="py-1"><b>Tipo de Contrato</b></th>
                                    <th class="py-1 text-center"><b>Salário Base</b></th>
                                    <th class="py-1 text-center"><b>Status</b></th>
                                    <th class="py-1 text-center"><b>Data de Ínicio</b></th>
                                    <th class="py-1 text-end"><b>Acções</b></th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($contratos as $contrato)
                                    <tr>
                                        <td class="py-1 small">
                                            {{ $contrato->codigo }}
                                        </td>
                                        <td class="py-1 small">
                                            {{ $contrato->tipo_contrato ?? 'NA' }}
                                        </td>

                                        <td class="py-1 small text-end">
                                            {{ number_format($contrato->salario_base ?? 'NA', 2, ',', '.') }}
                                        </td>

                                        <td class="py-1 small text-center" style="text-transform:capitalize">
                                            {{ $contrato->status ?? 'NA' }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            {{ $contrato->data_inicio->format('d/m/Y') }}
                                        </td>
                                        <td class="py-1 small text-end">
                                            <a href="{{ route('departamento.edit', $contrato->id) }}"
                                                class="text-active me-2" data-bs-toggle="modal"
                                                data-bs-target="#editContratoModal{{ $contrato->id }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="" class="text-danger me-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteDocumentoModal{{ $contrato->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <a href="{{ route('contrato.show', $contrato->id) }}"
                                                class="text-active me-2">
                                                <i class="far fa-eye"></i>
                                            </a>

                                            <a href="{{ route('add.clausulas', $contrato->id) }}"
                                                class="text-active me-2">
                                                <i class="fas fa-user-tie"></i>
                                            </a>
                                        </td>
                                    </tr>



                                    {{-- ===========MODAIS=============== --}}
                                    @include('company.colaboradores.contratos.edit-contato')
                                    {{-- @include('company.documentos.delete-confirme') --}}
                                    {{-- ===============MODAIS=========== --}}
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--Paginacao-->
                    <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                        <div>
                            <small>
                                Exibindo <strong>{{ $contratos->count() }}</strong> de
                                <strong>{{ $contratos->total() }}</strong> registro
                            </small>
                        </div>

                        <div>
                            {{ $contratos->links('paginacao.pagination') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
