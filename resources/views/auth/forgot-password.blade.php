@extends('layouts.auth-layout')
@section('title', 'Esqueci minha senha - PontoFy - Gestão de Recursos Humanos')
@section('content')

    {{-- ComponenteHeaderAuth --}}
    @include('auth.auth-components')

    <div class="auth-body">
       <div class="mb-3">
         <h3 class="text-start h5 form-title mb-2 p-0">
        Esqueceu sua senha?
        </h3>
        <p class="m-0 p-0 small">
          Sem problemas, Insira seu e-mail para receber as instruções de redefinição.
        </p>
       </div>
        {{-- ERROS --}}
        <x-validation-errors class="mb-4 small text-danger"/>
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <!-- Formulário de Login -->
        <form action="{{ route('password.email') }}" method="POST" id="auth-form">
            @csrf

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required
                    autofocus autocomplete="username" value="{{ old('email') }}">
                <label for="email">E-mail</label>
            </div>

          

            <button type="submit" class="btn-auth border-0" id="submit-form">
                <span id="submit-text">
                    Enviar link para redefinir senha por e-mail
                </span>
                <div class="spinner-border spinner-border-sm d-none" id="submit-spinner" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </button>
        </form>

        <div class="register-link">
            <p>Lembrou-se da Senha? <a href="{{ route('login') }}" class="text-primary">
                    <strong style="color: #003e46;">Fazer Login</strong>
                </a></p>
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
