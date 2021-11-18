<?php 

/********************
   Objetivo: arquivo responsavel por reserber o id do cliente e encaminhar para a funcao que ira excluir o dado
   Data:29/09/2021 
   Autor: Thiago Bueno 


*/


// importe do arquivo de configuracao de variaveis e constantes
require_once('../functions/config.php');

// importe do arquivo para excluir no banco de dados 
require_once(SRC.'/bd/excluirCliente.php');

/// o id esta sendo encaminhado pela index no link que foi realizado na imagem do excluir 
  $idCliente = $_GET['id'];


  /// nome da  foto foi enviado pela index , no link do excluir 
  $nomeFoto = $_GET['foto'];


//chama a funcao excluir e emcaminha o id que sera removido no banco de dados 
if(excluir($idCliente))
{    
    //apaga a foto que esta na pasta dos arquivos do upload
    unlink(SRC.NOME_DIRETORIO_FILE.$nomeFoto);
//    die;
    echo(BDMSG_EXCLUIR);
    
}    
else
    echo("
        <script> alert('". BDMSG_ERRO . "'); 
         window.history.back();
           </script>
    ");

   





?>