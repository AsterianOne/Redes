<?php
require_once('../conexao.php');
//include("../sessao/sessao.php");
$currentPage = $_SERVER['PHP_SELF'];
$maxRows_Recordset1 = 100;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "2";

mysqli_select_db($conn, $dbname);
$query_Recordset1 = "SELECT * FROM ramal ORDER BY `ramal`.`rack`, `ramal`.`porta` ASC";
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
    <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
    <script type="text/javascript">
    function carregar(pagina) {
        $("#conteudo").load(pagina);
    }
    </script>
    <style>
    @media screen and (min-width: 0px) and (max-width: 480px) {
        .tabela tr td div {
            font-size: 6px;
        }
    }
    </style>
    <title>FUNED - Gerenciamento de Ramais</title>
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
                <div class="login_img">
                <a href="../login/index.php"><img src="../img/restrito.png"></a>
                </div>
            </div>
            <div class="box_titulo">
                <nav class="main_nav">
                    <div class="navbar_link-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512">
                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        </svg>
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
                    <tr>
                        <td class="main_td" colspan="10">
                            <a href="./cad_ramal.php"><button class="butao">Cadastrar</button></a>
                            <h1 style="color: #FFF;margin: 0;">Gerenciamento de Ramais</h1>
                        </td>
                    </tr>
                    <div id="searchbox">
                        <?php include("../pesquisar.php"); ?>
                    </div>
                </div>
                <script>
                function classToggle() {
                    let selectId = document.getElementsByClassName('itens_nav navbar_toggleShow');
                    documentdocument.getElementsByClassName('itens_nav navbar_toggleShow').removeAttribute('fixed');

                    navs.forEach(nav => nav.classList.toggle('navbar_toggleShow'));
                }

                document.querySelector('.navbar_link-toggle')
                    .addEventListener('click', classToggle);
                </script>
            </div>
        </div>
        <div id="conteudo_tabela">
            <?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
            <p style="text-align: center;"><a href="cad_ramal.php">Nenhum dado casdastrado!!</a></p>
            <?php } // Show if recordset empty ?>

            <?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty?>

            <table class="tabela" border="0" bordercolor="#444" align="center" cellpadding="0" cellspacing="0">
                <tr class="main_tr" style="background-color: #384d61;">
                    <td width="8%">
                        <h2 class="h2_t">Numero</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">PABX</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Rack</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Interno</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Voice</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Categoria</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Setor</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Pt_Usuario</h2>
                    </td>
                    <td width="10%">
                        <h2 class="h2_t">Grupo_Chamada</h2>
                    </td>
                    <td width="8%">
                        <h2 class="h2_t">A&ccedil;&atilde;o</h2>
                    </td>
                </tr>
                <?php do { 
                    //PEGA O NOME DO RACK
                    $cod_rack = $row_Recordset1['rack'];
                    $query_rack = "SELECT * FROM rack WHERE cod_rack = '$cod_rack'";
                    $rackInfo = mysqli_query($conn, $query_rack) or die(mysql_error());
                    $row_rackInfo = mysqli_fetch_assoc($rackInfo);

                    //PEGA A SIGLA DO SETOR
                    $cod_setor = $row_Recordset1['setor'];                   
                    $query_dados = "SELECT * FROM setores WHERE cod_setor = '$cod_setor'";
                    $dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
                    $row_setor = mysqli_fetch_assoc($dados);

                    //PEGA A PORTA DO VOICE E O VOICE
                    $cod_PTvoice = $row_Recordset1['porta'];
                    $query_PTvoice = "SELECT * FROM pt_voice WHERE id_pt_voice = '$cod_PTvoice'";
                    $voicePTinfo = mysqli_query($conn, $query_PTvoice) or die(mysql_error());
                    $row_PTvoice = mysqli_fetch_assoc($voicePTinfo);

                    //PEGA A PORTA DO VOICE E O VOICE
                    $cod_PTpatch = $row_Recordset1['pt_usuario'];
                    $query_PTpatch = "SELECT * FROM pt_patch WHERE cod_pt_patch = '$cod_PTpatch'";
                    $patchPTinfo = mysqli_query($conn, $query_PTpatch) or die(mysql_error());
                    $row_PTpatch = mysqli_fetch_assoc($patchPTinfo);
                    ?>
                <tr style="background-color: #;">
                    <td style="font-weight: bold;">
                        <div><?php echo $row_Recordset1['numero']; ?></div>
                    </td>
                    <td>
                        <div><?php echo $row_Recordset1['pabx']; ?></div>
                    </td>
                    <td>
                        <div><?php if($row_rackInfo){ echo $row_rackInfo['nome'];}else{echo 'Desconectado';} ?></div>
                    </td>
                    <td>
                        <div><?php echo $row_Recordset1['interno']; ?></div>
                    </td>
                    <td>
                        <?php 
                        //SELECIONA O VOICE
                        if(isset($row_PTvoice)){
                                $cod_voice = $row_PTvoice['cod_voice']; 
                                $query_voice = "SELECT * FROM voice WHERE cod_voice = '$cod_voice'";
                                $voiceInfo = mysqli_query($conn, $query_voice) or die(mysql_error());
                                $row_voiceInfo = mysqli_fetch_assoc($voiceInfo);
                        }
                        ?>
                        <div><?php if(isset($row_PTvoice)){ echo $row_voiceInfo['nome_voice']; ?> - <?php echo $row_PTvoice['id_voice'];}else{
                            echo 'Desconectado';
                        } ?></div>
                    </td>
                    <td>
                        <div><?php echo $row_Recordset1['categoria']; ?></div>
                    </td>
                    <td>
                        <div><?php echo $row_setor['sigla']; ?></div>
                    </td>
                    <td>
                    <?php 
                        //SELECIONA O PATCH E PEGA A ETIQUETA
                        if(isset($row_PTpatch)){
                                $cod_patch = $row_PTpatch['cod_patch']; 
                                $query_patch = "SELECT * FROM patch_panel WHERE cod_patch = '$cod_patch'";
                                $patchInfo = mysqli_query($conn, $query_patch) or die(mysql_error());
                                $row_patchInfo = mysqli_fetch_assoc($patchInfo);
                        }
                        ?>
                        <div><?php if(isset($row_PTpatch)){ echo $row_PTpatch['id_patch'] + $row_patchInfo['etiqueta'];}else{echo 'Desconectado';}?></div>
                    </td>
                    <td>
                        <div><?php echo $row_Recordset1['grupo_chamada']; ?></div>
                    </td>
                    <td align="center">
                        <a class="action"
                            href="../cad_ramal/alterar_ramal.php?cod_ramal=<?php echo $row_Recordset1['cod_ramal']; ?>"
                            onclick="NovaJanela(this.href,'album','800','400','yes');return false"><img
                                src="../img/editar.png" alt="Alterar"></a>
                    </td>
                </tr>
                <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
                <tr>
                    <td colspan="10" align="center" style="background-color: #d3d3d3;">
                        <p><br>
                            Lista de Ramais <b><?php echo ($startRow_Recordset1 + 1) ?></b> a
                            <b><?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?></b>
                            de <b><?php echo $totalRows_Recordset1 ?></b> <br>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="seta" colspan="10" align="center" style="background-color: #d3d3d3;">
                        <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                        <a
                            href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">
                            <img src="../img/seta1.png" alt="Ínicio" border="" /></a>
                        <?php } // Show if not first page ?>
                        <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                        <a
                            href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">
                            <img src="../img/seta3.png" alt="Anterior" border="" /></a>
                        <?php } // Show if not first page ?>
                        <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                        <a
                            href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">
                            <img src="../img/seta2.png" alt="Próximo" border="" />
                            <?php } // Show if not last page ?>
                            <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                            <a
                                href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img
                                    src="../img/seta4.png" alt="Último" border="" /></a>
                            <?php } // Show if not last page ?>
                    </td>
                </tr>
            </table>
            <?php } mysqli_free_result($Recordset1); // Mostrar registros se não estiver vazio ?>
        </div>
    </div>
        <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>
</body>
</html>