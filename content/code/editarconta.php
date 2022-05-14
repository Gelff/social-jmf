<?php 
    if($token!=$acemail){header("Location:/content/code/sair.php?d=1");}
    if(isset($_POST['alterarconta'])){
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = base64_encode($_POST['senha']);
        $change = "UPDATE contas SET nome=:nome,sobrenome=:sobrenome,email=:email,senha=:senha WHERE id=$id";
        try{
            $checkregis = "SELECT * FROM contas WHERE email=:emailCheckR";
            $resulterR = $conect->prepare($checkregis);
            $resulterR->bindParam(':emailCheckR',$email,PDO::PARAM_STR);
            $resulterR->execute();
            if($resulterR->rowCount()<1){
                $m = $conect->prepare($change);
                $m->bindParam(':nome',$nome,PDO::PARAM_STR);
                $m->bindParam(':sobrenome',$sobrenome,PDO::PARAM_STR);
                $m->bindParam(':email',$email,PDO::PARAM_STR);
                $m->bindParam(':senha',$senha,PDO::PARAM_STR);
                $m->execute();
            }
        }catch(PDOException $e){}
        header("Refresh:0");
    }
?>