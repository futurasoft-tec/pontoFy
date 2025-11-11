<!--Perfil --->
<div class="card card-body rounded-0 pb-0 pt-0">
    <div class="d-flex align-items-center">
        <div class="card-profile">
            <div class="avatar-xxlA">
                <img src="{{ asset('assets/img/joao_tomas.png') }}" alt="..." class="rounded-1 border img-fluid"
               style="width: 150px; height:150px;">
            </div>
        </div>
        <div class="card-body">
            <h4 class="text-active">{{ $colaborador->nome_completo }}</h4>
            <b>ID:</b> {{ $colaborador->id }}<br>
            <b>Processo Nº:</b> {{ $colaborador->codigo }} <br>
            <b>Data de Registro:</b> {{ $colaborador->created_at->format('d/m/Y') }}<br>
            <b>Data de Admissão:</b> {{\Carbon\Carbon::parse($colaborador->data_admissao)->format('d/m/Y') }} <br>
            <b>Data de Demissão:</b> {{ $colaborador->data_demissao }}
        </div>
    </div>
</div>

<!--Dados Pessoais --->
<div class="card card-body rounded-0 mt-2 pb-0">
    <h5 class="text-active mb-0 ps-2"><strong>Dados Pessoais</strong></h5>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="small">Data de Nascimento</th>
                    <th class="small">Sexo</th>
                    <th class="small">Estado Cívil</th>
                    <th class="small">Nacionalidade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small">{{ \Carbon\Carbon::parse($colaborador->data_nascimento)->format('d/m/Y') }}</td>
                    <td class="small">{{ $colaborador->genero }}</td>
                    <td class="small">{{ $colaborador->estado_civil }}</td>
                    <td class="small">{{ $colaborador->nacionalidade }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!--Dados Fiscais --->
<div class="card card-body rounded-0 mt-2 pb-0">
    <h5 class="text-active mb-0 ps-2"><strong>Dados Fiscais</strong></h5>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="small">Documento</th>
                    <th class="small">Nº de Documento</th>
                    <th class="small">Data de Emissão</th>
                    <th class="small">Data de Validade</th>
                    <th class="small">NIF</th>
                    <th class="small">Nº INSS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small">{{ $colaborador->tipo_documento }}</td>
                    <td class="small">{{ $colaborador->numero_doc_id }}</td>
                    <td class="small">{{ \Carbon\Carbon::parse($colaborador->data_emissao_doc)->format('d/m/Y') }}</td>
                    <td class="small">{{ \Carbon\Carbon::parse($colaborador->data_validade_doc)->format('d/m/Y') }}</td>
                    <td class="small">{{ $colaborador->nif }}</td>
                    <td class="small">{{ $colaborador->numero_inss }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!--Dados de Contactos  --->
<div class="card card-body rounded-0 mt-2 pb-0">
    <h5 class="text-active mb-0 ps-2"><strong>Dados de Contactos</strong></h5>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="small">País de Residência</th>
                    <th class="small">Cidade/Província</th>
                    <th class="small">Endereço</th>
                    <th class="small">Telefone</th>
                    <th class="small">Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small">{{ $colaborador->pais }}</td>
                    <td class="small">
                        @if ($colaborador->provincia)
                            {{ $colaborador->provincia }}
                        @else
                            {{ $colaborador->cidade_estrangeira }}
                        @endif
                    </td>
                    <td class="small">{{ $colaborador->endereco }}</td>
                    <td class="small">{{ $colaborador->telefone }}</td>
                    <td class="small">{{ $colaborador->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
