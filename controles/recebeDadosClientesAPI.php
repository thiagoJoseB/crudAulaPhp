<?php
  
/*
objetivo: Arquivo responsavel por receber dados API (POST ou PUT)
data: 24/11/2021
autor: marcel





*/

require_once('../functions/config.php');

///importe do arquivo que vai inserir no banco de dados
require_once(SRC.'bd/inserirClientes.php');



require_once(SRC.'bd/atualizarCliente.php');





//// funcao que vai inserir dados no banco de dados
function inserirClienteApi($arrayDados)
{
    
    ////fazer tratamento fr dados para consistencia 
    if(inserir($arrayDados))
        return true;
    
    else
        return false;
    
    
}


//// funcao que vai atualizar dados no banco de dados
//// via put da da api
function atualizarClienteApi($arrayDados, $id)
{
    //// Cria um novo array apenas com um novo id 
    $novoItem = array("id" => $id);

    /// acresenta o arrray do novo item no arrayDados 
    /// fazendo uma mescla de chaves 
    $arrayCliente = $arrayDados + $novoItem;
    
    ////fazer tratamento fr dados para consistencia 
    if(excluir($arrayCliente))
        return true;
    
    else
        return false;
    
    
}










?>