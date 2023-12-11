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
<?php
include("../sessao/sessao.php");
ob_start();
?>
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
$query_Recordset1 = "SELECT cod_ramal, numero, pabx, rack, interno, porta, categoria, setor, pt_usuario, grupo_chamada FROM ramal";
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
<body >
  <div class="main" id="main">
      <div class="header">
        <div class="cabecalho">
          <div id="img">
            <img src="../img/logo.png">
          </div>
          <div id="cabecalho_texto">
            <h1>Sistema SARTS</h1>
            <h3>Gerenciamento de ativos - Rede e Telefonia</h3>
          </div>
        </div>
        <div class="menu">
          <ul class="menu_ul">
            <li><a href="#">Cadastro</a>
              <ul>
                <li><a href="./cadastro/user">User</a></li>
                <li><a href="./cadastro/area">Area</a></li>
                <li><a href="./cadastro/bloco">Bloco</a></li>
                <li class="rack_opt"><a href="./cad_rack/lst_rack.php">Rack</a>
                    <li><a href="./cad_switch/lst_switch.php">Switch</a>
                    <li><a href="./cadastro/rack/path-painel">Path painel</a></li>
                    <li><a href="./cad_voice/lst_voice.php">Voice painel</a></li> 
                    <li><a href="./cad_ramal/lst_ramal.php">Ramal</a></li>
                </li>
                <li><a href="./cadastro/planta">Planta</a></li>
              </ul>
            </li>
            <li><a href="./pesquisar">Pesquisar</a></li>
            <li><a href="./mapa">Mapa</a>
              <ul>
                <li><a href="./mapa/global">Global</a></li>
                <li><a href="./mapa/bloco">Bloco </a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div id="conteudo" style="height:auto">  
            <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
          <a href="cad_ramal.php" onClick="NovaJanela(this.href,'album','901,'300','yes');return false">Nenhum dado casdastrado!!</a> 
            <?php } // Show if recordset empty ?>
          </p>
        
        <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
        <!-- Inicio pesquisa 
            <div style="float:left; margin-left:10px; margin-top:0px;" align="left" >
                <table width="70%">
                  <tr>
                      <td width="96%" height="29"><input type="text" class="search" id="searchbox"  style="margin-top:0px; height:25px"/></td>
                      <td width="4%" align="center" valign="center"><img src="img/pesq.png" st/></td>
                  </tr>
                </table>
                <br />
                <div id="display">
                </div>
              </div>
          Fim pesquisa -->
          <table width="586" border="1" bordercolor="#444" align="center" cellpadding="0" cellspacing="0">
            <tr> 
              <td class="main_td" colspan="10"> 
              <button><a href="../cad_rack/index.php">Home</a></button> 
              <H1>Gerenciamento de Ramais</H1>
              <!-- <button><a href="cad_ramal.php" onclick="NovaJanela(this.href,'album','901','500','yes');return false">Cadastrar Ramal</a></button> -->
              </td>
            </tr> 
            <tr> 
                <td width="10%"> <h2>Numero</h2></td>
                <td width="10%"> <h2>PABX</h2></td>
                <td width="10%"> <h2>Rack</h2></td>
                <td width="10%"> <h2>Interno</h2></td>
                <td width="13%"> <h2>Porta</h2></td>
                <td width="13%"> <h2>Categoria</h2></td>
                <td width="13%"> <h2>Setor</h2></td>
                <td width="13%"> <h2>Pt_Usuario</h2></td>
                <td width="13%"> <h2>Grupo_Chamada</h2></td>
                <td width="20%"> <h2>A&ccedil;&atilde;o</h2></td>
            </tr> 
            <?php do { ?>
            <tr>
              <td><div><?php echo $row_Recordset1['numero']; ?></div></td>
              <td><div><?php echo $row_Recordset1['pabx']; ?></div></td>
              <td><div><?php echo $row_Recordset1['rack']; ?></div></td>
              <td><div><?php echo $row_Recordset1['interno']; ?></div></td>
              <td><div><?php echo $row_Recordset1['porta']; ?></div></td>
              <td><div><?php echo $row_Recordset1['categoria']; ?></div></td>
              <td><div><?php echo $row_Recordset1['setor']; ?></div></td>
              <td><div><?php echo $row_Recordset1['pt_usuario']; ?></div></td>
              <td><div><?php echo $row_Recordset1['grupo_chamada']; ?></div></td>
              <td align="center">
                  <a href="../cad_ramal/alterar_ramal.php?cod_ramal=<?php echo $row_Recordset1['cod_ramal']; ?>" onclick="NovaJanela(this.href,'album','900','600','yes');return false"><img src="../img/editar.png" alt="Alterar" width="16" height="16"></a>
              </td>
            </tr>
            <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
          </table>
          <?php } // Mostrar registros se não estiver vazio ?>
        
          <form><input type="hidden" name="cod_ramal" value="<?php echo $row_Recordset1['cod_ramal'];?>"></form>

        <?php
        mysqli_free_result($Recordset1);
        ?>
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
        <div class="rodape">
          <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e responsabilidades Política de privacidade.</h3>
        </div>
    </div>
  </div>
</body>
</html>