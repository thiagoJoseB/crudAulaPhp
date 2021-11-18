<?php

/// import para o start do slim php
require_once("vendor/autoload.php"); 



///// import do arquivo de configuracao do sistema 
//require_once("../functions/config.php");


/////importe do arquivo que solicita das requisicoes 
/////de busca no bd 
//require_once('../controles/exibeDadosCliente.php');

/// instancia da classe slim 
/// esta instancia é realizada aos metodos da classe
$app = new \Slim\App();
 
 
 
/// EndPoint - é um ponto de parada da API, ou seja serao as ////formas de requisicao que a API ira responder 

/*
 $request - rera usado para pegar algo que vai enviado para a api
 
 $response - sera utilizado para quando a API ira devolver algo, seja uma mensagem , status, body , header , etc 

 $args - serao os argumentos que podem ser encaminhados para API


*/
///Endpoint: GET, retorna todos os dados de clientes
$app->get('/clientes', function ($request, $response, $args){
    
/////importe do arquivo que solicita das requisicoes 
/////de busca no bd
    require_once('../controles/exibeDadosCliente.php');
    
    ///Chama a funcao (na pasta controles) que vai requisitar os dados no BANCO DE DADOS
    if($listDados = exibirClientes())
      
     if($listDadosArray = criarArray($listDados))
   
         $listDadosJSON = criarJSON($listDadosArray);
        
    
return  $response  ->withStatus(200)   
                   ->withHeader('content-type', 'application/json')
                   ->write($listDadosJSON);
    
    
});


///Endpoint: POST , envia um novo cliente para o BD 
$app->post('/clientes', function ($request, $response, $args){
    
return  $response  ->withStatus(201)   
                   ->WithHeader('Content-Type', 'application/json')
                   ->write('{"message":"item criado com sucesso"}');
    
    
});



///Endpoint: PUT , atualiza um cliente no BD
$app->put('/clientes', function ($request, $response, $args){
    
return  $response  ->withStatus(201)   
                   ->WithHeader('Content-Type', 'application/json')
                   ->write('{"message":"item atualizado com sucesso"}');
    
    
});


///Endpoint: DELETE , exclui um cliente no BD
$app->delete('/clientes', function ($request, $response, $args){
    
return  $response  ->withStatus(200)   
                   ->WithHeader('Content-Type', 'application/json')
                   ->write('{"message":"item excluido com sucesso"}');
    
    
});

///Carrega todos os EndPoint para execucao 

$app->run();











?>