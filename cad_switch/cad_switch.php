<!-- Seleciona Rack's --->
<?php
include("../sessao/sessao.php");
if($_SESSION['type'] == 'admin'){
ob_start();
require_once('../conexao.php'); 
$query_dados = "SELECT * FROM rack ORDER BY nome ASC";
$dados = mysqli_query($conn, $query_dados) or die(mysqli_error());
$row_dados = mysqli_fetch_assoc($dados);
$totalRows_dados = mysqli_num_rows($dados);
?>

<!DOCTYPE html>
<html lang="ptbr" dir="ltr">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../styles/estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="http://intranet.funed.lan/wp-content/themes/intranet-funed/images/favicon.ico">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <title>Cadastro Switch</title>
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
 <div class="titulo_cad">
      <h2>Cadastrar Switch</h2>
 </div>
    <form method="POST" class="cad_item" action="../cad_switch/cad_switch2.php">
    <table class="tabela" border="0" cellpadding="0" cellspacing="3">
      <tr height="20">
      <td width="20%" align="right"><b>Ip:</b></td>
      <td width="50%"><input style="width: 240px" type="tel" name="txt_ip" onkeypress="$(this).mask('0ZZ.0ZZ.0ZZ.0ZZ', { translation: { 'Z': { pattern: /[0-9]/, optional: true } } });" required="required" placeholder="Apenas números"></td>
      </tr>
      <tr>
      <td width="20%" align="right"><b>Nome:</b></td>
      <td width="50%"><input style="width: 240px" type="text" name="txt_switch" value=""></td>
      </tr>
      <tr>
      <td width="20%" align="right"><b>Modelo:</b></td>
      <td width="50%"><input style="width: 240px" type="text" name="txt_modelo" value=""></td>
      </tr>
      <tr>
      <td width="20%" align="right"><b>Serial:</b></td>
      <td width="50%"><input style="width: 240px" type="text" name="txt_serial" value=""></td>
      </tr>
      <tr>
      <td width="20%" align="right"><b>Portas:</b></td>
      <td width="50%"><input style="width: 240px" type="number" name="txt_qtd_portas" value=""></td>
      </tr>
      <tr>
        <td width="20%" align="right"><b>Patrimonio:</b></td>
          <td width="50%"><input name="txt_patrimonio" type="text" required="required" value="" maxlength="60" style="width: 240px"></td>
      </tr>
       <tr>
      <td width="20%" align="right"><b>Local:</b></td>
      <td width="50%">
        <select style="width: 240px" name="txt_rack" id="txt_rack">
                        <?php do {
                            $localAtual = $row_dados['local'];
                            $query_dados = "SELECT * FROM setores ORDER BY cod_setor != '$localAtual', cod_setor";
                            $dados_setor = mysqli_query($conn, $query_dados) or die(mysqli_error());
                            $row_setor = mysqli_fetch_assoc($dados_setor);?>
                        <option value="<?php echo $row_dados['cod_rack']?>"><?php echo $row_dados['cod_rack']?>-<?php echo $row_dados['nome']?>-<?php echo $row_setor['sigla'];?></option>
                            <?php
                          } while ($row_dados = mysqli_fetch_assoc($dados));
                            $rows = mysqli_num_rows($dados);
                            if($rows > 0) {
                                mysqli_data_seek($dados, 0);
                              $row_dados = mysqli_fetch_assoc($dados);
                            }else{
                              echo "Nenhum rack cadastrado!!!";
                            }
                        ?>
                    </select><br>
      </td>
      </tr>
      </table>
    <br>
    <div class="botao">
        <button type="submit" name="Cadastrar">Cadastrar</button>
        <a href="./lst_switch.php"><button type="button" name="Cancelar">Cancelar</button></a>
    </div>      
    </form>
  </div>
  </body>
  <footer class="rodape">
            <h3>Copyright © 2023 Fundação Ezequiel Dias. Todos os direitos reservados. Aspectos legais e
                responsabilidades Política de privacidade.</h3>
        </footer>
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