<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
require_once('../conexao.php');
$cod_user = $_GET['cod_user'];

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM usuario WHERE cod_user = $cod_user ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div class="main" id="main">
  <div id="conteudo" style="margin-top: 0px; padding-top: 0px">
<form action="alterar_login2.php" method="POST">
  <table class="tabela" width="75%" align="center">
   <tr>
   	<td colspan="2" class="main_td" style="background-color: #9D2243"><h2>Atualizando Usuario</h2>
   </tr>    
   <tr>
    <td><b>Nome:</b></td>
    <td><input name="nome" type="text" value="<?php echo $row_dados['nome']; ?>"></td>
   </tr>
   <tr>
    <td><b>Usuário:</b></td>
    <td width="78%"><input name="usuario_nome" value="<?php echo $row_dados['usuario']; ?>"></td>
   </tr>
   <tr>
    <td><b>Senha:</b></td>
    <td width="78%"><input type="password" name="senha" value="<?php echo $row_dados['senha']; ?>"></td>
   </tr>
    <td><b>Tipo de Acesso:</b></td>
      <td width="78%">
        <select  id="tipo" name="tipo" value="<?php echo $row_dados['tipo']; ?>">
         <option value="usuario">Usuário</option> 
         <option value="admin">Admin</option>
         </select></td>
   </tr>
          <input type="hidden" name="cod_user" value="<?php echo $cod_user;?>">
   </table>
   <div class="botao" style="margin-top:15px">
       <button type="submit" name="Submit">Atualizar</button>
    </div>
</form>
  
<?php
mysqli_free_result($Recordset1);
?>
</div>
<div id="rodape" style="padding-bottom: 50px">

</div>
</div>

</body>
</html>
<?php }else{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css" />
</head>
<body>
    <div class="main" id="main">
    <div class="header">
            <div class="cabecalho">
                <div id="img">
                    <a href="../">
                        <img src="../img/logo.png">
                    </a>
                </div>
                <div id="cabecalho_texto">
                    <h1>Sistema SARTS</h1>
                    <h3>Gerenciamento de ativos - Rede e Telefonia</h3>
                </div>
        </div>
    </div>
        <div id="conteudo" style="">
            <h1 style="text-align:center;">Nível de acesso Insuficiente</h1>
            <h3 style="text-align:center; margin-top: 8px;"><a href="#" onclick="history.go(-1);">Clique aqui para retornar</a></h3>
        </div>
        <div id="rodape" style="padding-bottom: 50px">

        </div>
    </div>
    <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>

</body>

<?php } ?>
