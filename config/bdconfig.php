<?php



const DRIVE = "pgsql";
const ENDERECO = "localhost";
const PORTA = "5433";
const DBNAME = "projeto";
const USER = "postgres";
const PASSWORD = "root";

try {

    function conexao() {
        $conexao = new PDO(DRIVE . ":host=" . ENDERECO . ";port=" . PORTA
                . ";dbname=" . DBNAME . ";user=" . USER . ";password=" . PASSWORD);

        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        if ($conexao) {
            return $conexao;
        }
    }

} catch (PDOException $erro) {
    echo "Não foi possível realizar a conexão <br>";
    echo $erro->getMessage();
}

function console($msg) {
    echo "<script>";
    echo "console.log('" . $msg . "');";
    echo "</script>";
}

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
        if ($statement->execute()) {
            $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($statement->rowCount() > 0):
                echo "Usuário Encontrado";

                inicia_sessao($login, $senha);
            else:
                echo "Usuário Não cadastrado <br>";
                insert_Login($login, $senha);
            endif;
        }
        // }   
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function consulta($consulta) {
            $conn = conexao();
            $stmt = $conn->prepare($consulta);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

function limpar($campo) {
        if (isset($_POST[$campo])) {
            return filter_input(INPUT_POST, $campo, FILTER_SANITIZE_STRING);
        }
        return "";
    } 









function inicia_sessao($login, $senha) {
    $_SESSION['usuario'] = $login;
    $_SESSION['senha'] = $senha;
    header("Location: FormPessoa.php");
}

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