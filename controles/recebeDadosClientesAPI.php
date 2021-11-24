<?php
  
/*
objetivo: Arquivo responsavel por receber dados API (POST ou PUT)
data: 24/11/2021
autor: marcel





*/

require_once('../functions/config.php');

///importe do arquivo que vai inserir no banco de dados
require_once(SRC.'bd/inserirClientes.php');


//// funcao que vai inserir dados no banco de dados
function inserirClienteApi($arrayDados)
{
    
    ////fazer tratamento fr dados para consistencia 
    if(inserir($arrayDados))
        return true;
    
    else
        return false;
    
    
}





?>