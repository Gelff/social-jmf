<?php 
    if(isset($_POST['deletarcc'])){
        $confirmarsenha = base64_encode($_POST['confirmarsenha']);
        if($confirmarsenha==$acsenha){
            try{
                $deletea = "DELETE FROM contas WHERE id=$id";
                $del = $conect->prepare($deletea);
                $del->execute();
                $deletea2 = "DELETE FROM perfil WHERE id=$id";
                $del2 = $conect->prepare($deletea2);
                $del2->execute();
                $deletea3 = "DELETE FROM amigos WHERE pessoa1=$id OR pessoa2=$id";
                $del3 = $conect->prepare($deletea3);
                $del3->execute();
                $deletea4 = "DELETE FROM curtidas WHERE idConta=$id";
                $del4 = $conect->prepare($deletea4);
                $del4->execute();
                $deletea5 = "DELETE FROM publicacoes WHERE idConta=$id";
                $del5 = $conect->prepare($deletea5);
                $del5->execute();

                header("Location: /content/code/sair.php?d=1");
            }catch(PDOException $e){}
        }else{
            echo "<b style='color:red;'>Senha Incorreta!</b>";
        }
        header("Refresh:2");
    }
?>