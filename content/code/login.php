<?php
if(isset($_POST['entrar'])){
    $emailL = $_POST['emailL'];
    $senhaL = base64_encode($_POST['senhaL']);
    $select = "SELECT * FROM contas WHERE email=:emailL2 AND senha=:senhaL2";
    try{
        $rL = $conect->prepare($select);
        $rL->bindParam(':emailL2',$emailL,PDO::PARAM_STR);
        $rL->bindParam(':senhaL2',$senhaL,PDO::PARAM_STR);
        $rL->execute();
        if($rL->rowCount()>0){
            $emailL = $_POST['emailL'];
            $senhaL = $_POST['senhaL'];

            $_SESSION['email'] = $emailL;
            $_SESSION['senha'] = $senhaL;

            $updateStatus = "UPDATE contas SET status=1 WHERE email=:emailLe";
            $rU = $conect->prepare($updateStatus);
            $rU->bindParam(':emailLe',$emailL,PDO::PARAM_STR);
            $rU->execute();
            
            $insertLog = "INSERT INTO logs(token,macaddr,type) VALUES(:logid,:logmac,:logtype)";
            $tok = md5($emailL);
            $logtype = 1;
            $MAC = exec('getmac');
            $MAC = strtok($MAC, ' ');
            $logI = $conect->prepare($insertLog);
            $logI->bindParam(':logid',$tok,PDO::PARAM_STR);
            $logI->bindParam(':logmac',$MAC,PDO::PARAM_STR);
            $logI->bindParam(':logtype',$logtype,PDO::PARAM_INT);
            $logI->execute();

            header('Refresh: 0, /perfil/');
        }else{
            errorMes(1);
        }
    }catch(PDOException $e){}
}
?>