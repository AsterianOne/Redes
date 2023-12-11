<?php
    include '../conn.php';
        $ufid = filter_input(INPUT_POST, 'cod_voice', FILTER_SANITIZE_NUMBER_INT);

        $query = $pdo->prepare("SELECT * FROM pt_voice where cod_voice=? AND status = 0 ORDER BY id_pt_voice");
        $query->bindParam(1, $ufid, PDO::PARAM_INT);
        $query->execute();
        echo json_encode($query->fetchAll());

        return;
echo NULL;
?>