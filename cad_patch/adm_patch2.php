<?php 
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
require_once('../conexao.php');
ob_start();
$cod_patch = $_POST["cod_patch"];
$nome = $_POST['nome_patch'];
$rack = $_POST['select_rack'];
$etiqueta = $_POST['etiqueta'];

$alterar = mysqli_query($conn, "UPDATE patch_panel SET nome_patch = '$nome', rack = '$rack', etiqueta='$etiqueta' WHERE cod_patch = '$cod_patch'")
or die("Erro no comando SQL:".mysqli_error());
mysqli_close($conn);
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <title>FUNED - Sistema SARTS</title>
</head>

<body>
    <div class="main" id="main">
        <div id="conteudo" style="height:auto; padding-top:0;">
            <script>
            window.onuload = fechaEstaAtualizaAntiga;

            function fechaEstaAtualizaAntiga() {
                window.opener.location.reload();
                window.close();
            }
            </script>
            <p style="text-align:center">Patch Panel atualizado com SUCESSO!!!</p>
            <p style="text-align:center"><a href="javascript:void(0)" onclick="fechaEstaAtualizaAntiga();">aqui Clique aqui para finalizar.</a></p>
        </div>
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