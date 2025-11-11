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

 <style>
        :root {
            --primary-dark: #003e46;
            --primary: #00c780;
            --transparent: #0000;
            --white: #fff;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: var(--white);
            padding: 30px;
            text-align: center;
        }
        
        .login-body {
            padding: 40px;
        }
        
        .logo {
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .tagline {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        .form-title {
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--primary-dark);
            text-align: center;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e1e5e9;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(0, 199, 128, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin-top: 25px;
        }
        
        .feature-list li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #6c757d;
        }
        
        .feature-list i {
            color: var(--primary);
            margin-right: 10px;
            font-size: 16px;
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 10;
        }
        
        .password-container {
            position: relative;
        }
        
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: var(--primary-dark);
        }
        
        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e9ecef;
            z-index: 1;
        }
        
        .divider-text {
            background-color: var(--white);
            padding: 0 15px;
            color: #6c757d;
            font-size: 14px;
            position: relative;
            z-index: 2;
        }
        
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .social-btn {
            flex: 1;
            padding: 10px;
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            color: #495057;
            text-decoration: none;
        }
        
        .social-btn:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        
        .social-btn i {
            font-size: 18px;
        }
        
        .google-btn i {
            color: #DB4437;
        }
        
        .microsoft-btn i {
            color: #00A4EF;
        }
        
        .demo-account {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
        }
        
        .demo-account p {
            margin-bottom: 10px;
            font-size: 14px;
            color: #6c757d;
        }
        
        .demo-btn {
            background-color: var(--primary-dark);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .demo-btn:hover {
            background-color: var(--primary);
        }
    </style>
</head>

<body>
    @yield('content')
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
