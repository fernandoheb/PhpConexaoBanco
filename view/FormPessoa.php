<?php session_start(); 
 include_once '../dao/PessoaDAO.php';
 NaoEstaLogado();
        
?>

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
          <?php include_once "../config/cabecalho.php"; ?>       
        <?php
     
        include_once '../config/bdconfig.php';                
   
            if (isset($_GET['update'])) {
                $id = filter_input(INPUT_GET, 'update', FILTER_SANITIZE_NUMBER_INT);
                //abre conexão       
                if (!empty($id) ) {
                    $conexao = conexao();
                    $recupera_pessoa = "select * from pessoa wher id=(?)";



                    $sql_string = 'UPDATE public.pessoa
                        SET  
                        cpf_cnpj_pes=?, 
                        rg_ie_pes=?, 
                        nom_pes=?, 
                        end_pes=?, 
                        num_pes=?, 
                        bai_pes=?, 
                        cid_pes=?, 
                        est_pes=?, 
                        cep_pes=?, 
                        tip_pes=?
                        WHERE id_pes=?;';
                    $SQL = $conexao->prepare($sql_string);
                    $x = "";
                    $SQL->bindParam(1, $cpf);
                    $SQL->bindParam(2, $rg);
                    $SQL->bindParam(3, $nome);
                    $SQL->bindParam(4, $endereco);
                    $SQL->bindParam(5, $num);
                    $SQL->bindParam(6, $bai);
                    $SQL->bindParam(7, $cid);
                    $SQL->bindParam(8, $est);
                    $SQL->bindParam(9, $cep);
                    $SQL->bindParam(10, $tipo);
                    $SQL->execute();
                }
            }
        
        ?>
        
    </head>
    <body>
        <?php include "../config/nav.php"; ?>
        <div class="container">
            <!-- Forms -->
            <div class="row">
                <form class="w-100" method="POST" action="../controller/pessoaCTR.php">
                    <div class="row ">
                        <div class="form-group w-100">
                            <label for="nom_pes">Nome</label>
                            <input type="text" class="form-control " id="nom_pes"  name=nom_pes aria-describedby="Nome da pessoa" placeholder="Nome" required>                
                        </div>      
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-2 p-0">
                            <label for="cpf_cnpj_pes">CPF/CNPJ</label>
                            <input type="text" class="form-control" id="cpf_cnpj_pes"  name="cpf_cnpj_pes" aria-describedby="Cpf ou CNPJ" placeholder="xxx.xxx.xxx-xx" >                
                        </div>   
                        <div class="form-group  col-md-2 p-0 ml-1">
                            <label for="RG">RG</label>
                            <input type="text" class="form-control" id="rg_pes"  name="rg_pes" aria-describedby="RG" placeholder=" digite seu rg" >                
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6   p-0">
                            <label for="end_pes">Endereço</label>
                            <input type="text" class="form-control" id="end_pes"  name=end_pes aria-describedby="Endereço da pessoa" placeholder="endereco">                
                        </div>   
                        <div class="form-group col-md-1 ml-1  p-0">
                            <label for="num_pes">Número</label>
                            <input type="number" class="form-control" id="num_pes"   name=num_pes aria-describedby="número da residência" placeholder="Nº">                
                        </div>
                        <div class="form-group col-md-3  ml-1 p-0">
                            <label for="bai_pes">Bairro</label>
                            <input type="text" class="form-control" id="bai_pes"   name=bai_pes aria-describedby="Bairro da pessoa" placeholder="Bairro">                
                        </div>
                        <div class="form-group col-md-2 ml-1  p-0">
                            <label for="cep_pes">CEP</label>
                            <input type="text" class="form-control" id="cep_pes"   name=cep_pes aria-describedby="CEP da Residência" placeholder="Cidade">                                            
                        </div>
                        <div class="form-group col-md-3  ml-1 p-0">
                            <label for="cid_pes">Cidade</label>
                            <input type="text" class="form-control" id="cid_pes"   name=cid_pes aria-describedby="Cidade da pessoa" placeholder="Cidade">                
                        </div>
                         <div class="form-group col-md-1 ml-1  p-0">
                            <label for="est_pes">Estado</label>
                            <input type="text" class="form-control" id="est_pes"  maxlength="2" name=est_pes aria-describedby="Estado da Residência" placeholder="Estado">                
                        </div>
                    </div>
                    <button type="submit" class="btn-lg btn-primary mb-2" name="cadastrar">Salvar</button>
                    <button type="reset" class="btn btn-warning mb-2" name="cancelar">Limpar</button>
                </form>
            </div>

            
            <?php 
                    $consulta = 'select id_pes as id, nom_pes as Nome, end_pes as Endereço from pessoa';
                    $campos ='id_pes as id, nom_pes as Nome, end_pes as Endereço';                            
                    $resultado = consulta_pessoas($campos);
                    //$resultado = consulta_Generica($campos, 'pessoa', 'where false');                                                        
                if(count($resultado) > 0):      
                    $linha = $resultado[0];
            ?>
                        
            <!-- Tabela de consulta -->
            <div class="row">
                <table  class="table table-striped ">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            
                            foreach ($linha as $coluna => $valor) {
                                echo '<th scope="col"> ' . $coluna . ' </th>';
                            }
                            ?>  
                            <th scope="col">  Apagar </th>
                            <th scope="col">  Atualizar  </th>
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
                            . "<a class='btn btn-success' href=../view/UpdatePessoa.php". 
                            "?id=". $linha['id'] . "> Atualizar </a> </td>";
                            
                            echo "<td> "
                            . "<a class='btn btn-danger' href=../controller/pessoaCTR.php?apagar=" . $linha['id'] . "> Apagar </a> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php 
                else: 
                echo " <div class='row'> <h2 class='text-center'> Nenhum Registro Encontrado </h2> </div>";
            
                endif;
               ?>
            
            
        </div>
      

        <?php
        $aula = "- Insert";
        include "../config/footer.php";
        ?>
    </body>
</html>
