<section class="card-bodyA">
    <!--Lista dos dependentes-->
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <h4 class="h4 text-active">
            Rubricas
        </h4>
        <div class="ms-md-autoA py-2A py-md-0A mt-0">
            <a href="{{ route('colaborador.create') }}" class="btn-active btn-round" data-bs-toggle="modal"
                data-bs-target="#addRubricaModal">
                <i class="fas fa-plus-square"></i>
                <span class="d-none d-sm-inline-block ms-2">Nova Rubrica</span>
            </a>
        </div>
    </div>

    @include('company.colaboradores.rubricas.add-rubrica')

    <div class="card rounded-0">
        <div class="card-body p-1">
            <div class="table-responsive">
                @if ($colaborador->rubricas->isEmpty())
                    <div class="p-5">
                        <div class="text-acitve text-center">
                            <div class="mb-4 ">
                                <i class="fas fa-exclamation" style="font-size: 80px;"></i>
                            </div>
                            <h5 class="fw-normal mb-3">Nenhuma rubrica foi Adicionando</h5>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 small table-sm align-middle">
                            <thead>
                                <tr>
                                    <th class="py-1"><b>Código</b></th>
                                    <th class="py-1"><b>Nome</b></th>
                                    <th class="py-1"><b>Tipo</b></th>
                                    <th class="py-1 text-center"><b>Base Cálculo</b></th>
                                    <th class="py-1 text-center"><b>Status</b></th>
                                    <th class="py-1 text-center"><b>Valor</b></th>
                                    <th class="py-1 text-center"><b>Tributável</b></th>
                                    <th class="py-1 text-center"><b>Automática?</b></th>
                                    <th class="py-1 text-end"><b>Acções</b></th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($colaborador->rubricas as $rubrica)
                                    <tr>
                                        <td class="py-1 small">
                                            {{ $rubrica->codigo ?? 'NA' }}
                                        </td>
                                        <td class="py-1 small">
                                            {{ $rubrica->nome ?? 'NA' }}
                                        </td>

                                        <td class="py-1 small" style="text-transform:capitalize;">
                                            {{ $rubrica->tipo ?? 'NA' }}
                                        </td>



                                        <td class="py-1 small text-center" style="text-transform:capitalize">
                                            {{ $rubrica->base_calculo ?? 'NA' }}
                                        </td>

                                        <td class="py-1 small text-center" style="text-transform:capitalize">
                                            {{ $rubrica->pivot->status }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            @if (isset($rubrica->pivot) && $rubrica->pivot->valor_customizado !== null)
                                                {{ number_format($rubrica->pivot->valor_customizado, 2, ',', '.') }}
                                            @else
                                                {{ number_format($rubrica->valor ?? 0, 2, ',', '.') }}
                                            @endif
                                        </td>


                                        <td class="py-1 small text-center">
                                            {{ $rubrica->is_tributavel ? 'Sim' : 'Não' }}
                                        </td>

                                        <td class="py-1 small text-center">
                                            {{ $rubrica->pivot->eh_automatica ? 'Sim' : 'Não' }}
                                        </td>

                                        <td class="py-1 small text-end">

                                            <!-- Editar -->
                                            <a href="{{ route('rubricaColaborador.edit', $rubrica->pivot->id) }}"
                                                class="text-active me-2" data-bs-toggle="modal"
                                                data-bs-target="#editRubricaModal{{ $rubrica->pivot->id }}">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <!-- Visualizar -->
                                            <a href="{{ route('rubricaColaborador.show', $rubrica->pivot->id) }}"
                                                class="text-active me-2" data-bs-toggle="modal"
                                                data-bs-target="#detailRubricaModal{{ $rubrica->pivot->id }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            @if ($rubrica->pivot->status === 'ativo')
                                                <!-- Desativar -->
                                                <a href="{{ route('rubricaColaborador.desativar', $rubrica->pivot->id) }}"
                                                    class="text-warning me-2" data-bs-toggle="modal"
                                                    data-bs-target="#desativarRubricaModal{{ $rubrica->pivot->id }}">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            @elseif($rubrica->pivot->status === 'inativo')
                                                <!-- Reativar -->
                                                <a href="{{ route('rubricaColaborador.reativar', $rubrica->pivot->id) }}"
                                                    class="text-success me-2" data-bs-toggle="modal"
                                                    data-bs-target="#reativarRubricaModal{{ $rubrica->pivot->id }}">
                                                    <i class="fas fa-power-off"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- ===========MODAIS=============== --}}
                                    @include('company.colaboradores.rubricas.confirm-desativar')
                                    @include('company.colaboradores.rubricas.confirm-reativar')
                                    @include('company.colaboradores.rubricas.edit-rubrica')
                                    @include('company.colaboradores.rubricas.details-rubrica')
                                    {{-- ===============MODAIS=========== --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--Paginacao-->
                    {{-- <div class="mt-3 d-flex justify-content-between align-items-center mt-0 pt-2 pb-2 p-3 border">
                        <div>
                            <small>
                                Exibindo <strong>{{ $colaborador->rubricas->count() }}</strong> de
                                <strong>{{ $colaborador->rubricas->total() }}</strong> registro
                            </small>
                        </div>

                        <div>
                            {{ $colaborador->rubricas->links('paginacao.pagination') }}
                        </div>
                    </div> --}}
                @endif
            </div>
        </div>
    </div>
</section>
@include('company.rubricas.create')
