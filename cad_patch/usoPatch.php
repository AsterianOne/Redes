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
  $cod_patch = $_GET['cod_patch'];
  $currentPage = $_SERVER['PHP_SELF'];
  $maxRows_pt_Patch = 50;
  $pageNum_pt_Patch = 0;

  if (isset($_GET['pageNum_pt_Patch'])) {
    $pageNum_pt_Patch = $_GET['pageNum_pt_Patch'];
  }
  $startRow_pt_Patch = $pageNum_pt_Patch * $maxRows_pt_Patch;

  $colname_pt_Patch = "2";

  mysqli_select_db($conn, $dbname);
  $query_pt_Patch = "SELECT * FROM pt_patch WHERE cod_patch = $cod_patch ORDER BY cod_pt_patch ASC"; 
  $query_limit_pt_Patch = sprintf("%s LIMIT %d, %d", $query_pt_Patch, $startRow_pt_Patch, $maxRows_pt_Patch);
  $Recordset_pt_Patch = mysqli_query($conn, $query_limit_pt_Patch) or die(mysqli_error());
  $row_pt_Patch = mysqli_fetch_assoc($Recordset_pt_Patch);

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
  <?php if ($totalRows_pt_Patch == 0) { // Show if recordset empty ?>
    <table class="tabela_switch_uso" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="100%"> <h2 class="h2_t" style="color: #000">NEHUMA PORTA LISTADA NO PATCH</h2></td>
      </tr>
    </table>
    <?php } // Show if recordset empty ?>
    <div class="container">
    <table class="tabela_switch_uso" border="1" cellpadding="0" cellspacing="0" style="background-color: #353535">
    <?php if($totalRows_pt_Patch > 0) { // Show if recordset not empty 
      do {
            if($row_pt_Patch['status'] == 0){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_0.png')">
       <div class="item" ><b style="color: #fff"><?php echo $row_pt_Patch['cod_pt_patch']; ?></b></div>
      </td>
      </tr>
      <?php }if($row_pt_Patch['status'] == 1){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_1.png')">
       <div class="item"><b style="color: #fff"><?php echo $row_pt_Patch['cod_pt_patch']; ?></b></div>
      </td>
        </tr>
        <?php }if($row_pt_Patch['status'] == 2){?>
        <tr class="switch_uso">
       <td border="1" width="30px" style="background-image: url('../img/port_2.png')">
       <div class="item"><b style="color: #000"><?php echo $row_pt_Patch['cod_pt_patch']; ?></b></div>
      </td>
        </tr>
       <?php } }while ($row_pt_Patch = mysqli_fetch_assoc($Recordset_pt_Patch)); } // Mostrar registros se não estiver vazio ?>
    </table>
    </div>

</body>
</html>
    

