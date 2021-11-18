<?php

/*
objetivo: listar os dados de estado no bano de dados
data: 27/10/2021
autor: thiago bueno 

*/

// importe do arquivo para inserir no banco de dados 
require_once(SRC.'/bd/listarEstados.php');

function exibirEstados ()
{    
    // chama funcao que busca os dados no bd e recebe os registros de clientes
    $dados = listarEstados();
    
    return $dados;
}
?>






















