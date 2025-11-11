@extends('layouts.auth-layout')
@section('title', 'Cria Conta Grátis - PontoFy - Gestão de Recursos Humanos')
@section('content')

    {{-- ComponenteHeaderAuth --}}
    @include('auth.auth-components')

    <div class="auth-body">
        <h3 class="form-title">Criar Conta</h3>

        <!-- Indicador de Progresso -->
        <div class="progress-indicator">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        {{-- ERROS --}}
        <x-validation-errors class="mb-4" />
        <!-- Formulário de Cadastro -->
        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf 
            <div class="form-floating">
                <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name') }}"
                    placeholder="Nome completo" required autofocus autocomplete="name">
                <label for="fullName">Nome completo</label>
            </div>

            
            <div class="form-floating">
                <input type="text" class="form-control" id="companyName" name="company_name"
                    value="{{ old('company_name') }}" placeholder="Nome da empresa" required autocomplete="name">
                <label for="companyName">Nome da empresa</label>
                <div class="field-counter" id="company-counter">0/100</div>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="E-mail" required autocomplete="username">
                <label for="email">E-mail</label>
            </div>

            <div class="mb-3 password-container">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                        placeholder="Senha" required autocomplete="new-password">
                    <label for="password">Senha</label>
                    <button type="button" class="password-toggle" id="toggle-password">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <div class="password-strength mt-2">
                    <div class="password-strength-bar" id="password-strength-bar"></div>
                </div>
                <div class="form-text" id="password-strength-text">Use pelo menos 8 caracteres</div>
            </div>

            <div class="mb-3 password-container">
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                        placeholder="Confirmar senha" required autocomplete="new-password">
                    <label for="confirmPassword">Confirmar senha</label>
                    <button type="button" class="password-toggle" id="toggle-confirm-password">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <div class="form-text" id="password-match-text"></div>
            </div>
            
            {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        Concordo com os <a href="#" class="text-primary">Termos</a> e <a href="#"
                            class="text-primary">Privacidade</a>
                    </label>
                </div>
            @endif --}}
            <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        Concordo com os <a href="{{ route('termos.condicoes') }}" class="text-active"><b>Termos</b></a> e <a 
                        href="{{ route('politica.privacidade') }}" class="text-active"><b>Privacidade</b></a>
                    </label>
                </div>

            <button type="submit" class="btn-auth border-0 rounded-1" id="submit-form">
                <span id="submit-text">Criar Conta</span>
                <div class="spinner-border spinner-border-sm d-none" id="submit-spinner" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </button>
        </form>


        <div class="login-link">
            <p>Já tem uma conta? <a href="{{ route('login') }}" class="" style="color: #003e46;"> <strong>Faça login</strong> </a></p>
        </div>


    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos do DOM
            const registerForm = document.getElementById('register-form');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const passwordStrengthBar = document.getElementById('password-strength-bar');
            const passwordStrengthText = document.getElementById('password-strength-text');
            const passwordMatchText = document.getElementById('password-match-text');
            const togglePasswordBtn = document.getElementById('toggle-password');
            const toggleConfirmPasswordBtn = document.getElementById('toggle-confirm-password');
            const companyNameInput = document.getElementById('companyName');
            const companyCounter = document.getElementById('company-counter');
            const progressBar = document.getElementById('progress-bar');
            const submitBtn = document.getElementById('submit-form');
            const submitText = document.getElementById('submit-text');
            const submitSpinner = document.getElementById('submit-spinner');

            // Atualizar contador de caracteres para nome da empresa
            companyNameInput.addEventListener('input', function() {
                const count = this.value.length;
                companyCounter.textContent = `${count}/100`;

                if (count > 100) {
                    this.value = this.value.substring(0, 100);
                    companyCounter.textContent = '100/100';
                }
            });

            // Alternar visibilidade da senha
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' :
                    '<i class="far fa-eye-slash"></i>';
            });

            // Alternar visibilidade da confirmação de senha
            toggleConfirmPasswordBtn.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' :
                    '<i class="far fa-eye-slash"></i>';
            });

            // Validação de senha
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
                updateProgressBar();
            });

            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Função para verificar a força da senha
            function checkPasswordStrength(password) {
                let strength = 0;
                let text = 'Use pelo menos 8 caracteres';
                let color = '';

                if (password.length >= 8) {
                    strength++;
                    text = 'Senha fraca';
                    color = 'password-weak';
                }

                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/\d/)) strength++;
                if (password.match(/[^a-zA-Z\d]/)) strength++;

                switch (strength) {
                    case 0:
                        text = 'Use pelo menos 8 caracteres';
                        color = '';
                        break;
                    case 1:
                        text = 'Senha fraca';
                        color = 'password-weak';
                        break;
                    case 2:
                        text = 'Senha média';
                        color = 'password-medium';
                        break;
                    case 3:
                        text = 'Senha forte';
                        color = 'password-strong';
                        break;
                    case 4:
                        text = 'Senha muito forte';
                        color = 'password-very-strong';
                        break;
                }

                passwordStrengthBar.style.width = `${strength * 25}%`;
                passwordStrengthBar.className = `password-strength-bar ${color}`;
                passwordStrengthText.textContent = text;
                passwordStrengthText.className = `form-text ${color}`;
            }

            // Função para verificar se as senhas coincidem
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword === '') {
                    passwordMatchText.textContent = '';
                    return;
                }

                if (password === confirmPassword) {
                    passwordMatchText.textContent = 'As senhas coincidem';
                    passwordMatchText.className = 'form-text text-success';
                } else {
                    passwordMatchText.textContent = 'As senhas não coincidem';
                    passwordMatchText.className = 'form-text text-danger';
                }

                updateProgressBar();
            }

            // Atualizar barra de progresso
            function updateProgressBar() {
                let progress = 0;
                const fullName = document.getElementById('fullName').value;
                const email = document.getElementById('email').value;
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (fullName) progress += 25;
                if (email) progress += 25;
                if (password) progress += 25;
                if (confirmPassword && password === confirmPassword) progress += 25;

                progressBar.style.width = `${progress}%`;
            }

            // Event listener para envio do formulário
            // registerForm.addEventListener('submit', function(e) {
            //     e.preventDefault();

            //     // Validar campos
            //     const fullName = document.getElementById('fullName').value;
            //     const email = document.getElementById('email').value;
            //     const password = passwordInput.value;
            //     const confirmPassword = confirmPasswordInput.value;
            //     const terms = document.getElementById('terms').checked;

            //     let isValid = true;

            //     if (!fullName.trim()) {
            //         showValidationError(document.getElementById('fullName'),
            //             'Por favor, informe seu nome completo');
            //         isValid = false;
            //     } else {
            //         clearValidationError(document.getElementById('fullName'));
            //     }

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
            //         showValidationError(passwordInput, 'Por favor, crie uma senha');
            //         isValid = false;
            //     } else if (password.length < 8) {
            //         showValidationError(passwordInput, 'A senha deve ter pelo menos 8 caracteres');
            //         isValid = false;
            //     } else {
            //         clearValidationError(passwordInput);
            //     }

            //     if (!confirmPassword) {
            //         showValidationError(confirmPasswordInput, 'Por favor, confirme sua senha');
            //         isValid = false;
            //     } else if (password !== confirmPassword) {
            //         showValidationError(confirmPasswordInput, 'As senhas não coincidem');
            //         isValid = false;
            //     } else {
            //         clearValidationError(confirmPasswordInput);
            //     }

            //     if (!terms) {
            //         showValidationError(document.getElementById('terms'),
            //             'Você deve aceitar os termos de serviço');
            //         isValid = false;
            //     } else {
            //         clearValidationError(document.getElementById('terms'));
            //     }

            //     if (isValid) {
            //         // Simular envio do formulário
            //         submitText.classList.add('d-none');
            //         submitSpinner.classList.remove('d-none');
            //         submitBtn.disabled = true;

            //         setTimeout(function() {
            //             alert(
            //                 'Conta criada com sucesso! Em breve você receberá um e-mail de confirmação.');

            //             // Resetar formulário
            //             registerForm.reset();
            //             passwordStrengthBar.style.width = '0';
            //             passwordStrengthText.textContent = 'Use pelo menos 8 caracteres';
            //             passwordMatchText.textContent = '';
            //             progressBar.style.width = '0';

            //             submitText.classList.remove('d-none');
            //             submitSpinner.classList.add('d-none');
            //             submitBtn.disabled = false;
            //         }, 1500);
            //     }
            // });

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

            // Atualizar progresso ao preencher campos
            document.querySelectorAll('#register-form input').forEach(input => {
                input.addEventListener('input', updateProgressBar);
            });
        });
    </script>


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

        .register-container {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: var(--white);
            padding: 30px;
            text-align: center;
        }

        .register-body {
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

        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }

        .password-weak {
            background-color: #dc3545;
        }

        .password-medium {
            background-color: #ffc107;
        }

        .password-strong {
            background-color: #28a745;
        }

        .password-very-strong {
            background-color: var(--primary);
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

        .login-link {
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
        }

        .password-container {
            position: relative;
        }

        .progress-indicator {
            height: 4px;
            background-color: #e9ecef;
            border-radius: 2px;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--primary);
            width: 25%;
            transition: width 0.3s ease;
        }

        .field-counter {
            text-align: right;
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>

@endsection
