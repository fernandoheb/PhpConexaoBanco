<?php

const DRIVE = "pgsql";
const ENDERECO = "localhost";
const PORTA = "5433";
const DBNAME = "projeto";
const USER = "postgres";
const PASSWORD = "root";

function conexao() {
    try {
        $conexao = new PDO(DRIVE . ":host=" . ENDERECO . ";port=" . PORTA
                . ";dbname=" . DBNAME . ";user=" . USER . ";password=" . PASSWORD);

        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        if ($conexao) {
            return $conexao;
        }
    } catch (PDOException $erro) {
        echo "Não foi possível realizar a conexão <br>";
        echo $erro->getMessage();
    }
}

function console($msg) {
    echo "<script>";
    echo "console.log('" . $msg . "');";
    echo "</script>";
}
/*
function login($log_fun, $sen_fun) {
    try {
        $conexao = conexao();
        //se uuario existe{
        //recebi usuario e senha?
        $login = filter_var($log_fun, FILTER_SANITIZE_STRING);
        $senha = filter_var($sen_fun, FILTER_SANITIZE_STRING);

        //consultar se existe no banco
        $sql = 'select * from funcionario where log_fun = ? and sen_fun = ?';
        $statement = $conexao->prepare($sql);
        $statement->bindParam(1, $login);
        $statement->bindParam(2, $senha);
        $statement->execute();
        if ($statement->rowCount() > 0) {            
            if ($statement->rowCount() > 0):
                echo "Usuário Encontrado";
                return inicia_sessao($login, $senha);
            else:
                return false;
                //echo "Usuário Não encontrado <br>";
             //   insert_Login($login, $senha);
            endif;
        }
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}*/

//Função de consulta que Recebe os Campos, a tabela e potencialmente uma condição ou complementos do select
//retorna o objeto statement de resultado com o conjunto de tuplas recuperadas pela pesquisa
function consulta_Generica($campos = '*', $tabela, $add = '') {
    if (empty($tabela))
        return FALSE;
    $sql = "select $campos from $tabela $add";
    $conexao = conexao();
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//função que verifica o maior valor de um campo de uma determinada tabela
//retorna o valor númerico do resultado;
function Max_id($campo, $tabela) {
    $conn = conexao();
    $stmt = $conn->prepare("select max($campo) as val from $tabela ");
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $valor = $resultado[0];
    return $valor['val'];
}

//função para limpar um determinado $campo string ou inteiro
// $int deve ser = false quando o campo é do tipo string e true quando for inteiro
// retorna o valor após a sanitização do campo, caso o campo seja vazio retorna "" ou 0;
function limpar($campo, $int = false) {
    // Verifica se o campo não é inteiro
    if (!$int) {
        if (!empty($campo)) {
            return filter_var($campo, FILTER_SANITIZE_STRING);
        }
        return "";
    } else {
        if (!empty($campo)) {
            return filter_var($campo, FILTER_SANITIZE_NUMBER_INT);
        }
        return 0;
    }
}



//deve ser mudada para a controler de funcionário
function insert_Login($usuario, $senha) {
    echo "Inserindo usuário <br>";
    $conexao = conexao();
    if (isset($usuario)) {
        $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
    }
    //verifica se foi informado um valor para end_pes
    if (isset($senha)) {
        $senha = filter_var($senha, FILTER_SANITIZE_STRING);
    }
    if (!empty($usuario) && !empty($senha)) {
        $id = 28;
        //Cria o script de insert
        $sql = "INSERT INTO funcionario ( log_fun, sen_fun, id_pes ) VALUES (?,?,?);";
        //Prepara para inserir
        $statement = $conexao->prepare($sql);
        //Informa qual o valor da primeira variável ?    nom_pes
        $statement->bindParam(1, $usuario);
        //Informa qual o valor da segunda variável ?    end_pes
        $statement->bindParam(2, $senha);
        $statement->bindParam(3, $id);
        $statement->execute();
        inicia_sessao($usuario, $senha);
        echo "<script> alert('usuário inserido' )</script>";
    } else {
        echo "<script> alert('É preciso informar um nome' )</script>";
    }
}

?>