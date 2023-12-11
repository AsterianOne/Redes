<?php
include("../sessao/sessao.php");
ob_start();
?>
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
<?php Include_once("../conexao.php"); 
//include("sessao.php");
?>
<?php
$maxRows_Recordset1 = 100;
$pageNum_Recordset1 = 0;
if (isset($HTTP_GET_VARS['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $HTTP_GET_VARS['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

//variavel do bd $conn
$query_Recordset1 = "SELECT cod_switch, marca, modelo, serial, qtd_portas, rack FROM switch";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($conn, $query_limit_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($HTTP_GET_VARS['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $HTTP_GET_VARS['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($conn,$query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../styles/tabela.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FUNED - Sistema SARTS</title>
</head>
<body>
<div id="tudo">
	<div id="topo">
    
    </div>
  <div id="conteudo">
<div align="center"> 
  <p>
    <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
    <strong><a href="../cad_switch/cad_switch.php">Nenhum switch cadastrado!!</a></strong> 
    <?php } // Show if recordset empty ?>
  </p>
  </div>
 
<?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <table width="70%" border="1" align="center">
    <tr> 
    <td colspan="8" bgcolor="#9D2243"> 
      <button><a href="..//principal.php">Home</a></button> 
      <H1 style="text-align: center">Gerenciando Switchs</H1>
      <button><a href="../cad_switch/cad_switch.php">Cadastrar Switch</a></button>
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
<?php } // Show if recordset not empty ?>
    <p align=center>
    <form>
    <input type="hidden" name="cod_switch" value="<?php echo $cod_switch;?>">
  </form>
  </p>

</div>
<div id="rodape" style="padding-bottom: 50px">

</div>
</div>

</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>