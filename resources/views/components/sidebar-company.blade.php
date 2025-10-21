<!-- Sidebar -->
{{-- <div class="sidebar" data-background-color="dark" id="sidebar"> --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header border-bottom" data-background-color="active">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('logo/Logo-pontoFy.png') }}" alt="navbar brand" class="img-fluidA navbar-brand"
                    height="27" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="collapsed text-light" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Colaboradores -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#colaboradores" class="text-light">
                        <i class="fas fa-user-tie"></i>
                        <p>Colaboradores</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="colaboradores">
                        <ul class="nav nav-collapse">
                            <li><a href="/colaboradores"><span class="sub-item">Listar Colaboradores</span></a></li>
                            <li><a href="/colaboradores/create"><span class="sub-item">Adicionar Colaborador</span></a>
                            </li>
                            <li><a href="{{ route('categorias.index') }}"><span class="sub-item">Categorias Profissionais</span></a></li>
                            <li><a href="{{ route('niveis.index') }}"><span class="sub-item">Níveis Hierárquico</span></a></li>
                            <li><a href="{{ route('cargos.index') }}"><span class="sub-item">Cargos e Funções</span></a></li>
                            <li><a href="/documentos-colaboradores"><span class="sub-item">Documentos</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Departamentos -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#departamentos">
                        <i class="fas fa-suitcase"></i>
                        <p>Departamentos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="departamentos">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('departamentos.index') }}"><span class="sub-item">Departamentos</span></a></li>
                            <li><a href="{{ route('departamento.create') }}"><span class="sub-item">Criar Novo</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Folhas de Salários -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#salarios">
                        <i class="far fa-money-bill-alt"></i>
                        <p>Folhas de Salários</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="salarios">
                        <ul class="nav nav-collapse">
                            <li><a href="/salarios/processar"><span class="sub-item">Processar Folha</span></a></li>
                            <li><a href="/salarios"><span class="sub-item">Listar Folhas</span></a></li>
                            <li><a href="/adiantamentos"><span class="sub-item">Adiantamentos</span></a></li>
                            <li><a href="/abonos-descontos"><span class="sub-item">Descontos e Abonos</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Contratos -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#contratos">
                        <i class="far fa-sticky-note"></i>
                        <p>Contratos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="contratos">
                        <ul class="nav nav-collapse">
                            <li><a href="/contratos"><span class="sub-item">Listar Contratos</span></a></li>
                            <li><a href="/contratos/create"><span class="sub-item">Novo Contrato</span></a></li>
                            <li><a href="/contratos/tipos"><span class="sub-item">Tipos de Contrato</span></a></li>
                            <li><a href="/contratos/gestao"><span class="sub-item">Renovação/Rescisão</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Assiduidade -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#assiduidade">
                        <i class="fas fa-fingerprint"></i>
                        <p>Assiduidade</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="assiduidade">
                        <ul class="nav nav-collapse">
                            <li><a href="/assiduidade/ponto"><span class="sub-item">Registo de Ponto</span></a></li>
                            <li><a href="/assiduidade/faltas"><span class="sub-item">Faltas e Justificações</span></a>
                            </li>
                            <li><a href="/assiduidade/horarios"><span class="sub-item">Horários de Trabalho</span></a>
                            </li>
                            <li><a href="/assiduidade/escalas"><span class="sub-item">Escalas de Serviço</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Recibos -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#recibos">
                        <i class="fas fa-money-check-alt"></i>
                        <p>Recibos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="recibos">
                        <ul class="nav nav-collapse">
                            <li><a href="/recibos/create"><span class="sub-item">Emitir Recibo</span></a></li>
                            <li><a href="/recibos"><span class="sub-item">Histórico de Recibos</span></a></li>
                            <li><a href="/recibos/pendentes"><span class="sub-item">Recibos Pendentes</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Benefícios -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#beneficios">
                        <i class="fas fa-umbrella-beach"></i>
                        <p>Benefícios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="beneficios">
                        <ul class="nav nav-collapse">
                            <li><a href="/beneficios/subsidios"><span class="sub-item">Subsídios</span></a></li>
                            <li><a href="/beneficios/ferias"><span class="sub-item">Férias e Licenças</span></a></li>
                            <li><a href="/beneficios/outros"><span class="sub-item">Outros Benefícios</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- Mapas -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#mapas">
                        <i class="fas fa-map-signs"></i>
                        <p>Mapas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="mapas">
                        <ul class="nav nav-collapse">
                            <!-- Mapas Legais -->
                            <li><a href="/mapas/inss"><span class="sub-item">Mapa de INSS</span></a></li>
                            <li><a href="/mapas/irt"><span class="sub-item">Mapa de IRT</span></a></li>
                            <!-- Mapas Operacionais -->
                            <li><a href="/mapas/ferias"><span class="sub-item">Mapa de Férias</span></a></li>
                            <li><a href="/mapas/faltas"><span class="sub-item">Faltas e Assiduidade</span></a>
                            </li>
                            <li><a href="/mapas/remuneracoes"><span class="sub-item">Mapa de Remunerações</span></a>
                            </li>
                            <li><a href="/mapas/beneficios"><span class="sub-item">
                                        Mapa de Benefícios</span></a></li>
                            <li><a href="/mapas/encargos"><span class="sub-item">Mapa de Encargos</span></a></li>

                            <!-- Exportação -->
                            <li><a href="/mapas/export"><span class="sub-item">Exportação (Excel/PDF)</span></a></li>
                        </ul>
                    </div>
                </li>


                <!-- Relatórios -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#relatorios">
                        <i class="fas fa-chart-bar"></i>
                        <p>Relatórios</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="relatorios">
                        <ul class="nav nav-collapse">
                            <li><a href="/relatorios/colaboradores"><span class="sub-item">Colaboradores</span></a>
                            </li>
                            <li><a href="/relatorios/salarios"><span class="sub-item">Salários</span></a></li>
                            <li><a href="/relatorios/assiduidade"><span class="sub-item">Assiduidade</span></a></li>
                            <li><a href="/relatorios/beneficios"><span class="sub-item">Benefícios</span></a></li>
                            <li><a href="/relatorios/personalizados"><span class="sub-item">Personalizados</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>



        </div>
    </div>

    <div class="sidebar-logo p-0 rounded-0 mb-0 bg-active text-light"
        style="position: fixed; bottom: 0; left: 0; width: 265px; z-index: 1030;">
        <div class="d-flex align-items-center p-1" style="border-top:1px solid #ebe3f5;">
            <!-- Ícone -->
            <a href="#" class="d-flex align-items-center justify-content-center me-2"
                style="height: 50px; width: 70px;">
                <i class="fas fa-cog text-light" style="font-size: 20px;"></i>
            </a>

            <!-- Texto -->
            <div class="logo text-start flex-grow-1">
                <a href="#" class="text-light m-0 config-link">
                    Configurações
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar -->
