<?php
include_once '../config/bdconfig.php';

function  selecionarCarro($id) {
      return consulta_Generica('*', 'carro', 'where id_car = '.$id);
}
