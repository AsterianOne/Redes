<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
require_once('../conexao.php');
$cod_switch = $_POST["cod_switch"];
$ip = $_POST['txt_ip'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$serial = $_POST['serial'];
$qtd_portas = $_POST['qtd_portas'];
$porta_disponivel = $_POST['txt_porta_disponivel'];
$rack = $_POST['rack'];

$alterar = mysqli_query($conn, "UPDATE switch SET ip = '$ip', marca = '$marca', modelo = '$modelo', serial = '$serial', qtd_portas = '$qtd_portas', rack = '$rack' WHERE cod_switch = '$cod_switch'")
or die("Erro no comando SQL:".mysqli_error());
mysqli_close($conn);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<link rel="stylesheet" type="text/css" href="../styles/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<title>FUNED - Sistema SARTS</title>
</head>
<body >
<div class="main" id="main">
 <div id="conteudo" style="height:auto; padding-top:0;">
    <script>
      window.onuload = fechaEstaAtualizaAntiga;
      function fechaEstaAtualizaAntiga() {
        window.opener.location.reload();
        window.close();
      }
      </script>
  <p style="text-align:center">Ramal atualizada com SUCESSO!!!</p>
  <p style="text-align:center">Clique <a href="javascript:void(0)" onclick="fechaEstaAtualizaAntiga();">aqui </a> para finalizar.</p>
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