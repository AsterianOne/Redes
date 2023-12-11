<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);
include('../conexao.php');
ob_start();
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysqli_query($conn, "SELECT * FROM ramal WHERE numero like '%$q%' ORDER BY cod_ramal LIMIT 5")
or die("Erro no comando SQL:".mysqli_error());
while($_row = mysqli_fetch_array($sql_res))
{
$numero=$_row['numero'];
$pabx=$_row['pabx'];
$rack=$_row['rack'];
$interno=$_row['interno'];
$voice=$_row['porta'];
$pt_usuario=$_row['pt_usuario'];
$cod_ramal=$_row['cod_ramal'];

$re_numero='<b>'.$q.'</b>';
$final_numero = str_ireplace($q, $re_numero, $numero);

?>
<div class="display_box" align="left">
<a class="action" style="color: #9D2243" href="../cad_ramal/alterar_ramal.php?cod_ramal=<?php echo $cod_ramal; ?>"onclick="NovaJanela(this.href,'album','800','400','yes');return false"><B>RAMAL:</b><?php echo $final_numero; ?> </a> - PABX:<?php echo ($pabx);?> - RACK:<?php echo ($rack);?> - INTERNO:<?php echo ($interno);?> - VOICE:<?php echo ($voice);?> - USUARIO:<?php echo ($pt_usuario);?></div>
<?php
}

}
else
{

}
?>
