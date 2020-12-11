<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <title>Gestão de Pessoas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <?php include "config/cabecalho.php"; ?>
        <link rel="stylesheet" href="css/main.css">
       
        <?php
        include 'config/bdconfig.php';


        // INSERT
        if (isset($_POST['cadastrar'])) {
            $conexao = conexao();
            $nome = "";
            $endereco = "";
            if (isset($_POST['nom_pes'])) {
                $nome = filter_input(INPUT_POST, 'nom_pes', FILTER_SANITIZE_STRING);
            }
            //verifica se foi informado um valor para end_pes
            if (isset($_POST['end_pes'])) {
                $endereco = filter_input(INPUT_POST, 'end_pes', FILTER_SANITIZE_STRING);
            }
            if (!empty($nome)) {
                //Cria o script de insert
                $sql = "INSERT INTO pessoa( nom_pes, end_pes ) VALUES (?,?);";
                //Prepara para inserir
                $statement = $conexao->prepare($sql);
                //Informa qual o valor da primeira variável ?    nom_pes
                $statement->bindParam(1, $nome);
                //Informa qual o valor da segunda variável ?    end_pes
                $statement->bindParam(2, $endereco);
                $statement->execute();
            } else {
                echo "<script> alert('É preciso informar um nome' )</script>";
            }
        }
        if (isset($_GET['apagar'])) {
            $id = filter_input(INPUT_GET, 'apagar', FILTER_SANITIZE_NUMBER_INT);
            if (!empty($id) && (filter_var($id, FILTER_VALIDATE_INT))) {
                try {
                    //abre conexão              
                    $conexao = conexao();
                    //Cria o script para apagar
                    $sql = "DELETE from  pessoa where id_pes=(?);";
                    //Prepara para apagar
                    $statement = $conexao->prepare($sql);
                    //Informa qual o valor da primeira variável ?    id_pes
                    $statement->bindParam(1, $id);
                    //executa
                    if ($statement->execute()) {
                        echo "<script> alert('Registro apagado' )</script>";
                        //header("Location: ".$_SERVER['PHP_SELF']);
                    } else {
                        echo "<script> alert('Não foi possível apagar o registro' )</script>";
                    }
                } catch (Exception $exc) {
                    echo $exc->getMessage();
                }
            }
        }
        if (isset($_GET['update'])) {
            
        }

        if (isset($_POST['login'])) {
            login($_POST['log_fun'], $_POST['sen_fun']);
        }
       
        ?>
    </head>
    <body>
        <?php include "config/nav.php"; ?>
        <div class="container">
            <!-- Forms -->
            <div class="row">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="login">login</label>
                        <input type="text" class="form-control" id="nom_pes"  name='log_fun' aria-describedby="Nome da pessoa" placeholder="Usuário">                
                    </div>       
                    <div class="form-group">
                        <label for="senha">senha</label>
                        <input type="password" class="form-control" id="end_pes"  name='sen_fun' aria-describedby="inserir sua senha" placeholder="Senha">                
                    </div>   
                    <button type="submit" class="btn btn-primary mb-2" name="login">Login</button>
                    <button type="reset" class="btn btn-warning mb-2" name="cancelar">Limpar</button>
                </form>
            </div>

            <!-- Tabela de consulta -->
            <div class="row">
                <table  class="table table-striped ">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            $consulta = 'select id_pes as id, nom_pes as Nome, end_pes as Endereço from pessoa';
                            $resultado = consulta($consulta);
                            $linha = $resultado[0];
                            foreach ($linha as $coluna => $valor) {
                                echo '<th scope="col"> ' . $coluna . ' </th>';
                            }
                            ?>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado as $linha) {
                            echo "<tr>";
                            echo "<td> " . $linha['id'] . " </td>";
                            echo "<td> " . $linha['nome'] . " </td>";
                            echo "<td> " . $linha['endereço'] . " </td>";
                            //Cria um link informando  o ID e a operação apagar através do método GET
                            echo "<td> "
                            . "<a class='btn btn-danger' href=" . $_SERVER['PHP_SELF'] .
                            "?apagar=" . $linha['id'] . "> Apagar </a> </td>";
                            echo "<td> "
                            . "<a class='btn btn-success' href=" . $_SERVER['PHP_SELF'] .
                            "?update=" . $linha['id'] . "> Atualizar </a> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <?php
        $aula = "- Insert";
        include "config/footer.php";
        ?>
    </body>
</html>
