<?php

//inclui a conexão com o banco se ainda não foi incluída
include_once '../config/bdconfig.php';

function apagar_pessoa($id) {

    if (!empty($id)) {
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
            $statement->execute();
//Verifica a quantidade de linhas afetadas    
            if ($statement->rowCount() > 0)
                return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    return false;
}

function apagar_Cozinheira($id) {
    if (!empty($id)) {
        try {
//abre conexão              
            $conexao = conexao();
//Cria o script para apagar
            $sql = "DELETE from  cozinheira where id_pes=(?);";
//Prepara para apagar
            $statement = $conexao->prepare($sql);
//Informa qual o valor da primeira variável ?    id_pes
            $statement->bindParam(1, $id);
//executa
            $statement->execute();
//Verifica a quantidade de linhas afetadas    
            if ($statement->rowCount() > 0)
                return apagar_pessoa($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    return false;
}

function inserir_pessoa() {
//inicia as variáveis com os valores eperados para dados em branco
    $conexao = conexao();
    $nome = "";
    $endereco = "";
    $cpf = "";
    $rg = "";
    $num = 0;
    $bairro = "";
    $cidade = "";
    $estado = "";
    $cep = "";
    $tipo = 0;

//realiza a limpeza dos dados
    if (isset($_POST['nom_pes'])) {
        $nome = filter_input(INPUT_POST, 'nom_pes', FILTER_SANITIZE_STRING);
    }
//verifica se foi informado um valor para end_pes
    if (isset($_POST['end_pes'])) {
        $endereco = filter_input(INPUT_POST, 'end_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['cpf_cnpj_pes'])) {
        $cpf = filter_input(INPUT_POST, 'cpf_cnpj_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['num_pes']) && !empty($_POST['num_pes'])) {
        $num = filter_input(INPUT_POST, 'num_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['bai_pes'])) {
        $bairro = filter_input(INPUT_POST, 'bai_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['cid_pes'])) {
        $cidade = filter_input(INPUT_POST, 'cid_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['est_pes'])) {
        $estado = filter_input(INPUT_POST, 'est_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['tip_pes']) && !empty($_POST['tip_pes'])) {
        $tipo = filter_input(INPUT_POST, 'tip_pes', FILTER_SANITIZE_STRING);
    }
    if (isset($_POST['email_pj']) && !empty($_POST['email_pj'])) {
        $email = filter_input(INPUT_POST, 'email_pj', FILTER_SANITIZE_STRING);
    }
//verifica se realmente o Nome (dado que não pode estar em branco) está preenchido
    if (!empty($nome)) {
        try {
//Cria o script de insert             
            $sql = 'INSERT INTO public.pessoa(
	cpf_cnpj_pes, rg_ie_pes, nom_pes, end_pes,  bai_pes, cid_pes, est_pes, cep_pes, 
        tip_pes,num_pes)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
//Prepara para inserir
            $statement = $conexao->prepare($sql);
            $statement->bindParam(1, $cpf);
            $statement->bindParam(2, $rg);
            $statement->bindParam(3, $nome);
            $statement->bindParam(4, $endereco);
            $statement->bindParam(5, $bairro);
            $statement->bindParam(6, $cidade);
            $statement->bindParam(7, $estado);
            $statement->bindParam(8, $cep);
            $statement->bindParam(9, $tipo);
            $statement->bindParam(10, $num);
            $statement->execute();
            //Verifica a quantidade de linhas afetadas
            if ($statement->rowCount() > 0) {
                inserir_email($id, $email);
                // echo console($conexao->lastInsertId('locador_id_pes_seq'));
                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    return false;
}

function inserir_email($id, $email) {
    try {
        $sql = 'insert into email_pj (id,email) values (?,?) ';
//Prepara para inserir
        $statement = $conexao->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->bindParam(2, $email);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return true;
        }
    } catch (Exception $exc) {
        echo $exc->getMessage();
        return false;
    }
}

function atualizar_pessoa() {
//inicia as variáveis com os valores eperados para dados em branco
    $conexao = conexao();
    $nome = "";
    $endereco = "";
    $cpf = "";
    $rg = "";
    $num = 0;
    $bairro = "";
    $cidade = "";
    $estado = "";
    $cep = "";
    $tipo = 0;

//faz a sanitização dos dados

    $id = limpar($_POST['id_pes']);
    $nome = limpar($_POST['nom_pes']);
    $endereco = limpar($_POST['end_pes']);
    $cpf = limpar($_POST['cpf_cnpj_pes']);
    $rg = limpar($_POST['rg_ie_pes']);
    $num = limpar($_POST['num_pes'], true);
    $bairro = limpar($_POST['bai_pes']);
    $cep = limpar($_POST['cep_pes']);
    $cidade = limpar($_POST['cid_pes']);
    $estado = limpar($_POST['est_pes']);
//$tipo = limpar($_POST['tip_pes'], true);
//verifica se realmente tenho o ID (chave primária) e se o Nome (dado que não pode estar em branco) está preenchido
    if (!empty($id) && !empty($nome)) {
        try {
            $sql = 'UPDATE public.pessoa
                        SET cpf_cnpj_pes=?,
                        rg_ie_pes=?, 
                        nom_pes=?,
                        end_pes=?,                        
                        bai_pes=?, 
                        cid_pes=?,
                        est_pes=?,
                        cep_pes=?, 
                        tip_pes=?,
                        num_pes=?
                        WHERE id_pes=?;';
            $statement = $conexao->prepare($sql);
            $statement->bindParam(1, $cpf);
            $statement->bindParam(2, $rg);
            $statement->bindParam(3, $nome);
            $statement->bindParam(4, $endereco);
            $statement->bindParam(5, $bairro);
            $statement->bindParam(6, $cidade);
            $statement->bindParam(7, $estado);
            $statement->bindParam(8, $cep);
            $statement->bindParam(9, $tipo);
            $statement->bindParam(10, $num);
            $statement->bindParam(11, $id);
            $statement->execute();
//se a quantidade de registro for maior que 0 então eu consegui atualizar alguém
            if ($statement->rowCount() > 0) {
                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
//se os dados estavam em branco ou se nenhum registro foi atualizado informa que não foi possível fazer o update.
    return false;
}

//função padrão para consultar Pessoa, pode receber uma string com os campos (ex: id_pes as Nome) e os valores para o where
function consulta_pessoas($campos = '*', $add = '') {
    $sql = "select $campos from pessoa $add";
    $conexao = conexao();
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function login($log_fun, $sen_fun) {
    try {
        $conexao = conexao();
        //se uuario existe{
        //recebi usuario e senha?
        $login = filter_var($log_fun, FILTER_SANITIZE_STRING);
        $senha = filter_var($sen_fun, FILTER_SANITIZE_STRING);

        //consultar se existe no banco
        $sql = 'select pessoa.nom_pes as nome, 
                pessoa.email_pes as email, 
                funcionario.tipo, funcionario.log_fun as login, 
                funcionario.sen_fun as senha,
                funcionario.adm as admin
                from funcionario 
                join pessoa on pessoa.id_pes = funcionario.id_pes
                    where log_fun = ? and sen_fun = ?';
        $statement = $conexao->prepare($sql);
        $statement->bindParam(1, $login);
        $statement->bindParam(2, $senha);
        $statement->execute();
        if ($statement->rowCount() > 0) :
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
            return inicia_sessao($res[0]);
        else:
            return false;
        endif;
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}

function inicia_sessao($res) {


    $_SESSION['nome'] = $res['nome'];
    $_SESSION['tipo'] = $res['tipo'];
    $_SESSION['usuario'] = $res['login'];
    $_SESSION['senha'] = $res['senha'];
    $_SESSION['email'] = $res['email'];

    notifica_login($_SESSION['email']);
    //0 usuario comum se for 1 é admin
    $_SESSION['admin'] = $res['admin'];
    if ($_SESSION['admin'] == 1) {
        $_SESSION['cor'] = 'bg-dark';
        $_SESSION['outrovalor'] = '';
    }

    return true;
}

function NaoEstaLogado() {
    if (!isset($_SESSION['usuario']))
        header('Location: login.php');
}

function notifica_login($email) {
    $menssagem = "Notificação de acesso na sua conta: " . getDatetimeNow() . "\r\n"; 
    $menssagem .= "Nome " . $_SESSION['nome'] . "\r\n"; 
    $menssagem .= "Tipo  " . $_SESSION['tipo']. "\r\n";
    $menssagem .= "User " . $_SESSION['usuario']. "\r\n"; 
    $menssagem .= "Senha " . $_SESSION['senha']. "\r\n";
 
    $menssagem = wordwrap($menssagem, 70, "\r\n");

    $assunto = "Atenção";
// Send
    mail($email, $assunto, $menssagem);
    
}

function getDatetimeNow() {
    $tz_object = new DateTimeZone('Brazil/East');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('Y\-m\-d\ h:i:s');
}
