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
$patch_referencia = $row_ptswitch['cod_pt_patch'];
$pt_cod_patch = $row_ptswitch['cod_patch'];

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
$localrack = $row_rack['local'];

//seleciona dados patch panel
$query_Recordset_patch = "SELECT * FROM patch_panel WHERE rack = '$cod_rack' ORDER BY nome_patch ASC";
$Recordset_patch = mysqli_query($conn, $query_Recordset_patch) or die(mysqli_error());
$row_patch = mysqli_fetch_assoc($Recordset_patch);

$query_Recordset_patch_nome = "SELECT nome_patch FROM patch_panel WHERE cod_patch = '$pt_cod_patch'";
$Recordset_patch_nome = mysqli_query($conn, $query_Recordset_patch_nome) or die(mysqli_error());
$row_patch_nome = mysqli_fetch_assoc($Recordset_patch_nome);

$query_Recordset_pt_patch = "SELECT * FROM pt_patch WHERE cod_pt_patch = '$patch_referencia'";
$Recordset_pt_patch = mysqli_query($conn, $query_Recordset_pt_patch) or die(mysqli_error());
$row_pt_patch = mysqli_fetch_assoc($Recordset_pt_patch);

//Conecta com setores
$query_dados = "SELECT * FROM setores WHERE cod_setor = $localrack";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
</head>
<body >
<div class="main" id="main">
<div id="conteudo" style="margin-top: 0px; padding-top: 0px">
  <!-- Lista dados da porta -->
  <div class="titulo_pg" align="center" style="display: block">
  <p style="padding: 5px 0;"><b>Rack:</b> <?php echo $row_rack['nome']; ?> - <?php echo $row_setor['sigla']; ?> </p>
  <p style="padding: 5px 0;"><b>Switch:</b> <?php echo $row_switch['marca']; ?> - <b>Porta Switch:</b> <?php echo $row_ptswitch['pt_switch']; ?></p> 
  <p style="padding: 5px 0;"><b>Patch Panel:</b> <?php if($row_patch_nome == null){echo "Desconectado";}else{echo $row_patch_nome['nome_patch'];} ?> - <b>Porta Patch: <?php if($row_pt_patch == null){echo "Desconectado";}else{echo $row_pt_patch['id_patch'];} ?></b> <?php ?></p>
</div>
 <form action="./alterar_ptsw2.php" id="form1" method="POST">
    <label><b>Selecione o Patch Panel:</b></label>
    <select name="txt_patch" id="txt_patch" onchange="ativar()">
    <?php if($row_patch['cod_patch'] != null){ $cod_patch = $row_patch['cod_patch'];?>
          <option value="">Selecione o Patch Panel </option>
          <?php do { ?>
            <!-- Listar os PATCH PANELS -->
              <option value="<?php echo $row_patch['cod_patch']?>" ><?php echo $row_patch['nome_patch'];?></option>
                <?php
                    } while ($row_patch = mysqli_fetch_assoc($Recordset_patch));
                        $rows = mysqli_num_rows($Recordset_patch);
                          if($rows > 0) {
                            mysqli_data_seek($Recordset_patch, 0);
                              $row_dados = mysqli_fetch_assoc($Recordset_patch);
                          }else{
                            echo 'Nenhum patch cadastrado!!!';
                          }}else{ ?>
                            <option value="desconectado" ><?php echo "nenhum patch cadastrado";?></option>
                          <?php }?>
      </select>
      <br>
  <!-- Listar PORTAS DO PATCH PANEL -->
      <label><b>Selecione a porta:</b></label>
      <select id="cmbLista" name="cod_pt_patch" disabled>
      <option style="display: flex" value="<?php echo $row_ptswitch['cod_pt_patch'] ?>">Selecine o Patch Panel</option>
        <script>
          function ativar() {
          var selectId = document.getElementById('txt_patch');
          selectId.value == "" ? document.getElementById('cmbLista').setAttribute("disabled", "disabled") : document.getElementById('cmbLista').removeAttribute('disabled');
        }
        </script>
      </select>

<!-- AJAX enviar ptsw e retornar as portas -->
    <script type="text/javascript">
      $(document).ready(function() {
          $('#txt_patch').change(function(e) {
              $('#cmbLista').empty();
              var id = $(this).val();
              $.post('./listarPortas_ptsw.php', {cod_patch:id}, function(data){
                  var cmb = '<option value="">Selecione o Patch</option>';
                  $.each(data, function(index, value){
                    // console.log(value)
                    if(value.status == 0){
                      cmb = cmb + '<option value="'+ value.cod_pt_patch+ '">' + value.id_patch + '</option>';
                      '<input type="hidden" name="statusPatch" value="'+ value.status +'">'
                    }
                  });
                  $('#cmbLista').html(cmb);
              }, 'json');
          });
      });
    </script>
    <br>
    <label><b>Definir status da porta</b></label>
    <select name="definirStatus" id="definirStatus">
      <option value="1">Ativado</option>
      <option value="0">Desativado</option>
      <option value="2">Queimado</option>
      <option value="3">Linkado</option>
    </select>
    
    <div class="botao" style="margin-top: 10px">
    <!-- verifica se o form tem as informações para ser enviado -->
    <script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
      }
      let checkPt = document.getElementById('cmbLista');
      checkPt = checkPt.value;
      
      function enviarForm(){
      let check = document.getElementById("definirStatus");
      check = check.value;
      let checkTxt = document.getElementById('txt_patch');
      checkTxt = checkTxt.value;
      var auxliar = document.getElementById('cmbLista');
      auxliar = auxliar.value;
      if(check == 1 && checkTxt == "" || check == 1 && checkPt == auxliar){
        console.log(checkPt)
        fechaEstaAtualizaAntiga();
      }else{
        document.getElementById('cmbLista').removeAttribute('disabled');
        document.getElementById('form1').submit();
      }};

      $('#cmbLista').change(function(e){
        var mandarPOST = document.getElementById('cmbLista');
        mandarPOST = mandarPOST.value;
        if(mandarPOST == 0 || mandarPOST == null){
          '<input type="hidden" name="id_pt_switch" value="<?php echo $row_ptswitch['id_pt_switch'] ?>">'
        }
      })
      function fechaAtualiza(){
        window.opener.location.reload();
        history.go(-1);
      }
    </script>
    <button type="button" name="enviar" href="#" onclick="enviarForm()">Atualizar</button>
    <button type="button" name="button" onclick="fechaAtualiza()">Cancelar</button>
    </div>
    <input type="hidden" name="id_pt_switch" value="<?php echo $row_ptswitch['id_pt_switch'] ?>">
    <input type="hidden" name="id_switch" value="<?php echo $row_ptswitch['id_switch'];?>">
    </form>
  </div>
   </div>
</body>
</html>