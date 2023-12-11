<?php
    include '../conn.php';
        $ufid = filter_input(INPUT_POST, 'cod_rack', FILTER_SANITIZE_NUMBER_INT);
        if($ufid){
        $query_voice = $pdo->prepare("SELECT * FROM voice where rack=?");
        $query_voice->bindParam(1, $ufid, PDO::PARAM_INT);
        $query_voice->execute();
        echo json_encode($query_voice->fetchAll());
    }
    return;
echo NULL;
?>