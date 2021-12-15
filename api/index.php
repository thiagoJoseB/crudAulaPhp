<?php
/**
  
permissoes e cofiguracoes para a api responder em um servidor real



**/


header('Access-Control-Allow-Origin: *');//requisicoes
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');///methodos
header('Access-Control-Allow-Header: Content-Type');///nossa api é json
header('Content-Type: application/json');

/// import do arquivo de configuracao do sistema 
require_once("../functions/config.php");
///cria um array 
$url = (string) null;
$url = explode('/', $_GET['url']); 




/// estrutura condicional para encaminhar a API 
// conforme a escolha [clientes ou estados]
switch($url[0])
{
        
        case 'clientes';
         //// importe do arquivo de API de cliente 
         require_once('clientesAPI/index.php');
        
        case 'estados';
        //// importe do arquivo de API de cliente 
         require_once('estadosApi/index.php');
}













?>