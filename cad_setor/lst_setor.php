<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
require_once('../conexao.php');
//include("../admin/sessao.php");
ob_start();

$currentPage = $_SERVER['PHP_SELF'];
$maxRows_Recordset1 = 50;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "2";

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM setores ORDER BY cod_setor DESC";
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
<script LANGUAGE="JavaScript">
function confirmSubmit()
{
var agree=confirm("Tem certeza que deseja deletar o setor?");
if (agree)
	return true ;
else
	return false ;
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-language" content="pt-br">
<link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
<link rel="stylesheet" type="text/css" href="../styles/estilo.css" />
<title>FUNED - Gerenciamento de Usuarios</title>
</head>
<body>
<div class="main" id="main">
      <div class="header">
        <div class="cabecalho">
          <div id="img">
            <a href="../index.php"><img src="../img/logo.png"></a>
          </div>
          <div id="cabecalho_texto">
            <h1>Sistema SARTS</h1>
            <h3>Gerenciamento de ativos - Rede e Telefonia</h3>
          </div>
          <div class="login_img">
                <a href="../login/index.php"><img src="../img/restrito.png"></a>
          </div>
        </div>
        <div class="box_titulo">
    <nav class="main_nav">
    <div class="navbar_link-toggle">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
      </div>
      <nav class="itens_nav">
        <div class="menu">
        <ul class="menu_ul">
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
          <li style="margin-left: 2px"><a href="#">Mapa</a>
            <ul>
              <li><a href="../mapa/global">Global</a></li>
              <li><a href="../mapa/bloco">Bloco </a></li>
            </ul>
            <li style="margin-left: 2px"><a href="../sessao/logout.php">Sair</a></li>
          </li>
        </ul>
      </div>
   </nav>
  </nav>
  <div class="titulo_pg">
  <a href="../login/principal_adm.php"><button class="butao" style="width: 70px">Principal</button></a>
        <a href="./cad_setor.php"><button class="butao">Cadastrar</button></a>
            <tr> 
                <h1 style="color:fff; padding: 8px 0 8px 0">Gerenciamento de Usuarios</h1>
            </tr> 
        </div>
  <script>
    function classToggle() {
    document.querySelector('.navbar_link-toggle')
    const navs = document.querySelectorAll('.itens_nav')
  
    navs.forEach(nav => nav.classList.toggle('navbar_toggleShow'));
        }

        document.querySelector('.navbar_link-toggle')
      .addEventListener('click', classToggle);
</script>
           </div>
        </div>

  <div id="conteudo_tabela">  
    <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
  <p style="text-align: center;"><a href="cad_login.php">Nenhum dado casdastrado!!</a></p> 
    <?php } // Show if recordset empty ?>
 
<?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
<table class="tabela" width="586" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr style="background-color: #384d61;"> 
  <td width="10%"><h2 class="h2_t"> Cod_setor</h2></td>
         <td width="20%"> <h2 class="h2_t">Setor</h2></td>
         <td width="20%"> <h2 class="h2_t">Sigla</h2></td>
         <td colspan="2"><h2 class="h2_t">A&ccedil;&atilde;o</h2></td>  
  </tr> 
  <?php do { ?>
  <tr>
  <td><div><?php echo $row_Recordset1['cod_setor']; ?></div></td>
    <td><div><?php echo $row_Recordset1['setor']; ?></div></td>
    <td><div><?php echo $row_Recordset1['sigla']; ?></div></td>
     <td width="5%" align="center"><div>
         <a class="action" href="./alterar_setor.php?cod_setor=<?php echo $row_Recordset1['cod_setor']; ?>" onclick="NovaJanela(this.href,'album','895','300','yes');return false"><img src="../img/editar.png" alt="Alterar" width="16" height="16"></a>
         <a class="action" href="./excluir_setor.php?cod_setor=<?php echo $row_Recordset1['cod_setor']; ?>" onclick="return confirmSubmit()"><img src="../img/excluir.png" alt="Alterar" width="16" height="16"></a>
      </div>
      </td>
  </tr>
  <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
              <tr>
                <td colspan="4" border="0px" align="center" style="background-color: #d3d3d3;">
                  <p><br>
                  Lista de Setores <b><?php echo ($startRow_Recordset1 + 1) ?></b> a <b><?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?></b> de <b><?php echo $totalRows_Recordset1 ?></b> <br>
                  </p>
                </td>
              </tr>
              <tr>
                <td class="seta" idth="100%" colspan="4" align="center" style="background-color: #d3d3d3;">
                  <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">
                    <img src="../img/seta1.png" alt="Ínicio" border=""/></a> 
                  <?php } // Show if not first page ?>
                  <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">
                    <img src="../img/seta3.png" alt="Anterior" border="" /></a> 
                  <?php } // Show if not first page ?>
                  <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">
                    <img src="../img/seta2.png" alt="Próximo" border="" /> 
                  <?php } // Show if not last page ?>
                  <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="../img/seta4.png" alt="Último" border="" /></a>
                  <?php } // Show if not last page ?>
                </td>
              </tr>
</table>
<?php }  mysqli_free_result($Recordset1); // Mostrar registros se não estiver vazio ?>
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
        
    </div>
    <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>

</body>

<?php } ?>
