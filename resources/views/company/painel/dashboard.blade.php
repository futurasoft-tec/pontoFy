@extends('layouts.company-main')
@section('title', 'Dashboard - PONTO-RH - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold mb-1 text-active">Dashboard</h4>
                    <nav>
                        <ol class="breadcrumb">
                            Olá, {{ Auth::user()->name }}
                        </ol>
                    </nav>
                </div>
                <div class="mt-0">
                    <div class="dropdown">
                        <button class="btn-outline-active dropdown-toggle pt-2 pb-2" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                            <span class="d-none d-sm-inline-block ms-2">Filtrar</span>
                        </button>
                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item text-active" href="#">Últimos 7 dias</a></li>
                            <li><a class="dropdown-item text-active" href="#">Este mês</a></li>
                            <li><a class="dropdown-item text-active" href="#">Últimos 3 meses</a></li>
                            <li><a class="dropdown-item text-active" href="#">Personalizado...</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--fim header-->

            {{-- CARDS-DASHBOARD-RESUMO --}}
            <section class="pt-2 pb-1 mt-2 rounded-0">
                <div class="container card-body">
                    <div class="row g-2 text-center">
                        <div class="col-12 col-sm-6 col-md-3 pe-2 ps-3">
                            <div class="summary-card border rounded-1">
                                <!-- Ícone principal -->
                                <div class="card-icon bg-primary-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users text-active"></i>
                                </div>
                                <!-- Título -->
                                <div class="card-title">Nº de Colaboradores</div>
                                <!-- Valor -->
                                <div class="card-value">247</div>
                                <!-- Variação -->
                                <div class="card-change positive d-flex align-items-center">
                                    <i class="fas fa-arrow-up me-1" style="font-size: 14px;"></i>
                                    +12 desde o mês passado
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 pe-2 ps-3">
                            <div class="summary-card border rounded-1">
                                <!-- Ícone principal -->
                                <div class="card-icon bg-success-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-wallet text-success"></i>
                                </div>
                                <!-- Título -->
                                <div class="card-title">Folha do Mês</div>
                                <!-- Valor -->
                                <div class="card-value">Kz 2.548.920,00</div>
                                <!-- Variação -->
                                <div class="card-change positive d-flex align-items-center">
                                    <i class="fas fa-arrow-up me-1" style="font-size: 14px;"></i>
                                    +5.2% desde o mês passado
                                </div>
                            </div>
                        </div><!--/-fim col-12 col-sm-6 col-md-3 pe-2 ps-3-->


                        <div class="col-12 col-sm-6 col-md-3 pe-2 ps-3">
                            <!-- Card: Total de Salários -->
                            <div class="summary-card border rounded-1">
                                <!-- Ícone principal -->
                                <div class="card-icon bg-warning-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-money-bill-wave text-warning"></i>
                                </div>
                                <!-- Título -->
                                <div class="card-title">Total de Salários Pago</div>
                                <!-- Valor -->
                                <div class="card-value">Kz 1.984.560,00</div>
                                <!-- Variação positiva -->
                                <div class="card-change positive d-flex align-items-center">
                                    <i class="fas fa-arrow-up me-1" style="font-size: 14px;"></i>
                                    +4.8% desde o mês passado
                                </div>
                            </div>
                        </div><!--/-fim col-12 col-sm-6 col-md-3 pe-2 ps-3-->

                        <div class="col-12 col-sm-6 col-md-3 pe-2 ps-3">
                            <!-- Card: Impostos Retidos -->
                            <div class="summary-card border rounded-1">
                                <!-- Ícone principal -->
                                <div class="card-icon bg-danger-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-file-invoice-dollar text-danger"></i>
                                </div>
                                <!-- Título -->
                                <div class="card-title">Impostos Retidos</div>
                                <!-- Valor -->
                                <div class="card-value">Kz 564.360,00</div>
                                <!-- Variação negativa -->
                                <div class="card-change negative d-flex align-items-center">
                                    <i class="fas fa-arrow-down me-1" style="font-size: 14px;"></i>
                                    -2.1% desde o mês passado
                                </div>
                            </div>
                        </div><!--/-fim col-12 col-sm-6 col-md-3 pe-2 ps-3-->
                    </div>
                </div>
            </section>
            {{-- FIM CARDS-DASHBOARD-RESUMO --}}


            {{-- GRAFICOS --}}
            <section class="pt-0 mt-0 mb-0 rounded-0">
                <div class="card-body rounded-0 mt-4 m-0">
                    <div class="row align-items-stretch">
                        <!-- Coluna esquerda (gráfico) -->
                        <div class="col-md-8 d-flex pt-0 pb-2">
                            <div class="card card-body p-0 bg-white rounded-1 w-100">
                                <div class="card-header  text-active  pt-2 pb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 text-active"><strong>Evolução da Folha (6 meses)</strong></h5>
                                        <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">Exportar</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="semesterChart" width="400" height="200"></canvas>
                                </div>

                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
                                    rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            </div>
                        </div><!--/-fim col-md-8-->

                        <!-- Coluna direita (cards menores) -->
                        <div class="col-md-4 d-flex flex-column p-2 pt-0">
                            <div
                                class="card card-header pb-1 bg-white rounded-1 text-active rounded-bottom-0 border-bottom-0">
                                <h5 class="text-active"><strong>Actividades Recentes</strong></h5>
                            </div>
                            <div class="p-2 card card-body rounded-1 bg-white flex-fill rounded-top-0">
                                <!--Actividade 1--->
                                <div class="d-flex align-items-center border-bottom pb-2 p-2">
                                    <div class="icon bg-primary-light d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-plane-departure text-active"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-active">Férias Agendadas</h6>
                                        <small class="text-muted small">15 Colaboradores</small>
                                    </div>
                                </div>
                                <!--fim Actividade 1--->

                                <!--Actividade 1--->
                                <div class="d-flex align-items-center border-bottom pb-2 p-2">
                                    <div class="icon bg-primary-light d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-plane-departure text-active"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-active"></h6>
                                        <small class="text-muted small">15 Colaboradores</small>
                                    </div>
                                </div>
                                <!--fim Actividade 1--->


                                <!--Actividade 1--->
                                <div class="d-flex align-items-center border-bottom pb-2 p-2">
                                    <div class="icon bg-primary-light d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-plane-departure text-active"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-active">Férias Agendadas</h6>
                                        <small class="text-muted small">15 Colaboradores</small>
                                    </div>
                                </div>
                                <!--fim Actividade 1--->

                                <!--Actividade 1--->
                                <div class="d-flex align-items-center border-bottom pb-2 p-2">
                                    <div class="icon bg-primary-light d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-plane-departure text-active"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-active">Férias Agendadas</h6>
                                        <small class="text-muted small">15 Colaboradores</small>
                                    </div>
                                </div>
                                <!--fim Actividade 1--->
                                <!--Actividade 1--->
                                <div class="d-flex align-items-center border-bottom pb-2 p-2">
                                    <div class="icon bg-primary-light d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 30px; height: 30px;">
                                        <i class="fas fa-plane-departure text-active"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-active">Férias Agendadas</h6>
                                        <small class="text-muted small">15 Colaboradores</small>
                                    </div>
                                </div>

                                <hr class="p-0 mt-2">
                                <div class="text-center">
                                    <a href="" class="text-active">Ver mais</a>
                                </div>
                                <!--fim Actividade 1--->
                            </div>
                        </div><!--/-fim col-md-4-->
                    </div><!--.row align-items-stretch-->
                </div>
            </section>
            {{-- FIM GRAFICOS --}}

            {{-- ULTIMOS PROCESSAMENTOS --}}
            <section class="mt-3 rounded-0">
                <div class="card-header card bg-white border-bottom-0 text-activ rounded-top-1 ">
                    <div class="d-flex justify-content-between align-items-center pt-2 pb-2">
                        <h5 class="mb-0 text-active"><strong>Últimos Processamentos</strong></h5>
                        <a href="#" class="p-1 rounded-1 btn-active   small fw-semibold">
                            Ver Histórico Completo
                        </a>
                    </div>
                </div>
                
                <div class="card card-body rounded-0 bg-white">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover mb-0 small table-sm align-middle">
                            <thead class="">
                                <tr>
                                    <th class="py-1"> <b>Período - {{ date('Y') }}</b> </th>
                                    <th class="py-1 text-end"><b>Valor</b></th>
                                    <th class="py-1 text-end"><b>IRT</b></th>
                                    <th class="py-1 text-end"><b>INSS</b></th>
                                    <th class="py-1 text-end"><b>Sub. Natal</b></th>
                                    <th class="py-1 text-end"><b>Sub. Férias</b></th>
                                    <th class="py-1 text-end"><b>Total</b></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Janeiro - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Fevereiro - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Março - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Abril - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Maio - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Junho - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Julho - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Agosto - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Setembro - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Outurbro - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Novembro - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>

                                <tr>
                                    <td class="py-1 small">
                                        <a href="" class="text-active">Dezembro - {{ date('Y') }}</a>
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.200.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        120.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        98.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        100.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        80.000,00
                                    </td>
                                    <td class="py-1 small text-end">
                                        1.598.000,00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

            {{-- FIM ULTIMOS PROCESSAMENTOS  --}}



        </section>
    </main>

@endsection
