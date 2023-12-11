<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
ob_start();
$cod_patch = $_GET['cod_patch'];

$query_Recordset1 = "SELECT * FROM patch_panel WHERE cod_patch = $cod_patch ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$rackAtual = $row_dados['rack'];

$query_dados = "SELECT * FROM rack ORDER BY cod_rack != '$rackAtual', cod_rack";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_rack = mysqli_fetch_assoc($dados);
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <title>FUNED - Sistema SARTS</title>
</head>

<body>
    <div class="main" id="main">
        <div id="conteudo" style="margin-top: 0px; padding-top: 0px">
            <div class="titulo_pg" style="text-align: center; display: block;">
                <h2>Atualizando Patch: <?php echo $row_dados['cod_patch']; ?></h2>
            </div>
            <form action="adm_patch2.php" name="form1" method="POST">
                <table class="tabela" border="0" cellpadding="0" cellspacing="3">
                        <td width="20%" align="right"><b>Nome:</b></td>
                        <td width="50%"><input name="nome_patch" type="text"
                                value="<?php echo $row_dados['nome_patch']; ?>" maxlength="60"></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right"><b>Rack:</b></td>
                        <td width="50%">

                        <select name="select_rack" style="width: 173px;">
                        <?php do { 
                            $localAtual = $row_rack['local'];

                            $query_dados = "SELECT * FROM setores ORDER BY cod_setor != '$localAtual', cod_setor";
                            $dados_setor = mysqli_query($conn, $query_dados) or die(mysqli_error());
                            $row_setor = mysqli_fetch_assoc($dados_setor);?>
                        <option value="<?php echo $row_rack['cod_rack']?>"><?php echo $row_rack['cod_rack']?> - <?php echo $row_rack['nome']?> - <?php echo $row_setor['sigla'];?></option>
                            <?php
                          } while ($row_rack = mysqli_fetch_assoc($dados));
                            $rows = mysqli_num_rows($dados);
                            if($rows > 0) {
                                mysqli_data_seek($dados, 0);
                              $row_rack = mysqli_fetch_assoc($dados);
                            }else{
                              echo "Nenhum rack cadastrado!!!";
                            }
                        ?>
                </select>
                </td>
                    </tr>
                    <tr>
                        <td width="20%" align="right"><b>Etiqueta:</b></td>
                        <td width="50%">
                            <input name="etiqueta" type="text"  value="<?php echo $row_dados['etiqueta']; ?>" maxlength="60">
                        </td>
                        </tr>

                </table>
                <br>
                <div class="botao">
                    <button type="submit" name="Submit">Atualizar</button>
                    <button type="button" name="button" onclick="fechaEstaAtualizaAntiga();">Cancelar</button>
                </div>
                <input type="hidden" name="cod_patch" value="<?php echo $cod_patch;?>">
            </form>
        </div>
        <?php
        mysqli_free_result($Recordset1);
        ?>
    </div>
</body>

</html>