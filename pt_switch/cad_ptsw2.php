<?php
include("../sessao/sessao.php");
require_once('../conexao.php');
if($_SESSION['type'] == 'admin'){
ob_start();
$cod_switch = $_POST['cod_switch'];
$qt_ptsw = $_POST['txt_ptsw'];
$pt_sw = range(0 , $qt_ptsw);

for($x=1; $x<count($pt_sw); $x++){
  $query_dados = sprintf("INSERT INTO pt_swtich(pt_switch, id_switch) VALUES ('$x', '$cod_switch')");
  $dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
}

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
      <h2>Cadastrado portas do Switch: <?php echo $cod_switch; ?> </h2>
 </div>

  </div>
</div>
<div class="rodape">
          <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e responsabilidades Política de privacidade.</h3>
        </div>
  </body>
  <?php
    mysql_free_result($dados);
  ?>
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