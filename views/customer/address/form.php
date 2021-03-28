<div class="form-row col-12 p-0">
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][cep]">Cep</label>
        <input autocomplete="no" type="text" class="form-control form-address" id="address[<?=$index?>][cep]"
               data-name="cep" name="address[<?=$index?>][cep]" maxlength="9" required>
    </div>
    <div class="form-group col-md-7">
        <label for="address[<?=$index?>][address]">Endereço
        </label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][address]" id="address[<?=$index?>][address]"
               maxlength="100" data-name="address" required>
    </div>
    <div class="form-group col-md-2">
        <label for="address[<?=$index?>][number]">Número</label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][number]"
               data-name="number" id="address[<?=$index?>][number]" maxlength="10" required>
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][complement]">Complemento</label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][complement]"
               data-name="complement"  id="address[<?=$index?>][complement]"
               maxlength="60">
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][neighborhood]">Bairro
        </label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][neighborhood]"
               id="address[<?=$index?>][neighborhood]" maxlength="60" data-name="neighborhood"  required>
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][city]">Cidade</label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][city]"
               data-name="city"  id="address[<?=$index?>][city]" maxlength="60" required>
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][state]">Estado</label>
        <select type="text" class="form-control form-address" name="address[<?=$index?>][state]"
                data-name="state" id="address[<?=$index?>][state]" autocomplete="no" required>
            <option value="">Estados</option>
            <?php foreach($states as $key => $state) { ?>
                <option value="<?=$key?>"><?=$state?></option>
            <?php } ?>
        </select>
    </div>

</div>