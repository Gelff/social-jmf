<?php 
if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = base64_encode($_POST['senha']);
    $dara = date(DATE_RFC822);
    $verificado = 0;
    $status = 0;
    if(!empty($nome)&&!empty($sobrenome)&&!empty($email)&&!empty($senha)){
        errorMes(2);
        try{
            
            $checkregis = "SELECT * FROM contas WHERE email=:emailCheckR";
            $resulterR = $conect->prepare($checkregis);
            $resulterR->bindParam(':emailCheckR',$email,PDO::PARAM_STR);
            $resulterR->execute();
            if($resulterR->rowCount()>0){
                errorMes(3);
            }else{
                $cadastro = "INSERT INTO contas (nome, sobrenome, email, senha, verificado, status, criacao) VALUES (:nome, :sobrenome, :email, :senha, :verificado, :status, :criacao)";
                $result = $conect->prepare($cadastro);
                $result->bindParam(':nome',$nome,PDO::PARAM_STR);
                $result->bindParam(':sobrenome',$sobrenome,PDO::PARAM_STR);
                $result->bindParam(':email',$email,PDO::PARAM_STR);
                $result->bindParam(':senha',$senha,PDO::PARAM_STR);
                $result->bindParam(':verificado',$verificado,PDO::PARAM_STR);
                $result->bindParam(':status',$status,PDO::PARAM_STR);
                $result->bindParam(':criacao',$dara,PDO::PARAM_STR);
                $result->execute();
                
                $checklogin = "SELECT * FROM contas WHERE email=:emailCheck";
                $resulter = $conect->prepare($checklogin);
                $resulter->bindParam(':emailCheck',$email,PDO::PARAM_STR);
                $resulter->execute();
                if($resulter->rowCount()>0){
                    $apelido = "";
                    $capa = "capa.png";
                    $biografia = "Escreva algo legal :)";
                    $turma = "none";
                    $foto = "nil.png";
                    $rc = $resulter->fetch(PDO::FETCH_OBJ);
                    $idCheck = $rc->id;
                    $perfil = "INSERT INTO perfil(id,apelido,capa,biografia,turma,foto) VALUES(:idp,:apelido,:capa,:biografia,:turma,:foto)";
                    $perfilresult = $conect->prepare($perfil);
                    $perfilresult->bindParam(':idp',$idCheck,PDO::PARAM_STR);
                    $perfilresult->bindParam(':apelido',$apelido,PDO::PARAM_STR);
                    $perfilresult->bindParam(':capa',$capa,PDO::PARAM_STR);
                    $perfilresult->bindParam(':biografia',$biografia,PDO::PARAM_STR);
                    $perfilresult->bindParam(':turma',$turma,PDO::PARAM_STR);
                    $perfilresult->bindParam(':foto',$foto,PDO::PARAM_STR);
                    $perfilresult->execute();
                }
            }
        }catch(PDOException $e){
            echo "<strong>ERRO DE CADASTRO PDO = </strong>".$e->getMessage();
        }
    }else{
        errorMes(0);
    }
}
?>