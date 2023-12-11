<!DOCTYPE html>
<html lang="en">
 <head>
    <link rel="stylesheet" href="/styles/menu.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <title>Login - Sistema SARTS</title>
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
    </style>
 </head>
 <body>
    <main class="main">
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
    <div class="card_login">
        <form method="POST" action="./login.php">
                <div class="login">
                    <h1>Login</h1>
                    <div class="username_camp">
                    <label for="usuario">Usuário:</label>
                    <input type="text" name="usuario" required="required" placeholder="Usúario...">
                    </div>
                    <div class="password_camp">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" required="required" placeholder="Senha...">
                    </div>
                    <div class="button_camp" >
                        <button type="submit" name="btn_login" value="btn_login" class="btn_login">
                            Logar
                        </button>
                        <a href="../">
                        <button type="button" name="btn_voltar" class="btn_voltar" value="btn_voltar">
                            Voltar
                        </button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="rodape">
    <h3>Copyright © 2023 Fundação Ezequiel Dias.
     Todos os direitos reservados.
     Aspectos legais e responsabilidades
     Política de privacidade.
  </div>
    </main>
 </body>
</html>