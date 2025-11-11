<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    {{-- Título dinâmico --}}
    <title>@yield('title', 'PONTO-Fy - Gestão de Recursos Humanos')</title>

    {{-- Responsividade --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

    {{-- SEO Básico --}}
    <meta name="description"
        content="PONTO-Fy é um sistema completo de gestão de recursos humanos, desenvolvido pela Futurasoft - Tecnologia, Lda. Automatize folha de salários, assiduidade e processos de Fy de forma simples e eficiente." />
    <meta name="keywords"
        content="PONTO-Fy, gestão de recursos humanos, folha de salários, Fy Angola, Futurasoft, software de Fy" />
    <meta name="author" content="Futurasoft - Tecnologia, Lda" />

    {{-- URL do site --}}
    <link rel="canonical" href="https://pontorh.ao" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    {{-- Open Graph (Facebook, LinkedIn, WhatsApp, etc.) --}}
    <meta property="og:title" content="PONTO-Fy - Gestão de Recursos Humanos" />
    <meta property="og:description"
        content="Solução completa para folha de salários e gestão de recursos humanos em Angola." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://pontorh.ao" />
    <meta property="og:image" content="{{ asset('assets/img/kaiadmin/og-image.png') }}" />
    <meta property="og:site_name" content="PONTO-Fy" />

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="PONTO-Fy - Gestão de Recursos Humanos" />
    <meta name="twitter:description" content="Automatize folha de salários e gestão de Fy com o PONTO-Fy." />
    <meta name="twitter:image" content="{{ asset('assets/img/kaiadmin/og-image.png') }}" />
    <meta name="twitter:site" content="@pontorh" />

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
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">

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
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader" id="preloader">
            <div class="loader-container">
                <div class="loader-logo">PontoFy</div>
                <div class="loader">
                    <div class="loader-circle"></div>
                    <div class="loader-circle"></div>
                </div>
                <div class="loader-progress">
                    <div class="loader-progress-bar" id="progressBar"></div>
                </div>
            </div>
        </div> --}}

        @include('components.sidebar-company')

        {{-- END SIDBAR --}}

        <div class="main-panel">
            {{-- HEADER --}}
            @include('components.company-header')
            {{-- END HEADER --}}
            @yield('content')

            {{-- SIDBAR --}}
            {{-- FOOTER --}}
            @include('components.company-footer')
            {{-- END FOOTER --}}
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src=" {{ asset('assets/js/plugin/chart-circle/circles.min.js') }} "></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="{{ asset('assets/js/grafico-salarial-semestral.js') }}"></script>


    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>
