<?php
$title = 'Clientes';
include __DIR__ . '/../layouts/section/section.php';
?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline-block">Clientes</h4>
                <a href="<?=$_SERVER['SCRIPT_NAME'].'/customer/create'?>" class="btn btn-outline-dark float-right d-inline-block">
                    <i class="fa fa-user-plus mr-2"></i>Novo Cliente</a>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/../component/message.php';?>
                <table class="table">
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
                            <td><?=date('d/m/Y', strtotime($customer['birth_date']))?></td>
                            <td><?=$customer['cpf']?></td>
                            <td><?=$customer['rg']?></td>
                            <td><?=$customer['phone']?></td>
                            <td class="d-flex">
                                <a href="<?=$_SERVER['SCRIPT_NAME'].'/customer/edit/'.$customer['id']?>" class="btn">
                                    <i class="fas fa-pencil-alt	"></i>
                                </a>
                                <form action="<?=$_SERVER['SCRIPT_NAME'].'/customer/delete/'.$customer['id']?>" method="post">
                                    <input type="hidden" value="<?=\Kabum\App\Csrf::csrf()?>" name="_token">
                                    <button class="btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/../layouts/section/endSection.php';?>