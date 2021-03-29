
<div class="form-row col-12 p-0">
    <?php if($index > 0){ ?>
        <div class="col-12">
            <button class="float-right btn btn-danger" type="button" id="btn-remove-address-<?=$index?>">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    <?php } ?>
    <input type="hidden" value="<?=$address['id']?>" name="address[<?=$index?>][id]">
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][cep]">Cep<span style="color: red">*</span></label>
        <input autocomplete="no" type="text" class="form-control form-address" id="address[<?=$index?>][cep]"
               data-name="cep" name="address[<?=$index?>][cep]" maxlength="9" value="<?=$address['cep']?>">
    </div>
    <div class="form-group col-md-7">
        <label for="address[<?=$index?>][address]">Endereço<span style="color: red">*</span>
        </label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][address]" id="address[<?=$index?>][address]"
               maxlength="100" data-name="address" value="<?=$address['address']?>">
    </div>
    <div class="form-group col-md-2">
        <label for="address[<?=$index?>][number]">Número<span style="color: red">*</span></label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][number]"
               data-name="number" id="address[<?=$index?>][number]" maxlength="10" value="<?=$address['number']?>">
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][complement]">Complemento</label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][complement]"
               data-name="complement"  id="address[<?=$index?>][complement]"  value="<?=$address['complement']?>"
               maxlength="60">
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][neighborhood]">Bairro<span style="color: red">*</span>
        </label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][neighborhood]"
               id="address[<?=$index?>][neighborhood]" maxlength="60" data-name="neighborhood" value="<?=$address['neighborhood']?>">
    </div>
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][city]">Cidade<span style="color: red">*</span></label>
        <input autocomplete="no" type="text" class="form-control form-address" name="address[<?=$index?>][city]"
               data-name="city"  id="address[<?=$index?>][city]" maxlength="60"  value="<?=$address['city']?>">
    </div>
    
    <div class="form-group col-md-3">
        <label for="address[<?=$index?>][state]">Estado<span style="color: red">*</span></label>
        <select type="text" class="form-control form-address" name="address[<?=$index?>][state]"
                data-name="state" id="address[<?=$index?>][state]" autocomplete="no">
            <option value="">Estados</option>
            <?php foreach($states as $key => $state) {?>
                <option value="<?=$key?>" <?=$key == $address['state'] ? 'selected' : ''?> ><?=$state?></option>
            <?php } ?>
        </select>
    </div>
</div>