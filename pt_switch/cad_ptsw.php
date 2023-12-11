<?php 
require_once('../conexao.php');
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
$cod_switch = $_GET['cod_switch'];

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM switch WHERE cod_switch = $cod_switch ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html lang="ptbr" dir="ltr">
  <head>
  <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <title>Cadastro Switch</title>
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
 <div id="box_cad">
 <div class="titulo_pg" style="display: block">
      <h2>Portas Switch: <?php echo $row_dados['marca']; ?></h2>
 </div>
    <form method="POST" action="../pt_switch/cad_ptsw2.php">
    <table class="tabela" border="0" cellpadding="0" cellspacing="3">
      <tr height="20">
        <td width="20%" align="right"><b>id_switch:</b></td>
        <td width="50%"><label><?php echo $row_dados['cod_switch']; ?></label></td>
        </tr>
        <tr>
        <td width="20%" align="right"><b>Quantidade de portas:</b></td>
        <td width="50%"><input name="txt_ptsw" type="text" value="<?php echo $row_dados['qtd_portas']; ?>"></td>
      </tr>
    </table>
    <br>
    <div class="botao">
        <button type="submit" name="Cadastrar">Cadastrar portas</button>
        <a href="./cad_ptsw.php"><button type="reset" name="Cancelar">Cancelar</button></a>
    </div>      
    </div>      
      <input type="hidden" name="cod_switch" value="<?php echo $cod_switch;?>">
  </div>
</form>
<?php
mysqli_free_result($Recordset1);
?>
  <div class="rodape">
    <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e responsabilidades Política de privacidade.</h3>
  </div>
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
        <div class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </div>
    </div>

</body>

<?php } ?>