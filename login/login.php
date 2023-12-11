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
            <div id="box_login">
                <div class="login_message">
              <?php
                  ob_start();
                  require_once('../conexao.php');	
                  $usuario = $_POST['usuario'];
                  $senha = $_POST['senha'];

                  /* Verifica se existe usuario */
                  $sql_logar = "SELECT * FROM usuario WHERE usuario = '$usuario' && senha = MD5('$senha')";
                  $exe_logar = mysqli_query($conn, $sql_logar) or die (mysql_error());
                  $fet_logar = mysqli_fetch_assoc($exe_logar);
                  $num_logar = mysqli_num_rows($exe_logar);

                  //--Verifica se n existe uma linha com o login e a senha digitado 
                  if($num_logar == 0){
                    echo "Usuário ou Senha inválido.";
                    echo "<br><a href='javascript:window.history.go(-1)'>Clique aqui para voltar.</a>";   

                  } 
                  //verifica se é admin ou usuario.
                  elseif($fet_logar['tipo'] == "admin") {
                  session_start();
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['type'] = $fet_logar['tipo'];
                    
                    header("Location:../login/principal_adm.php");
                    
                  } 

                  //verifica se é admin ou usuario.
                  elseif($fet_logar['tipo'] == "usuario") {
                  session_start();
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['type'] = $fet_logar['tipo'];

                    header("Location:../index.php");
                    
                  } 
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