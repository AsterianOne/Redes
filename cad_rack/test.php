<?php 
require_once('../conexao.php');

$cod_rack = $_GET['cod_rack'];

mysqli_select_db($conn, $dbname);
$query_Recordset_Voice = "SELECT * FROM voice WHERE rack = $cod_rack ";
$Recordset_Voice = mysqli_query($conn, $query_Recordset_Voice) or die(mysqli_error());
$row_Voice = mysqli_fetch_assoc($Recordset_Voice);
$totalRows_Recordset_Voice = mysqli_num_rows($Recordset_Voice);
$mysqli_num_rows = mysqli_num_rows($Recordset_Voice);

?>
<html>
	<head>
	<title>Exemplo</title>
</head>
<body>
<?php
$i = 0;
	// se o número de resultados for maior que zero, mostra os dados
	if($mysqli_num_rows > 0) {
		// inicia o loop que vai mostrar todos os dados
		do {
?>
			<p><?=$row_Voice['nome_voice']?> / <?=$row_Voice['qtd_portas']?></p>
<?php
		// finaliza o loop que vai mostrar os dados
        $i++;
		}while ($i < $mysqli_num_rows);
	// fim do if
	}
?>
</body>
</html>
<?php
// tira o resultado da busca da memória
mysqli_free_result($mysqli_num_row->result);
?>