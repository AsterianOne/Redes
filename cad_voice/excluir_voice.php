<?php
//Conecta ao banco de dados e recebe cod_voice
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
include "../conexao.php"; 
ob_start();
$id = $_GET['cod_voice'];

// Seleciona os dados das portas voice
$pt_voice = "SELECT * FROM pt_voice WHERE id_voice='$id'";
$dados_pt_voice = mysqli_query($conn, $pt_voice) or die(mysqli_error());

//Atualiza portas do patch
$atualiza_pt_patch = mysqli_query($conn, "UPDATE pt_patch SET status = '0', id_voice = ' ' WHERE id_voice = '$id'") or die("Erro no comando SQL:".mysqli_error());

//Deleta portas do voice
$del_portas = mysqli_query($conn,"DELETE FROM pt_voice WHERE cod_voice='$id'") or die(mysqli_error());

//Deleta voice
$del_voice = mysqli_query($conn,"DELETE FROM voice WHERE cod_voice='$id'") or die (mysqli_error());
?>

<html>
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
            <div id="box_cad">
                <?php
                echo "<br><br><div align=center><font face=Arial size=2>Voice excluído com Sucesso!
                <br><br><a href='./lst_voice.php'>[ Voltar]</a> </font></div><br>";
                ?>
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