<?php





///import do arquivo para buscar os dados do 
require_once('controles/visualizarDadosClientes.php');


///recebe o id enviado pelo ajax na pagina da index 
$id = $_GET['id'];

/// chama a funcao para buscar no banco de dados 
$dadosCliente = visualizarCliente($id);

//var_dump($dadosCliente);

?>
<html>
    
    <head>
  
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css"
         href="">
        
    </head>
    
    <body>
        <table>
            <tr>
                <td>nome:</td>
                <td><?=$dadosCliente['nome']?></td>
                
               
            </tr>
            
            <tr>
                <td>celular:</td>
                <td><?=$dadosCliente['celular']?></td>
                
                
            </tr>
            
            <tr>
                <td>email:</td>
                <td><?=$dadosCliente['email']?></td>
                
                
            </tr>
            
            <tr>
                <td>rg:</td>
                <td><?=$dadosCliente['rg']?></td>
                
                
            </tr>
            
            <tr>
                <td>cpf:</td>
                <td><?=$dadosCliente['cpf']?></td>
                
                
            </tr>
            
            <tr>
                <td>telefone:</td>
                <td><?=$dadosCliente['telefone']?></td>
                
                
            </tr>
            
            <tr>
                <td>obs:</td>
                <td><?=$dadosCliente['obs']?></td>
                
                
            </tr>
            
            
        </table>
        
        
    </body>
    
</html>