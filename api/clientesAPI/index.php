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
        
//// validacao para tratar banco de dados sem conteudo     
   if($listDadosArray)
    {     
return  $response  ->withStatus(200)   
                   ->withHeader('content-type', 'application/json')
                   ->write($listDadosJSON);
       
    
    }else{
       //// 204 nao teve retorno , 
       return $response      ->withStatus(200)
                             ->withHeader('content-type', 'application/json')
           
                              ->write('{"message":"nao ha dados para essa requisicao"}');
   }  
});


//// GET, retorna todos os dados de clientes
$app->get('/clientes/{id}', function ($request, $response, $args){
    
/////importe do arquivo que solicita das requisicoes 
/////de busca no bd
    require_once('../controles/exibeDadosCliente.php');
    
    ////Recebe o ID que sera encaminhado no URL 
    $id = $args['id'];
    
    
    ///Chama a funcao (na pasta controles) que vai requisitar os dados no BANCO DE DADOS
    if($listDados = buscarClientes($id))
      
     if($listDadosArray = criarArray($listDados))
   
         $listDadosJSON = criarJSON($listDadosArray);
        
//// validacao para tratar banco de dados sem conteudo     
   if($listDadosArray)
    {     
return  $response  ->withStatus(200)   
                   ->withHeader('content-type', 'application/json')
                   ->write($listDadosJSON);
       
    
    }else{
       //// 204 nao teve retorno , 
       return $response      ->withStatus(200)
                             ->withHeader('content-type', 'application/json')
           
                              ->write('{"message":"nao ha dados para essa requisicao"}');
   }  
});





///Endpoint: POST , envia um novo cliente para o BD 
$app->post('/clientes', function ($request, $response, $args){
 
//// recebe o content type do header para verificar se o padrao ///do body sera json
 $contentType = $request->getHeaderLine('Content-Type');
    
    if($contentType == 'application/json')
    {
        /// recebe o conteudo do enviado no body da mensagem
        $dadosBodyJSON =$request->getParsedBody();
        
        
        ///valida se o coorpo do body esta vazio 
        if($dadosBodyJSON == "" || $dadosBodyJSON == null)
        {
             return  $response  ->withStatus(406)   
                                 ->WithHeader('Content-Type', 'application/json')
                                 ->write('{"message":"conteudo enviado pelo body nao contem dados validos"}');
            
        }else{
         
        ///importe do arquivo que vai emcaminhar os dados para o ///banco de dados    
        require_once('../controles/recebeDadosClientesAPI.php');    
    /// envia os dados para o banco de dados        
       if(inserirClienteApi($dadosBodyJSON))
        {   
        
       return  $response    ->withStatus(201)   
                              ->WithHeader('Content-Type', 'application/json')
                              ->write('{"message":"item criado com sucesso"}');
           
           }else{
            return  $response  ->withStatus(400)   
                              ->WithHeader('Content-Type', 'application/json')
                              ->write('{"message":"nao foi possivel salvar os dados , favor conferir o body da mensagem"}');
           
               }
            
        }
    }else{
        
    
return  $response  ->withStatus(406)   
                   ->WithHeader('Content-Type', 'application/json')
                   ->write('{"message":"formato de dados do header incompativel com o padrao JSON"}');
    
   }  
    
    
});








///Endpoint: PUT , atualiza um cliente no BD
$app->put('/clientes/{id}', function ($request, $response, $args){
    
    //// recebe o content type do header para verificar se o padrao ///do body sera json
 $contentType = $request->getHeaderLine('Content-Type');
    /// valida se é JSON
    if($contentType == 'application/json')
    {
        /// recebe o conteudo do enviado no body da mensagem
        $dadosBodyJSON =$request->getParsedBody();
        
        
     
        
        
        ///valida se o coorpo do body esta vazio 
        if($dadosBodyJSON == "" || $dadosBodyJSON == null || !isset($args['id']) || !is_numeric($args['id']))       
        {
             return  $response  ->withStatus(406)   
                                 ->WithHeader('Content-Type', 'application/json')
                                 ->write('{"message":"conteudo enviado pelo body nao contem dados validos"}');
            
        }else{
            
               //// recebe o id que sera enviado pela URL
        $id = $args['id'];
         
        ///importe do arquivo que vai emcaminhar os dados para o ///banco de dados    
        require_once('../controles/recebeDadosClientesAPI.php');    
    /// envia os dados para o banco de dados        
       if(atualizarClienteApi($dadosBodyJSON, $id))
        {   
        
       return  $response    ->withStatus(200)   
                              ->WithHeader('Content-Type', 'application/json')
                              ->write('{"message":"item atualizado com sucesso"}');
           
           }else{
            return  $response  ->withStatus(400)   
                              ->WithHeader('Content-Type', 'application/json')
                              ->write('{"message":"nao foi possivel salvar os dados , favor conferir o body da mensagem"}');
           
               }
            
        }
    }else{
        
    
return  $response  ->withStatus(406)   
                   ->WithHeader('Content-Type', 'application/json')
                   ->write('{"message":"formato de dados do header incompativel com o padrao JSON"}');
    
   }
    

    
});





$app->delete('/clientes/{id}', function ($request, $response, $args){

    ///valida se o coorpo do body esta vazio 
        if(!isset($args['id']) || !is_numeric($args['id']))       
        {
             return  $response  ->withStatus(406)   
                                 ->WithHeader('Content-Type', 'application/json')
                                 ->write('{"message":"conteudo enviado pelo body nao contem dados validos"}');
            
        }else{
            
               //// recebe o id que sera enviado pela URL
        $id = $args['id'];
         
        ///importe do arquivo que de exclusao do cliente
        require_once('../controles/excluirDadosClientesAPI.php'); 
            
    
            
       if(excluirClienteApi($id))
        {   
        
       return  $response    ->withStatus(200)   
                              ->WithHeader('Content-Type', 'application/json')
                              ->write('{"message":"item excluido com sucesso "}');
           
           }else{
            return  $response  ->withStatus(400)   
                              ->WithHeader('Content-Type', 'application/json')
                              ->write('{"message":nao foi possivel excluir"}');
           
               }
            
        }

    
});


$app->run();











?>