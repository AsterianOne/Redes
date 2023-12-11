<?php
require_once('../conexao.php');
ob_start();

//Seleciona dados da porta
$cod_pt = $_GET['cod_ptpatch'];

$query_ptPatch = "SELECT * FROM pt_patch WHERE cod_pt_patch = '$cod_pt'";
$ptPatch = mysqli_query($conn, $query_ptPatch) or die(mysqli_error());
$row_ptPatch = mysqli_fetch_assoc($ptPatch);
$totalDadosgeral = mysqli_num_rows($ptPatch);
$cod_patch = $row_ptPatch['cod_patch'];

if(isset($row_ptPatch['id_voice'])){
$patch_referencia = $row_ptPatch['id_voice'];
$pt_cod_connect = $row_ptPatch['id_voice'];
$set = 1;

$query_Recordset_voice_nome = "SELECT nome_voice FROM voice WHERE cod_voice = '$pt_cod_connect'";
$Recordset_voice_nome = mysqli_query($conn, $query_Recordset_voice_nome) or die(mysqli_error());
$row_connect = mysqli_fetch_assoc($Recordset_voice_nome);

$query_Recordset_voice_pt = "SELECT * FROM pt_voice WHERE cod_pt_patch = '$cod_pt'";
$Recordset_voice_pt = mysqli_query($conn, $query_Recordset_voice_pt) or die(mysqli_error());
$row_port_connect = mysqli_fetch_assoc($Recordset_voice_pt);
}

if(isset($row_ptPatch['id_switch'])){
$patch_referencia = $row_ptPatch['id_switch'];
$pt_cod_connect = $row_ptPatch['id_switch'];
$set = 2;

$query_Recordset_switch_nome = "SELECT marca FROM switch WHERE cod_switch = '$pt_cod_connect'";
$Recordset_switch_nome = mysqli_query($conn, $query_Recordset_switch_nome) or die(mysqli_error());
$row_connect = mysqli_fetch_assoc($Recordset_switch_nome);

// id_switch == switch conectado
$query_Recordset_switch_pt = "SELECT * FROM pt_swtich WHERE cod_pt_patch = '$cod_pt'";
$Recordset_switch_pt = mysqli_query($conn, $query_Recordset_switch_pt) or die(mysqli_error());
$row_port_connect = mysqli_fetch_assoc($Recordset_switch_pt);
}

//Seleciona dados do Patch
$query_patch = "SELECT * FROM patch_panel WHERE cod_patch = '$cod_patch'";
$patch = mysqli_query($conn, $query_patch) or die(mysqli_error());
$row_patch_rack = mysqli_fetch_assoc($patch);
$totalDadosgeral = mysqli_num_rows($patch);
$cod_rack = $row_patch_rack['rack'];

//Seleciona dados da RACK
$query_rack = "SELECT * FROM rack WHERE cod_rack = '$cod_rack'";
$dados_rack = mysqli_query($conn, $query_rack) or die(mysqli_error());
$row_rack = mysqli_fetch_assoc($dados_rack);
$totalDadosrack = mysqli_num_rows($dados_rack);
$localrack = $row_rack['local'];

//seleciona dados patch panel
$query_Recordset_patch = "SELECT * FROM patch_panel WHERE rack = '$cod_rack' ORDER BY nome_patch ASC";
$Recordset_patch = mysqli_query($conn, $query_Recordset_patch) or die(mysqli_error());
$row_patch = mysqli_fetch_assoc($Recordset_patch);

//Conecta com setores
$query_dados = "SELECT * FROM setores WHERE cod_setor = $localrack";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);

?>

<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
</head>
<body >
<div class="main" id="main">
<div id="conteudo" style="margin-top: 0px; padding-top: 0px">
  <!-- Lista dados da porta -->
  <div class="titulo_pg_info" align="center" style="display: block">
  <p><b>Rack:</b> <?php echo $row_rack['nome']; ?> - <?php echo $row_setor['sigla']; ?> </p>
  <p><b>Patch:</b> <?php echo $row_patch['nome_patch']; ?> - <b>Porta Patch:</b> <?php echo $row_ptPatch['id_patch']; ?></p> 
  <p><b>Aparelho:</b> <?php if(isset($row_connect)){if($set == 1){echo $row_connect['nome_voice'];}
  if($set == 2){echo $row_connect['marca'];}}else{echo 'Desconectado';} ?> - 
  <b>Porta Conectada: <?php if(isset($row_connect)){if($set == 1){echo $row_port_connect['id_voice'];}
  if($set == 2){echo $row_port_connect['pt_switch'];}}else{echo 'Desconectado';} ?></b></p>

  </div>
    <div class="botao" style="margin-top: 10px">
    <script>
      function fechaAtualiza(){
        window.opener.location.reload();
        history.go(-1);
      }
    </script>
    <button type="button" name="button" onclick="fechaAtualiza()">Voltar</button>
    </div>
  </div>
   </div>
</body>
</html>