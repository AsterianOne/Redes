<?php
include("../sessao/sessao.php");
    $pdo = new PDO('mysql:dbname=bd_sarts;host=localhost', 'root', '', 
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
?>