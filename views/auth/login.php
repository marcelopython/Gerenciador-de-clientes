<?php include __DIR__ . '/../layouts/parciais/header.php' ?>

<div class="container h-100">
    <div class="content-login d-flex justify-content-center h-100 align-items-center">
        <div class="col col-md-4" style="box-shadow: 10px 10px rgba(211, 211, 211, 0.1)">
            <h2 class=" text-center">Login</h2>
            <form action="<?=$_SERVER['SCRIPT_NAME'].'/login'?>" method="post">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="Senha">Senha</label>
                    <input type="password" class="form-control" id="Senha" name="password" required>
                </div>
                <button class="btn btn-info">Entrar</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/parciais/footer.php' ?>

