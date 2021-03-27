<?php
$title = 'Clientes';
include __DIR__ . '/../layouts/section/section.php';
?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline-block">Clientes</h4>
                <a href="<?=$_SERVER['SCRIPT_NAME'].'/customer/create'?>" class="btn btn-outline-dark float-right d-inline-block">Novo Cliente</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <caption>Lista de clientes</caption>
                    <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Data Nascimento</th>
                        <th scope="col">CPF</th>
                        <th scope="col">RG</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($customers as $customer){ ?>
                        <tr>
                            <th scope="row"><?=$customer['name']?></th>
                            <td><?=$customer['birth_date']?></td>
                            <td><?=$customer['cpf']?></td>
                            <td><?=$customer['rg']?></td>
                            <td><?=$customer['phone']?></td>
                            <td>
                                <a href="<?=$_SERVER['SCRIPT_NAME'].'/customer/edit/'.$customer['id']?>">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../layouts/section/endSection.php';?>