<?php

/********************
   Objetivo:arquivo responsavel por receber o id do cliente encaminhar para a funcao que ira buscar os dados 
   Data:06/10/2021
   Autor: Thiago Bueno 



*/


// importe do arquivo de configuracao de variaveis e constantes
require_once('../functions/config.php');

// importe do arquivo para excluir no banco de dados 
require_once(SRC.'/bd/listarClientes.php');

/// o id esta sendo encaminhado pela index no link que foi realizado na imagem do excluir 
  $idCliente = $_GET['id'];

//chama a funcao para buscar de id do cliente
$dadosClientes = buscar($idCliente);

//chama a funcao buscar e emcaminha o id que sera localizado  no banco de dados 
if($rsClientes=mysqli_fetch_assoc($dadosClientes))
{
   
    //ativa a utilizacao de variaveis de sessao 
    /// (sao variaveis) globais
   session_start();
    
    // criamos uma variavel de sessao para guardar o array 
    ///com os dados do cliente que retornou do bd 
    $_SESSION['cliente'] = $rsClientes;
    
    // permite chamar um arquivo como se fosse um link,
    //atraves do php
    header('location: ../index.php');
}
   // echo(BDMSG_EXCLUIR);
else
     echo("
            <script> alert('". BDMSG_ERRO . "'); 
             window.history.back();
               </script>
        ");









?>