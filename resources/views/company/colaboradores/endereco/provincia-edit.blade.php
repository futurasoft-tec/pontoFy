<div id="provincia_div" style="display: none;">
    <label for="provincia" class="form-label fw-semibold">Província</label>
    <select class="form-select form-select-lg rounded-1" id="provincia" name="provincia">
        <option value="">Selecione a província</option>
        <option value="Bengo" {{ $colaborador->provincia == 'Bengo' ? 'selected' : '' }}>Bengo</option>
        <option value="Benguela" {{ $colaborador->provincia == 'Benguela' ? 'selected' : '' }}>Benguela
        </option>
        <option value="Bié" {{ $colaborador->provincia == 'Bié' ? 'selected' : '' }}>Bié</option>
        <option value="Cabinda" {{ $colaborador->provincia == 'Cabinda' ? 'selected' : '' }}>Cabinda
        </option>
        <option value="Cuando Cubango" {{ $colaborador->provincia == 'Cuando Cubango' ? 'selected' : '' }}>Cuando
            Cubango</option>
        <option value="Cuanza Norte" {{ $colaborador->provincia == 'Cuanza Norte' ? 'selected' : '' }}>Cuanza
            Norte</option>
        <option value="Cuanza Sul" {{ $colaborador->provincia == 'Cuanza Sul' ? 'selected' : '' }}>Cuanza Sul
        </option>
        <option value="Cunene" {{ $colaborador->provincia == 'Cunene' ? 'selected' : '' }}>Cunene
        </option>
        <option value="Huambo" {{ $colaborador->provincia == 'Huambo' ? 'selected' : '' }}>Huambo
        </option>
        <option value="Huíla" {{ $colaborador->provincia == 'Huíla' ? 'selected' : '' }}>Huíla</option>
        <option value="Luanda" {{ $colaborador->provincia == 'Luanda' ? 'selected' : '' }}>Luanda
        </option>
        <option value="Lunda Norte" {{ $colaborador->provincia == 'Lunda Norte' ? 'selected' : '' }}>Lunda
            Norte</option>
        <option value="Lunda Sul" {{ $colaborador->provincia == 'Lunda Sul' ? 'selected' : '' }}>Lunda Sul
        </option>
        <option value="Malanje" {{ $colaborador->provincia == 'Malanje' ? 'selected' : '' }}>Malanje
        </option>
        <option value="Moxico" {{ $colaborador->provincia == 'Moxico' ? 'selected' : '' }}>Moxico
        </option>
        <option value="Namibe" {{ $colaborador->provincia == 'Namibe' ? 'selected' : '' }}>Namibe
        </option>
        <option value="Uíge" {{ $colaborador->provincia == 'Uíge' ? 'selected' : '' }}>Uíge</option>
        <option value="Zaire" {{ $colaborador->provincia == 'Zaire' ? 'selected' : '' }}>Zaire</option>
    </select>
</div>


<div class="mb-3" id="cidade_estrangeira" style="display: none;">
    <label for="cidade_estrangeira" class="form-label fw-semibold">Cidade</label>
    <input type="text" class="form-control rounded-1 border" id="cidade_estrangeira" name="cidade_estrangeira"
        placeholder="Digite a cidade" style="height: 40px;" value="{{ $colaborador->cidade_estrangeira }}">
</div>
