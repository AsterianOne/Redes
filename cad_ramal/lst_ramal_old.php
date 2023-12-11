<script LANGUAGE="JavaScript">
<!--
function confirmSubmit()
{
var agree=confirm("Tem certeza que deseja deletar esse Usuário?");
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>
<?php
include("../sessao/sessao.php");
ob_start();
?>
<?php
require_once('../conexao.php');
//include("../admin/sessao.php");
$currentPage = $_SERVER['PHP_SELF'];
$maxRows_Recordset1 = 100;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "2";

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM ramal ORDER BY numero DESC";
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
<!-- <link rel="stylesheet" type="text/css" href="../styles/tabela.css"> -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div id="tudo">
	<div id="topo">
    
    </div>
  <div id="conteudo">
  <div align="center"> 
    <p>
      <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
      <strong><a href="../cad_ramal/cad_ramal.php">Nenhum ramal cadastrado!!</a></strong> 
      <?php } // Show if recordset empty ?>
    </p>
    </div>
  
  <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
    <table width="70%" border="1" align="center">
      <tr> 
      <td colspan="12" bgcolor="#9D2243"> 
        <button><a href="..//principal.php">Home</a></button> 
        <H1 style="text-align: center">Gerenciando Ramais</H1>
        <button><a href="../cad_ramal/cad_ramal.php">Cadastrar Ramal</a></button>
      </td>
    </tr>
    <tr> 
      <td width="10%"><h2 align="center"> ID</h2></td>
          <td width="10%"> <h2 align="center">Numero</h2></td>
          <td width="10%"> <h2 align="center">PABX</h2></td>
          <td width="10%"> <h2 align="center">Rack</h2></td>
          <td width="10%"> <h2 align="center">Interno</h2></td>
          <td width="13%"> <h2 align="center">Porta</h2></td>
          <td width="13%"> <h2 align="center">Categoria</h2></td>
          <td width="13%"> <h2 align="center">Setor</h2></td>
          <td width="13%"> <h2 align="center">Pt_Usuario</h2></td>
          <td width="13%"> <h2 align="center">Grupo_Chamada</h2></td>
          <td width="20%" colspan="2"> <h2 align="center">A&ccedil;&atilde;o</h2></td>
    </tr>
    <?php do { ?>
      <tr> 
      <td><div align="center"><?php echo $row_Recordset1['cod_ramal']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['numero']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['pabx']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['rack']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['interno']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['porta']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['categoria']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['setor']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['pt_usuario']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['grupo_chamada']; ?></div></td>
      <td width="0%" align="center">
                <a href="../cad_ramal/alterar_ramal.php?id=<?php echo $row_Recordset1['cod_ramal']; ?>"><img src="../img/editar.png" alt="Alterar" width="16" height="16"></a>
        </td>
          <td width="8%" align="center">
            <a href="../cad_ramal/excluir_ramal.php?id=<?php echo $row_Recordset1['cod_ramal']; ?>"><img src="../img/excluir.png" alt="Excluir" width="16" height="16"></a>
      </td>
    </tr>
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
      <p align=center>
      <form>
      <input type="hidden" name="id" value="<?php echo $id;?>">
    </form>
    </p>
    <table border="0" width="220px" align="center">
                <tr>
                  <td colspan="4" border="0px">
                    <p><br>
                    Ramal <b><?php echo ($startRow_Recordset1 + 1) ?></b> a <b><?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?></b> de <b><?php echo $totalRows_Recordset1 ?></b> <br>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td width="100%" colspan="4" align="center">
                    <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">
                      <img src="../img/seta1.png" width="25" height="25" alt="Ínicio" border=""/></a> 
                    <?php } // Show if not first page ?>
                    <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">
                      <img src="../img/seta3.png" width="25" height="25" alt="Anterior" border="" /></a> 
                    <?php } // Show if not first page ?>
                    <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">
                      <img src="../img/seta2.png" width="25" height="25" alt="Próximo" border="" /> 
                    <?php } // Show if not last page ?>
                    <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="../img/seta4.png" alt="Último" width="25" height="25" border="" /></a>
                    <?php } // Show if not last page ?>
                    </td>
                  </tr>
              </table>
  </div>
  <div id="rodape" style="padding-bottom: 50px">

  </div>
</div>

</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>