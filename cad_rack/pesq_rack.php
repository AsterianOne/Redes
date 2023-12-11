<?php 
require_once('../conexao.php');
ob_start();
$cod_rack = $_GET['cod_rack'];

mysqli_select_db($conn, $dbname);
$query_Recordset_Rack = "SELECT * FROM rack WHERE cod_rack = $cod_rack ";
$Recordset_Rack = mysqli_query($conn, $query_Recordset_Rack) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset_Rack);
$totalRows_Recordset_Rack = mysqli_num_rows($Recordset_Rack);
$localAtual = $row_dados['local'];

$query_dados = "SELECT * FROM setores ORDER BY cod_setor != '$localAtual', cod_setor";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);

// SWITCH BANCO DE DADOS INICIO 
    $currentPage = $_SERVER['PHP_SELF'];
    $maxRows_Switch = 50;
    $pageNum_Switch = 0;
    if (isset($_GET['pageNum_Switch'])) {
      $pageNum_Switch = $_GET['pageNum_Switch'];
    }
    $startRow_Switch = $pageNum_Switch * $maxRows_Switch;

    $colname_Switch = "2";

    mysqli_select_db($conn, $dbname);
    $query_Switch = "SELECT * FROM switch WHERE rack = $cod_rack ORDER BY marca ASC"; 
    $query_limit_Switch = sprintf("%s LIMIT %d, %d", $query_Switch, $startRow_Switch, $maxRows_Switch);
    $Recordset_Switch = mysqli_query($conn, $query_limit_Switch) or die(mysqli_error());
    $row_Switch = mysqli_fetch_assoc($Recordset_Switch);
    

    if (isset($_GET['totalRows_Switch'])) {
      $totalRows_Switch = $_GET['totalRows_Switch'];
    } else {
      $all_Switch = mysqli_query($conn, $query_Switch);
      $totalRows_Switch = mysqli_num_rows($all_Switch);
    }

    $totalPages_Switch = ceil($totalRows_Switch/$maxRows_Switch)-1;

    $queryString_Switch = "";
    if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
      $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
      $newParams = array();
      foreach ($params as $param) {
        if (stristr($param, "pageNum_Switch") == false && 
            stristr($param, "totalRows_Switch") == false) {
          array_push($newParams, $param);
        }
      }
      if (count($newParams) != 0) {
        $queryString_Switch = "&" . implode("&", $newParams);
      }
    }
    $queryString_Switch = sprintf("&totalRows_Switch=%d%s", $totalRows_Switch, $queryString_Switch);
    ?>
<!-- SWITCH BANCO DE DADOS FINAL -->

<!-- VOICE BANCO DE DADOS INICIO -->
<?php 
    $currentPage = $_SERVER['PHP_SELF'];
    $maxRows_Voice = 50;
    $pageNum_Voice = 0;
    if (isset($_GET['pageNum_Voice'])) {
      $pageNum_Voice = $_GET['pageNum_Voice'];
    }
    $startRow_Voice = $pageNum_Voice * $maxRows_Voice;

    $colname_Voice = "2";

  mysqli_select_db($conn, $dbname);
  $query_Voice = "SELECT * FROM voice WHERE rack = $cod_rack ORDER BY nome_voice ASC"; 
  $query_limit_Voice = sprintf("%s LIMIT %d, %d", $query_Voice, $startRow_Voice, $maxRows_Voice);
  $Recordset_Voice = mysqli_query($conn, $query_limit_Voice) or die(mysqli_error());
  $row_Voice = mysqli_fetch_assoc($Recordset_Voice);

  if (isset($_GET['totalRows_Voice'])) {
  $totalRows_Voice = $_GET['totalRows_Voice'];
  } else {
  $all_Voice = mysqli_query($conn, $query_Voice);
  $totalRows_Voice = mysqli_num_rows($all_Voice);
  }

  $totalPages_Voice = ceil($totalRows_Voice/$maxRows_Voice)-1;

  $queryString_Voice = "";
  if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Voice") == false && 
        stristr($param, "totalRows_Voice") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Voice = "&" . implode("&", $newParams);
  }
  }
  $queryString_Voice = sprintf("&totalRows_Voice=%d%s", $totalRows_Voice, $queryString_Voice);
?>
 <!-- VOICE BANCO DE DADOS FINAL -->


 <!-- PATCH BANCO DE DADOS INICIO -->
  <?php
  $currentPage = $_SERVER['PHP_SELF'];
  $maxRows_Patch = 50;
  $pageNum_Patch = 0;
  if (isset($_GET['pageNum_Patch'])) {
  $pageNum_Patch = $_GET['pageNum_Patch'];
  }
  $startRow_Patch = $pageNum_Patch * $maxRows_Patch;
  
  $colname_Patch = "2";

    
  mysqli_select_db($conn, $dbname);
  $query_Patch = "SELECT * FROM patch_panel WHERE rack = $cod_rack ORDER BY nome_patch ASC"; 
  $query_limit_Patch = sprintf("%s LIMIT %d, %d", $query_Patch, $startRow_Patch, $maxRows_Patch);
  $Recordset_Patch = mysqli_query($conn, $query_limit_Patch) or die(mysqli_error());
  $row_Patch = mysqli_fetch_assoc($Recordset_Patch);


  if (isset($_GET['totalRows_Patch'])) {
    $totalRows_Patch = $_GET['totalRows_Patch'];
  } else {
    $all_Patch = mysqli_query($conn, $query_Patch);
    $totalRows_Patch = mysqli_num_rows($all_Patch);
  }

  $totalPages_Patch = ceil($totalRows_Patch/$maxRows_Patch)-1;

  $queryString_Patch = "";
  if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
      if (stristr($param, "pageNum_Patch") == false && 
          stristr($param, "totalRows_Patch") == false) {
        array_push($newParams, $param);
      }
    }
    if (count($newParams) != 0) {
      $queryString_Patch = "&" . implode("&", $newParams);
    }
  }
  $queryString_Patch = sprintf("&totalRows_Patch=%d%s", $totalRows_Patch, $queryString_Patch);
  ?>
<!-- PATCH BANCO DE DADOS FINAL -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
<style>
  .main{
    font-family: "Arial Black";
    background-image: url('../img/bg_rack.PNG') ;
    background-repeat: no-repeat;
    background-size: 100%;
  }
  .tabela_rack tr{
    background-color: #fefefe;
    height: 35px;
    background-size: 100%;
    background-repeat: no-repeat;
    padding-bottom:10px;
  }
  tr:nth-child(even){
  background-color: transparent;
  }
  .portas_uso{
    margin-right: 9px;
    color: #32CD32;
  }
  #uso_portas{
    margin-right: 9px;
    color: #32CD32;
  }
  
</style>
<script>
        function switchScreen(switchCode){
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=895,height=300,left=500,top=300`
        open(`../cad_switch/alterar_switch.php?cod_switch=${switchCode}`, 'switch', params);
        }
        function patchScreen(patchCode){
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=895,height=300,left=500,top=300`
        open(`../cad_patch/alterar_patch.php?cod_patch=${patchCode}`, 'patch', params);
        }
        function voiceScreen(voiceCode, portas){
          if(portas == 24){
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=895,height=300,left=500,top=300`
        open(`../cad_voice/alterar_voice.php?cod_voice=${voiceCode}`, 'patch', params);
      }if(portas == 50){
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=936,height=348,left=500,top=300`
        open(`../cad_voice/alterar_voice.php?cod_voice=${voiceCode}`, 'patch', params);
      }if(portas == 30){
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1250,height=310,left=330,top=300`
        open(`../cad_voice/alterar_voice.php?cod_voice=${voiceCode}`, 'patch', params);
      }else{
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=900,height=600,left=500,top=300`
        open(`../cad_voice/alterar_voice.php?cod_voice=${voiceCode}`, 'patch', params);
      }
        }
</script>
</head>
<body>
<div class="main" id="main">
 <div id="conteudo" style="margin-top: 0px; padding-top: 0px">
  <div class="titulo_rack">
      <h2 class="rack_h2" style="color: #fff;">Rack <?php echo $row_dados['nome']; ?> - <?php echo $row_setor['sigla']; ?></h2>
  </div>
  <!-- DIVISA INICIO -->

  <div class="rack_divisa">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr >
                <td width="100%" ></h2>.</td>
                </tr>
            </table>
  </div>

  <!-- DIVISA FIM -->

  <!-- SWITCH TABELA INICIO -->
  <?php if ($totalRows_Switch == 0) { // Show if recordset empty ?>
  <div class="rack_celula">
    <table class="tabela_rack" border="0" cellpadding="0" cellspacing="0">
        <tr> 
        <td width="100%"> <h2 class="rack_h2">Nenhum Switch linkado ao Rack</h2></td>
        </tr>
        </table>
  </div>
        <?php } // Show if recordset empty ?>
    <?php if ($totalRows_Switch > 0) { // Show if recordset not empty ?>
  <div class="rack_celula">
        <table class="tabela_rack" border="0" cellpadding="0" cellspacing="0">
            
        
          <?php do { 
          $cod_switch = $row_Switch['cod_switch'];

          $query_countTotal = "SELECT COUNT(*) AS qnt_total FROM pt_swtich WHERE id_switch = $cod_switch AND status=0";
          $Recordset_count = mysqli_query($conn, $query_countTotal) or die(mysqli_error());
          $row_count = mysqli_fetch_assoc($Recordset_count);

          ?>
          
          <tr  background="../img/switch.png" opacity= 0.5 >
          <td width="30%"><p class="rack_element"><b class="ip_rack"><?php echo $row_Switch['ip']; ?></b></p></td>
          <td width="50%"><p class="rack_element"><a class="action" style="color: blue" href="#" onclick="switchScreen(<?php echo $row_Switch['cod_switch']; ?>)"><?php echo $row_Switch['marca']; ?></p></a></td>
          <td width="10%"><p class="rack_element"><?php echo $row_Switch['qtd_portas']; ?></p></td>
          <td width="10%"><p class="portas_uso"><?php echo $row_count['qnt_total']; ?></p></td>
          </tr>
          
        <?php } while ($row_Switch = mysqli_fetch_assoc($Recordset_Switch));
        $row_count = 0; ?>
        </table>
  </div>
        <?php } // Mostrar registros se não estiver vazio ?>
  <!-- FIM TABELA SWITCH --->

  <!-- DIVISA INICIO -->

  <div class="rack_divisa">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr >
                <td width="100%" ></h2>.</td>
                </tr>
            </table>
  </div>
  <!-- DIVISA FIM -->

  <!-- PATCH TABELA INICIO -->
    <?php if ($totalRows_Patch == 0) { // Show if recordset empty ?>
  <div class="rack_celula">
    <table class="tabela_rack" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="100%"> <h2 class="rack_h2">Nenhum Patch Panel linkado ao Rack</h2></td>
      </tr>
    </table>
        <?php } // Show if recordset empty ?>
    <?php if ($totalRows_Patch > 0) { // Show if recordset not empty ?>
  <div class="rack_celula">
      <table class="tabela_rack" border="0" cellpadding="0" cellspacing="0">
      <?php do {
        $cod_patch = $row_Patch['cod_patch'];

        $query_countTotal = "SELECT COUNT(*) AS qnt_total FROM pt_patch WHERE cod_patch = $cod_patch AND status=0";
        $Recordset_count = mysqli_query($conn, $query_countTotal) or die(mysqli_error());
        $row_count = mysqli_fetch_assoc($Recordset_count);
                  ?>
       <tr background="../img/patch.png">
        <td width="80%"><p class="rack_element"><a class="action" style="margin-left: 12px; cursor: pointer;" onclick="patchScreen(<?php echo $row_Patch['cod_patch']; ?>)"><?php echo $row_Patch['nome_patch']; ?>: <?php echo $row_Patch['etiqueta']+1; ?> - <?php echo $row_Patch['etiqueta']+$row_Patch['qtd_portas']; ?>  </p></a></td>
        <td width="10%"><p class="rack_element"><?php echo $row_Patch['qtd_portas']; ?></p></td>
        <td width="10%"><p class="portas_uso"><?php echo $row_count['qnt_total']; ?></p> </td>
       </tr>
       <?php } while ($row_Patch = mysqli_fetch_assoc($Recordset_Patch)); 
       $row_count = 0;?>
      </table>
      <?php } // Mostrar registros se não estiver vazio ?>
  </div>
  <!-- PATCH TABELA FINAL -->

  <!-- DIVISA -->
  <div class="rack_divisa">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr ></tr>
                <td width="100%" ></h2>.</td>
            </table>
  </div>
  <!-- DIVISA -->

  <!-- VOICE TABELA INICIO -->
    <?php if ($totalRows_Voice == 0) { // Show if recordset empty ?>
  <div class="rack_celula">
    <table class="tabela_rack" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="100%"> <h2 class="rack_h2">Nenhum Voice panel linkado ao Rack</h2></td>
      </tr>
    </table>
  </div>
        <?php } // Show if recordset empty ?>
    <?php if ($totalRows_Voice > 0) { // Show if recordset not empty ?>
  <div class="rack_celula">
    <table class="tabela_rack" border="0" cellpadding="0" cellspacing="0">
      <?php do {
      $cod_voice = $row_Voice['cod_voice'];

      $query_countTotal = "SELECT COUNT(*) AS qnt_total FROM pt_voice WHERE cod_voice = $cod_voice AND status=0";
      $Recordset_count = mysqli_query($conn, $query_countTotal) or die(mysqli_error());
      $row_count = mysqli_fetch_assoc($Recordset_count);
    ?>
        <tr background="../img/voice.png">
          <div><td width="80%"><p class="rack_element"><a style="margin-left: 12px; color: #000;" href="#" onclick="voiceScreen(<?php echo $row_Voice['cod_voice']; ?>, <?php echo $row_Voice['qtd_portas']; ?>)"><?php echo $row_Voice['nome_voice']; ?></p></a></td></div>
          <div><td width="10%"><p class="rack_element"><?php echo $row_Voice['qtd_portas']; ?></p></td></div>
          <div><td width='10%'><p class="portas_uso"><?php echo $row_count['qnt_total']; ?></p></td></div>
        </tr>
       <?php } while ($row_Voice = mysqli_fetch_assoc($Recordset_Voice)); 
       $row_count = 0;?>
    </table>
      <?php } // Mostrar registros se não estiver vazio ?>
  </div>

  <!-- VOICE TABELA FINAL -->

  <!-- DIVISA -->
  <div class="rack_divisa">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td width="100%" ></h2>.</td>
                </tr>
            </table>
  </div>
  <!-- DIVISA -->
 </div>
</div>

</body>
</html>