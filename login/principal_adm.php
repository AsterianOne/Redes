<?php
include("../sessao/sessao.php");
ob_start();
if($_SESSION['type'] == 'admin'){
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Vagner da Silva Moreira - 3314-4508"/>
<meta name="reply-to" content="vagner.moreira@funed.mg.gov.br"/>
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
   <title>FUNED - Sistema SARTS</title>
</head>
<body>
<main class="main" id="main">
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
      <div class="login_img">
                <a href="../login/index.php"><img src="../img/restrito.png"></a>
      </div>
    </div>
    <nav class="main_nav">
    <div class="navbar_link-toggle" style="margin-center: 60px">
      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#9e2243}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>    
      </div>
      <nav class="itens_nav">
        <div class="menu">
        <div id="index_ul">
        <ul class="menu_ul" style="margin-left: 0px;">
          <li><a href="#">Cadastro</a>
            <ul>
            <li><a href="../login/lst_usuario.php">Usuario</a></li>
              <li><a href="../area">Area</a></li>
              <li><a href="../bloco">Bloco</a></li>
              <li><a href="../cad_setor/lst_setor.php">Setor</a></li>
              <li><a href="../cad_rack/lst_rack.php">Rack</a>
              <li><a href="../cad_switch/lst_switch.php">Switch</a>
              <li><a href="../cad_patch/lst_patch.php">Path panel</a></li>
              <li><a href="../cad_voice/lst_voice.php">Voice panel</a></li> 
              <li><a href="../cad_ramal/lst_ramal.php">Ramal</a></li>
              <li><a href="../planta">Planta</a></li>
            </ul>
          </li>
          <li><a href="#">Mapa</a>
            <ul>
              <li><a href="../mapa/global">Global</a></li>
              <li><a href="../mapa/bloco">Bloco </a></li>
            </ul>
            <li><a href="../sessao/logout.php">Sair</a></li>
          </li>
        </ul>
        </div>
      </div>
   </nav>
  </nav>
  </nav>
  <script>
    function classToggle() {
    const navs = document.querySelectorAll('.itens_nav')

    navs.forEach(nav => nav.classList.toggle('navbar_toggleShow'));
        }

        document.querySelector('.navbar_link-toggle')
      .addEventListener('click', classToggle);
    </script>
  </div>
<div id="conteudo_main"> 
      <div id="main_adm">
      <div class="manege_buttons">
      <label style="font-size: 14px"><b>Backup</b></br><a title="Backup" id="cad_backupImg" href="../pasta_backup/backup.php"></a></label>
      <label style="font-size: 14px"><b>Usuario</b></br><a title="Usuario" id="cad_usuariosImg" href="../login/lst_usuario.php"></a></label>
      </div>
        <div class="element_adm">
              <a href="../cad_rack/lst_rack.php"><img src="../img/rack2.png" alt=""  width="200" height="500"/></a>
              <div class="element_button">
              <a id="cad_rackImg" href="../cad_rack/cad_rack.php" ><p><b>Cadastrar</b></p></a> <a id="alterar_rackImg" href="../cad_rack/lst_rack.php"><p><b>Alterar</b></p></a>
              </div>     
      </div>
      <div class="elements_adm">
      <div class="element_adm"> 
              <a href="../cad_switch/lst_switch.php"><img src="../img/switch2.png" alt=""/></a>
              <div class="element_button">
              <a id="cad_switchImg" href="../cad_switch/cad_switch.php"><p><b>Cadastrar</b></p></a> <a id="alterar_switchImg" href="../cad_switch/lst_switch.php"><p><b>Alterar</b></p></a>     
              </div>
      </div>
      <div class="element_adm">
            <a href="../cad_patch/lst_patch.php"><img src="../img/patchpanel.png" alt="" /></a>
            <div class="element_button">
            <a id="cad_patchImg" href="../cad_patch/cad_patch.php"><p><b>Cadastrar</b></p></a> <a id="alterar_patchImg" href="../cad_patch/lst_patch.php"><p><b>Alterar</b></p></a>
            </div>
      </div>
      <div class="element_adm">
            <a href="../cad_voice/lst_voice.php"><img src="../img/voicepanel.png" alt="Gerenciar VOICE"/></a>
            <div class="element_button">
          <a id="cad_voiceImg" href="../cad_voice/cad_voice.php"><p><b>Cadastrar</b></p></a> <a id="alterar_voiceImg" href="../cad_voice/lst_voice.php"><p><b>Alterar</b></p></a>
          </div>
      </div>
      </div>
      </div>
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
    </div>
    <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>
</body>

<?php } ?>