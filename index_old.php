<?php
require_once('./conexao.php');

$currentPage = $_SERVER['PHP_SELF'];
$maxRows_Recordset1 = 50;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "2";

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM rack ORDER BY nome ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($conn, $query_limit_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($conn, $query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}

$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $params = explode("&", $HTTP_SERVER_VARS['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . implode("&", $newParams);
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Vagner da Silva Moreira - 3314-4508"/>
    <meta name="reply-to" content="vagner.moreira@funed.mg.gov.br"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <link rel="stylesheet" href="./styles/styles_test.css">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>TESTE</title>
    <style>::-webkit-scrollbar { display: none;}</style>
</head>
    <script type="text/javascript">

    function carregar(pagina) {
        $("#conteudo").load(pagina);
    }

    </script>
<body>
    <main>
        <div class="header">
            <div class="cabecalho">
              <div id="img">
                <a href="./">
                <img src="./img/logo.png">
                </a>
              </div>
              <div id="cabecalho_texto">
                <h1>Sistema SARTS 
                <p> Gerenciamento de ativos - Rede e Telefonia</p></h1>
              </div>
              <div class="login_img">
              <a href="./login/index.php"><img src="./img/restrito.png"></a>
              </div>
            </div>
            <nav class="main_nav">
            <div class="navbar_link-toggle">
              <svg style="transform: translateY(-50%);" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#9e2243}</style><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>    
              </div>
              <nav class="itens_nav">
                <div class="menu">
                <div id="index_ul">
                <ul class="menu_ul">
                  <li><a href="#">Cadastro</a>
                  <ul>
                    <li><a href="./login/lst_usuario.php">Usuario</a></li>
                      <li><a href="./area">Area</a></li>
                      <li><a href="./bloco">Bloco</a></li>
                      <li><a href="./cad_setor/lst_setor.php">Setor</a></li>
                      <li><a href="./cad_rack/lst_rack.php">Rack</a>
                      <li><a href="./cad_switch/lst_switch.php">Switch</a>
                      <li><a href="./cad_patch/lst_patch.php">Path panel</a></li>
                      <li><a href="./cad_voice/lst_voice.php">Voice panel</a></li> 
                      <li><a href="./cad_ramal/lst_ramal.php">Ramal</a></li>
                      <li><a href="./planta">Planta</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Mapa</a>
                    <ul>
                      <li><a href="./mapa/global">Global</a></li>
                      <li><a href="./mapa/bloco">Bloco </a></li>
                    </ul>
                    <li><a href="./sessao/logout.php">Sair</a></li>
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
            <div id="tabela_conteudo"> 
            <table id="index_table" border="0" align="center" cellspacing="0" bgcolor="#FFFFFF">
                <tr style="text-align: center;">
                  <?php
                  while($res=mysqli_fetch_array($all_Recordset1)) {
                    //selecione o setor
                      $localAtual = $res['local'];
                      $query_dados = "SELECT * FROM setores WHERE cod_setor = $localAtual";
                      $dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
                      $row_setor = mysqli_fetch_assoc($dados);
                  ?>
                  
                    <td width="160" height="150" valign="center" align="center" style="display: inline-table; margin: 8px 0px 20px 0px;">
                      <a href="./cad_rack/pesq_rack.php?cod_rack=<?php echo $res['cod_rack']; ?>" onclick="NovaJanela(this.href,'album','414','924','yes');return false">
                        <b><?php echo $res['nome'];?> - Chave:<?php echo $res['chave'];?></b<br>
                        <img src="./img/rack2.png" alt=""  width="130" height="350" border="" style="border:2px solid #ccc; padding:3px;border:3px solid #384d61; margin-left:2px; margin-top:2px; margin-right:4px; margin-bottom:2px;"/>
                        <br>
                          <?php echo $row_setor['sigla'];?>       
                      </a>
                    </td>
            
                          
                  <?php
                  }
                  ?>
                  </tr>
                </table>
              </div>
            </div>
            <div class="rodape">
                <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e responsabilidades Política de privacidade.</h3>
              </div>
    </main>
</body>
</html>