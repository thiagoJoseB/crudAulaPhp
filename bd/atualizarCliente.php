<?php
/********************
   Objetivo: atualizar dados de um  cliente existente no banco de dados
   Data:13/10/2021
   Autor: Thiago Bueno 


*/

// importe de arquivo de conexao com o  banco de dados
require_once('../bd/conexaoMysql.php');


function editar ($arrayCliente)
{
   $sql = "update tblcliente set 
          nome = '".$arrayCliente['nome']."',
          rg = '".$arrayCliente['rg']."',
          cpf = '".$arrayCliente['cpf']."',
          telefone = '".$arrayCliente['telefone']."',
          celular = '".$arrayCliente['celular']."',
          email = '".$arrayCliente['email']."',
          obs = '".$arrayCliente['obs']."',
          idEstado = ".$arrayCliente['idEstado'].",
          foto = '".$arrayCliente['foto']."'
        where idcliente = " .$arrayCliente['id']; 
   
  
   
     $conexao = conexaoMysql();
    // envia o escripe sql para o banco de dados
   if (mysqli_query($conexao, $sql))
       return true; /// retorna verdadeiro se o registro no banco for inserido
    else
        return false; /// retorna falso se tiver algum problema
    
    
   
   
}




?>