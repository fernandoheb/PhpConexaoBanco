<?php

include_once '../dao/CarroDAO.php';

if (isset($_GET["id"])) { 
   $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    echo json_encode(selecionarCarro($id));
    //{nome:valor,campo:valor}
}
