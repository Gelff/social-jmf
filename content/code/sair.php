<?php
    ob_start();
    session_start();
    include("conexao.php");
    if(!isset($_SESSION['email'])&&(!isset($_SESSION['senha']))){
        header("Location: /");
    }

    $token = $_SESSION['email'];
    $login = "SELECT * FROM contas WHERE email=:token";
    try{
        $get = $conect->prepare($login);
        $get->bindParam(':token',$token,PDO::PARAM_STR);
        $get->execute();
        if($get->rowCount()>0){
            $ac = $get->fetch(PDO::FETCH_OBJ);
            $id = $ac->id;
            $nome = $ac->nome;
        } 
    } catch(PDOException $e){
    }

    if(isset($_GET['d'])){
        $d = $_GET['d'];
        if($d==1){
            $updateStatus = "UPDATE contas SET status=0 WHERE id=:idU";
            try{

                $insertLog = "INSERT INTO logs(token,macaddr,type) VALUES(:logid,:logmac,:logtype)";
                $tok = md5($token);
                $logtype = 0;
                $MAC = exec('getmac');
                $MAC = strtok($MAC, ' ');
                $logI = $conect->prepare($insertLog);
                $logI->bindParam(':logid',$tok,PDO::PARAM_STR);
                $logI->bindParam(':logmac',$MAC,PDO::PARAM_STR);
                $logI->bindParam(':logtype',$logtype,PDO::PARAM_INT);
                $logI->execute();

                $rU = $conect->prepare($updateStatus);
                $rU->bindParam(':idU',$id,PDO::PARAM_STR);
                $rU->execute();
                session_destroy();
                header("Refresh:0, /perfil/");
            }catch(PDOException $e){}
        }
    }
?>