<?php
session_start();

$nome = (string) null;
$celular = (string) null;
$email = (string) null;
$rg = (string) null;
$cpf = (string) null;
$telefone = (string) null;
$obs = (string) null; 
$foto = (string) "semfoto.gif";
$id = (int) 0;

/// variaveis para trazer  os valores do estado para edicao
 $idEstado = (int) null;
$sigla = (string) "selecione um item";


// essa variavel sera ultilizada para definir o modo de manipulacao com o banco 

/// salvar = sera feito o insert 
// atualizar sera feito um uptdade
$modo = (string) "salvar";

 /// importe do arquivo de configuracao de variaveis e constantes 
 require_once('functions/config.php');


 require_once(SRC.'bd/conexaoMysql.php');


//require_once('bd/conexaoMysql.php');


require_once(SRC.'controles/exibeDadosCliente.php');

/// import do arquivo que lista todos os estados do bd
require_once(SRC.'controles/listarDadosEstados.php');

/// verifica a existencia da variavel de sessao que usamos para trazer  
if(isset($_SESSION['cliente']))
{   
    $id =  $_SESSION['cliente']['idcliente']; 
    $nome = $_SESSION['cliente']['nome'];
    $celular = $_SESSION['cliente']['celular'];
   $email = $_SESSION['cliente']['email'];
   $rg = $_SESSION['cliente']['rg'];
   $cpf = $_SESSION['cliente']['cpf'];
   $telefone = $_SESSION['cliente']['telefone'];
   $obs = $_SESSION['cliente']['obs'];
    $idEstado = $_SESSION['cliente']['idEstado']; 
    $sigla = $_SESSION['cliente']['sigla']; 
    $foto = $_SESSION['cliente']['foto'];
    $modo =  "Atualizar";
    
   
    ///elimina um objeto , variavel da memoria
    unset($_SESSION['cliente']);
    
    
}



?>

<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script src="js/jquery.js"></script>
       
       <script>
           
        $(document).ready(function(){   
           //Alterando uma propriedade de css ao carregar da pagina
           $('#containerModal').css('display','none');
           
           //abre modal
          
             $('.pesquisar').click(function(){
                $('#containerModal').fadeIn(1000);
                 
                 ///recebe o id do cliente que foi adicionado pelo
                 //data atributo no html
                 
                 let idCliente = $(this).data('id');
                 
                ///realiza uma requisicao para consumir dados de uma outra pagina  
                 $.ajax({
                    
                     type:"GET",  /// tipo de requisao(GET,POST,PUT.etc)
                     url:"visualizarDados.php", /// url da pagina que sera consumida
                     data:{id:idCliente},
                     success: function(dados){///se a requisicao dar certo iremos receber o conteudo na variavel dados 
                         
                         $('#modal').html(dados); //exibe dentro da div modal
                     }
                     
                     
                 });
                 
             });
           
             /// fecha modal 
              $('#fecharModal').click(function(){
                 $('#containerModal').fadeOut(); 
              });
              
          });
        
      </script>
       
    </head>
    <body>
       <div id="containerModal">
           <div id="modal">
           
           <span id="fecharModal"> Fechar</span>
           <span id="modal"></span>
           
           
            </div>
       </div>
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
            </div>
            <div id="cadastroInformacoes">
                <!--
                 principais elementos de formulario para HTML5
               <input type ="tel"> indica que a caixa recebe um telefone
               <input type ="email"> indica que a caixa recebe um  email@ 
               <input type ="url"> indica que a caixa recebe uma URL VÁLIDA (http://)
               <input type ="number"> indica que a caixa recebe numeros inteiros 
               <input type ="range"> cria um elemento tipo barra de rolagem horizontal
               <input type ="color"> cria uma palheta de cor para o usuario escolher
               <input type ="date"> cria um calendario para escolha da data 
               <input type ="month"> cria um calendario para escolha somente do mes e ano 
               <input type ="week"> cria um calendario que retorna o numero da semana
               


-->
<!--- as variaveis modo e id, foram utilizados no action do form , sao responsaveis por encaminhar para a pagina recebeDadosCliente.php duas informacoes:
             modo - que é responsavel por definir se epara inserir ou atualizar
             
              id - que é responsavel por identificar o registro a ser 
              atualizado no BD 
              
                --->    
               
               <!---  enctype="multipart/form-data" é obrigatorio ser utilizado quando for trabalhar com imagens  obs:(para trabalhar com a input="type" é obrigatorio usar o metodo post   ) -->
               
                <form enctype="multipart/form-data"  action="controles/recebeDadosCliente.php?modo=<?=$modo?>&id=<?=$id?>&nomeFoto=<?=$foto?>" name="frmCadastro" method="post">
                   
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                    
                    
                    
                     <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Foto: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="fleFoto" accept="image/jpeg , image/jpg , image/png">
                            
                            
                        </div>
                        
                        <div id="visualizarFoto">
                           <img  src="<?=NOME_DIRETORIO_FILE.$foto?>">
                            
                            
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estado: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstado">
                               <option selected value="<?=$idEstado?>"><?=$sigla?>  </option>
                                
                                <?php
                                 /// chama a funcao que  vai buscar todos os estados
                                 $listEstados = exibirEstados();
                              /// repeticao para exibir os dados do banco
                                 while($rsEstados = mysqli_fetch_assoc($listEstados))
                                 {
                                    ?>
                                         <option value="<?=$rsEstados['idEstado']?>"> <?=$rsEstados['sigla']?> </option>
                                         
                                     <?php 
                                 }
    
                                ?>
                                
                                
                                
                            </select>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=$celular?>" maxlength="17">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=$email?>" maxlength="17">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> RG: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtRg" value="<?=$rg?>" maxlength="20">
                        </div>
                    </div>
                    
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> CPF: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCpf" value="<?=$cpf?>" maxlength="20">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=$telefone?>" maxlength="16">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=$obs?></textarea>
                        </div>
                    </div>
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="<?=$modo?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                     <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
               <?php
                
                $dadosClientes = exibirClientes();
                
                while ($rsClientes=mysqli_fetch_assoc($dadosClientes))
                { 
                
                ?>
                
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$rsClientes['nome']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['celular']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['email']?></td>
                     <td class="tblColunas registros">
                     <img class="foto" src="<?=NOME_DIRETORIO_FILE.$rsClientes['foto']?>">
                     
                     </td>
                    <td class="tblColunas registros">
                       <a href="controles/editaDadosClientes.php?id=<?=$rsClientes['idcliente']?>">
                        <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                       </a> 
                      <a onclick="return confirm('tem certeza que deseja excluir?');" href="controles/excluiDadosClientes.php?id=<?=$rsClientes['idcliente']?>&foto=<?=$rsClientes['foto']?>"> <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir"> </a> 
                        
                        <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar" data-id="<?=$rsClientes['idcliente']?>">
                    </td>
                </tr>
                <?php
                    }
                ?>
                
            </table>
        </div>
    </body>
</html>