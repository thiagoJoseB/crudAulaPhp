<?php
/********************
   Objetivo:arquivo para configurar a configurar a conexao com o banco de dados  MySOL
   Data:15/09/2021
   Autor: Thiago Bueno 



*/
function conexaoMysql()
{
// require_once('../functions/config.php');

// abre a conexao com a base de dados MySQL
   
    
    // declaracao de variaves para conexao com BD
    $server= (string) BD_SERVER ;
    $user = (string) BD_USER ;      /// USUARIO 
    $password = (string)  BD_PASSWORD  ;
    $database = (string) BD_DATABASE ;


/*

   formas de criar a conexao xom BD
   
   mysql_connect();
   mysqli_connect();  
   PDO(); 



*/
    
    

  if($conexao = mysqli_connect($server, $user, $password,$database))
     return $conexao;
   
       
    else
    {
        echo(ERRO_CONEXAO_BD);
        return false;
    }
}





?>