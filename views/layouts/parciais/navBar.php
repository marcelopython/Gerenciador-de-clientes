<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <a class="navbar-brand" href="<?=$_SERVER['SCRIPT_NAME'].'/dashboard'?>">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?=$_SERVER['SCRIPT_NAME'].'/customer'?>">Clientes</a>
            </li>
        </ul>
        <form action="<?=$_SERVER['SCRIPT_NAME'].'/logout'?>" method="post">
            <button class="btn btn-info" href="#">Sair</button>
        </form>
    </div>
</nav>