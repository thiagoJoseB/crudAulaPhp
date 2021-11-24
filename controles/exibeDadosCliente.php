<?php

/*
objetivo: buscar ou listar os dados de clientes solicitando ao bano de dados
data: 23/09/2021
autor: thiago bueno 

*/

// importe do arquivo para inserir no banco de dados 
require_once(SRC.'/bd/listarClientes.php');

function exibirClientes ()
{    
    // chama funcao que busca os dados no bd e recebe os registros de clientes
    $dados = listar();
    
    return $dados;
}

//// funcao para buscar dados no bd
function buscarClientes ($id)
{    
    // chama funcao que busca os dados no bd e recebe os registros de clientes
    $dados = buscar($id);
    
    return $dados;
}







//// funcao para criar um array de dados no banco  no retorno do BANCO DE DADOS 
function criarArray($objeto)
{   
    $cont = (int) 0;
    ///estrutura de repeticao para pegar um objeto de dados 
    /// e convertar em um aaray 
    while ($rsDados = mysqli_fetch_assoc($objeto))
    {
        $arrayDados[$cont] = array(
            
               "id"  => $rsDados['idcliente'],
               "nome"  => $rsDados['nome'],
               "rg"  => $rsDados['rg'],
               "cpf"  => $rsDados['cpf'],
               "telefone"  => $rsDados['telefone'],
               "celular"  => $rsDados['celular'],
               "email"  => $rsDados['email'],
               "obs"  => $rsDados['obs'],
               "foto"  => $rsDados['foto'],
               "idEstado"  => $rsDados['idEstado'],
               "sigla"  => $rsDados['sigla']
               
        
        
        
        ); 
        
        $cont +=1;
    }
    ////tratamento para validar se existe dados no banco de dados 
    /// senao houver o retorno devera ser false 
    if(isset($arrayDados))
        return $arrayDados;
    else
        return false;
}


///funcao para gerar um Json , com base em um array de dados 

function criarJson($arrayDados)
{
    ///especifica no cabecalho do php que sera gerado um JSON
  header("content-type:application/json");
    
    /// converte um array em JSON 
    $listJSON = json_encode($arrayDados);
    
    /*
      json_encode() -- converte um array em formato JSON
      json_decode() -- converte um JSON em formato array
    
    
    */
    
    if(isset($listJSON))
        return $listJSON;
        
        else
            return false;
    
    
    
}

?>