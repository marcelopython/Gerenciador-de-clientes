<?php
$title = 'Clientes';
include __DIR__ . '/../layouts/section/section.php';
?>

    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline-block">Clientes</h4>
                <button class="btn btn-outline-dark float-right d-inline-block">Novo Cliente</button>
            </div>
            <div class="card-body">
                <!--    Nome; Data Nascimento;CPF; RG; Telefone.-->
<!--                Incluir, Editar e Excluir-->
                <table class="table">
                    <caption>List of users</caption>
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
                    <tr>
                        <th scope="row">Nome do cliente</th>
                        <td>24/06/1996</td>
                        <td>703.73054130</td>
                        <td>@62984357539</td>
                        <td>62984357539</td>
                        <td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layouts/section/endSection.php';?>