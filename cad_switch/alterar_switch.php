<?php
require_once('../conexao.php');

$cod_switch = $_GET['cod_switch'];
$id_switch = $_GET['cod_switch'];
$currentPage = $_SERVER['PHP_SELF'];
$maxRows_pt_Switch = 50;
$pageNum_pt_Switch = 0;

$query_Recordset1 = "SELECT * FROM switch WHERE cod_switch = $cod_switch ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

$cod_rack = $row_dados['rack'];

$query_Recordset_Rack = "SELECT * FROM rack WHERE cod_rack = $cod_rack ";
$Recordset_Rack = mysqli_query($conn, $query_Recordset_Rack) or die(mysqli_error());
$row_dados_Rack = mysqli_fetch_assoc($Recordset_Rack);
$totalRows_Recordset_Rack = mysqli_num_rows($Recordset_Rack);

if (isset($_GET['pageNum_pt_Switch'])) {
  $pageNum_pt_Switch = $_GET['pageNum_pt_Switch'];
}
$startRow_pt_Switch = $pageNum_pt_Switch * $maxRows_pt_Switch;

$colname_pt_Switch = "2";

$query_pt_Switch = "SELECT * FROM pt_swtich WHERE id_switch = $id_switch ORDER BY id_pt_switch ASC"; 
$query_limit_pt_Switch = sprintf("%s LIMIT %d, %d", $query_pt_Switch, $startRow_pt_Switch, $maxRows_pt_Switch);
$Recordset_pt_Switch = mysqli_query($conn, $query_limit_pt_Switch) or die(mysqli_error());
$row_pt_Switch = mysqli_fetch_assoc($Recordset_pt_Switch);

$query_countTotal = "SELECT COUNT(*) AS qnt_total FROM pt_swtich WHERE id_switch = $id_switch AND status=0";
$Recordset_count = mysqli_query($conn, $query_countTotal) or die(mysqli_error());
$row_count = mysqli_fetch_assoc($Recordset_count);

if (isset($_GET['totalRows_pt_Switch'])) {
  $totalRows_pt_Switch = $_GET['totalRows_pt_Switch'];
} else {
  $all_pt_Switch = mysqli_query($conn, $query_pt_Switch);
  $totalRows_pt_Switch = mysqli_num_rows($all_pt_Switch);
}

$totalPages_pt_Switch = ceil($totalRows_pt_Switch/$maxRows_pt_Switch)-1;

  $queryString_pt_Switch = "";
  if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
      if (stristr($param, "pageNum_pt_Switch") == false && 
          stristr($param, "totalRows_pt_Switch") == false) {
        array_push($newParams, $param);
      }
    }
    if (count($newParams) != 0) {
      $queryString_pt_Switch = "&" . implode("&", $newParams);
    }
  }
  $queryString_pt_Switch = sprintf("&totalRows_pt_Switch=%d%s", $totalRows_pt_Switch, $queryString_pt_Switch);
?>
<script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
        window.close();
      }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<title>FUNED - Sistema SARTS</title>
</head>
<body>
<div class="main" id="main">
 <div id="conteudo" style="margin-top: 0px; padding-top: 0px">
 <form action="alterar_switch2.php" name="form1" method="POST">
 <div class="titulo_Switch" style="display: block">
      <p>Rack: <input align="center" class="input_exibirSwitch" style="width: 55px" value="<?php echo $row_dados_Rack['nome']; ?>" disabled> - <input class="input_exibirSwitch" value="<?php echo $row_dados['marca']; ?>" disabled> - <input class="input_exibirSwitch" name="txt_ip" value="<?php echo $row_dados['ip']; ?>" onkeypress="$(this).mask('000.000.000.000');" maxlength="12"></p>
 </div>
 <div id="exibir_switch" width=768 height=62 style="background-color: #fff; display: fixed;">

<?php if ($totalRows_pt_Switch == 0) { // Show if recordset empty ?>
  <table class="tabela_switch_uso" border="0" cellpadding="0" cellspacing="0">
  <tbody class="tbody_switch">
    <tr> 
      <td width="100%"> <h2 class="h2_t" style="color: #000">NEHUMA PORTA LISTADA NO SWITCH</h2></td>
    </tr>
  </tbody>
  </table>
  <?php } // Show if recordset empty ?>
  <div class="container">
  <table class="tabela_switch_uso" border="1" cellpadding="0" cellspacing="0" style="background-color: #353535">
  <tbody class="tbody_switch">
  <?php
  if($totalRows_pt_Switch > 0) { // Show if recordset not empty 
    do {
          if($row_pt_Switch['status'] == 0){?>
      <tr class="switch_uso">
     <td border="1" class="portas_responsivas" style="background-image: url('../img/port_0.png')">
      <a class="action" href="../portaSwitch/alterar_ptsw.php?cod_ptsw=<?php echo $row_pt_Switch['id_pt_switch']; ?>">
        <div class="item" ><b style="color: #DCDCDC"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
     </a>
    </td>
    </tr>
    <?php }if($row_pt_Switch['status'] == 1){?>
      <tr class="switch_uso">
     <td border="1" class="portas_responsivas" style="background-image: url('../img/port_1.png')">
      <a class="action" href="../portaSwitch/alterar_ptsw.php?cod_ptsw=<?php echo $row_pt_Switch['id_pt_switch']; ?>">
        <div class="item"><b style="color: #DCDCDC"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
      </a>
    </td>
      </tr>
      <?php }if($row_pt_Switch['status'] == 2){ ?>
    <tr class="switch_uso">
     <td border="1" class="portas_responsivas" style="background-image: url('../img/port_2.png')">
      <a class="action" href="../portaSwitch/alterar_ptsw.php?cod_ptsw=<?php echo $row_pt_Switch['id_pt_switch']; ?>">
        <div class="item"><b style="color: #DCDCDC"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
      </a>    
      </td>
      </tr>
      <?php }if($row_pt_Switch['status'] == 3){ ?>
    <tr class="switch_uso">
     <td border="1" class="portas_responsivas" style="background-image: url('../img/port_3.png')">
      <a class="action" href="../linkados/linkadoSwitch.php?cod_ptsw=<?php echo $row_pt_Switch['id_pt_switch']; ?>">
        <div class="item"><b style="color:#DCDCDC"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
      </a>    
      </td>
      </tr>
     <?php } }while ($row_pt_Switch = mysqli_fetch_assoc($Recordset_pt_Switch)); } // Mostrar registros se não estiver vazio ?>
  </table>
  </div>
  </div>
    <table class="tabela" border="0" cellpadding="0" cellspacing="3" >
    <tr> 
      <td class="td_exibirSwitch"><p style="display: inline-flex;font-weight: bold;">Modelo:</p><input name="modelo" style="width: 100px;" value="<?php echo $row_dados['modelo']; ?>" maxlength="60"><p style="display: inline-flex;font-weight: bold;">Serial:</p><input name="serial" style="width: 100px;" type="text" value="<?php echo $row_dados['serial']; ?>" maxlength="60">
      <p style="display: inline-flex;font-weight: bold;">Portas:</p><input style="width: 50px;" name="qtd_portas" type="number" value="<?php echo $row_dados['qtd_portas']; ?>" maxlength="60"><p style="display: inline-flex;font-weight: bold;">Portas disponíveis:</p><input style="width: 50px;" name="txt_porta_disponivel" type="number" value="<?php echo $row_count['qnt_total']; ?>" maxlength="60"></td> 
   </tr>
   <tr>
    <td><div class="legenda_switchImg" style="background-image: url('../img/port_0.png'); margin: 0;"></div><p class="legenda_switch">Porta Desconectada</p></td>
   </tr>
   <tr>
    <td><div class="legenda_switchImg" style="background-image: url('../img/port_1.png'); margin: 0;"></div><p class="legenda_switch">Porta Conectada</p></td>
   </tr>
   <tr>
    <td><div class="legenda_switchImg" style="background-image: url('../img/port_3.png'); margin: 0;"></div><p class="legenda_switch">Conectado a um Switch</p></td>
   </tr>
   <tr>
    <td><div class="legenda_switchImg" style="background-image: url('../img/port_2.png'); margin: 0;"></div><p class="legenda_switch">Porta Queimada</p></td>
   </tr>
    </table></br>
    <div class="botao"> <button type="submit" onclick="fechaEstaAtualizaAntiga()" >Voltar</button> </div>
    <input type="hidden" name="marca" value="<?php echo $row_dados['marca'] ?>">
    <input type="hidden" name="rack" value="<?php echo $row_dados_Rack['cod_rack'] ?>" > 
    <input type="hidden" name="cod_switch" value="<?php echo $cod_switch;?>">
  </form>
        </div>
      </div>
    </div>
<?php mysqli_free_result($Recordset1); ?>
  </body>
</html>