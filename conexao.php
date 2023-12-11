<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "bd_sarts";
        
//Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    if(!$conn){
        die("Falha na conexao: " . mysqli_connect_error());
    }else{
        echo " ";
    };
?>
<script>
var win = null;
function NovaJanela(pagina,nome,w,h,scroll){
  if(win == null){
    LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
    TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
    settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
    win = window.open(pagina,nome,settings);
    
  }else{
    win.close()
    win = null
    LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
    TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
    settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
    win = window.open(pagina,nome,settings);
    
  }
}
</script>