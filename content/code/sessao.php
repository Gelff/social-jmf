<?php
    ob_start();
    session_start();
    include("../content/code/conexao.php");
    if(!isset($_SESSION['email'])&&(!isset($_SESSION['senha']))){
        header("Location: ../");
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
    if($ac->status==0){header("Refresh:0,/content/code/sair.php?d=1");}
    $acID = $id;
    $acSelect = "SELECT * FROM contas WHERE id=:acID";
    try{
        $acr = $conect->prepare($acSelect);
        $acr->bindParam(':acID',$acID, PDO::PARAM_INT);
        $acr->execute();
        if($acr->rowCount()>0){
            $acc = $acr->fetch(PDO::FETCH_OBJ);
            $acnome = $acc->nome;
            $acsobrenome = $acc->sobrenome;
            $acemail = $acc->email;
            $acsenha = $acc->senha;
            $acstatus = $acc->status;
            $acverificado = $acc->verificado;

            $pSelect = "SELECT * FROM perfil WHERE id=:pID";
            $pCon = $conect->prepare($pSelect);
            $pCon->bindParam(':pID', $acID, PDO::PARAM_INT);
            $pCon->execute();
            if($pCon->rowCount()>0){
                $pO = $pCon->fetch(PDO::FETCH_OBJ);
                $pApelido = $pO->apelido;
                $pCapa = $pO->capa;
                $pBio = $pO->biografia;
                $pTurma = $pO->turma;
                $pFoto = $pO->foto;
            }
        }
    }catch(PDOException $i){}
?>