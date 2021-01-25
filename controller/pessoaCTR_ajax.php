<?php

session_start();
include_once '../dao/pessoaDAO.php';
//Funções de ROTA


if (isset($_POST['cadastrar'])) {
    if (inserir_pessoa()):
        echo "<h1 class= 'text-center' > Pessoa inserida com sucesso </h1>";
    else:
        echo "<h1 class= 'text-center' > Pessoa não foi inserido </h1>";
    endif;
}else if (isset($_GET['apagar'])) {
    $id = filter_input(INPUT_GET, 'apagar', FILTER_SANITIZE_NUMBER_INT);
    if (apagar_pessoa($id)):
        echo "Pessoa removida com sucesso ";
    else:
        echo "Pessoa não foi removida ou a Pessoa não foi encontrada ";
    endif;
} else if (isset($_POST['update'])) {
    if (atualizar_pessoa()):
        echo "<h1 class= 'text-center' > Registro atualizado com sucesso </h1>";
    else:
        echo "<h1 class= 'text-center' > Registro não atualizado </h1>";
    endif;
} else if (isset($_POST['login'])) {

    if (login($_POST['log_fun'], $_POST['sen_fun'])) {
        echo print_r($_SESSION);
        /*
          if($_SESSION['tipo']=='m'){
          header('Location: ../view/matriz.php');
          } else {
          header('Location: ../view/filial.php');
          } */
        // header('Location: ../view/FormPessoa.php');
        // echo "<a href= 'formPessoa.php'> Cadastro </a>"; 
    } else {
        echo "<h1 class= 'text-center' > Não logado </h1>";
    }
} else if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../view/login.php');
} else {
    //caso pessoaCTR seja chamada mas não entre em update, apagar, ou cadastrar informar que a rota não foi identificada
    echo "<h1 class= 'text-center' > Rota Não identificada  </h1>";
}
?>                   