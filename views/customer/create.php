<?php
$title = 'Cadastro de clientes';

include __DIR__ . '/../layouts/section/section.php';
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-danger">Voltar</button>
            </div>
            <div class="card-body">
                <form action="<?=$_SERVER['SCRIPT_NAME'].'/customer/create'?>" method="post">
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="name" id="name" required>
                        </div>
                        <div class="col-md-2">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" required>
                        </div>
                        <div class="col-md-2">
                            <label for="rg">RG</label>
                            <input type="text" class="form-control" name="rg" id="rg" required>
                        </div>
                        <div class="col-md-2">
                            <label for="birth_date">Data Nascimento</label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date" required>
                        </div>
                        <div class="col-md-2">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="col-12">
                            <hr>
                            <h6>Endereço</h6>
                            <button class="float-right btn btn-warning" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="address[0][cep]">Cep</label>
                            <input autocomplete="no" type="text" inputmode="numeric" class="form-control" id="address[0][cep]"
                                   name="address[0][cep]" maxlength="9">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="address[0][address]">Endereço
                            </label>
                            <input autocomplete="no" type="text" class="form-control" name="address[0][address]" id="address[0][address]"
                                   maxlength="100">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="address[0][number]">Número</label>
                            <input autocomplete="no" type="text" class="form-control" name="address[0][number]" id="address[0][number]" maxlength="10">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="address[0][complement]">Complemento</label>
                            <input autocomplete="no" type="text" class="form-control" name="address[0][complement]" id="address[0][complement]"
                                   maxlength="60">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="address[0][neighborhood]">Bairro
                            </label>
                            <input autocomplete="no" type="text" class="form-control" name="address[0][neighborhood]"
                                   id="address[0][neighborhood]" maxlength="60">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="address[0][city]">Cidade</label>
                            <input autocomplete="no" type="text" class="form-control" name="address[0][city]" id="address[0][city]" maxlength="60">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="address[0][state]">Estado</label>
                            <select type="text" class="form-control" name="address[0][state]" id="address[0][state]" autocomplete="no">
                                <option value="GO">GO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address[1][cep]">Cep</label>
                        <input autocomplete="no" type="text" inputmode="numeric" class="form-control" id="address[1][cep]"
                               name="address[1][cep]" maxlength="9">
                    </div>
                    <div class="form-group col-md-7">
                        <label for="address[1][address]">Endereço
                        </label>
                        <input autocomplete="no" type="text" class="form-control" name="address[1][address]" id="address[1][address]"
                               maxlength="100">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="address[1][number]">Número</label>
                        <input autocomplete="no" type="text" class="form-control" name="address[1][number]" id="address[1][number]" maxlength="10">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address[1][complement]">Complemento</label>
                        <input autocomplete="no" type="text" class="form-control" name="address[1][complement]" id="address[1][complement]"
                               maxlength="60">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address[1][neighborhood]">Bairro
                        </label>
                        <input autocomplete="no" type="text" class="form-control" name="address[1][neighborhood]"
                               id="address[1][neighborhood]" maxlength="60">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address[1][city]">Cidade</label>
                        <input autocomplete="no" type="text" class="form-control" name="address[1][city]" id="address[1][city]" maxlength="60">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address[1][state]">Estado</label>
                        <select type="text" class="form-control" name="address[1][state]" id="address[1][state]" autocomplete="no">
                            <option value="GO">GO</option>
                        </select>
                    </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success float-right">Salvar</button>
            </div>
            </form>
        </div>
    </div>

    </div>

<?php include __DIR__ . '/../layouts/section/endSection.php';?>