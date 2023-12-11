<?php
include("../sessao/sessao.php");
ob_start();
require_once('../conexao.php');
//verifica o que é necessario mudar
$voicePtAntigo = $_POST['voicePtAntigo'];
$patchPtAntigo = $_POST['patchPtAntigo'];

$cod_ramal = $_POST["cod_ramal"]; //s
$pabx = $_POST['pabx']; //s
$rack = $_POST['rack']; //s
$interno= $_POST['interno']; //s
$categoria = $_POST['categoria']; //s
$setor = $_POST['setor']; //s
$grupo_chamada = $_POST['grupo_chamada']; //s
//voice
$voice = $_POST['voice']; //s
$pt_voice = $_POST['pt_voice']; //s
//patch panel
$patch = $_POST['patch']; //s
$pt_usuario = $_POST['pt_usuario']; //s


//Desativa antiga conexão
$desativaPtVoiceAntigo = mysqli_query($conn, "UPDATE pt_voice SET cod_pt_patch = '0', cod_patch = '0', status = '0' WHERE id_pt_voice = '$voicePtAntigo'")
or die("Erro no comando SQL:".mysqli_error());

//Desativa antiga conexão
$desativaPtPatchAntigo = mysqli_query($conn, "UPDATE pt_patch SET id_voice = '0', status = '0' WHERE cod_pt_patch = '$patchPtAntigo'")
or die("Erro no comando SQL:".mysqli_error());

//establece nova conexão
$alterar = mysqli_query($conn, "UPDATE ramal SET pabx = '$pabx', rack = '$rack', interno = '$interno', categoria = '$categoria', setor = '$setor', grupo_chamada = '$grupo_chamada', porta = '$pt_voice', pt_usuario = '$pt_usuario' WHERE cod_ramal = '$cod_ramal'")
or die("Erro no comando SQL:".mysqli_error());

$ativarPTpatch = mysqli_query($conn, "UPDATE pt_patch SET id_voice = '$pt_voice', status = '1' WHERE cod_pt_patch = '$pt_usuario' ")
or die("Erro no comando SQL:".mysqli_error());

$ativarPTvoice =  mysqli_query($conn, "UPDATE pt_voice SET cod_pt_patch = '$pt_usuario', status = '1', cod_patch = '$patch' WHERE id_pt_voice = '$pt_voice'")
or die("Erro no comando SQL:".mysqli_error());
mysqli_close($conn);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div class="main" id="main">
 <div id="conteudo" style="height:auto; padding-top:0;">
    <script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
        window.close();
      }
      </script>
  <p style="text-align:center">Ramal atualizada com SUCESSO!!!</p>
  <p style="text-align:center">Clique <a href="javascript:void(0)" onclick="fechaEstaAtualizaAntiga();">aqui </a> para finalizar.</p>
</div>
<div id="rodape" style="padding-bottom: 50px">

</div>
</div>

</body>
</html>
