<?php

function enviarEmail($Destinatario,$assunto,$mensagem){
    
    
    mail($Destinatario, $assunto, $mensagem );
}