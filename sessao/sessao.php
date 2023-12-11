<?php
@session_start();
if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])){
   $login_usuario = $_SESSION['usuario'];
}
else {
   header('Location:../login/index.php');
   exit();
}
?>