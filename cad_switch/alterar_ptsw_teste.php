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
$rows_patch = mysqli_num_rows($Recordset_patch);
$cod_patch = $row_patch['cod_patch'];
$colunasArray = Array();
while ($row2 = mysqli_fetch_array($Recordset_patch, MYSQLI_ASSOC)) {
  $colunasArray [] =  $row2['nome_patch'];  
}

//Numero de registros
$currentPage = $_SERVER['PHP_SELF'];
$maxRows_pt_Patch = 50;
$pageNum_pt_Patch = 0;

if (isset($_GET['pageNum_pt_Patch'])) {
  $pageNum_pt_Patch = $_GET['pageNum_pt_Patch'];
}
$startRow_pt_Patch = $pageNum_pt_Patch * $maxRows_pt_Patch;

$colname_pt_Patch = "2";


?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
<script>

// Valores (a fonte aqui deve vir de um dataset customizado, porém para este exemplo trabalharei com array bidimensional)            
//  patchpanel (id patchpanel nome patchpanel - Dataset

function dtsListaPatchPanel() {
    var patchpanel = [["1", " patchpanel 1"],
                       ["2", " patchpanel 2"],
                       ["3", " patchpanel 3"]];
    return patchpanel;
}

// Obras (idObra, nomeObra, id patchpanel - Dataset
function dtsListaPortasPatch() {
    var portaspatch = [
                ["1", "PT-01", "1"],
                ["2", "PT-02", "1"],
                ["3", "PT-03", "1"],
                ["4", "PT-01", "2"],
                ["5", "PT-02", "2"],
                ["6", "PT-01", "3"],
                ["7", "PT-02", "3"]];
    return portaspatch ;
}

// Inicializando o formulário
function iniciaForm() {
    // Patch Panel
    var campoSelect = document.getElementById("cmbPatchPanel");
    limparCombo(campoSelect);
    montarCombo(campoSelect, dtsListaPatchPanel());
    // Portas Patch Panel (apenas limpa o campo)
    campoSelect = null;
    campoSelect = document.getElementById("cmbPortasPatch");
    limparCombo(campoSelect);
 }
// Modificando  patchpanel
function modificaPatchPanel(patchpanel) {
 var campoSelect = document.getElementById("cmbPortasPatch");
    limparCombo(campoSelect);
    montarCombo(campoSelect, dtsListaPortasPatch(), patchpanel);
}

// Montando o combo (SELECT)
function montarCombo(campoCombo, listaValores, filtro) {
    // Adicionar novos elementos ao campo
    if (campoCombo != null) {
        var novoElemento = document.createElement("option");
        novoElemento.value = "";
        novoElemento.text = "-- Escolha a opção --";
        campoCombo.options.add(novoElemento);
        for (var i in listaValores) {
            novoElemento = null;
            novoElemento = document.createElement("option");
            if (filtro == null || filtro == "" || listaValores[i][2] == filtro) {
                novoElemento.value = listaValores[i][0];
                novoElemento.text = listaValores[i][1];
                campoCombo.options.add(novoElemento);
            }
        }
    }
}

// Limpando o combo (SELECT)
function limparCombo(campoCombo) {
    // Limpa o campo caso existam valores
    while (campoCombo.length) {
        campoCombo.remove(0);
    }
}

function verifica(valor){
    let testeValor = document.getElementById("txt_patch")
    testeValor = testeValor.value
    console.log(testeValor)
}

</script>
</head>
<body  onload="iniciaForm();" >
<div class="main" id="main">
  <!-- Lista dados da porta -->
  Porta:<b><?php echo $row_ptswitch['pt_switch']; ?></b> - 
  Switch:<b><?php echo $row_switch['marca']; ?></b> - 
  Rack:<b><?php echo $row_rack['nome']; ?> - 
  Patch Panel:<input type="text" name="pt_panel"> <?php echo $row_ptswitch['patch_panel']; ?></input><br>
  <!-- Listar PATCH PANEL -->

<br>
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
      <br>
      <br>
      
      <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <label>Patch Panel</label>
                    <br />
                    <select name="patchpanel" id="cmbPatchPanel" onchange="modificaPatchPanel(this.value);">
                        <option value="" selected="selected"> -- Escolha a opção -- </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Portas do Patch Panel</label>
                    <br />
                    <select name="obra" id="cmbPortasPatch">
                        <option value="" selected="selected"> -- Escolha a opção -- </option>
                    </select>
                </td>
            </tr>
        </table>

  </div>
</body>
</html>