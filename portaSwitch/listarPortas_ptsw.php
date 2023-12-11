<?php
include("../sessao/sessao.php");
ob_start();
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest"){
    include '../conn.php';
        $ufid = filter_input(INPUT_POST, 'cod_patch', FILTER_SANITIZE_NUMBER_INT);
        if ($ufid){
        $query = $pdo->prepare("SELECT * FROM pt_patch where cod_patch=? AND status = 0 ORDER BY cod_pt_patch");
        $query->bindParam(1, $ufid, PDO::PARAM_INT);
        $query->execute();
        echo json_encode($query->fetchAll());
        return;
        }
}
echo NULL;
?>