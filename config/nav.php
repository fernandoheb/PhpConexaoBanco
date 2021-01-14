
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow clearfix">
    <a href="login.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Gnome-home.svg/1200px-Gnome-home.svg.png" class="h-auto d-inline-block align-top float-left rounded-circle" alt="" width="30px">
    </a>
    <a class="navbar-brand float-left" href="FormPessoa.php">       
        Cadastro de Pessoa
    </a>
    <a class="navbar-brand btn  btn-link" href="FormPessoa.php">       
        Cadastro de Funcionarios
    </a>
    <a class="navbar-brand btn btn-link" href="FormPessoa.php">       
        Cadastro de Locador
    </a>
    <?php
        if(isset($_SESSION['usuario'])) {
            echo "<span class='float-right text-light '> <h1 class='text-capitalize'>  ". $_SESSION['usuario'] ." </h1> </span>";
    ?>
    
        <form class="float-right" method="POST" action="../controller/pessoaCTR.php" >
            <input class="btn btn-primary"  type="submit" name="logout" value="Sair">
        </form>
    <?php
        }
    ?>
</nav>
