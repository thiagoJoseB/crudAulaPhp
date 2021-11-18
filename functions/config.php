<?php
/*********
 Objetivo: arquivo de configuracao de variaveis e constamtes que serao utilizados no sistema 
 
 data: 15/09/2021
 autor: thiago bueno
*/

///constatante para indicar a pasta raiz do servidor mais a estrutura de diretorios ate o meu projeto
define('SRC' ,$_SERVER['DOCUMENT_ROOT'].'/ds2t20212/thiago/AULA13/crud/');

const BD_SERVER = 'localhost';
const  BD_USER = 'root';
const BD_PASSWORD ='bcd127';
const BD_DATABASE = 'dbContatos20212t';


//mensagem de erro do sistema

const ERRO_CONEXAO_BD = "nao foi possivel realizar a conexao com o banco de dados , entre em contato com o administrador do sistema;";

const ERRO_CAIXA_VAZIA = "nao foi possivel realizar a opercao, pois existem campos obrigatorios a serem preenchidos ";

const ERRO_MAXLENGHT = "nao foi possivel realizar a opercao, pois a quantidade de caracteres ultrapassa o permitido no banco de dados ";

/// mensagem de aceitacao e validacao de dados no banco

const BDMSG_INSERIR = "registro salvo com sucesso no banco de dados";

const BDMSG_ERRO = "ERRO: nao foi possivel manipular os dados no banco de dados";

const BDMSG_EXCLUIR = "<script>
                     alert('registro excluido com sucesso no banco de dados');
                       window.location.href='../index.php';
                    </script>";



//// constantes para upload de arquivos 
define ('NOME_DIRETORIO_FILE' ,'arquivos/');

$extensoesPermitidasFile = array ("image/png", "image/jpeg", "image/jpg");
define('EXTENSOES_PERMITIDAS', $extensoesPermitidasFile);

const TAMANHO_FILE = "5120";





                




?>