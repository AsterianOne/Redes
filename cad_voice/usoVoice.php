<?php 
require_once('../sessao/sessao.php');
require_once('../conexao.php');
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
  <title>Uso de Portas Patch</title>
    <style>
        body{
        background-color: #fff;
        display: fixed;
        }
        tbody{
         display: flex;
         flex-wrap: wrap;
         width: 768px;
        }
        tbody tr{
            padding-top: 12px;
        }  
        .tabela_switch_uso{
            padding: 10px;
        }
        tr:nth-child(even){
         background-color: transparent;
        }
        table {
	      border: thin default ridge; padding: 1;
	      empty-cells: show;
        width: 0;
        }
    </style>
</head>
<body>
  <?php
  $cod_voice = $_GET['cod_voice'];
  $currentPage = $_SERVER['PHP_SELF'];
  $maxRows_pt_Voice = 50;
  $pageNum_pt_Voice = 0;

  if (isset($_GET['pageNum_pt_Voice'])) {
    $pageNum_pt_Voice = $_GET['pageNum_pt_Voice'];
  }
  $startRow_pt_Voice = $pageNum_pt_Voice * $maxRows_pt_Voice;

  $colname_pt_Voice = "2";

  mysqli_select_db($conn, $dbname);
  $query_pt_Voice = "SELECT * FROM pt_voice WHERE cod_voice = $cod_voice ORDER BY id_pt_voice ASC"; 
  $query_limit_pt_Voice = sprintf("%s LIMIT %d, %d", $query_pt_Voice, $startRow_pt_Voice, $maxRows_pt_Voice);
  $Recordset_pt_Voice = mysqli_query($conn, $query_limit_pt_Voice) or die(mysqli_error());
  $row_pt_Voice = mysqli_fetch_assoc($Recordset_pt_Voice);

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
  <?php if ($totalRows_pt_Voice == 0) { // Show if recordset empty ?>
    <table class="tabela_switch_uso" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="100%"> <h2 class="h2_t" style="color: #000">NEHUMA PORTA LISTADA NO VOICE</h2></td>
      </tr>
    </table>
    <?php } // Show if recordset empty ?>
    <div class="container">
    <table class="tabela_switch_uso" border="1" cellpadding="0" cellspacing="0" style="background-color: #353535">
    <?php if($totalRows_pt_Voice > 0) { // Show if recordset not empty 
      do {
            if($row_pt_Voice['status'] == 0){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_0.png')">
       <div class="item" ><b style="color: #fff"><?php echo $row_pt_Voice['id_pt_voice']; ?></b></div>
      </td>
      </tr>
      <?php }if($row_pt_Voice['status'] == 1){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_1.png')">
       <div class="item"><b style="color: #fff"><?php echo $row_pt_Voice['id_pt_voice']; ?></b></div>
      </td>
        </tr>
        <?php }if($row_pt_Voice['status'] == 2){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_2.png')">
       <div class="item"><b style="color: #000"><?php echo $row_pt_Voice['id_pt_voice']; ?></b></div>
      </td>
        </tr>
       <?php } }while ($row_pt_Voice = mysqli_fetch_assoc($Recordset_pt_Voice)); } // Mostrar registros se não estiver vazio ?>
    </table>
    </div>

</body>
</html>
    

