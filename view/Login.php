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
         <?php include "../config/cabecalho.php"; ?>
        <link rel="stylesheet" href="css/main.css">
       
        <?php
        include_once '../config/bdconfig.php';


        
                
      

        
       
        ?>
    </head>
    <body>
        <?php include "../config/nav.php"; ?>
        <div class="container mx-auto">
            <!-- Forms -->
            <div class="row w-25  mx-auto ">
                <form class ="mx-auto " method="POST" action="../controller/pessoaCTR.php">
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


        <?php
        $aula = "Login";
        include "../config/footer.php";
        ?>
    </body>
</html>
