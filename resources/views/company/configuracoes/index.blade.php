@extends('layouts.company-main')
@section('title', 'Configurações - PONTO-Fy - Gestão de Recursos Humanos')
@section('content')

    <main class="container" style="min-height: 100vh;">
        <section class="page-inner p-3">
            {{-- Header page --}}
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold mb-1 text-active">Configurações</h4>
                    <nav>
                        <ol class="breadcrumb">
                            Olá, {{ Auth::user()->name }}
                        </ol>
                    </nav>
                </div>
                <div class="mt-0">
                    <div class="dropdown">
                        <a href="{{ route('dashboard') }}" class="btn-outline-active rounded-1">
                            <i class="fas fa-reply"></i>
                            <span class="d-none d-sm-inline-block">Voltar</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--fim header-->

            {{-- CARDS-DASHBOARD-RESUMO --}}
            <section class="pt-2 pb-1 mt-2 rounded-0">
                <div class="container card-body">
                    <h1>Configurações</h1>
                </div>
            </section>

            {{-- FIM ULTIMOS PROCESSAMENTOS  --}}
            <a href="{{ route('periodos.index') }}" class="btn btn-active">
                Criar ano de Processamento
            </a>

            <a href="{{ route('rubricas.index') }}" class="btn btn-active">
                Criar Rubricas
            </a>


        </section>
    </main>

@endsection
