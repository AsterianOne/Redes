<?php
require_once('../conexao.php');
$cod_voice = $_GET['cod_voice'];
$currentPage = $_SERVER['PHP_SELF'];
$maxRows_pt_Voice = 50;
$pageNum_pt_Voice = 0;

//Seleciona dados do voice panel

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM voice WHERE cod_voice = $cod_voice ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

$cod_rack = $row_dados['rack'];

//Seleciona nome do rack

$query_rack = "SELECT * FROM rack WHERE cod_rack = $cod_rack ";
$rack = mysqli_query($conn, $query_rack) or die(mysqli_error());
$row_dados_rack = mysqli_fetch_assoc($rack);
$totalRows_Rack = mysqli_num_rows($rack);

if (isset($_GET['pageNum_pt_Voice'])) {
  $pageNum_pt_Voice = $_GET['pageNum_pt_Voice'];
}
$startRow_pt_Voice = $pageNum_pt_Voice * $maxRows_pt_Voice;

$colname_pt_Voice = "2";

$query_pt_Voice = "SELECT * FROM pt_voice WHERE cod_voice = $cod_voice ORDER BY id_pt_voice ASC"; 
$query_limit_pt_Voice = sprintf("%s LIMIT %d, %d", $query_pt_Voice, $startRow_pt_Voice, $maxRows_pt_Voice);
$Recordset_pt_Voice = mysqli_query($conn, $query_limit_pt_Voice) or die(mysqli_error());
$row_pt_Voice = mysqli_fetch_assoc($Recordset_pt_Voice);

//Verifica potas disponíveis em pt_voice

$query_countTotal = "SELECT COUNT(*) AS qnt_total FROM pt_voice WHERE cod_voice = $cod_voice AND status=0";
$Recordset_count = mysqli_query($conn, $query_countTotal) or die(mysqli_error());
$row_count = mysqli_fetch_assoc($Recordset_count);

if (isset($_GET['totalRows_pt_Voice'])) {
  $totalRows_pt_Voice = $_GET['totalRows_pt_Voice'];
  } else {
  $all_pt_Voice = mysqli_query($conn, $query_pt_Voice);
  $totalRows_pt_Voice = mysqli_num_rows($all_pt_Voice);
}

$totalPages_pt_Voice = ceil($totalRows_pt_Voice/$maxRows_pt_Voice)-1;

  $queryString_pt_Voice = "";
  if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
    $newParams = array();
      foreach ($params as $param) {
        if (stristr($param, "pageNum_pt_Voice") == false && 
            stristr($param, "totalRows_pt_Voice") == false) {
          array_push($newParams, $param);
        }
      }
      if (count($newParams) != 0) {
        $queryString_pt_Voice = "&" . implode("&", $newParams);
    }
  }
  $queryString_pt_Voice = sprintf("&totalRows_pt_Voice=%d%s", $totalRows_pt_Voice, $queryString_pt_Voice);
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
  <meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
</head>
<body>
<div class="main" id="main">
  <div id="conteudo" style="margin-top: 0px; padding-top: 0px">
  <form action="./alterar_voice2.php" name="form1" method="POST">
  <div class="titulo_pg" align="center" style="display: block">
      <p>Voice: <?php echo $row_dados_rack['nome']; ?> - <input class="input_exibirSwitch" name="nome_voice" type="text" value="<?php echo $row_dados['nome_voice']; ?>"></p>
 </div>
 <div id="exibir_switch" width=768 height=62 style="background-color: #fff; display: fixed;">
  <?php if($totalRows_pt_Voice == 0) { //Show if recordset empty ?>

    <table class="tabela_switch_uso" style="padding: 10" border="0" cellpadding="0" cellspacing="0">
    <tbody class="tbody_switch" style="display: table">
    <tr> 
      <td> <h2 class="h2_t" style="color: #000; padding-left: 20px; text-align: center">NEHUMA PORTA LISTADA NO SWITCH</h2></td>
    </tr>
    </tbody>
    </table>
    <?php } // Show if recordset empty ?>
    <div class="container">
    <table class="tabela_switch_uso" border="1" cellpadding="0" cellspacing="0" style="background-color: #353535">
    <tbody class="tbody_switch">
    <?php if($totalRows_pt_Voice > 0) { // Show if recordset not empty 
      do {
            if($row_pt_Voice['status'] == 0){//exibir porta com base no código?>
        <tr class="switch_uso">
       <td border="1" class="portas_responsivas" style="background-image: url('../img/port_0.png')">
       <a href="../portaVoice/alterar_ptp.php?cod_ptp=<?php echo $row_pt_Voice['id_pt_voice']; ?>">
       <div class="item" ><b style="color: #fff"><?php echo $row_pt_Voice['id_voice']; ?></b></div>
       </a>
      </td>
      </tr>
      <?php }if($row_pt_Voice['status'] == 1){?>
        <tr class="switch_uso">
          <td border="1" class="portas_responsivas" style="background-image: url('../img/port_1.png')">
        <a href="../portaVoice/alterar_ptp.php?cod_ptp=<?php echo $row_pt_Voice['id_pt_voice']; ?>">
       <div class="item"><b style="color: #fff"><?php echo $row_pt_Voice['id_voice']; ?></b></div>
      </a>
      </td>
        </tr>
        <?php }if($row_pt_Voice['status'] == 2){?>
        <tr class="switch_uso">
          <td border="1" class="portas_responsivas" style="background-image: url('../img/port_2.png')">
        <a href="../portaVoice/alterar_ptp.php?cod_ptp=<?php echo $row_pt_Voice['id_pt_voice']; ?>">
       <div class="item"><b style="color: #fff"><?php echo $row_pt_Voice['id_voice']; ?></b></div>
        </a>
      </td>
        </tr>
        <?php }if($row_pt_Voice['status'] == 3){ ?>
    <tr class="switch_uso">
     <td border="1" class="portas_responsivas" style="background-image: url('../img/port_3.png')">
      <a class="action" href="../portaVoice/alterar_ptp.php?cod_ptsw=<?php echo $row_pt_Voice['id_pt_Voice']; ?>">
        <div class="item"><b style="color: #fff"><?php echo $row_pt_Voice['id_voice']; ?></b></div>
      </a>    
      </td>
      </tr>
       <?php } }while ($row_pt_Voice = mysqli_fetch_assoc($Recordset_pt_Voice)); } // Mostrar registros se não estiver vazio ?>
    </table>
    </div>
    </div>
    <!-- exibir porta com base no código Final -->
    <table class="tabela" border="0" cellpadding="0" cellspacing="3" >
    <tr> 
      <td class="td_exibirSwitch"><p style="display: inline-flex;font-weight: bold;">Portas:</p><input style="width: 50px;" name="qtd_portas" type="number" value="<?php echo $row_dados['qtd_portas']; ?>" maxlength="60"><p style="display: inline-flex;font-weight: bold;">Portas disponíveis:</p><input style="width: 50px;" type="number" value="<?php echo $row_count['qnt_total']; ?>" maxlength="60"></td></td>
      <tr>
      <td><div class="legenda_switchImg" style="background-image: url('../img/port_0.png'); margin: 0;"></div><p class="legenda_switch">Porta Desconectada</p></td>
      </tr>
      <tr>
      <td><div class="legenda_switchImg" style="background-image: url('../img/port_1.png'); margin: 0;"></div><p class="legenda_switch">Porta Conectada</p></td>
      </tr>
      <tr>
      <td><div class="legenda_switchImg" style="background-image: url('../img/port_3.png'); margin: 0;"></div><p class="legenda_switch">Conectada a um Voice</p></td>
      </tr>
      <tr>
      <td><div class="legenda_switchImg" style="background-image: url('../img/port_2.png'); margin: 0;"></div><p class="legenda_switch">Porta Queimada</p></td>
    <tr>
    </table><br>
    <div class="botao">
        <button type="submit" onclick="fechaEstaAtualizaAntiga()">Voltar</button>
    </div>      
    <input type="hidden" name="cod_voice" value="<?php echo $cod_voice;?>">
    <input type="hidden" name="rack" value="<?php echo $row_dados_rack['cod_rack'] ?>" > 
  </form>
  </div>
<?php mysqli_free_result($Recordset1);?>
</div>
</body>
</html>