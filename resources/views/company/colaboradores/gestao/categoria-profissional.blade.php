<!--Categoria Profissional --->
<h4 class="h4 text-active">
    <strong>Categoria Profissional</strong>
</h4>

<!--Dados --->
<div class="card card-body rounded-0 mt-2 pb-0">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="small">Data de Contratação</th>
                    <th class="small">Cargo</th>
                    <th class="small">Departamento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small">{{ \Carbon\Carbon::parse($colaborador->data_admissao)->format('d/m/Y') }}</td>
                    <td class="small">{{ $colaborador->cargo->nome }}</td>
                    <td class="small">{{ $colaborador->departamento->nome }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


