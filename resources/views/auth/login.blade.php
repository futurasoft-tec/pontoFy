@extends('layouts.auth-layout')
@section('title', 'Login - PontoFy - Gestão de Recursos Humanos')
@section('content')

    {{-- ComponenteHeaderAuth --}}
    @include('auth.auth-components')
    <div class="auth-body">

        <h3 class="h5 form-title mb-4 p-0">
            Bem-Vindo!
        </h3>

        {{-- ERROS --}}
        <x-validation-errors class="mb-4 small text-danger" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <!-- Formulário de Login -->
        <form action="{{ route('login') }}" method="POST" id="auth-form">
            @csrf

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required
                    autofocus autocomplete="username" value="{{ old('email') }}">
                <label for="email">E-mail</label>
            </div>

            <div class="mb-3 password-container">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required
                        autocomplete="current-password">
                    <label for="password">Senha</label>
                    <button type="button" class="password-toggle" id="toggle-password">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="options-row">
                <div class="remember-me">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember" id="remember" name="remember">Lembrar-me</label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-password">Esqueceu a senha?</a>
            </div>

            <button type="submit" class="btn-auth border-0" id="submit-form">
                <span id="submit-text">Entrar</span>
                <div class="spinner-border spinner-border-sm d-none" id="submit-spinner" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </button>
            <div class="register-link">
                <p>Não tem uma conta? <a href="{{ route('register') }}" class="text-primary">
                        <strong style="color: #003e46;">Registrar-me</strong>
                    </a></p>
            </div>
        </form>



        <!-- Conta Demo -->
        <div class="demo-account">
            {{-- <p>Quer testar o sistema?</p> --}}
            <button class="demo-btn" id="demo-auth">Acessar Conta Demo</button>
        </div>

        {{-- Rodape --}}
        <div class="text-center mt-2">
            <a href="{{ route('politica.privacidade') }}" class="text-active"
            target="_blank">Política de Privacidade</a>
        </div>

    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos do DOM
            const authForm = document.getElementById('auth-form');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('toggle-password');
            const submitBtn = document.getElementById('submit-form');
            const submitText = document.getElementById('submit-text');
            const submitSpinner = document.getElementById('submit-spinner');
            const demoLoginBtn = document.getElementById('demo-auth');

            // Alternar visibilidade da senha
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' :
                    '<i class="far fa-eye-slash"></i>';
            });

            // Event listener para envio do formulário
            // authForm.addEventListener('submit', function(e) {
            //     e.preventDefault();

            //     // Validar campos
            //     const email = document.getElementById('email').value;
            //     const password = passwordInput.value;

            //     let isValid = true;

            //     if (!email.trim()) {
            //         showValidationError(document.getElementById('email'), 'Por favor, informe seu e-mail');
            //         isValid = false;
            //     } else if (!isValidEmail(email)) {
            //         showValidationError(document.getElementById('email'),
            //             'Por favor, informe um e-mail válido');
            //         isValid = false;
            //     } else {
            //         clearValidationError(document.getElementById('email'));
            //     }

            //     if (!password) {
            //         showValidationError(passwordInput, 'Por favor, informe sua senha');
            //         isValid = false;
            //     } else {
            //         clearValidationError(passwordInput);
            //     }

            //     if (isValid) {
            //         // Simular envio do formulário
            //         submitText.classList.add('d-none');
            //         submitSpinner.classList.remove('d-none');
            //         submitBtn.disabled = true;

            //         setTimeout(function() {
            //             // Simulação de auth bem-sucedido
            //             alert('Login realizado com sucesso! Redirecionando...');

            //             // Aqui você redirecionaria para a dashboard
            //             // window.location.href = '/dashboard';

            //             submitText.classList.remove('d-none');
            //             submitSpinner.classList.add('d-none');
            //             submitBtn.disabled = false;
            //         }, 1500);
            //     }
            // });

            // Login com conta demo
            demoLoginBtn.addEventListener('click', function() {
                // Preencher automaticamente com credenciais demo
                document.getElementById('email').value = 'demo@pontofy.com';
                passwordInput.value = 'demo1234';

                // Mostrar mensagem informativa
                alert('Credenciais de demonstração preenchidas. Clique em "Entrar" para continuar.');
            });

            // Função para validar e-mail
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Função para mostrar erro de validação
            function showValidationError(input, message) {
                input.classList.add('is-invalid');

                let feedback = input.nextElementSibling;
                if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    input.parentNode.appendChild(feedback);
                }

                feedback.textContent = message;
            }

            // Função para limpar erro de validação
            function clearValidationError(input) {
                input.classList.remove('is-invalid');

                const feedback = input.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
        });
    </script>

@endsection
