<div class="card rounded-0">
    <div class="card-header rounded-0">
        <h4 class="h5">
            Histórico Financeiro
        </h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-rubrica-tab" data-bs-toggle="pill" href="#pills-rubrica" role="tab"
                    aria-controls="pills-rubrica" aria-selected="true">Rubricas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-salarios-tab" data-bs-toggle="pill" href="#pills-salarios" role="tab"
                    aria-controls="pills-salarios" aria-selected="false">Salários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-recibos-tab" data-bs-toggle="pill" href="#pills-recibos" role="tab"
                    aria-controls="pills-recibos" aria-selected="false">Recibos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-impostos-tab" data-bs-toggle="pill" href="#pills-impostos" role="tab"
                    aria-controls="pills-impostos" aria-selected="false">Impostos</a>
            </li>
        </ul>
        <div class="tab-content mt-2 mb-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-rubrica" role="tabpanel" aria-labelledby="pills-rubrica-tab">
                @include('company.colaboradores.rubricas.index')
            </div>
            <div class="tab-pane fade" id="pills-salarios" role="tabpanel" aria-labelledby="pills-salarios-tab">
                @include('company.colaboradores.financeiro.salarios')
            </div>
            <div class="tab-pane fade" id="pills-recibos" role="tabpanel" aria-labelledby="pills-recibos-tab">
                @include('company.colaboradores.financeiro.recibos')
            </div>

            <div class="tab-pane fade" id="pills-impostos" role="tabpanel" aria-labelledby="pills-impostos-tab">
                @include('company.colaboradores.financeiro.impostos')
            </div>
        </div>
    </div>
</div>
