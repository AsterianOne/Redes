<!-- conecta ao BD -->
<?php
    include("../sessao/sessao.php");
    if($_SESSION['type'] == 'admin'){
    include "../conexao.php";
    ob_start();

 //Seleciona codigo do patch 
    $id = $_GET['cod_patch'];

//Atualiza portas do switch
    $atualiza_pt_switch = mysqli_query($conn, "UPDATE pt_swtich SET cod_pt_patch = '0',  cod_patch = '0', status = '0' WHERE cod_patch = '$id'")
    or die("Erro no comando SQL:".mysqli_error());

//Atualiza portas do voice
    $atualiza_pt_voice = mysqli_query($conn, "UPDATE pt_voice SET cod_pt_patch = '0', cod_patch = '0' , status = '0' WHERE cod_patch = '$id'")
    or die("Erro no comando SQL:".mysqli_error());

//Deletar portas do patch
    $del_portas = mysqli_query($conn,"DELETE FROM pt_patch WHERE cod_patch='$id'") or die(mysqli_error());

//Deleta patch panel
  $del_patch = mysqli_query($conn,"DELETE FROM patch_panel WHERE cod_patch='$id'") or die (mysqli_error());
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
                echo "<br><br><div align=center><font face=Arial size=2>Path Painel excluído com Sucesso!
                <br><br><a href='./lst_patch.php'>[ Voltar]</a> </font></div><br>";
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