<?php


include 'config/bdconfig.php';

$conexao = conexao();



$sql = "INSERT INTO public.pessoa( nom_pes ) VALUES (?);";
echo $sql;
$statement = $conexao ->prepare($sql);
$statement->bindParam(1, $nome);



$nome = "Mariana";
$statement->execute();
$host="localhost/PhpConexaoBanco/";

header("Location: tabela.php")




?>
