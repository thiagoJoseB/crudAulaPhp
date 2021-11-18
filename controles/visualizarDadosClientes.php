<?php
/**
objetivo: Arquivo responsavel por buscar um registro para exibir no modal do visualizar
data:21/10/2021
autor:thiago
*/
function visualizarCliente($id)
{
    // importe do arquivo de configuracao de variaveis e constantes
require_once('functions/config.php');

// importe do arquivo para excluir no banco de dados 
require_once(SRC.'/bd/listarClientes.php');

///recebe o id enviado na funcao
  $idCliente = $id;

//chama a funcao para buscar de id do cliente
$dadosClientes = buscar($idCliente);

//chama a funcao buscar e emcaminha o id que sera localizado  no banco de dados 
if($rsClientes=mysqli_fetch_assoc($dadosClientes))
{
    
    return $rsClientes;
}else
    return false;
    
    
    
}






?>
   
