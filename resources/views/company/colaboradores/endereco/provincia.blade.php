<div id="provincia_div" style="display: none;">
    <label for="provincia" class="form-label fw-semibold">Província</label>
    <select class="form-select rounded-1 border" id="provincia" name="provincia">
        <option selected value="">Selecione a província</option>
        <option value="Bengo">Bengo</option>
        <option value="Benguela">Benguela</option>
        <option value="Bié">Bié</option>
        <option value="Cabinda">Cabinda</option>
        <option value="Cuando Cubango">Cuando Cubango</option>
        <option value="Cuanza Norte">Cuanza Norte</option>
        <option value="Cuanza Sul">Cuanza Sul</option>
        <option value="Cunene">Cunene</option>
        <option value="Huambo">Huambo</option>
        <option value="Huíla">Huíla</option>
        <option value="Luanda">Luanda</option>
        <option value="Lunda Norte">Lunda Norte</option>
        <option value="Lunda Sul">Lunda Sul</option>
        <option value="Malanje">Malanje</option>
        <option value="Moxico">Moxico</option>
        <option value="Namibe">Namibe</option>
        <option value="Uíge">Uíge</option>
        <option value="Zaire">Zaire</option>
    </select>
</div>

<div class="mb-3" id="cidade_estrangeira" style="display: none;">
    <label for="cidade_estrangeira" class="form-label fw-semibold">Cidade</label>
    <input type="text" class="form-control rounded-1 border" id="cidade_estrangeira" name="cidade_estrangeira"
        placeholder="Digite a cidade" style="height: 40px;">
</div>







{{-- Script para exibir e ocular campos nif e documento ID --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona o dropdown e o grupo do campo NIF
        var tipoClienteSelect = document.getElementById('tipo');
        var nifGroup = document.getElementById('nif_group');

        // Adiciona um evento de mudança ao dropdown
        tipoClienteSelect.addEventListener('change', function() {
            // Verifica o valor selecionado
            if (tipoClienteSelect.value === 'Empresa') {
                // Mostra o campo NIF se "Empresa" for selecionado
                nifGroup.style.display = 'block';
            } else {
                // Oculta o campo NIF se "Particular" for selecionado
                nifGroup.style.display = 'none';
            }
        });
    });





    // Exibir e ocultar campo cidade
    document.getElementById('pais').addEventListener('change', function() {
        const paisSelecionado = this.value;
        const provinciaDiv = document.getElementById('provincia_div');
        const cidadeManualDiv = document.getElementById('cidade_estrangeira');

        if (paisSelecionado === 'Angola') {
            provinciaDiv.style.display = 'block';
            cidadeManualDiv.style.display = 'none';
        } else {
            provinciaDiv.style.display = 'none';
            cidadeManualDiv.style.display = 'block';
        }
    });
</script>
