{{-- MODAL EDITAR RUBRICA --}}
<div class="modal fade" id="detailRubricaModal{{ $rubrica->pivot->id }}" tabindex="-1"
    aria-labelledby="detailRubricaModalLabel{{ $rubrica->pivot->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

            <!-- Cabeçalho -->
            <div class="modal-header bg-active text-white">
                <h4 class="modal-title" id="detailRubricaModalLabel{{ $rubrica->pivot->id }}">
                    <i class="far fa-eye me-2"></i> Detalhe da Rubrica <i>'{{ $rubrica->nome }}'</i>
                </h4>
                <i class="bi bi-pencil-square me-2"></i>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>

            <div class="card-body ">
                <strong>Nome:</strong> {{ $rubrica->nome ?? $rubrica->pivot->nome }} <br>
                <strong>Código:</strong> {{ $rubrica->codigo ?? $rubrica->pivot->nome }} <br>
                <strong>Automática:</strong>
                @if ($rubrica->pivot->eh_automatica == 0)
                    Não
                @elseif($rubrica->pivot->eh_automatica == 1)
                    Sim
                @else
                    N/A
                @endif
                <br>
                <strong>Fórmula:</strong> {{ $rubrica->formula ?? ($rubrica->pivot->formula_customizada ?? 'NA') }} <br>
                <strong>Status:</strong> {{ $rubrica->pivot->status }} <br>
                <strong>Tipo:</strong> {{ $rubrica->tipo ?? 'NA' }} <br>
                <strong>Tributável:</strong>
                @if ($rubrica->is_tributavel == 0)
                    Não
                @elseif($rubrica->is_tributavel == 1)
                    Sim
                @else
                    N/A
                @endif
                <br>
                <strong>Valor:</strong> {{ number_format($rubrica->pivot->valor_customizado, 2, ',','.') }}Kz <br>
                <strong>Data de Registro:</strong> {{ $rubrica->pivot->created_at->format('d/m/Y') }} <br>
            </div>


            <!-- Rodapé -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-active border" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Fechar
                </button>
            </div>
        </div>
    </div>
</div>
{{-- ===============MODAIS=========== --}}
