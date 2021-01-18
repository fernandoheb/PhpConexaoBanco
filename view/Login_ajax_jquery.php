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
      

        <?php
        include_once '../config/bdconfig.php';
        ?>
    </head>
    <body>
        <?php include "../config/nav.php"; ?>
        <div class="container mx-auto">
            <!-- Forms -->
            <div class="row w-25  mx-auto" id="form-div">
                <form class ="mx-auto " id="form-login">
                    <div class="form-group">
                        <label for="login">login</label>
                        <input type="text" class="form-control" id="nom_pes"  name='log_fun' aria-describedby="Nome da pessoa" placeholder="Usuário">                
                    </div>       
                    <div class="form-group">
                        <label for="senha">senha</label>
                        <input type="password" class="form-control" id="end_pes"  name='sen_fun' aria-describedby="inserir sua senha" placeholder="Senha">                
                    </div>   
                    <button type="submit" class="btn btn-primary mb-2" name="login" value="true">Login</button>
                    <button type="reset" class="btn btn-warning mb-2" name="cancelar">Limpar</button>
                </form>
            </div>
            <div id="result"></div>

            <script>
                $(document).ready(function () {
                    $('#form-login').submit(function (e) {
                        e.preventDefault();
                        var login = 'login=true&'+$('#form-login').serialize();
                        console.log(login);
                        $.ajax({
                            url: '../controller/pessoaCTR_ajax.php',
                            dataType: 'html',
                            type: 'POST',
                            data: login,
                            success: function (data, textStatus) {
                                $('#result').html('<p class="bg-light mx-auto p-5 w-75 text-center">' + data + '</p>');
                                $('#form-div').hide();                                
                            },
                            error: function (xhr, er) {
                                $('#result').html('<p class="bg-danger p-5 text-center">Erro ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er + '</p>');
                            }
                        });
                    });
                });
            </script>    



<?php
$aula = "Login";
include "../config/footer.php";
?>
    </body>
</html>
