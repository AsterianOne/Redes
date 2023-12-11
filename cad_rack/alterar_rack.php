<?php
require_once('../conexao.php');
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
$cod_rack = $_GET['cod_rack'];

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM rack WHERE cod_rack = $cod_rack ";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
$localAtual = $row_dados['local'];

$query_dados = "SELECT * FROM setores ORDER BY cod_setor != '$localAtual', cod_setor";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_setor = mysqli_fetch_assoc($dados);
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
                <h2>Atualizando Rack: <?php echo $row_dados['cod_rack']; ?></h2>
            </div>
            <form action="alterar_rack2.php" name="form1" method="POST">
                <table class="tabela" border="0" cellpadding="0" cellspacing="3">
                    <tr>
                        <td width="20%" align="right"><b>Nome do Rack:</b></td>
                        <td width="50%" ><input name="nome" type="text" style="width: 320px" value="<?php echo $row_dados['nome']; ?>"
                                maxlength="60"></td>
                    </tr>
                    <tr>
                        <td width="20%" align="right"><b>Local:</b></td>
                        <td width="50%">                       
                        <select name="local" style="width: 320px">
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
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" align="right"><b>Bloco:</b></td>
                        <td width="50%"><input name="bloco" style="width: 320px" value="<?php echo $row_dados['bloco']; ?>" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" align="right"><b>chave:</b></td>
                        <td width="50%"><input name="chave" style="width: 320px" value="<?php echo $row_dados['chave']; ?>" maxlength="20">
                        </td>
                    </tr>
                </table>
                <br>
                <div class="botao">
                    <button type="submit" name="Submit">Atualizar</button>
                </div>
                <input type="hidden" name="cod_rack" value="<?php echo $cod_rack;?>">
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