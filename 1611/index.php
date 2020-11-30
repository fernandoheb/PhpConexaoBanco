<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Teste Conexão </title>
    </head>
    <body>
      
            <?php
            const DRIVE = "pgsql";
            const ENDERECO = "localhost";
            const PORTA = "5433";
            const DBNAME = "projeto";
            const USER = "postgres";
            const PASSWORD = "root";

            try {
                $conexao = new PDO(DRIVE . ":host=" . ENDERECO . ";port=" . PORTA
                        . ";dbname=" . DBNAME . ";user=" . USER . ";password=" . PASSWORD);

                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                if ($conexao) {
                    echo "Banco Conectado";
                   
                    echo "<br><br>";
                    $sql = "Select * from pessoa";
                    $obj_stmt = $conexao->query($sql);
             //       $r = $obj_stmt->setFetchMode(PDO::FETCH_ASSOC);
                  /*  while($resultado = $obj_stmt->fetch()){
                        print_r($resultado);
                        echo "<br><br>";
                    }
                    echo "Saiu do while";
                    */
                    $resultado = $obj_stmt->fetchAll(PDO::FETCH_ASSOC);
                    // print_r($resultado);
                     
                     
                     
                     
                     
                      echo "<br><br>"; echo "<br><br>";
                     /* foreach ($resultado as $linha){
                           echo "<br>=========================<br>";
                          // print_r($linha);
                          // echo "<br>";                           
                           echo "Código: ".$linha["id_pes"]; 
                           echo "--  Nome:  ".$linha["nom_pes"]; 
                           echo "--  CEP:  ".$linha["cep_pes"]; 
                           echo "<br>=========================<br>";
                      }*/
                       echo "<table>";
                       echo "<thead>";
                       echo "<tr>";
                       $linha = $resultado[0];
                       foreach($linha as $coluna => $valor){
                           echo "<td> $coluna </td>";
                       }                       
                       echo "</tr>"; 
                       echo "</thead>";
                       echo "<tbody>";
                       foreach ($resultado as $linha) {
                            echo "<tr>";
                            foreach ($linha as $coluna => $valor) {
                                echo "<td> $valor </td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tbody>";
                      echo"</table>";
                }
            } catch (PDOException $erro) {
                echo "Não foi possível realizar a conexão <br>";
                echo $erro->getMessage();
            }
            ?>
     
    </body>
</html>
