<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
?>
<!DOCTYPE html>
<html lang="ptbr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cadastro de Ramal</title>
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
      <link rel="stylesheet" type="text/css" href="../styles/estilo.css" />
  </head>
  <body>
    <div class="form-ramal">
      <h2>Cadastrar Ramal</h2>
<?php
    include_once("../conexao.php");
    $numero= $_POST['txt_numero'];
    $pabx = $_POST['txt_pabx'];
    $interno= $_POST['txt_interno'];
    $categoria = $_POST['txt_categoria'];
    $setor = $_POST['txt_local'];
    $grupo_chamada = $_POST['txt_grupo_chamada'];

    $result_ramal = "INSERT INTO ramal(numero, pabx, interno, categoria, setor, grupo_chamada) VALUES ('$numero', '$pabx', '$interno', '$categoria', '$setor', '$grupo_chamada')";
    $resultado = mysqli_query($conn, $result_ramal);
    

    if(mysqli_affected_rows($conn) != 0){
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=./lst_ramal.php'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <script type='text/javascript'>
                        alert('Ramal cadastrado com Sucesso.');
                    </script>
                ";    
            }else{
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=./lst_ramal.php'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <script type='text/javascript'>
                        alert('O Ramal não foi cadastrado com Sucesso.');
                    </script>
                ";    
            }
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