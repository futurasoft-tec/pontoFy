<!-- ! MSG - ALERTA SUCESSO -->
    @if (session('sucesso'))
        <div id="alertaSucesso" class="alert-container">
            <div class="alert alert-success">
                <div class="alert-icon">
                    <i class="bx bxs-check-circle"></i>
                </div>
                <div class="alert-content small">
                    <span>{{ session('sucesso') }}</span>
                </div>
                <button class="alert-close" onclick="this.parentElement.style.opacity='0'">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('erro'))
        <div id="alertaErro" class="alert-container">
            <div class="alert alert-error">
                <div class="alert-icon">
                    <i class="bx bxs-error-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>ERRO: </strong>
                    <span>{{ session('erro') }}</span>
                </div>
                <button class="alert-close" onclick="this.parentElement.style.opacity='0'">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        </div>
    @endif