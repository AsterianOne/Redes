<?php

    include '../conn.php';
        $ufid = filter_input(INPUT_POST, 'cod_patch', FILTER_SANITIZE_NUMBER_INT);
        if ($ufid){
        $query = $pdo->prepare("SELECT * FROM pt_patch where cod_patch=? AND status = 0 ORDER BY cod_pt_patch");
        $query->bindParam(1, $ufid, PDO::PARAM_INT);
        $query->execute();
        echo json_encode($query->fetchAll());
        return;
        }
        
echo NULL;
?>