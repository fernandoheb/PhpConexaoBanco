
<nav class="navbar navbar-light bg-light clearfix">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Gnome-home.svg/1200px-Gnome-home.svg.png" class="h-auto d-inline-block align-top float-left rounded-circle" alt="" width="30px">
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
        if(isset($_SESSION['usuario']))
            echo "<span class='float-right'> <h1>  ". $_SESSION['usuario'] ." </h1> </span>";
    ?>
</nav>
