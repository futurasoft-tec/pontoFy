@extends('layouts.auth-layout')
@section('title', 'Alterar Senha - PontoFy - Gestão de Recursos Humanos')
@section('content')

    {{-- ComponenteHeaderAuth --}}
    @include('auth.auth-components')
    <div class="auth-body">
        {{-- <h3 class="h5 form-title mb-4 p-0">
            Bem vindo de volta, <br> <strong>Faça seu Login!</strong>
        </h3> --}}

        {{-- ERROS --}}
        <x-validation-errors class="mb-4 small text-danger" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <!-- Formulário de Login -->
        <form action="{{ route('password.update') }}" method="POST" id="auth-form">
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

            <div class="mb-3 password-container">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                    placeholder="Confirmação de senha" required
                        autocomplete="current-password">
                    <label for="password">Confirmação de senha</label>
                    <button type="button" class="password-toggle" id="toggle-password">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-auth border-0" id="submit-form">
                <span id="submit-text">Alterar Senha</span>
                <div class="spinner-border spinner-border-sm d-none" id="submit-spinner" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </button>
        </form>
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
