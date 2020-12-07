<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php        
        include_once '../dao/PessoaDAO.php';
        
        //verifica se recebeu a chave que será utilizada para atualizar o registro
        if(isset($_GET['id'])) {
            $id = limpar($_GET['id']);
        } else {
            //se não tiver recebido a chave, redireciona o usuário de volta a tela de cadastro
            header('Location: FormPessoa.php');
        }
        
       /*$conexao = conexao();
        $sql = 'select * from pessoa where id_pes = ?';
        $statement = $conexao->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);*/
        
        
        // recupera os dados do cadastro
        $condicao = "where id_pes =  $id";
        $resultado = consulta_pessoas('*', $condicao); 
        
        //coloca os dados recebidos em um vetor para preencher o form
        $linha = $resultado[0];
        //var_dump($linha);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Atualizar Dados</title>
        <?php include_once '../config/cabecalho.php'; ?>
    </head>
    <body>
        <?php include_once "../config/nav.php"; ?>
        <div class="container">
            <!-- Forms -->
            <div class="row">
                
                <!-- Direciona para a Controller que cuidará da operação-->
                <form class="w-100" method="POST" action="../controller/pessoaCTR.php">
                    <div class="row ">
                       
                        <div class="form-group w-100">
                            <label for="id_pes">ID</label>
                            <!-- Recebe a chave do registro ela não pode ser alterada por isso a classe d-none (css display:none) para que o input não apareça e o usuário não o altere ou readonly se quiser que o elemento fique visível
                            o registro ainda está vulnerável ao usuário editar o HTML da página em si.
                            -->
                                                                                                                                               <!-- echo da variável para preencher o value do input verificar se o <? php ?> está entre aspas-->
                            <input type="text" class="form-control d-none " id="id_pes"  name="id_pes" aria-describedby="Id" readonly value="<?php echo $linha['id_pes'] ?>" >                
                            <label for="nom_pes">Nome</label>
                            <input type="text" class="form-control " id="nom_pes"  name="nom_pes" aria-describedby="Nome da pessoa" placeholder="Nome" value=" <?php echo $linha['nom_pes'] ?>" required>                
                        </div>      
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-2 p-0">
                            <label for="cpf_cnpj_pes">CPF/CNPJ</label>
                            <input type="text" class="form-control" id="cpf_cnpj_pes"  name="cpf_cnpj_pes" value="<?php echo $linha["cpf_cnpj_pes"] ?>" aria-describedby="Cpf ou CNPJ" placeholder="xxx.xxx.xxx-xx" >                
                        </div>   
                        <div class="form-group  col-md-2 p-0 ml-1">
                            <label for="RG">RG</label>
                            <input type="text" class="form-control" id="rg_pes"  name="rg_ie_pes" aria-describedby="RG" value="<?php echo $linha["rg_ie_pes"]?>"   placeholder=" digite seu rg" >                
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6   p-0">
                            <label for="end_pes">Endereço</label>
                            <input type="text" class="form-control" id="end_pes"  name=end_pes value="<?php echo $linha["end_pes"]?>" aria-describedby="Endereço da pessoa" placeholder="endereco">                
                        </div>   
                        <div class="form-group col-md-1 ml-1  p-0">
                            <label for="num_pes">Número</label>
                            <input type="number" class="form-control" id="num_pes" min="0"  name=num_pes  value="<?php echo $linha["num_pes"]?>" aria-describedby="número da residência" placeholder="Nº">                
                        </div>
                        <div class="form-group col-md-3  ml-1 p-0">
                            <label for="bai_pes">Bairro</label>
                            <input type="text" class="form-control" id="bai_pes"   name=bai_pes value="<?php echo $linha["bai_pes"]?>" aria-describedby="Bairro da pessoa" placeholder="Bairro">                
                        </div>
                        <div class="form-group col-md-2 ml-1  p-0">
                            <label for="cep_pes">CEP</label>
                            <input type="text" class="form-control" id="cep_pes"   name=cep_pes value="<?php echo $linha["cep_pes"]?>" aria-describedby="CEP da Residência" placeholder="Cidade">                                            
                        </div>
                        <div class="form-group col-md-3  ml-1 p-0">
                            <label for="cid_pes">Cidade</label>
                            <input type="text" class="form-control" id="cid_pes"   name=cid_pes value="<?php echo $linha["cid_pes"]?>" aria-describedby="Cidade da pessoa" placeholder="Cidade">                
                        </div>
                        <div class="form-group col-md-1 ml-1  p-0">
                            <label for="est_pes">Estado</label>
                            <input type="text" class="form-control" id="est_pes"  maxlength="2" name=est_pes  value="<?php echo $linha["est_pes"]?>" aria-describedby="Estado da Residência" placeholder="Estado">                
                        </div>
                    </div>
                    <button type="submit" class="btn-lg btn-primary mb-2" name="update">Salvar</button>
                    <button type="submit" action="action" onclick="window.history.go(-1); return false;"  class="btn btn-warning mb-2" > Voltar </button>
                </form>
            </div>
        </div>     
        <?php
        //o footer consulta a variável global aula  para escrever seu valor no rodapé, por isso essa declaração aqui.
        $aula = 'Atualizando dados';        
        include '../config/footer.php';
        ?>
    </body>
</html>
