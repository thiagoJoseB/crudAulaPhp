<?php
/**
  objetivo: arquivo responsavel por receber o id do cliente 
e excluir do banco







**/

require_once(SRC.'bd/excluirCliente.php');

function excluirClienteApi($id)
{

    if(excluir($id))
        return true;
    
    else
        return false;
    
    
}





?>