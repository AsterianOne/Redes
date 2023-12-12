<?php
    include '../conn.php';
        $ufid = filter_input(INPUT_POST, 'cod_rack', FILTER_SANITIZE_NUMBER_INT);

        $query_voice = $pdo->prepare("SELECT DISTINCT cod_voice, nome_voice, cod_patch, nome_patch FROM voice a, patch_panel b where a.rack=?");
        $query_voice->bindParam(1, $ufid, PDO::PARAM_INT);
        $query_voice->execute();
        echo json_encode($query_voice->fetchAll());
    
    return;
echo NULL;
?>
