<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
require_once('../conexao.php');
ob_start();

$id_pt_voice = $_POST['id_pt_voice'];
$cod_pt_patch = $_POST['cod_pt_patch'];
$status = $_POST['definirStatus'];
$cod_patch = $_POST['txt_patch'];
$id_voice = $_POST['id_voice'];
if($cod_patch == "" AND $status == 1){
  ?> <script>onload = reload()</script> <?php
}
else{
if($status == 1){
$alterar = mysqli_query($conn, "UPDATE pt_voice SET cod_pt_patch = '$cod_pt_patch', status = '$status', cod_patch = '$cod_patch' WHERE id_pt_voice = '$id_pt_voice'")
or die("Erro no comando SQL:".mysqli_error());

$alterarPatch = mysqli_query($conn, "UPDATE pt_patch SET status = '$status', id_voice = '$id_voice' WHERE cod_pt_patch = '$cod_pt_patch'")
or die("Erro no comando SQL:".mysqli_error());
}
if($status == 0 OR $status == 2){
  $alterar = mysqli_query($conn, "UPDATE pt_voice SET cod_pt_patch = '0', status = '$status', cod_patch = '0'  WHERE id_pt_voice = '$id_pt_voice'")
  or die("Erro no comando SQL:".mysqli_error());

  $alterarPatch = mysqli_query($conn, "UPDATE pt_patch SET status = '0', id_voice = '0' WHERE cod_pt_patch = '$cod_pt_patch'")
  or die("Erro no comando SQL:".mysqli_error());
}};
mysqli_close($conn);
?>
<script>
      function reload(){
        window.opener.location.reload();
        window.location.replace("../cad_voice/alterar_voice.php?cod_voice='<?php echo $id_voice ?>'")
      }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div class="main" id="main">
 <div id="conteudo" style="height:auto; padding-top:0;">
  <p style="text-align:center">PORTA CONECTADA COM SUCESSO!!!</p>
  <p style="text-align:center"><button style="cursor: pointer; color: blue; border:none; border-radius: 0px; background-color: #d3d3d3;" onclick="reload()">Clique aqui para finalizar.</button></p>
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
        <div class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </div>
    </div>

</body>

<?php } ?>