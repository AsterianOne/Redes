<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
?>
<!DOCTYPE html>
<html lang="ptbr" dir="ltr">
  <head>
      <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <meta charset="utf-8">
    <title>Cadastro de Usuario</title>
  </head>
  <body>
<?php
    require_once('../conexao.php');
    $nome= $_POST['nome'];
    $usuario= $_POST['usuario'];
    $senha= $_POST['senha'];
    $acesso= $_POST['acesso_select'];    
try{
    $result_usuario = "INSERT INTO usuario(nome, usuario, senha, tipo) VALUES ('$nome', '$usuario', MD5('$senha'), '$acesso')";
    $cadastro = mysqli_query($conn, $result_usuario);

    if(mysqli_affected_rows($conn) != 0){
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://172.16.101.67/sarts/login/lst_usuario.php'>        
        <script type='text/javascript'>
            alert('Cadastrado com Sucesso.');
        </script>
        ";
    }
}catch(Exception $erro){
        echo "<script type='text/javascript'> alert('Usuario já existente, Favor inserir outro Usuario.');</script>;
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://172.16.101.67/sarts/login/cad_login.php'>";
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
