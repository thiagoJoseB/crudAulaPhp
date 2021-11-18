<?php
/********************
   Objetivo: iserir dados de cliente no banco de dados
   Data:15/09/2021
   Autor: Thiago Bueno 


*/

// importe de arquivo de conexao com o  banco de dados
require_once('../bd/conexaoMysql.php');

function inserir ($arrayCliente)
{
    

  $sql = "insert into tblcliente
  
            (
             nome,
             rg,
             cpf,
             telefone,
             celular,
             email,
             obs,
             idEstado,
             foto
             
            )
            
      values
      (
         '". $arrayCliente['nome']."' ,
         '". $arrayCliente['rg']."' ,
         '". $arrayCliente['cpf']."' ,
         '". $arrayCliente['telefone']."' ,
         '". $arrayCliente['celular']."' ,
         '". $arrayCliente['email']."' ,
         '". $arrayCliente['obs']."'  , 
         ". $arrayCliente['idEstado']." ,
         '". $arrayCliente['foto']."'
    
        
      )
  

  
  
  " ;
    /// chamando a funcao que estabelece a conexao com o banco de dados
   
//    echo($sql);
//    die;
    $conexao = conexaoMysql();
    
    
    // envia o escripe sql para o banco de dados
   if (mysqli_query($conexao, $sql))
       return true; /// retorna verdadeiro se o registro no banco for inserido
    
    else
        return false; /// retorna falso se tiver algum problema
        
    
    
    
   
         
}




?>