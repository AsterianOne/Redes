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
  <title>Uso de Portas Switch</title>
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
  $id_switch = $_GET['id_switch'];
  $currentPage = $_SERVER['PHP_SELF'];
  $maxRows_pt_Switch = 50;
  $pageNum_pt_Switch = 0;

  if (isset($_GET['pageNum_pt_Switch'])) {
    $pageNum_pt_Switch = $_GET['pageNum_pt_Switch'];
  }
  $startRow_pt_Switch = $pageNum_pt_Switch * $maxRows_pt_Switch;

  $colname_pt_Switch = "2";

  mysqli_select_db($conn, $dbname);
  $query_pt_Switch = "SELECT * FROM pt_swtich WHERE id_switch = $id_switch ORDER BY id_pt_switch ASC"; 
  $query_limit_pt_Switch = sprintf("%s LIMIT %d, %d", $query_pt_Switch, $startRow_pt_Switch, $maxRows_pt_Switch);
  $Recordset_pt_Switch = mysqli_query($conn, $query_limit_pt_Switch) or die(mysqli_error());
  $row_pt_Switch = mysqli_fetch_assoc($Recordset_pt_Switch);

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
  <?php if ($totalRows_pt_Switch == 0) { // Show if recordset empty ?>
    <table class="tabela_switch_uso" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="100%"> <h2 class="h2_t" style="color: #000">NEHUMA PORTA LISTADA NO SWITCH</h2></td>
      </tr>
    </table>
    <?php } // Show if recordset empty ?>
    <div class="container">
    <table class="tabela_switch_uso" border="1" cellpadding="0" cellspacing="0" style="background-color: #353535">
    <?php if($totalRows_pt_Switch > 0) { // Show if recordset not empty 
      do {
            if($row_pt_Switch['status'] == 0){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_0.png')">
       <div class="item" ><b style="color: #fff"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
      </td>
      </tr>
      <?php }if($row_pt_Switch['status'] == 1){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_1.png')">
       <div class="item"><b style="color: #fff"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
      </td>
        </tr>
        <?php }if($row_pt_Switch['status'] == 2){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_2.png')">
       <div class="item"><b style="color: #000"><?php echo $row_pt_Switch['pt_switch']; ?></b></div>
      </td>
        </tr>
       <?php } }while ($row_pt_Switch = mysqli_fetch_assoc($Recordset_pt_Switch)); } // Mostrar registros se não estiver vazio ?>
    </table>
    </div>

</body>
</html>
    

