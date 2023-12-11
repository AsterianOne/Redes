<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
$cod_setor = $_GET['cod_setor'];

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM setores WHERE cod_setor = $cod_setor ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>

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
            <div class="titulo_pg" style="display: block;">
                <h2>Atualizando Setor</h2>
            </div>
            <form action="alterar_setor2.php" name="form1" method="POST">
                <table class="tabela" border="0" cellpadding="0" cellspacing="3">
                    <tr>
                        <td width="20%" align="right"><b>Setor:</b></td>
                        <td width="50%" ><input name="setor" type="text" style="width: 320px" value="<?php echo $row_dados['setor']; ?>"
                                maxlength="60"></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right"><b>Sigla:</b></td>
                        <td width="50%"><input name="sigla" style="width: 320px" value="<?php echo $row_dados['sigla']; ?>" maxlength="20">                      
                        </td>
                    </tr>
                </table>
                <br>
                <div class="botao">
                    <button type="submit" name="Submit">Atualizar</button>
                </div>
                <input type="hidden" name="cod_setor" value="<?php echo $cod_setor;?>">
        </div>
        <?php
        mysqli_free_result($Recordset1);
        ?>
    </div>
</body>

</html>
<?php }else{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css" />
</head>
<body>
    <div class="main" id="main">
    <div class="header">
            <div class="cabecalho">
                <div id="img">
                    <a href="../">
                        <img src="../img/logo.png">
                    </a>
                </div>
                <div id="cabecalho_texto">
                    <h1>Sistema SARTS</h1>
                    <h3>Gerenciamento de ativos - Rede e Telefonia</h3>
                </div>
        </div>
    </div>
        <div id="conteudo" style="">
            <h1 style="text-align:center;">Nível de acesso Insuficiente</h1>
            <h3 style="text-align:center; margin-top: 8px;"><a href="#" onclick="history.go(-1);">Clique aqui para retornar</a></h3>
        </div>
        <div id="rodape" style="padding-bottom: 50px">

        </div>
    </div>
    <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>

</body>

<?php } ?>