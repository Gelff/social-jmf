<?php 
    if(isset($_POST['savealtbio'])){
        $alterbio = $_POST["alterbio"];
        $alterturma = $_POST['turmas'];
        $selectbio = "UPDATE perfil SET biografia=:altb,turma=:alttu WHERE id=$id;";
        try{
            $resultadobio = $conect->prepare($selectbio);
            $resultadobio->bindParam(':altb',$alterbio,PDO::PARAM_STR);
            $resultadobio->bindParam(':alttu',$alterturma,PDO::PARAM_STR);
            $resultadobio->execute();
            header("Refresh:0");
        }catch(PDOException $e) {
        }
    }
?>