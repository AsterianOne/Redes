<?php
//conexao com o banco de dados
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
include_once("../conexao.php");
ob_start();
//Declaração de variáveis
    $ip = $_POST['txt_ip'];
    $switch = $_POST['txt_switch'];
    $modelo = $_POST['txt_modelo'];
    $serial = $_POST['txt_serial'];
    $patrimonio = $_POST['txt_patrimonio'];
    $qtd_portas= $_POST['txt_qtd_portas'];
    $local = $_POST['txt_rack'];
    $id_swt = $serial . $local; 

//Cadastrar switch
    $result_switch = "INSERT INTO switch(ip, marca, modelo, serial, patrimonio, qtd_portas, rack, id_swt) VALUES ('$ip', '$switch','$modelo', '$serial', '$patrimonio', '$qtd_portas', '$local', '$id_swt')";
    $resultado = mysqli_query($conn, $result_switch);

//Selecionar o código do switch
    $switch_cod = mysqli_query($conn, "SELECT * FROM switch WHERE id_swt='$id_swt'"); 
    $row = mysqli_fetch_array($switch_cod);
    $cod_switch = $row['cod_switch'];
    $pt_switch_portas = $row['qtd_portas'];

//Lista as portas a ser cadastradas
    $pt_sw = range(0 , $pt_switch_portas);
// Cadastrar portas Switch    
    for($x=1; $x<count($pt_sw); $x++){
      $query_dados = sprintf("INSERT INTO pt_swtich(pt_switch, id_switch, rack) VALUES ('$x', '$cod_switch', '$local')");
      $dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
    }
?>
<html>
<!DOCTYPE html>
<html lang="ptbr" dir="ltr">

<head>
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Switch</title>
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
                echo "<br><br><div align=center><font face=Arial size=2>Switch cadastrado com Sucesso!
                <br><br><a href='./lst_switch.php'>[Voltar]</a> </font></div><br>";
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