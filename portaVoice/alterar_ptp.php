<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
ob_start();

//Seleciona dados da porta
$cod_ptp = $_GET['cod_ptp'];

$query_ptvoice = "SELECT * FROM pt_voice WHERE id_pt_voice = '$cod_ptp'";
$ptvoice = mysqli_query($conn, $query_ptvoice) or die(mysqli_error());
$row_ptvoice = mysqli_fetch_assoc($ptvoice);
$totalDadosgeral = mysqli_num_rows($ptvoice);
$cod_voice = $row_ptvoice['cod_voice'];
$patch_referencia = $row_ptvoice['cod_pt_patch'];
$pt_cod_patch = $row_ptvoice['cod_patch'];

//Seleciona dados da VOICE
$query_voice = "SELECT * FROM voice WHERE cod_voice = '$cod_voice'";
$voice = mysqli_query($conn, $query_voice) or die(mysqli_error());
$row_voice = mysqli_fetch_assoc($voice);
$totalDadosgeral = mysqli_num_rows($voice);
$cod_rack = $row_voice['rack'];

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

$query_Recordset_patch_nome = "SELECT * FROM patch_panel WHERE cod_patch = '$pt_cod_patch'";
$Recordset_patch_nome = mysqli_query($conn, $query_Recordset_patch_nome) or die(mysqli_error());
$row_patch_nome = mysqli_fetch_assoc($Recordset_patch_nome);

$query_Recordset_pt_patch = "SELECT * FROM pt_patch WHERE cod_pt_patch = '$patch_referencia'";
$Recordset_pt_patch = mysqli_query($conn, $query_Recordset_pt_patch) or die(mysqli_error());
$row_pt_patch = mysqli_fetch_assoc($Recordset_pt_patch);

//Conecta com setores
$query_dados = "SELECT * FROM setores WHERE cod_setor = $localrack";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);

//Conecta com ramal
$query_ramal = "SELECT * FROM ramal WHERE porta = $cod_ptp";
$dados_ramal = mysqli_query($conn, $query_ramal) or die(mysqli_error());
$row_ramal = mysqli_fetch_assoc($dados_ramal);
if(isset($row_ramal['numero'])){
$ramal = $row_ramal['numero'];
}

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
  <div class="titulo_pg" align="center" style="display: block">
  <table style="padding-bottom: 20px">
      <tr>  
        <td colspan="8">
          <h2 style="margin-bottom: 10px;"><b>Ramal:</b> <?php if(isset($ramal)){echo $ramal;} ?> - <b>PABX:</b> <?php if(isset($ramal)){echo $row_ramal['pabx'];} ?> - <b>Interno:</b> <?php if(isset($ramal)){echo $row_ramal['interno'];} ?></h2>
        </td>
      </tr>
      <tr align="center">
      <td><font color="#FFFFFF"><b>Rack</b></font></td>
      <td><font color="#FFFFFF"><b>Setor</b></font></td>
      <td><font color="#FFFFFF"><b>Categoria</b></font></td>
      <td><font color="#FFFFFF"><b>Grupo de Chamada</b></font></td>
      <td><font color="#FFFFFF"><b>Voice</b></font></td>
      <td><font color="#FFFFFF"><b>Porta Voice</b></font></td>
      <td><font color="#FFFFFF"><b>Patch</b></font></td>
      <td><font color="#FFFFFF"><b>Porta Patch</b></font></td>
      </tr>
      <tr align="center">
        <td style="color: #FFFFFF;"><?php echo $row_rack['nome']; ?></td>
        <td style="color: #FFFFFF;"><?php echo $row_setor['sigla']; ?></td>
        <td style="color: #FFFFFF;"><?php if(isset($ramal)){echo $row_ramal['categoria'];}else{echo "Vazio";} ?></td>
        <td style="color: #FFFFFF;"><?php if(isset($ramal)){echo $row_ramal['grupo_chamada'];}else{echo "Vazio";} ?></td>
        <td style="color: #FFFFFF;"><?php echo $row_voice['nome_voice']; ?></td>
        <td style="color: #FFFFFF;"><?php echo $row_ptvoice['id_voice'];?></td>
        <td style="color: #FFFFFF;"><?php if(isset($row_patch_nome)){echo $row_patch_nome['nome_patch'];}else{echo "Vazio";} ?></td>
        <td style="color: #FFFFFF;"><?php if(isset($row_pt_patch)){echo $row_pt_patch['id_patch'] + $row_patch_nome['etiqueta'];}else{echo "Vazio";} ?></td>
      </tr>
  </table>
</div>
    
    <div class="botao" style="margin-top: 30px">
    <button type="button" name="button" onclick="history.go(-1);">Voltar</button>
    </div>
  </div>
   </div>
</body>
</html>