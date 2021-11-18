<?php

/*
objetivo:arquivo para fazer upload de iamgens 

data:03/10/2021
autor: thiago bueno */


/// funcao para fazer upload de imagens 
function uploadFile ($arrayFile)
{
    $fotoFile = $arrayFile;
    $tamanhoOriginal = (int)0;
    $tamanhoKB = (int)0;
    $extensao = (string) null;
    $tipoArquivo = (string) null;
    $nomeArquivo = (string) null;
    $nomeArquivoCript = (string) null;
    $foto = (string) null;
    $arquivoTemp = (string) null;
    
    
     
    
    
    
    
    /// validacao se o arquivo existe no array 
    if($fotoFile['size'] > 0 && $fotoFile['type'] != "")
    {   
        
        ///recebe o tamanho original do arquivo em byte
        $tamanhoOriginal = $fotoFile['size'];
        
        /// converte o tamanho original em KB
        $tamanhoKB = $tamanhoOriginal/1024;
        
        ///recebe a extencao original do arquio 
        $tipoArquivo = $fotoFile['type'];
        
        
        ///valida se o tamanho do arquivo é menor do que o permitido 
        if($tamanhoKB <= TAMANHO_FILE)
        {
            //validacao para percorre o array de extencoes permitidas buscando
            /// a extensao do arquivo atual, se  encontrar retorna true 
            if(in_array($tipoArquivo, EXTENSOES_PERMITIDAS ))
            {
               
                ///Permite extrair apenas um nome de arquivo sem a extensao 
     $nomeArquivo = pathinfo($fotoFile['name'],PATHINFO_FILENAME);
                
    ///Permite extrair apenas um nome de arquivo sem o nome
    $extensao = pathinfo($fotoFile['name'],PATHINFO_EXTENSION); 
                
    /*
      algoritimo de criptografia no php
        hash('256' , 'variavel')
        sha1('variavel')
       md5('variavel')
    
    
    */            
                
                ///md5 //hash('sha256') 
    $nomeArquivoCript = md5($nomeArquivo.uniqid(time()));
    
    /// monta o novo nome do arquivo com a extensao            
    $foto = $nomeArquivoCript.".".$extensao;
    
    ///recebe o nome do arquivo temporario que foi gerado 
    /// quando o apache o arquivo do form 
    $arquivoTemp = $fotoFile['tmp_name'];  
   
    ///move_upload_file move arquivo da pasta temporaria d            
                
   if(move_uploaded_file($arquivoTemp,  SRC.NOME_DIRETORIO_FILE.$foto))
       return $foto;
    else
        echo('errro no upload do arquivo!');
    
         
             
                
            }else
                echo('erro tipo de arquivo');
            
      }else
            echo('erro tamanho do arquivo');
        
  }
    
    
    
}





?>