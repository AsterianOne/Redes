<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
ob_start();
$cod_ramal = $_GET['cod_ramal'];

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM ramal WHERE cod_ramal = $cod_ramal ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
$localAtual = $row_dados['setor'];

//seleciona setores
$query_dados = "SELECT * FROM setores ORDER BY cod_setor != '$localAtual', cod_setor";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);
?>

<script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
        window.close();
      }
  </script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-88"20%"9-1" />
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div class="main" id="main">
 <div id="conteudo" style="height; align-top:top; padding-top:5; margin-top:5;">
 <div class="titulo_pg" align="center">
      <h2>Atualizando Ramal: <?php echo $row_dados['numero']; ?></h2>
 </div>
  <form action="alterar_ramal2.php" name="form1" method="POST">
    <table class="tabela" border="0" cellpadding="0" cellspacing="3">
      <tr height="20">
          <td class="main_tr" style="background-color: #384d61;"  align="right"><b>Numero:</b></td>
          <td width="50%"><input name="numero" style="width: 320px" type="text" value="<?php echo $row_dados['numero']; ?>"  maxlength="30" disabled></td>
      </tr> 
      <tr>
        <td width="20%" align="right"><b>PABX:</b></td>
          <td width="50%"><input name="pabx" style="width: 320px" type="text" value="<?php echo $row_dados['pabx']; ?>" maxlength="60"></td>
        </tr>
        <tr>
        <td width="20%" align="right"><b>Rack:</b></td>  
          <td width="50%"><input name="rack" style="width: 320px" value="<?php echo $row_dados['rack']; ?>" maxlength="20"></td>
        </tr>
        <tr>
        <td width="20%" align="right"><b>Interno:</b></td> 
          <td width="50%"><input name="interno" style="width: 320px" type="text" value="<?php echo $row_dados['interno']; ?>" maxlength="20"></td>
        </tr>
        <tr> 
          <td width="20%" align="right"><b>Porta:</b></td> 
          <td width="50%"><input name="porta" style="width: 320px" type="text" value="<?php echo $row_dados['porta']; ?>" maxlength="20"></td> 
        </tr>
        <tr>
        <td width="20%" align="right"><b>Categoria:</b></td>     
          <td width="50%"><input name="categoria" style="width: 320px" type="text" value="<?php echo $row_dados['categoria']; ?>" maxlength="20"></td>
        </tr>
        <tr>
        <td width="20%" align="right"><b>Setor:</b></td>  
          <td width="50%">
          <select name="setor" style="width: 320px">
                        <?php do { ?>
                        <option value="<?php echo $row_setor['cod_setor']?>"><?php echo $row_setor['sigla']?>-<?php echo $row_setor['setor']?></option>
                            <?php
                          } while ($row_setor = mysqli_fetch_assoc($dados));
                            $rows = mysqli_num_rows($dados);
                            if($rows > 0) {
                                mysqli_data_seek($dados, 0);
                              $row_setor = mysqli_fetch_assoc($dados);
                            }else{
                              echo "Nenhum Setor cadastrado!!!";
                            }
                        ?>
                       </select>
         <!-- <input name="setor" type="text" value="<?php echo $row_dados['setor']; ?>" maxlength="20"> -->
        </td> 
        </tr>
        <tr>
        <td width="20%" align="right"><b>PT Usuario:</b></td>  
          <td width="50%"><input name="pt_usuario" style="width: 320px" type="text" value="<?php echo $row_dados['pt_usuario']; ?>" maxlength="20"></td>
        </tr>
        <tr>
        <td width="20%" align="right"><b>Grupo:</b></td>  
          <td width="50%"><input name="grupo_chamada" style="width: 320px" type="text" value="<?php echo $row_dados['grupo_chamada']; ?>" maxlength="20"></td>
        </tr>
    </table>
    <br>
    <div class="botao">
        <button type="submit" name="Submit">Atualizar</button>
    </div>      
      <input type="hidden" name="cod_ramal" value="<?php echo $cod_ramal;?>">
  </div>
<?php
mysqli_free_result($Recordset1);
?>
</div>
</body>
</html>
