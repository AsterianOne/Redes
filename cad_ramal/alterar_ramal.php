<?php
//estabelece as conexões
include("../sessao/sessao.php");
require_once('../conexao.php');
ob_start();

//Pega o código do ramal
$cod_ramal = $_GET['cod_ramal'];

mysqli_select_db($conn, $dbname);
//SELECIONA RAMAL
$query_Recordset1 = "SELECT * FROM ramal WHERE cod_ramal = $cod_ramal ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

//voice e patch anteriormente conectados
$portaVoice = $row_dados['porta'];
$portaPatch = $row_dados['pt_usuario'];

//SELECIONA SETOR
$cod_setor = $row_dados['setor'];                   
$query_dados = "SELECT * FROM setores WHERE cod_setor = '$cod_setor'";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);

//SELECIONA RACKS
$rackAtual = $row_dados['rack'];
$query_racks = "SELECT * FROM rack ORDER BY cod_rack != '$rackAtual', nome";
$dados_rack = mysqli_query($conn, $query_racks) or die(mysqli_error());
$row_dados_rack = mysqli_fetch_assoc($dados_rack);
$totalRows_rack = mysqli_num_rows($dados_rack);

//SETORES LISTAR
$query_listarSetores = "SELECT * FROM setores ORDER BY cod_setor != '$cod_setor', cod_setor";
$listarSetores = mysqli_query($conn, $query_listarSetores) or die(mysqli_error());
$row_listarSetores = mysqli_fetch_assoc($listarSetores);

//verifica se já existe conexão
if(isset($portaVoice) AND is_numeric($portaVoice)){

//faz a peesquisa no banco de dados com base no código já conectado
$query_PTvoice = "SELECT * FROM pt_voice WHERE id_pt_voice = '$portaVoice'";
$voicePTinfo = mysqli_query($conn, $query_PTvoice) or die(mysql_error());
$row_PTvoice = mysqli_fetch_assoc($voicePTinfo);

//verifica se é possivel buscar no BD o voice já conectado
if(isset($row_PTvoice['cod_voice'])){
$cod_voice = $row_PTvoice['cod_voice']; 

//conecta com o voice já conectado
$query_voice = "SELECT * FROM voice WHERE cod_voice = '$cod_voice'";
$voiceInfo = mysqli_query($conn, $query_voice) or die(mysql_error());
$row_voiceInfo = mysqli_fetch_assoc($voiceInfo);
$row_voiceNumVoices = mysqli_num_rows($voiceInfo);

//SELECIONA OS VOICES EXISTENTES NO CASO DE JÁ ESTAR CONECTADO A ALGUM RACK
$query_voices_existentes = "SELECT * FROM voice WHERE rack = '$rackAtual' ORDER BY cod_voice != '$cod_voice'";
$dados_existsVoices = mysqli_query($conn, $query_voices_existentes) or die(mysql_error());
$row_voiceExistentes = mysqli_fetch_assoc($dados_existsVoices);

//SELECIONA AS PORTAS DO VOICE SE JÁ HOUVER UMA CONEXÃO
$query_existsPtVoice = "SELECT * FROM pt_voice WHERE cod_voice = '$cod_voice' AND status = 0 OR cod_voice = '$cod_voice' AND id_pt_voice = '$portaVoice'";
$dados_existsPtVoices = mysqli_query($conn, $query_existsPtVoice) or die(mysql_error());
$row_voicePtsExists = mysqli_fetch_assoc($dados_existsPtVoices);
}};

//verifica se já existe conexão
if(isset($portaPatch) AND is_numeric($portaPatch)){

//faz a peesquisa no banco de dados com base no código já conectado
$query_PTpatch = "SELECT * FROM pt_patch WHERE cod_pt_patch = '$portaPatch'";
$patchPTinfo = mysqli_query($conn, $query_PTpatch) or die(mysql_error());
$row_PTpatch = mysqli_fetch_assoc($patchPTinfo);

//verifica se é possivel buscar no BD o patch já conectado
if(isset($row_PTpatch['cod_patch'])){
$cod_patch = $row_PTpatch['cod_patch']; 

//conecta com o patch já conectado
$query_patch = "SELECT * FROM patch_panel WHERE cod_patch = '$cod_patch'";
$patchInfo = mysqli_query($conn, $query_patch) or die(mysql_error());
$row_patchInfo = mysqli_fetch_assoc($patchInfo);

//SELECIONA OS PATCHS EXISTENTES NO CASO DE JÁ ESTAR CONECTADO A ALGUM RACK
$query_existsPatch = "SELECT * FROM patch_panel WHERE rack = '$rackAtual' ORDER BY cod_patch != '$cod_patch'";
$dados_existsPatch = mysqli_query($conn, $query_existsPatch) or die(mysql_error());
$row_patchsExistentes = mysqli_fetch_assoc($dados_existsPatch);

//SELECIONA AS PORTAS DO PATCH SE JÁ HOUVER UMA CONEXÃO
$query_existsPtPatch = "SELECT * FROM pt_patch WHERE cod_patch = '$cod_patch' AND status = 0 OR cod_patch = '$cod_patch' AND cod_pt_patch = '$portaPatch'";
$dados_existsPtPatchs = mysqli_query($conn, $query_existsPtPatch) or die(mysql_error());
$row_patchPtsExists = mysqli_fetch_assoc($dados_existsPtPatchs);
}};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-88"20%"9-1" />
  <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
  <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
  <title>FUNED - Sistema SARTS</title>
 </head>
<body >
<div class="main" id="main">
 <div id="conteudo" style="padding-top: 0; margin-top: 0;">
 <div class="titulo_pg" style="display: block;">
    <table>
      <tr>  
        <td colspan="8">
          <h2>Ramal:<?php echo $row_dados['numero']; ?></h2>
        </td>
      </tr>
      <tr align="center">
        <!-- NOMES DOS CAMPOS DA TABELA -->
          <td><font color="#FFFFFF"><b>PABX</b></font></td>
          <td><font color="#FFFFFF"><b>Rack</b></font></td>
          <td><font color="#FFFFFF"><b>Interno</b></font></td>
          <td><font color="#FFFFFF"><b>Voice</b></font></td>
          <td><font color="#FFFFFF"><b>Categoria</b></font></td>
          <td><font color="#FFFFFF"><b>Setor</b></font></td>
          <td><font color="#FFFFFF"><b>Usuário</b></font></td>
          <td><font color="#FFFFFF"><b>Grupo de chamada</b></font></td>
      </tr>
      <tr align="center" >
        <!-- VALORES DOS CAMPOS DA TABELA -->
          <td><font color="#FFFFFF"><?php if($row_dados['pabx']) {echo $row_dados['pabx'];} ?></font></td>
          <td><font color="#FFFFFF"><?php if(isset($rackAtual) AND is_numeric($rackAtual)){echo $row_dados_rack['nome'];} ?></font></td>
          <td><font color="#FFFFFF"><?php echo $row_dados['interno']; ?></font></td>
          <td><font color="#FFFFFF"><?php if(isset($row_voicePtsExists)){ echo $row_voiceInfo['nome_voice'];} ?> - <?php if(isset($row_voicePtsExists)){ echo $row_PTvoice['id_voice'];} ?></font></td>
          <td><font color="#FFFFFF"><?php echo $row_dados['categoria']; ?></font></td>
          <td><font color="#FFFFFF"><?php echo $row_setor['sigla']; ?></font></td>
          <td><font color="#FFFFFF"><?php if(isset($row_patchInfo)){ echo $row_PTpatch['id_patch'] + $row_patchInfo['etiqueta'];} ?></font></td>
          <td><font color="#FFFFFF"><?php echo $row_dados['grupo_chamada']; ?></font></td>
      </tr>
    </table>
    <p>&nbsp;</p>
 </div>
  <form action="alterar_ramal2.php" name="form1" method="POST">
    <table class="tabela" border="0" cellpadding="0" cellspacing="2">
        <tr height="30">
          <td width="20%" style="background-color: #384d61; color:#FFF;" align="left"><b>PABX:</b>
            <input name="pabx" style="width:30%" type="text" value="<?php echo $row_dados['pabx']; ?>">
          </td>
          <td width="20%" colspan="2" align="left"><b>Interno:</b>
            <input name="interno" style="width:15%" type="text" value="<?php echo $row_dados['interno']; ?>">
          </td>

        </tr> 
        <tr height="30"> 
          <td width="20%" colspan="2" align="left"><b>Rack:</b>       
            <select style="width:30%" name="rack" id="txt_rack">
            <!-- VERIFICA SE JÁ HA CONEXÃO, CASO HAJA PASSA PELA PRIMEIRA option -->
            <?php if(!is_numeric($row_dados['rack'])){ ?> <option value=""><?php echo 'Selecione o Rack' ?></option> <?php } ?>
            <!-- EXIBE TODOS OS RACKS EXISTENTES NA TABELA -->
            <?php do { ?>
                        <option value="<?php echo $row_dados_rack['cod_rack'];?>"><?php echo $row_dados_rack['nome'];?></option>
                            <?php
                          } while ($row_dados_rack = mysqli_fetch_assoc($dados_rack));
                            if($totalRows_rack > 0) {
                                mysqli_data_seek($dados_rack, 0);
                              $row_dados_rack = mysqli_fetch_assoc($dados_rack);
                            }else{
                              echo "Nenhum rack cadastrado!!!";
                            } ?>
            </select>
          </td>
        </tr>
        <tr height="30"> 
          <td width="20%" align="left">
            <b>Voice:</b>
            <select style="width:50%" id="cmb_voice" name="voice">
            <!-- VERIFICA A EXISTENCIA DE UMA CONEXÃO COM O VOICE, CASO HAJA EXIBE OS VALORES JÁ EXISTENTES -->
            <?php if(isset($row_voicePtsExists)){ do { ?>
              <option value="<?php if(isset($row_voicePtsExists)){echo $row_voiceExistentes['cod_voice'];} ?>"><?php if(isset($row_voicePtsExists)){echo $row_voiceExistentes['nome_voice'];}?></option>
              <?php }while($row_voiceExistentes = mysqli_fetch_assoc($dados_existsVoices));
                 $row_allVoices = mysqli_num_rows($dados_existsVoices);
                   if($row_allVoices > 0) {
                   mysqli_data_seek($dados_existsVoices, 0);
                   $row_voiceExistentes = mysqli_fetch_assoc($dados_existsVoices);
                   }
                } ?>
            </select>
          </td>
          <td width="20%" align="left"><b>Porta:</b>
            <select style="width:20%" id="cmb_PTvoice" name="pt_voice" required>
            <!-- VERIFICA A EXISTENCIA DE UMA CONEXÃO COM O VOICE, CASO HAJA EXIBE OS VALORES JÁ EXISTENTES -->
            <?php if(isset($row_voicePtsExists)){ do { ?>
             <option value="<?php if(isset($row_voicePtsExists)){echo $row_voicePtsExists['id_pt_voice'];} ?>"><?php if(isset($row_voicePtsExists)){echo $row_voicePtsExists['id_voice'];}?></option>
             <?php }while($row_voicePtsExists = mysqli_fetch_assoc($dados_existsPtVoices));
                 $row_allPtVoice = mysqli_num_rows($dados_existsPtVoices);
                   if($row_allPtVoice > 0) {
                   mysqli_data_seek($dados_existsPtVoices, 0);
                   $row_voicePtsExists = mysqli_fetch_assoc($dados_existsPtVoices);
                   }
                } ?>
            </select>
          </td>   
        </tr>
        <tr height="30"> 
          <td width="20%" align="left"><b>Patch:</b>
           <select style="width:50%" id="cmb_patch" name="patch">
           <!-- VERIFICA A EXISTENCIA DE UMA CONEXÃO COM O PATCH, CASO HAJA EXIBE OS VALORES JÁ EXISTENTES -->
              <?php if(isset($row_patchsExistentes)){ do{ ?>
              <option value="<?php if(isset($row_patchsExistentes)){echo $row_patchsExistentes['cod_patch']; ?>, <?php echo $row_patchsExistentes['etiqueta']; }?>"><?php if(isset($row_patchsExistentes)){echo $row_patchsExistentes['nome_patch'];} ?></option>
              <?php }while($row_patchsExistentes = mysqli_fetch_assoc($dados_existsPatch));
              $row_allPatchs = mysqli_num_rows($dados_existsPatch);
              if($row_allPatchs > 0){
                mysqli_data_seek($dados_existsPatch, 0);
                $row_patchsExistentes = mysqli_fetch_assoc($dados_existsPatch);
              } 
            } ?>
            </select>
          </td>
          <td width="20%" align="left"><b>Porta:</b>
            <select style="width:20%" id="cmb_PTpatch" name="pt_usuario" required>
          <!-- VERIFICA A EXISTENCIA DE UMA CONEXÃO COM O PATCH, CASO HAJA EXIBE OS VALORES JÁ EXISTENTES -->
            <?php if(isset($row_patchsExistentes)){ do { ?>
              <option value="<?php if(isset($row_patchsExistentes)){echo $row_patchPtsExists['cod_pt_patch'];} ?>"><?php if(isset($row_patchsExistentes)){echo $row_patchPtsExists['id_patch'] + $row_patchInfo['etiqueta'];} ?></option>
            <?php }while($row_patchPtsExists = mysqli_fetch_assoc($dados_existsPtPatchs));
              $row_allPtPatchs = mysqli_num_rows($dados_existsPtPatchs);
              if($row_allPtPatchs > 0){
                mysqli_data_seek($dados_existsPtPatchs, 0);
                $row_patchPtsExists = mysqli_fetch_assoc($dados_existsPtPatchs);
              } 
            } ?>
            </select>
          </td>
        </tr>
        <tr height="30">
          <td width="20%" align="left"><b>Categoria:</b>
            <input name="categoria" style="width:11%" type="text" value="<?php echo $row_dados['categoria']; ?>">
          </td>
          <td width="20%" align="left">
            <b>Grupo de Chamada:</b>
            <input name="grupo_chamada" style="width:20%" type="text" value="<?php echo $row_dados['grupo_chamada']; ?>">
          </td>
        </tr>
        <tr height="30"> 
          <td width="50%" colspan="2" align="left">
            <b>Setor:</b>
            <select style="width: 90%;" name="setor" >
            <!-- FAZ A EXIBIÇÃO DOS SETORES DO BD, LISTANDO O PRIMEIRO COMO O JÁ CONECTADO CASO HAJA CONEXÃO -->
                        <?php do { ?>
                        <option value="<?php echo $row_listarSetores['cod_setor']?>"><?php echo $row_listarSetores['sigla']?>-<?php echo $row_listarSetores['setor']?></option>
                            <?php
                          } while ($row_listarSetores = mysqli_fetch_assoc($listarSetores));
                            $rows = mysqli_num_rows($listarSetores);
                            if($rows > 0) {
                                mysqli_data_seek($listarSetores, 0);
                              $row_listarSetores = mysqli_fetch_assoc($listarSetores);
                            }else{
                              echo "Nenhum Setor cadastrado!!!";
                            } ?>
              </select>
            </td>
        </tr>
    </table>
    <br>
    <div class="botao">
        <button type="submit" name="Submit">Atualizar</button>
    </div> 
    <!-- VALORES OCULTOS ESSENCIAS PARA A DESCONECXÃO -->
      <input type="hidden" name="cod_ramal" value="<?php echo $cod_ramal;?>">     
      <input type="hidden" name="voicePtAntigo" value="<?php echo $portaVoice;?>">
      <input type="hidden" name="patchPtAntigo" value="<?php echo $portaPatch;?>">
  </div>
  <?php mysqli_free_result($Recordset1); ?>
  </div>
 </body>
</html>
<script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
        window.close();
      }

      // AJAX enviar Rack e retornar Voices e Patchs -->

      //PROCURA OS VOICES EM SEGUNDO PLANO
      $(document).ready(function() {
          $('#txt_rack').change(function(e) {
              $('#cmb_voice').empty();
              var id = $(this).val();
              $.post('./listar.php', {cod_rack:id}, function(data){
                  var cmb = '<option value="">Selecione o Voice</option>';
                  $.each(data, function(index, value){
                    //console.log(value)
                    if(value){
                      cmb = cmb + '<option value="'+ value.cod_voice+ '">' + value.nome_voice + '</option>';
                    }
                  });
                  $('#cmb_voice').html(cmb);
              }, 'json');
          });
      });

      //PROCURA AS PORTAS DO VOICE EM SEGUNDO PLANO
      $(document).ready(function() {
        //inicia a função a qualquer mudança no select txt_patch
          $('#cmb_voice').change(function(e) {
            //esvazia o select cmbLista
              $('#cmb_PTvoice').empty();
              //coleta o array contido no value do txt_patch
              let valores = $(this).val();
              //separa o array
              valores = valores.split(',');
              //seleciona o cod_voice do array
              let id = valores[0];
              //transforma o valor da etiqueta em um numero na base10
              let mod = parseInt(valores[1], 10);
              //envia para o resgate das portas disponiveis com base no txt_patch
              $.post('./listarPortas_voice.php', {cod_voice:id}, function(data){
                //cria uma option como base
                  var cmb_PTvoice = '<option value="">Selecione a porta</option>';
                  //laço de repetição para a criação das options
                  $.each(data, function(index, value){
                    // transforma o valor da porta em um numero
                    let v1 = parseInt(value.cod_voice, 10);
                      //cria uma option com base na porta disponivel resgatada anteriormente
                      cmb_PTvoice = cmb_PTvoice+ `<option value="${value.id_pt_voice}"> ${value.id_voice}</option>`;
                      '<input type="hidden" name="statusPatch" value="'+ value.status +'">'
                  });
                  //imprime no html a cmbLista
                  $('#cmb_PTvoice').html(cmb_PTvoice);
                  //informa em que tipo de arquivo deve transformar as informações
              }, 'json');
          });
      });

      // PROCURA OS PATCHS EM SEGUNDO PLANO
      $(document).ready(function() {
          $('#txt_rack').change(function(e) {
              $('#cmb_patch').empty();
              var id = $(this).val();
              $.post('./listar_patch.php', {cod_rack:id}, function(data){
                  var cmb = '<option value="">Selecione o Patch</option>';
                  $.each(data, function(index, value){
                    //console.log(value)
                    if(value){
                      cmb = cmb + `<option value=" ${[value.cod_patch, value.etiqueta]} "> ${value.nome_patch} </option>`;
                    }
                  });
                  $('#cmb_patch').html(cmb);
              }, 'json');
          });
      });
      
      // PROCURA AS PORTAS DO PATCHS EM SEGUNDO PLANO
      $(document).ready(function() {
        //inicia a função a qualquer mudança no select txt_patch
          $('#cmb_patch').change(function(e) {
            //esvazia o select cmbLista
              $('#cmb_PTpatch').empty();
              //coleta o array contido no value do txt_patch
              let valores = $(this).val();
              //separa o array
              valores = valores.split(',');
              //seleciona o cod_patch do array
              let id = valores[0];
              //transforma o valor da etiqueta em um numero na base10
              let mod = parseInt(valores[1], 10);
              //envia para o resgate das portas disponiveis com base no txt_patch
              $.post('./listarPortas_patch.php', {cod_patch:id}, function(data){
                //cria uma option como base
                  var cmb_PTpatch = '<option value="">Selecione a porta</option>';
                  //laço de repetição para a criação das options
                  $.each(data, function(index, value){
                    // transforma o valor da porta em um numero
                    let v1 = parseInt(value.id_patch, 10);
                      //cria uma option com base na porta disponivel resgatada anteriormente
                      cmb_PTpatch = cmb_PTpatch + `<option value="${value.cod_pt_patch}"> ${v1 + mod}</option>`;
                      '<input type="hidden" name="statusPatch" value="'+ value.status +'">'
                  });
                  //imprime no html a cmbLista
                  $('#cmb_PTpatch').html(cmb_PTpatch);
                  //informa em que tipo de arquivo deve transformar as informações
              }, 'json');
          });
      });
</script>