<?php
    $formatP = ["png","jpg","jpeg","JPG","gif"];
    if(isset($_POST['alterfoto'])){
        $extensao = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
        
        if(in_array($extensao, $formatP)){
            $pasta = "../content/img/alunos/";
            $temporario = $_FILES['foto']['tmp_name'];
            $novoNome = md5($id.$token).".jpg";
            $mudarfoto = "UPDATE perfil SET foto=:foto WHERE id=$id";
            try{
                $resultfoto = $conect->prepare($mudarfoto);
                $resultfoto->bindParam(':foto',$novoNome,PDO::PARAM_STR);
                $resultfoto->execute();
                $upar = move_uploaded_file($temporario, $pasta.$novoNome);
            }catch(PDOException $e){}
            header("Refresh:0");
        }
    }
    if(isset($_POST['altercape'])){
        $extensao = pathinfo($_FILES['cape']['name'],PATHINFO_EXTENSION);
        
        if(in_array($extensao, $formatP)){
            $pasta = "../content/img/capas/";
            $temporario = $_FILES['cape']['tmp_name'];
            $novoNome = md5($id.$token).".jpg";
            $mudarcapa = "UPDATE perfil SET capa=:capa WHERE id=$id";
            try{
                $resultcapa = $conect->prepare($mudarcapa);
                $resultcapa->bindParam(':capa',$novoNome,PDO::PARAM_STR);
                $resultcapa->execute();
                $uparcapa = move_uploaded_file($temporario, $pasta.$novoNome);
            }catch(PDOException $e){}
            header("Refresh:0");
        }
    }
?>