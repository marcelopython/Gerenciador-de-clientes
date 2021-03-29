<?php
$title = 'Editar cliente';
include __DIR__ . '/../layouts/section/section.php';
?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h5>Cadastro de cliente</h5>
                <a href="<?=$_SERVER['SCRIPT_NAME'].'/customer'?>" class="btn btn-danger">Voltar</a>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/../component/message.php';?>
                <form action="<?=$_SERVER['SCRIPT_NAME'].'/customer/update/'.$customer['id']?>" method="post">
                    <input type="hidden" value="<?=\Kabum\App\Csrf::csrf()?>" name="_token">
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="name">Nome<span style="color: red">*</span></label>
                            <input type="text" class="form-control" placeholder="Nome" name="name" id="name" required
                                   autocomplete="no" maxlength="60" value="<?=$customer['name']?>">
                        </div>
                        <div class="col-md-2">
                            <label for="cpf">CPF<span style="color: red">*</span></label>
                            <input type="number" class="form-control" name="cpf" id="cpf" required autocomplete="no"
                                   value="<?=$customer['cpf']?>" maxlength="11">
                        </div>
                        <div class="col-md-2">
                            <label for="rg">RG<span style="color: red">*</span></label>
                            <input type="number" class="form-control" name="rg" id="rg" required autocomplete="no"
                                   value="<?=$customer['rg']?>">
                        </div>
                        <div class="col-md-2">
                            <label for="birth_date">Data Nascimento<span style="color: red">*</span></label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date"
                                   value="<?=$customer['birth_date']?>" required autocomplete="no">
                        </div>
                        <div class="col-md-2">
                            <label for="phone">Telefone<span style="color: red">*</span></label>
                            <input type="number" class="form-control" name="phone" id="phone" required autocomplete="no"
                             maxlength="11" value="<?=$customer['phone']?>">
                        </div>
                        <div class="col-12">
                            <hr>
                            <h6>Endereço</h6>
                            <button class="float-right btn btn-warning" type="button" id="btn-new-address">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div id="container-address">
                            <input type="hidden" value="<?=count($addresses)?>" id="total-item-address">
                            <?php
                                foreach($addresses as $key => $address) {
                                    $index = $key;
                                    include __DIR__ . '/../customer/address/edit.php';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-success align-right">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="base-url" value="<?=  $_SERVER['SCRIPT_NAME'] ?>">
    <script src="<?=  (new \Kabum\App\Router())->asset('/js/src/customer/form.js') ?>"></script>
<?php include __DIR__ . '/../layouts/section/endSection.php';?>

