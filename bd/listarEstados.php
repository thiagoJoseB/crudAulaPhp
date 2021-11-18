<?php

/*
objetivo:listar todos os dados de clientes

data: 27/09/2021
autor: thiago bueno 

*/

// importe de arquivo de conexao com o  banco de dados
require_once(SRC.'bd/conexaoMysql.php');

///retorna todos os registro existentes do banco  
function listarEstados ()
{
    $sql = "select * from tblEstado order by nome";
    
    // abre a conexao com o banco de dados
    $conexao = conexaoMysql();
    
    //solicita ao banco a execucao do script sql  
   $select = mysqli_query($conexao, $sql);
    
    return $select;

}



?>