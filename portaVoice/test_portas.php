<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
ob_start();

//Seleciona dados da porta
$cod_ptp = $_GET['cod_ptp'];

$query_ptvoice = "SELECT * FROM pt_voice WHERE id_pt_voice = '$cod_ptp'";
$ptvoice = mysqli_query($conn, $query_ptvoice) or die(mysqli_error());
$row_ptvoice = mysqli_fetch_assoc($ptvoice);
$totalDadosgeral = mysqli_num_rows($ptvoice);
$cod_voice = $row_ptvoice['cod_voice'];
$patch_referencia = $row_ptvoice['cod_pt_patch'];
$pt_cod_patch = $row_ptvoice['cod_patch'];

//Seleciona dados da VOICE
$query_voice = "SELECT * FROM voice WHERE cod_voice = '$cod_voice'";
$voice = mysqli_query($conn, $query_voice) or die(mysqli_error());
$row_voice = mysqli_fetch_assoc($voice);
$totalDadosgeral = mysqli_num_rows($voice);
$cod_rack = $row_voice['rack'];

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

$query_Recordset_patch_nome = "SELECT * FROM patch_panel WHERE cod_patch = '$pt_cod_patch'";
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
  <p style="padding: 5px 0;"><b>Voice:</b> <?php echo $row_voice['nome_voice']; ?> - <b>Porta Voice:</b> <?php echo $row_ptvoice['id_voice'];?></p> 
  <p style="padding: 5px 0;"><b>Patch Panel:</b> <?php if($row_patch_nome == null){echo "Desconectado";}else{echo $row_patch_nome['nome_patch'];} ?> - <b>Porta Patch: <?php if($row_pt_patch == null){echo "Desconectado";}else{echo $row_pt_patch['id_patch'] + $row_patch_nome['etiqueta'];} ?></b></p>
</div>
 <!-- Listar PATCH PANEL -->
 <form action="#" name="form1" method="POST">
    <label><b>Selecione o Patch Panel:</b></label>
    <select name="txt_patch" id="txt_patch" onchange="ativar()">
    <?php if($row_patch['cod_patch'] != null){ $cod_patch = $row_patch['cod_patch'];?>
          <option value="">Selecione o Patch Panel </option>
          <?php do { ?>
              <option value="<?php echo $row_patch['cod_patch']?>, <?php echo $row_patch['etiqueta']?>" ><?php echo $row_patch['nome_patch'];?></option>
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
      <option style="display: flex" value="<?php echo $row_ptvoice['cod_pt_patch'] ?>">Selecione a porta</option>
        <script>
          function ativar() {
          let selectId = document.getElementById('txt_patch');
          //ativa e desetiva a seleção de portas
          selectId.value == "" ? document.getElementById('cmbLista').setAttribute("disabled", "disabled") : document.getElementById('cmbLista').removeAttribute('disabled');
        }
        </script>
      </select>

      
<!-- AJAX enviar ptsw e retornar as portas -->
    <script type="text/javascript">
      $(document).ready(function() {
        //inicia a função a qualquer mudança no select txt_patch
          $('#txt_patch').change(function(e) {
            //esvazia o select cmbLista
              $('#cmbLista').empty();
              //coleta o array contido no value do txt_patch
              let valores = $(this).val();
              //separa o array
              valores = valores.split(',');
              //seleciona o cod_patch do array
              let id = valores[0];
              //transforma o valor da etiqueta em um numero na base10
              let mod = parseInt(valores[1], 10);
              //envia para o resgate das portas disponiveis com base no txt_patch
              $.post('./listarPortas_ptp.php', {cod_patch:id}, function(data){
                //cria uma option como base
                  var cmb = '<option value="">Selecione a porta</option>';
                  //laço de repetição para a criação das options
                  $.each(data, function(index, value){
                    // console.log(value)
                    // transforma o valor da porta em um numero
                    let v1 = parseInt(value.id_patch, 10);
                      //cria uma option com base na porta disponivel resgatada anteriormente
                      cmb = cmb + `<option value="${value.cod_pt_patch}"> ${v1 + mod}</option>`;
                      '<input type="hidden" name="statusPatch" value="'+ value.status +'">'
                  });
                  //imprime no html a cmbLista
                  $('#cmbLista').html(cmb);
                  //informa em que tipo de arquivo deve transformar as informações
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
    <script>
      function enviarForm(){
      //pega o valor dos selects
      let checkPt = document.getElementById('cmbLista').value;
      let checkStatus = document.getElementById("definirStatus").value;
      //Verifica se a porta está selecionada
      if(checkPt == 0 || checkPt == null){
        //caso a porta não esteja seleciona verifica o valor do STATUS
        if(checkStatus == 1){
          //caso o status seja igual a 1 não há alteração e retorna a pagina anterior
            history.back()
        }else{
          //caso o status seja diferente de 1 envia para fazer alterações
        document.getElementById("verificar").value = 1
        document.getElementById('cmbLista').removeAttribute('disabled');
        document.forms['form1'].submit();
        }
      }
      else{
        //caso a porta esteja selecionada envia para alteração
        document.forms['form1'].submit();
      }
    };
    </script>
    <button type="button" name="enviar" onclick="enviarForm()">Atualizar</button> 
    <button type="button" name="button" onclick="history.back()">Cancelar</button>
    </div>
        <input type="hidden" name="id_pt_voice" value="<?php echo $row_ptvoice['id_pt_voice'] ?>">
        <input type="hidden" name="id_voice" value="<?php echo $row_ptvoice['cod_voice'];?>">
        <input type="hidden" id="verificar" name="verificar" value="0">
    </form>
  </div>
   </div>
</body>
</html>