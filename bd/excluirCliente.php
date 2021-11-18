<?php

/********************
   Objetivo: excluir  dados de cliente no banco de dados
   Data:29/09/2021
   Autor: Thiago Bueno 


*/

// importe de arquivo de conexao com o  banco de dados
require_once('../bd/conexaoMysql.php');


function excluir($idCliente)
    
{
    $sql = "delete from tblcliente 
            where idcliente = ".$idCliente;
  
    
 /// chamando a funcao que estabelece a conexao com o banco de dados
    $conexao = conexaoMysql();
    
   if(mysqli_query($conexao , $sql)) 
               /// banco , script 
       

    return true; /// retorna verdadeiro se o registro no banco for inserido
    
    else
        return false; /// retorna falso se tiver algum problema


}








?>