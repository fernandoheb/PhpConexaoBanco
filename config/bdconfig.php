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

?>