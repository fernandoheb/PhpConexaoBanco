<html>
    <head>
        <meta charset="utf-8">
        <title>
           Tabela do banco
        </title>

        <?php
            include_once'config/cabecalho.php';
            require_once 'config/bdconfig.php';   
             
               
        ?>
    </head>
    <body>  
        <div class="container">
        <?php
        $conexao = conexao();
        if ($conexao) {
            echo "Banco Conectado";
            echo "<br><br>";
            $sql = "Select * from pessoa";
            $obj_stmt = $conexao->query($sql);
            $r = $obj_stmt->setFetchMode(PDO::FETCH_ASSOC);
            /*  while($resultado = $obj_stmt->fetch()){
              print_r($resultado);
              echo "<br><br>";
              }
              echo "Saiu do while";
             */
            $resultado = $obj_stmt->fetchAll();
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