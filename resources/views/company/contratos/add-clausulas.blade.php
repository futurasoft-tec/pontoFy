<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrato {{ $contrato->codigo }}</title>

    {{-- Manifest para PWA / Mobile --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
    <meta name="theme-color" content="#1d4ed8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <link rel="apple-touch-icon" href="{{ asset('assets/img/kaiadmin/apple-touch-icon.png') }}" />

    
    <!-- Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-rXnQ6zv9c8O1xA8pKz+0XjN0+YxZ7oVR4O3w2J1CwKcF5mDkqzLhEwI6uhOjD7LRa4JX3ayjSgrtq+XlT3aA9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sidebar-company.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/alerta.css') }}">

    <script src="{{ asset('') }}"></script>

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>

    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>


</head>

<body>


    {{-- Header page --}}
    <header class="card-header bg-light border d-flex align-items-center justify-content-between py-2">
        <div class="container">
            <h4 class="fw-bold mb-1">Contrato {{ $contrato->codigo }}</h4>
        </div>
        <div class="ms-md-autoA py-2A py-md-0A mt-0">
            <a href="{{ route('colaborador.show', $contrato->colaborador->id) }}" class="btn-active btn-round">
                <i class="fas fa-reply"></i>
                <span class="d-none d-sm-inline-block ms-2">Voltar</span>
            </a>
        </div>
    </header>
    <!--fim header-->

    {{-- ALERTA SUCESSO E ERROS --}}
    

    <main class="" style="min-height: 100vh; margin-top:1rem;">
        <div class="" style="margin-top: 1rem;">
            @include('components.alerta-sucesso')
        </div>
        <link rel="stylesheet" href="{{ asset('css/alerta.css') }}">
        <section class="page-inner py-4 p-5">
            
            <section class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('company.contratos.add-clausula-form')
                    </div>

                    {{-- <div class="col-md-7">
                        @include('company.contratos.clausula-preview')
                    </div> --}}
                </div>
            </section>
        </section>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
