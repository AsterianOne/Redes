<!-- Seleciona Rack's --->
<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
require_once('../conexao.php'); 
ob_start();
mysqli_select_db($conn, $dbname);
?>
<!DOCTYPE html>
<html lang="ptbr" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <meta charset="utf-8">
    <title>Cadastro Patch Panel</title>
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
        <div id="box_cad">
            <div class="titulo_cad">
                <h2>Cadastrar Setor</h2>
            </div>
            <form method="POST" class="cad_item" action="./cad_setor2.php">
                <table class="tabela" border="0" cellpadding="0" cellspacing="3">
                    <tr height="20">
                        <td width="20%" align="right"><b>Setor:</b></td>
                        <td width="50%"><input name="txt_setor" type="text" value="" maxlength="60" style="width: 250px">
                        </td>
                    </tr>
                    <tr height="20">
                        <td width="20%" align="right"><b>Sigla:</b></td>
                        <td width="50%"><input style="width: 250px" name="txt_sigla" type="text" maxlength="60"></td>
                    </tr>
                </table>
                <br>
                <div class="botao">
                    <button type="submit" name="Cadastrar">Cadastrar</button>
                    <a href="./lst_setor.php"><button type="button" name="Cancelar">Cancelar</button></a>
                </div>
            </form>
        </div>
    </div>
    <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>
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