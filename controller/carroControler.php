<?php

include_once '../dao/CarroDAO.php';

if (isset($_GET["Carroid"])) { 
   $id = filter_input(INPUT_GET, 'Carroid', FILTER_SANITIZE_NUMBER_INT);   
    echo json_encode(selecionarCarro($id));
    // converte de vetor para JSON {nome:valor,campo:valor}
}
