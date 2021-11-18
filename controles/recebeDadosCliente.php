<?php


/*
objetivo:Arquivo responsavel por receber dados, tratar os dados e validar os dados de clientes

data:15/9/2021
autor: thiago bueno 



*/

//// importe do arquivo que faz o upload de imagens
//require_once(SRC.'functions/upload.php');

// importe do arquivo de configuracao de variaveis e constantes
require_once('../functions/config.php');
require_once(SRC.'functions/upload.php');

// importe do arquivo para inserir no banco de dados 
require_once(SRC.'/bd/inserirClientes.php');
require_once(SRC.'/bd/atualizarCliente.php');
 

/// declaracao de variaveis
$nome = (string) null;
$rg = (string) null;
$cpf = (string) null;
$telefone = (string) null;
$celular = (string) null;
$email= (string) null;
$obs = (string) null;
$idEstado =(int) null;


/*variavel criada para guardar o nome da foto*/
$foto = (string) null;

/// validacao para saber se o id do registro esta chegando 
/// pela URL (modo "atualizar" um registro )

if(isset($_GET['id']))
    $id = (int) $_GET['id'];
else
$id = (int) 0;
/// sera para atualizar somente para editar 



/// $_SERVER['REQUEST_METHOD'] verfica qual tipo de requisicao foi enviada pelo form(GET/POST)
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    // recebendo os dados encaminhados pelo formulario atraves do metodo post
    $nome = $_POST['txtNome'];
    $rg =  $_POST['txtRg'];
    $cpf =  $_POST['txtCpf'];
    $telefone =  $_POST['txtTelefone'];
    $celular =  $_POST['txtCelular'];
    $email=  $_POST['txtEmail'];
    $obs =  $_POST['txtObs'];
    $idEstado =  $_POST['sltEstado'];
    
    /// esse nome esta chegando atraves do action do form
    /// da index , o motivo dessa variavel é para conscluir //o editar com o upload da foto 
    $nomeFoto = $_GET['nomeFoto'];
    
    /// chama a funcao que faz o upload de um arquivo

    
    if(strtoupper($_GET['modo']) == 'ATUALIZAR' )
    {
        if($_FILES['fleFoto']['name'] != "")
        {
            // chama a funcao que faz o upload de um arquivo 
            $foto = uploadFile($_FILES['fleFoto']);
            ///apaga imagem antiga
            unlink(SRC.NOME_DIRETORIO_FILE.$nomeFoto);
    
            
        }else
        {
            
            $foto = $nomeFoto;
            
        }
       
   
    } else{
            
            //"ATUALIZAR"
            /// a variavel seja salvar entao sera ///obrigatorio o upload da foto 
            
            // chama a funcao que faz o upload de um arquivo 
            $foto = uploadFile($_FILES['fleFoto']);
            
            
        }
    
    ///serve para parar a execucao do codigo do apache
    ///$_FILES['fleFoto']
    
    if ($nome == null || $rg == null || $cpf == null)
        echo("<script> alert('". ERRO_CAIXA_VAZIA ."'); 
         window.history.back(); </script>");
    // strlen() retorna a quantidade de caracteres de uma variavel 
    elseif(strlen($nome)>100 || strlen($rg)>20 || strlen($cpf)>20)
    echo("<script> alert('". ERRO_MAXLENGHT ."'); 
         window.history.back(); </script>");
   else
   {
       /// local para enviar os dados para o banco de dados 
       
       
       /// criacao de um array para encaminhar a funçao 
       
       $cliente = array(
           "nome" => $nome,
           "rg" => $rg,
           "cpf" => $cpf,
           "telefone" => $telefone,
            "celular" => $celular,
           "email" => $email,
           "obs"  => $obs,
           "id"  => $id,
            "idEstado" =>$idEstado,
           "foto" => $foto
        
           
       );
       
       // chama a funcao inserir do arquivo inserirCliente encaminha o array com os dados do cliente 
       
       //$x = inserir($cliente);
       //echo($x);
       //die;
    if(strtoupper($_GET['modo']) == 'SALVAR')
    {
       if(inserir($cliente))
           echo("
              <script> alert('". BDMSG_INSERIR . "'); 
               window.location.href = '../index.php';
               </script>
           ");
       else
           echo("
              <script> alert('". BDMSG_ERRO . "'); 
               window.history.back();
               </script>
           ");
    }elseif (strtoupper($_GET['modo']) == 'ATUALIZAR')
    {
       if (editar($cliente)) 
           
           echo("
              <script> alert('". BDMSG_INSERIR . "'); 
               window.location.href = '../index.php';
               </script>
           ");
       else
           echo("
              <script> alert('". BDMSG_ERRO . "'); 
               window.history.back();
               </script>
           ");
           
           
    }
        
   }        
                               
}



?>