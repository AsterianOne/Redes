<?php
    require_once("../sessao/sessao.php");
    if($_SESSION['type'] == 'admin'){
    include "../conexao.php"; //Conecta com o banco de dados MySQL
    ob_start();

    $id = $_GET['cod_rack'];

    //Excluir o Switch e portas do Switch
    $excluirPtSwitch = mysqli_query($conn, "DELETE FROM pt_swtich WHERE rack = '$id'" )or die("Erro no comando SQL:".mysqli_error());
    $excluirSwitch = mysqli_query($conn, "DELETE FROM switch WHERE rack = '$id'" )or die("Erro no comando SQL:".mysqli_error());

    //Excluir o Patch e portas do Patch
    $excluirPtPatch = mysqli_query($conn, "DELETE FROM pt_patch WHERE rack = '$id'" )or die("Erro no comando SQL:".mysqli_error());
    $excluirPatch = mysqli_query($conn, "DELETE FROM patch_panel WHERE rack = '$id'" )or die("Erro no comando SQL:".mysqli_error());

    //Excluir o Voice e portas do Voice
    $excluirPtVoice = mysqli_query($conn, "DELETE FROM pt_voice WHERE rack = '$id'" )or die("Erro no comando SQL:".mysqli_error());
    $excluirVoice = mysqli_query($conn, "DELETE FROM voice WHERE rack = '$id'" )or die("Erro no comando SQL:".mysqli_error());

    //Excluir Rack
    $excluirRack= mysqli_query($conn, "DELETE FROM rack WHERE cod_rack='$id'")or die("Erro no comando SQL:".mysqli_error());
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
            <div id="box_cad">
                <?php
                echo "<br><br><div align=center><font face=Arial size=2>Rack excluído com Sucesso!
                <br><br><a href='./lst_rack.php'>[ Voltar]</a> </font></div><br>";
                ?>
            </div>
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