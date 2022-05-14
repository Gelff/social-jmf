<?php
    if(isset($_POST['addfriend'])){
    $adim = "INSERT INTO amigos(pessoa1,pessoa2,status) VALUES($id,$acID,1)";
    try{
        $verifyfriend = "SELECT * FROM amigos WHERE pessoa1=$id AND pessoa2=$acID";
        $rverifyfriend = $conect->prepare($verifyfriend);
        $rverifyfriend->execute();
        if($rverifyfriend->rowCount()<1){
            $radim = $conect->prepare($adim);
            $radim->execute();
            echo "<div style='position:absolute;width:100%;display:flex;justify-content:flex-end;align-items:center;'><b style='color:green;margin-right:10%;margin-top:55px;'>Você adicionou $acnome $acsobrenome aos amigos!</b></div>";
            header("Refresh:2");
        }else{
            echo "<div style='position:absolute;width:100%;display:flex;justify-content:flex-end;align-items:center;'><b style='color:red;margin-right:10%;margin-top:55px;'>Já está na lista de amigos!</b></div>";
            header("Refresh:2");
        }
    }catch(PDOException $e){}
    }
?>