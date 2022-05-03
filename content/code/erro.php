<?php 
function errorMes($chose){
    $alarm = ["red","orangered","green"];
    $pack = ["Preencha Todos os Campo!","Usuário Inválido.","Cadastrado Com Sucesso!"];
    echo "<div style='position:absolute;top:-10px;width:100%;height:50px;background-color:".$alarm[$chose].";'><b>".$pack[$chose]."</b></div>";
    header("Refresh:2");
}
?>