<?php
require_once('../conexao.php');
$cod_patch = $_GET['cod_patch'];
$currentPage = $_SERVER['PHP_SELF'];
$maxRows_pt_Patch = 50;
$pageNum_pt_Patch = 0;

//Seleciona dados do patch panel

$query_Recordset1 = "SELECT * FROM patch_panel WHERE cod_patch = $cod_patch ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

$cod_rack = $row_dados['rack'];

//Seleciona nome do rack

$query_Recordset_Rack = "SELECT * FROM rack WHERE cod_rack = $cod_rack ";
$Recordset_Rack = mysqli_query($conn, $query_Recordset_Rack) or die(mysqli_error());
$row_dados_Rack = mysqli_fetch_assoc($Recordset_Rack);
$totalRows_Recordset_Rack = mysqli_num_rows($Recordset_Rack);

if (isset($_GET['pageNum_pt_Patch'])) {
  $pageNum_pt_Patch = $_GET['pageNum_pt_Patch'];
}
$startRow_pt_Patch = $pageNum_pt_Patch * $maxRows_pt_Patch;

$colname_pt_Patch = "2";

$query_pt_Patch = "SELECT * FROM pt_patch WHERE cod_patch = $cod_patch ORDER BY cod_pt_patch ASC"; 
$query_limit_pt_Patch = sprintf("%s LIMIT %d, %d", $query_pt_Patch, $startRow_pt_Patch, $maxRows_pt_Patch);
$Recordset_pt_Patch = mysqli_query($conn, $query_limit_pt_Patch) or die(mysqli_error());
$row_pt_Patch = mysqli_fetch_assoc($Recordset_pt_Patch);

//Verifica potas disponíveis em pt_patch

$query_countTotal = "SELECT COUNT(*) AS qnt_total FROM pt_patch WHERE cod_patch = $cod_patch AND status=0";
$Recordset_count = mysqli_query($conn, $query_countTotal) or die(mysqli_error());
$row_count = mysqli_fetch_assoc($Recordset_count);

if (isset($_GET['totalRows_pt_Patch'])) {
$totalRows_pt_Patch = $_GET['totalRows_pt_Patch'];
} else {
$all_pt_Patch = mysqli_query($conn, $query_pt_Patch);
$totalRows_pt_Patch = mysqli_num_rows($all_pt_Patch);
}

$totalPages_pt_Patch = ceil($totalRows_pt_Patch/$maxRows_pt_Patch)-1;

  $queryString_pt_Patch = "";
  if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
    $newParams = array();
      foreach ($params as $param) {
    if (stristr($param, "pageNum_pt_Patch") == false && 
    stristr($param, "totalRows_pt_Patch") == false) {
      array_push($newParams, $param);
  }
  }
  if (count($newParams) != 0) {
  $queryString_pt_Patch = "&" . implode("&", $newParams);
  }
  }
  $queryString_pt_Patch = sprintf("&totalRows_pt_Patch=%d%s", $totalRows_pt_Patch, $queryString_pt_Patch);
?>
<script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
        window.close();
      }
</script>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <title>FUNED - Sistema SARTS</title>
</head>

<body>
    <div class="main" id="main">
        <div id="conteudo" style="margin-top: 0px; padding-top: 0px">
                <div class="titulo_Switch" align="center" style="display: block">
                    <p>Patch Panel: <?php echo $row_dados_Rack['nome']; ?> - <input name="nome_patch"
                            class="input_exibirSwitch" type="text" value="<?php echo $row_dados['nome_patch']; ?>"></p>
                </div>
                <div id="exibir_switch" width=768 height=62 style="background-color: #fff; display: fixed;">
                    <?php if($totalRows_pt_Patch == 0) { //Exibir se não houver registros ?>

                    <table class="tabela_switch_uso" style="padding: 10" border="0" cellpadding="0" cellspacing="0">
                        <tbody class="tbody_switch" style="display: table">
                            <tr>
                                <td>
                                    <h2 class="h2_t" style="color: #000; padding-left: 20px; text-align: center">NEHUMA
                                        PORTA LISTADA NO SWITCH</h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php } ?>

                    <div class="container">
                        <table class="tabela_switch_uso" border="1" cellpadding="0" cellspacing="0"
                            style="background-color: #353535">
                            <tbody class="tbody_switch">
                                <?php if($totalRows_pt_Patch > 0){ do{ //Exibir se não estiver vazio
                                if($row_pt_Patch['status'] == 0){ ?>
                                <tr class="switch_uso">
                                    <td border="1" class="portas_responsivas" style="background-image: url('../img/port_0.png')">
                                    <a href="../portaPatch/alterar_ptpatch.php?cod_ptpatch=<?php echo $row_pt_Patch['cod_pt_patch']; ?>">
                                        <div class="item"><b style="color: #fff"><?php echo $row_pt_Patch['id_patch'] + $row_dados['etiqueta']; ?></b></div>
                                        </a>
                                    </td>
                                </tr>
                                <?php }if($row_pt_Patch['status'] == 1){if($row_pt_Patch['id_voice'] > 0){?>
                                <tr class="switch_uso">
                                    <td border="1" class="portas_responsivas" style="background-image: url('../img/port_4.png')">
                                    <a href="../portaPatch/alterar_ptpatch.php?cod_ptpatch=<?php echo $row_pt_Patch['cod_pt_patch']; ?>">
                                        <div class="item"><b style="color: #fff"><?php echo $row_pt_Patch['id_patch'] + $row_dados['etiqueta']; ?></b></div>
                                        </a>
                                    </td>
                                </tr>
                                <?php }else{ ?>
                                    <tr class="switch_uso">
                                    <td border="1" class="portas_responsivas" style="background-image: url('../img/port_1.png')">
                                    <a href="../portaPatch/alterar_ptpatch.php?cod_ptpatch=<?php echo $row_pt_Patch['cod_pt_patch']; ?>">
                                        <div class="item"><b style="color: #fff"><?php echo $row_pt_Patch['id_patch'] + $row_dados['etiqueta']; ?></b></div>
                                        </a>
                                    </td>
                                </tr>
                                <?php }}if($row_pt_Patch['status'] == 2){ ?>
                                <tr class="switch_uso">
                                    <td border="1" class="portas_responsivas" style="background-image: url('../img/port_2.png')">
                                    <a href="../portaPatch/alterar_ptpatch.php?cod_ptpatch=<?php echo $row_pt_Patch['cod_pt_patch']; ?>">
                                        <div class="item"><b style="color: #fff"><?php echo $row_pt_Patch['id_patch'] + $row_dados['etiqueta']; ?></b></div>
                                        </a>
                                    </td>
                                </tr>
                                <?php } }while ($row_pt_Patch = mysqli_fetch_assoc($Recordset_pt_Patch)); } // Mostrar registros se não estiver vazio ?>
                        </table>
                    </div>
                </div>
                <table class="tabela" border="0" cellpadding="0" cellspacing="3">
                    <tr>
                        <td class="td_exibirSwitch">
                            <p style="display: inline-flex;font-weight: bold;">Portas:</p><input style="width: 50px;"
                                name="qtd_portas" type="number" value="<?php echo $row_dados['qtd_portas']; ?>"
                                maxlength="60" disabled>
                            <p style="display: inline-flex;font-weight: bold;">Portas disponíveis:</p><input
                                style="width: 50px;" name="txt_porta_disponivel" type="number"
                                value="<?php echo $row_count['qnt_total']; ?>" maxlength="60" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="legenda_switchImg"
                                style="background-image: url('../img/port_0.png'); margin: 0;"></div>
                            <p class="legenda_switch">Porta Desconectado</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="legenda_switchImg"
                                style="background-image: url('../img/port_1.png'); margin: 0;"></div>
                            <p class="legenda_switch">Conectado ao Switch</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="legenda_switchImg"
                                style="background-image: url('../img/port_4.png'); margin: 0;"></div>
                            <p class="legenda_switch">Conectado ao Voice</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="legenda_switchImg"
                                style="background-image: url('../img/port_2.png'); margin: 0;"></div>
                                <p class="legenda_switch">Porta Queimada</p>
                        </td>
                    </tr>
                </table></br>
                <div class="botao"> <button type="submit" onclick="fechaEstaAtualizaAntiga()" >Voltar</button> </div>
        </div>
    </div>
    <?php mysqli_free_result($Recordset1); ?>
</body>

</html>