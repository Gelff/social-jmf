<?php 
function errorMes($chose){
    $alarm = ["red","orangered","green","orangered"];
    $pack = ["Preencha Todos os Campo!","Usuário Inválido.","Cadastrado Com Sucesso!","Email em Uso!"];
    echo "<div style='display:flex;justify-content:center;align-items:center;text-align:center;position:absolute;top:0px;width:100%;height:50px;background-color:".$alarm[$chose].";'><b style='color:white !important;'>".$pack[$chose]."</b></div>";
    header("Refresh:2");
}
?>