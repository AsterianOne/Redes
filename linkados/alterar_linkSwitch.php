<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
require_once('../conexao.php');
ob_start();

$id_pt_switch = $_POST['id_pt_switch'];
$cod_pt_switch = $_POST['cod_pt_switch'];
$status = $_POST['definirStatus'];
$cod_Linkado = $_POST['txt_switch'];
$id_switch = $_POST['id_switch'];

if($cod_Linkado == "" AND $status == 1){
  ?> <script>onload = reload()</script> <?php
}
else{
if($status == 3){
$alterar = mysqli_query($conn, "UPDATE pt_swtich SET cod_pt_patch = '$cod_pt_switch', status = '$status', cod_patch = '$id_switch' WHERE id_pt_switch = '$id_pt_switch'")
or die("Erro no comando SQL:".mysqli_error());

$alterarLink = mysqli_query($conn, "UPDATE pt_swtich SET cod_pt_patch = '$cod_pt_switch', status = '$status', cod_patch = '$id_switch' WHERE id_pt_switch = '$cod_Linkado'")
or die("Erro no comando SQL:".mysqli_error());
if($status == 0 OR $status == 2){
  $alterar = mysqli_query($conn, "UPDATE pt_swtich SET cod_pt_patch = '0', status = '$status', cod_patch = '0' WHERE id_pt_switch = '$id_pt_switch'")
  or die("Erro no comando SQL:".mysqli_error());

  $alterarLink = mysqli_query($conn, "UPDATE pt_swtich SET cod_pt_patch = '0', status = '$status', cod_patch = '0' WHERE id_pt_switch = '$cod_Linkado'")
  or die("Erro no comando SQL:".mysqli_error());
}};
};
mysqli_close($conn);
?>
<script>
      function reload(){
        window.opener.location.reload();
        window.location.replace("http://172.16.101.67/sarts/cad_switch/alterar_switch.php?cod_switch='<?php echo $id_switch ?>'")
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