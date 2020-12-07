<html>
    <head>
        <title>Pessoa controler </title>
        <?php
        include_once '../config/cabecalho.php';
        include_once '../dao/pessoaDAO.php';
        ?>
    </head>
    <body>
        <div class='container'> 
            <div class='row clearfix'> 
                <div class='w-100'>

                    <?php
//Funções de ROTA
                    if (isset($_POST['cadastrar'])) {
                        if (inserir_pessoa()):
                            echo "<h1 class= 'text-center' > Pessoa inserida com sucesso </h1>";
                        else:
                            echo "<h1 class= 'text-center' > Pessoa não foi inserido </h1>";
                        endif;
                    }else if (isset($_GET['apagar'])) {
                        if (apagar_pessoa()):
                            echo "<h1 class= 'text-center' > Pessoa removida com sucesso </h1>";
                        else:
                            echo "<h1 class= 'text-center' > Pessoa não foi removida ou a Pessoa não foi encontrada </h1>";
                        endif;
                    } else if (isset($_POST['update'])) {
                        if (atualizar_pessoa()):
                            echo "<h1 class= 'text-center' > Registro atualizado com sucesso </h1>";
                        else:
                            echo "<h1 class= 'text-center' > Registro não atualizado </h1>";
                        endif;
                    } else {
                        //caso pessoaCTR seja chamada mas não entre em update, apagar, ou cadastrar informar que a rota não foi identificada
                        echo "<h1 class= 'text-center' > Rota Não identificada  </h1>";
                    }
                    ?>
                    <a class='btn btn-primary float-right' href='../view/FormPessoa.php'> Voltar </a>
                </div>
            </div>
        </div>
    </body>
</html>