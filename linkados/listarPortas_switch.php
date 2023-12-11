<?php
include("../sessao/sessao.php");
ob_start();
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
    include '../conn.php';
        $ufid = filter_input(INPUT_POST, 'cod_switch', FILTER_SANITIZE_NUMBER_INT);
        if ($ufid){
        $query = $pdo->prepare("SELECT * FROM pt_swtich WHERE id_switch=? AND status = 3 ORDER BY id_pt_switch");
        $query->bindParam(1, $ufid, PDO::PARAM_INT);
        $query->execute();
        echo json_encode($query->fetchAll());
        return;
        }
}
echo NULL;
?>