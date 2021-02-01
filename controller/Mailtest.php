<?php
session_start();    
include '../dao/PessoaDAO.php';
    $m = 'fernando.heb@gmail.com';
    if (isset($_GET['mail'])){
        $m = $_GET['mail'];
        notifica_login($m);
    } else {        
        notifica_login($m);
    }
    echo $m;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

