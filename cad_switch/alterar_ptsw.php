<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
ob_start();

//Seleciona dados da porta
$cod_ptsw = $_GET['cod_ptsw'];

$query_ptswitch = "SELECT * FROM pt_swtich WHERE id_pt_switch = '$cod_ptsw'";
$ptswitch = mysqli_query($conn, $query_ptswitch) or die(mysqli_error());
$row_ptswitch = mysqli_fetch_assoc($ptswitch);
$totalDadosgeral = mysqli_num_rows($ptswitch);
$cod_switch = $row_ptswitch['id_switch'];

//Seleciona dados da SWITCH
$query_switch = "SELECT * FROM switch WHERE cod_switch = '$cod_switch'";
$switch = mysqli_query($conn, $query_switch) or die(mysqli_error());
$row_switch = mysqli_fetch_assoc($switch);
$totalDadosgeral = mysqli_num_rows($switch);
$cod_rack = $row_switch['rack'];

//Seleciona dados da RACK
$query_rack = "SELECT * FROM rack WHERE cod_rack = '$cod_rack'";
$dados_rack = mysqli_query($conn, $query_rack) or die(mysqli_error());
$row_rack = mysqli_fetch_assoc($dados_rack);
$totalDadosrack = mysqli_num_rows($dados_rack);


//seleciona dados patch panel
$query_Recordset_patch = "SELECT * FROM patch_panel WHERE rack = '$cod_rack' ORDER BY nome_patch ASC";
$Recordset_patch = mysqli_query($conn, $query_Recordset_patch) or die(mysqli_error());
$row_patch = mysqli_fetch_assoc($Recordset_patch);
$cod_patch = $row_patch['cod_patch'];
?>

<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div class="main" id="main">
  <!-- Lista dados da porta -->
  Porta:<b><?php echo $row_ptswitch['pt_switch']; ?></b> - 
  Switch:<b><?php echo $row_switch['marca']; ?></b> - 
  Rack:<b><?php echo $row_rack['nome']; ?> - 
  Patch Panel:<input type="text" name="pt_panel"> <?php echo $row_ptswitch['patch_panel']; ?></input><br>
  <!-- Listar PATCH PANEL -->
      Patch panel: 
      <form name="form_porta" method="POST" action="<?php echo $PHP_SELF ?>">
      <select name="txt_patch" id="txt_patch" onchange="verifica(this.value)">
        <option value="off">Selecione o Patch Panel </option>
        <?php do { ?>
            <option value="<?php echo $row_patch['cod_patch']?>" ><?php echo $row_patch['cod_patch']?>-<?php echo $row_patch['nome_patch'];?></option>
              <?php
                  } while ($row_patch = mysqli_fetch_assoc($Recordset_patch));
                      $rows = mysqli_num_rows($Recordset_patch);
                        if($rows > 0) {
                          mysqli_data_seek($Recordset_patch, 0);
                            $row_dados = mysqli_fetch_assoc($Recordset_patch);
                        }else{
                          echo 'Nenhum patch cadastrado!!!';
                } ?>
      </select>
      </form>
    <br>
    <!-- Teste listar dados array -->
    <?php

// Numeric array

$sql = "SELECT * FROM patch_panel WHERE rack = '$cod_rack' ORDER BY nome_patch ASC";
$result = mysqli_query($conn,$sql);
$row10 = mysqli_fetch_array($result, MYSQLI_NUM);
printf ("%s (%s)\n", $row10[0], $row10[1], );

// Associative array
$row10 = mysqli_fetch_array($result, MYSQLI_ASSOC);
printf ("%s (%s)\n", $row10["cod_patch"], $row10["nome_patch"]);

// Free result set
mysqli_free_result($result);

mysqli_close($conn);
?>


    <div class="botao"> <button type="submit" name="Submit" >Atualizar</button> </div>
    <input type="hidden" name="marca" value="<?php echo $row_ptswitch['id_switch'] ?>">
   </div>
</body>
</html>