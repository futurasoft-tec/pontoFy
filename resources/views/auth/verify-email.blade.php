@extends('layouts.auth-layout')
@section('title', 'Conformar Senha - PontoFy - Gestão de Recursos Humanos')
@section('content')

    {{-- ComponenteHeaderAuth --}}
    @include('auth.auth-components')
    <div class="auth-body">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <!-- Formulário de Login -->
        <form action="{{ route('verification.send') }}" method="POST" id="auth-form">
            @csrf
            <button type="submit" class="btn-auth border-0" id="submit-form">
                <span id="submit-text">
                    Reenviar o e-mail de verificação
                </span>
                <div class="spinner-border spinner-border-sm d-none" id="submit-spinner" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </button>
        </form>


        {{-- Terminar a sessao iniciada --}}
        <div class="mb-3 mt-3 text-center">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf

                <button type="submit"
                    class="underline border btn text-sm text-danger hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                    Terminar Sessão
                </button>
            </form>
        </div>
    </div>
@endsection

