<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="/styles/menu.css">
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <title>Cadastrar</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: Arial;
            background-color: #e4e4e4;
        }
        .tabela{
        width: 80%;
        }
    </style>
 </head>
 <body>
    <main class="main">
    <div class="header">
    <div class="cabecalho">
      <div id="img">
        <img src="../img/logo.png">
      </div>
      <div id="cabecalho_texto">
        <h1>Sistema SARTS</h1>
        <h3>Gerenciamento de ativos - Rede e Telefonia</h3>
            </div>
        </div>
    </div>
<form method="POST" class="cad_item"  action="../login/cad_login2.php">
            <div class="card_login">
                <div class="login">
                    <h1>cadastrar</h1>
                    <div class="username_camp">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required="required" placeholder="Nome e Sobrenome...">
                    </div>
                    <div class="username_camp">
                    <label for="usuario">Usuário:</label>
                    <input type="text" name="usuario" required="required" placeholder="Usuário...">
                    </div>
                    <div class="password_camp">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" required="required" placeholder="Senha...">
                    </div>
                    <label for="acesso">Tipo de Acesso</label>
                    <select name="acesso_select" id="acesso_select">
                        <option value="usuario">
                            Usuário
                        </option>
                        <option value="admin">
                            Admin
                        </option>
                    </select>
                    <div class="button_camp" >
                    <button type="submit" name="btn_login" class="btn_login" value="Cadastrar">Cadastrar</button>
                        <a href="./lst_usuario.php">
                        <button type="button" name="btn_login" class="btn_voltar">
                            Voltar
                        </button></a>
                    </div>
                </div>
            </div>

            </form>
    </div>

    </main>
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
