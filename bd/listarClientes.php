<?php

/*
objetivo:listar todos os dados de clientes

data: 23/09/2021
autor: thiago bueno 

*/

// importe de arquivo de conexao com o  banco de dados
require_once(SRC.'bd/conexaoMysql.php');

///retorna todos os registro existentes do banco  
function listar ()
{
    $sql = "select tblcliente.*, tblEstado.sigla 
         from tblcliente 
         inner join tblEstado
        on tblEstado.idEstado = tblCliente.idEstado
           order by idcliente desc";
    
    // abre a conexao com o banco de dados
    $conexao = conexaoMysql();
    
    //solicita ao banco a execucao do script sql  
   $select = mysqli_query($conexao, $sql);
    
    return $select;

}


///retorna apenas um registro , com base no id 
//function buscar ($idCliente)
// { 
//    
//
//    //$sql = "select * from tblcliente where idcliente = " . $idCliente;
//    
//    $sql = "select * from tblcliente  order by idcliente desc";
//    
//   // echo($sql);
//    //die;
//    
//    // abre a conexao com o banco de dados
//    $conexao = conexaoMysql();
//     
//    //solicita ao banco a execucao do script sql  
//   $select = mysqli_query($conexao, $sql);
//    
//
//        
//    
//    return $select;
//
//
//}
    

function buscar ($idCliente)
{
    $sql = "select tblcliente.*, tblEstado.sigla 
         from tblcliente 
         inner join tblEstado
        on tblEstado.idEstado = tblCliente.idEstado
    
    where tblcliente.idcliente = " . $idCliente;
    
    // abre a conexao com o banco de dados
    $conexao = conexaoMysql();
    
    //solicita ao banco a execucao do script sql  
   $select = mysqli_query($conexao, $sql);
    
    return $select;

}


///// passo 03 , 04 index api
//// retorna a lista de registro com filtro pelo nome do cliente 
function buscarNome($nome)
{
     $sql = "select tblcliente.*, tblEstado.sigla 
         from tblcliente 
         inner join tblEstado
        on tblEstado.idEstado = tblCliente.idEstado
    
    where tblcliente.nome like '%".$nome."%'"; 
    
    // abre a conexao com o banco de dados
    $conexao = conexaoMysql();
    
    //solicita ao banco a execucao do script sql  
   $select = mysqli_query($conexao, $sql);
    
    return $select;
    
    
}











?>