<?php
$title = 'Cadastro de clientes';

include __DIR__ . '/../layouts/section/section.php';
?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h5>Cadastro de cliente</h5>
                <a href="<?=$_SERVER['SCRIPT_NAME'].'/customer'?>" class="btn btn-danger">Voltar</a>
            </div>
            <div class="card-body">
                <form action="<?=$_SERVER['SCRIPT_NAME'].'/customer/create'?>" method="post">
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="name" id="name" required
                                   autocomplete="no" maxlength="60">
                        </div>
                        <div class="col-md-2">
                            <label for="cpf">CPF</label>
                            <input type="number" class="form-control" name="cpf" id="cpf" required autocomplete="no" maxlength="11">
                        </div>
                        <div class="col-md-2">
                            <label for="rg">RG</label>
                            <input type="number" class="form-control" name="rg" id="rg" required autocomplete="no" maxlength="7">
                        </div>
                        <div class="col-md-2">
                            <label for="birth_date">Data Nascimento</label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date" required autocomplete="no">
                        </div>
                        <div class="col-md-2">
                            <label for="phone">Telefone</label>
                            <input type="number" class="form-control" name="phone" id="phone" required autocomplete="no"
                             maxlength="11">
                        </div>
                        <div class="col-12">
                            <hr>
                            <h6>Endereço</h6>
                            <button class="float-right btn btn-warning" type="button" id="btn-new-address">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div id="container-address">
                            <?php
                                $index = 0;
                                include __DIR__ . '/../customer/address/form.php';
                            ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success align-right">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="base-url" value="<?=  $_SERVER['SCRIPT_NAME'] ?>">
    <script src="<?=  (new \Kabum\App\Router())->asset('/js/src/customer/create.js') ?>"></script>
<?php include __DIR__ . '/../layouts/section/endSection.php';?>