<html>
    <head>
        <meta charset="utf-8">
        <title>
            Tabela do banco
        </title>

        <?php
        include 'config/bdconfig.php';
        include 'config/cabecalho.php';
        $conexao = conexao();
        $tabela = (string) filter_input(INPUT_GET, 'tabela');
        echo $tabela;
        if (isset($_POST['consulta'])) {
            echo 'consulta';
        }
        if (isset($_Get['consulta'])) {
            echo 'consulta here';
        }
        ?>
    </head>
    <body>  
        <div class="container">
            <?php

            function consulta($consulta) {
                $conn = conexao();
                $stmt = $conn->prepare($consulta);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>

            <?php
            if ($conexao && ($tabela != '')) {


                echo "<h1> Listagem de $tabela </h1>" ;
                              
                $sql = "Select * from $tabela where true;";
                echo "<br>$sql<br>";
                $statement = $conexao->prepare($sql);
                if ($statement->execute()) {
                    $obj_stmt = $statement->fetchAll(PDO::FETCH_ASSOC);
                    echo "executou";
                }
                $resultado = $obj_stmt;
               // print_r($resultado);
                echo "<br><br>";
                echo "<br><br>";
                ?>
                <table>
                    <thead>
                        <tr>
                            <?php
                            $linha = $resultado[0];
                            foreach ($linha as $coluna => $valor) {
                                echo "<td> $coluna </td>";
                            }
                            ?>  
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            foreach ($resultado as $linha) {
                                echo "<tr>";
                                foreach ($linha as $coluna => $valor) {
                                    echo "<td> $valor </td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
                    <?php
                } else {
                    echo "not ok";
                }
                ?>
        </div>
    </body>
</html>