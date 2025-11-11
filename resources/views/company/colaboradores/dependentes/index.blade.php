<section class="card card-body">
    <!--Lista dos dependentes-->
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <h4 class="h4 text-active">
            Depedentes
        </h4>
        <div class="ms-md-autoA py-2A py-md-0A mt-0">
            <a href="{{ route('colaborador.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                data-bs-target="#createDependenteModal">
                <i class="fas fa-plus-square"></i>
                <span class="d-none d-sm-inline-block ms-2">Novo Depedente</span>
            </a>
             @include('company.colaboradores.dependentes.create')
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if ($dependentes->isEmpty())
                    <div class="p-5">
                        <div class="text-acitve text-center">
                            <div class="mb-4 ">
                                <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                            </div>
                            <h5 class="fw-normal mb-3">Nenhum Depedente Adicionando</h5>
                        </div>
                        <div class="text-center">
                            <a href="" class="btn btn-active rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#createDependenteModal">
                                <i class="ri-user-add-line me-2"></i>Adicionar Novo Dependente
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
                                    <th class="py-1"><b>Nome</b></th>
                                    <th class="py-1 text-center"><b>Parentesco</b></th>
                                    <th class="py-1 text-center"><b>Sexo</b></th>
                                    <th class="py-1 text-center"><b>Data de Nascimento</b></th>
                                    <th class="py-1 text-end"><b>Acções</b></th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($dependentes as $dependente)
                                    <tr>
                                        <td class="py-1 small">
                                            {{ $dependente->id }}
                                        </td>
                                        <td class="py-1 small">
                                            {{ $dependente->nome }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            {{ $dependente->parentesco }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            {{ $dependente->sexo }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            {{ $dependente->data_nascimento }}
                                        </td>
                                        <td class="py-1 small text-end">
                                            <a href="" class="text-active me-2" data-bs-toggle="modal"
                                                data-bs-target="#editDependente{{ $dependente->id }}">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <a href="{{ route('dependente.show', $dependente->id) }}"
                                                class="text-danger me-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteDependenteModal{{ $dependente->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>



                                    {{-- ===========MODAIS=============== --}}
                                    @include('company.colaboradores.dependentes.edit')
                                    @include('company.colaboradores.dependentes.confirma-delete')
                                    {{-- ===============MODAIS=========== --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--Paginacao-->
                    <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                        <div>
                            <small>
                                Exibindo <strong>{{ $dependentes->count() }}</strong> de
                                <strong>{{ $dependentes->total() }}</strong> registro
                            </small>
                        </div>

                        <div>
                            {{ $dependentes->links('paginacao.pagination') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>













