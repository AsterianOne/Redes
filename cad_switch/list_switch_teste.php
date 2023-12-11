<?php
include("../sessao/sessao.php");
ob_start();
?>
<script LANGUAGE="JavaScript">
<!--
function confirmSubmit()
{
var agree=confirm("Tem certeza que deseja deletar esse Anúncio?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
<script language="javascript">
var win = null;
function NovaJanela(pagina,nome,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(pagina,nome,settings);
}
</script>


<?php
require_once('../conexao.php');
//include("../admin/sessao.php");

$currentPage = $_SERVER['PHP_SELF'];
$maxRows_Recordset1 = 5;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "2";

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM switch ORDER BY cod_switch DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($conn, $query_limit_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($conn, $query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}

$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . implode("&", $newParams);
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Vagner da Silva Moreira - (31) 8923-1900">
<meta name="reply-to" content="vagner_prof@hotmail.com">
<meta http-equiv="content-language" content="pt-br">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<link rel="stylesheet" type="text/css" href="../styles/tabela.css">
<title>FUNED - Gerenciamento de Switchs</title>
</head>
<body>
  <div id="conteudo" style="height:auto">  
    <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <a href="cad_switch.php" onClick="NovaJanela(this.href,'album','901,'300','yes');return false">Nenhum Switch cadastrado!!</a> 
    <?php } // Show if recordset empty ?>
  </p>
 
<?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
<table width="586" border="0" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td colspan="5"> 
      <p> Gerenciamento de Switchs</p>    
      <p> <a href="cad_switch.php" onclick="NovaJanela(this.href,'album','901,'300','yes');return false">Cadastrar Switch<a></p>
    </td>
  </tr> 
  <tr> 
      <td width="10%"><h2 align="center"> ID</h2></td>
      <td width="18%"> <h2 align="center">Marca</h2></td>
      <td width="18%"> <h2 align="center">Modelo</h2></td>
      <td width="18%"> <h2 align="center">Portas</h2></td>
      <td width="18%"> <h2 align="center">Serial</h2></td>
      <td width="18%"> <h2 align="center">Rack</h2></td>
      <td colspan="2"><h2 align="center">A&ccedil;&atilde;o</h2></td>  
  </tr> 
  <?php do { ?>
  <tr>
  <td><div align="center"><?php echo $row_Recordset1['cod_switch']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['marca']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['modelo']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['serial']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['qtd_portas']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['rack']; ?></div></td>
    <td width="8%" align="center">
          <a href="../cad_switch/alterar_switch.php?cod_switch=<?php echo $row_Recordset1['cod_switch']; ?>"><img src="../img/editar.png" alt="Alterar" width="16" height="16"></a>
    </td>
    <td width="8%" align="center">
        <a href="../cad_switch/excluir_switch.php?id=<?php echo $row_Recordset1['cod_switch']; ?>"><img src="../img/excluir.png" alt="Excluir" width="16" height="16"></a>
    </td>
  </tr>
  <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>
<?php } // Mostrar registros se não estiver vazio ?>

<form>
    <input type="hidden" name="cod_switch" value="<?php echo $row_Recordset1['cod_switch'];?>">
</form>

 <?php
mysqli_free_result($Recordset1);
?>
 <table border="0" width="220px" align="center">
   <tr>
   	<td colspan="4">
    	<p><br>
    	 Switch<b><?php echo ($startRow_Recordset1 + 1) ?></b> a <b><?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?></b> de <b><?php echo $totalRows_Recordset1 ?></b> <br>
      </p>
    </td>
   
   </tr>
    <tr> 
      <td width="23%" align="center"> <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">
        <img src="../img/seta1.png" width="16" height="16" alt="Ínicio" border=""/></a> 
      <?php } // Show if not first page ?> </td>
      <td width="31%" align="center"> <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">
        <img src="../img/seta3.png" width="16" height="16" alt="Anterior" border="" /></a> 
      <?php } // Show if not first page ?> </td>
      <td width="23%" align="center"> <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">
        <img src="../img/seta2.png" width="16" height="16" alt="Próximo" border="" /> 
      <?php } // Show if not last page ?> </td>
      <td width="23%" align="center"> <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="../img/seta4.png" alt="Último" width="16" height="16" border="" /></a>
      <?php } // Show if not last page ?> </td>
    </tr>
  </table>
  </div>

</body>
</html>
