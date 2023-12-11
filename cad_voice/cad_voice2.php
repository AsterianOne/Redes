<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
include_once("../conexao.php");
ob_start();


        //Declaração de variáveis
        $nome_voice= $_POST['txt_nome_voice'];
        $rack = $_POST['txt_rack'];
        $qtd_portas = $_POST['txt_qtd_portas'];
        $id_vc = $_POST['txt_nome_voice'] . rand(); 
        
        //Cadastrar VOICE
        $result_voice = "INSERT INTO voice(nome_voice, rack, qtd_portas,id_vc) VALUES ('$nome_voice', '$rack', '$qtd_portas', '$id_vc')";
        $resultado = mysqli_query($conn, $result_voice);
        
        //Seleciona cod_voice
        $vc_cod = mysqli_query($conn, "SELECT * FROM voice WHERE id_vc = '$id_vc'"); 
        $row = mysqli_fetch_array($vc_cod);
        $cod_voice = $row['cod_voice'];
        $pt_voice_portas = $row['qtd_portas'];

        //Lista as portas a ser cadastradas
        $pt_pt = range(0 , $pt_voice_portas);

        //Cadastrar portas do patch
        for($x=1; $x<count($pt_pt); $x++){
        $query_dados = sprintf("INSERT INTO pt_voice(id_voice, cod_voice, rack) VALUES ('$x', '$cod_voice', '$rack')");
        $dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
        }
    ?>
<html>
<!DOCTYPE html>
<html lang="ptbr" dir="ltr">

<head>
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <meta charset="utf-8">
    <title>Cadastro de Voice</title>
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
                echo "<br><br><div align=center><font face=Arial size=2>Voice cadastrado com Sucesso!
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