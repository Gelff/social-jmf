<div class="publicacoes">
    <?php
        if(isset($_POST['publik'])){
            $textin = $_POST["textin"];
            #if(str_contains("$textin", ' ')){
            if($textin!=""){
                $select = "INSERT INTO publicacoes(midia,texto,idConta,idPerfil) VALUES(:midia,:textin,:idc,:idpe)";
                try{
                    $formatPp = ["png","jpg","jpeg","JPG","gif"];
                    $extensaop = pathinfo($_FILES['fotopub']['name'],PATHINFO_EXTENSION);
                    if(in_array($extensaop, $formatPp)){
                        $pasta = "../content/img/pub/";
                        $temporario = $_FILES['fotopub']['tmp_name'];
                        $novoNome = md5($acID.$nome.$token.uniqid()).".jpg";
                        $uparp = move_uploaded_file($temporario, $pasta.$novoNome);
                    } if($novoNome==""){$novoNome="nil";}
                    $resultado = $conect->prepare($select);
                    $resultado->bindParam(':midia',$novoNome,PDO::PARAM_STR);
                    $resultado->bindParam(':textin',$textin,PDO::PARAM_STR);
                    $resultado->bindParam(':idc',$id,PDO::PARAM_STR);
                    $resultado->bindParam(':idpe',$acID,PDO::PARAM_STR);
                    $resultado->execute();


                    header("Refresh:0");
                }catch(PDOException $e) {
                }
            }else{
                echo "<b style='color:red; width:100%;text-align:center;'>Insira ao menos 1 palavra para publicar!</b>";
                header("Refresh:2,./$acID");
            }
        }
        
        $select = "SELECT * FROM publicacoes WHERE idPerfil=$acID ORDER BY id DESC";
        try{
            $resultado = $conect->prepare($select);
            $resultado->execute();
            if($resultado->rowCount()>0){
                while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
                    $acIDPub = $show->id;
                    $idContala = $show->idConta;
                    ?>
    <div class="pub">
        <div class="minicon" style="background-image: url(/content/img/alunos/<?php echo $pFoto; ?>"></div>
        <div>
            <div style="display:flex;flex-direction:column;align-items:flex-start;justify-content:center;">
                <?php
                    $dia = substr($show->data,8,-9);$mes = substr($show->data, 6,1);$ano = substr($show->data, 0,4);
                    $meses = [1 => 'Janeiro','Fev.','Março','Abril','Maio','Junho','Julho','Agosto','Set.','Out.','Nov.','Dez.'];
                    $data = $dia." de ".$meses[$mes]." de ".$ano;
                ?>
                <a><b><?php echo $acnome." ".$acsobrenome; ?></b> - <?php echo $data; ?></a>
                <a class="textpub"><?php echo $show->texto; ?></a>
                <?php if($show->midia!="nil") { ?>
                    <img style="border-radius:10px;" width="250" src="/content/img/pub/<?php echo $show->midia; ?>">
                <?php } ?>
            </div>
            <form method="post">
                <div style="display:flex;flex-direction:column;align-items:center;">
                    <button name="curtir" class="curtir" id="curtir" value="<?php echo $acIDPub; ?>"></button>
                    <b><?php echo $show->likes ?></b>
                </div>
                <button class="responder"></button>
                <button class="compartilhar"></button>
                <?php if($acID==$id) { ?>
                    <button name="excluir" class="excluir" value="<?php echo $acIDPub; ?>"></button>
                <?php } ?>
            </form>
        </div>
    </div>

    <?php }}}catch(PDOException $e){ echo '<strong>ERRO DE PDO= </strong>'.$e->getMessage();} ?>
    <?php
        if(isset($_POST['excluir'])){
            $exc = $_POST['excluir'];
            $deletar = "DELETE FROM publicacoes WHERE id=$exc AND idConta=$acID";
            $deletare = $conect->prepare($deletar);
            $deletare->execute();
            header("Refresh:0");
        }
        if(isset($_POST['curtir'])){
            $cut = $_POST['curtir'];
            $inserircurtida = "INSERT INTO curtidas(idPub,idConta) VALUES(:idPub,:idConta)";
            try{
                $curtidas = "SELECT * FROM curtidas WHERE idPub=:vidPub AND idConta=:vidConta";
                $getcurtidas = $conect->prepare($curtidas);
                $getcurtidas->bindParam(':vidPub',$cut,PDO::PARAM_INT);
                $getcurtidas->bindParam(':vidConta',$id,PDO::PARAM_INT);
                $getcurtidas->execute();
                if($getcurtidas->rowCount()>0){
                    $removercurtida = "DELETE FROM curtidas WHERE idPub=$cut AND idConta=$id";
                    $resultcurtir = $conect->prepare($removercurtida);
                    $resultcurtir->execute();
                    $curtirr = "UPDATE publicacoes SET likes=likes-1 WHERE id=$cut";
                    $curtirre = $conect->prepare($curtirr);
                    $curtirre->execute();
                }else{
                    $resultcurtir = $conect->prepare($inserircurtida);
                    $resultcurtir->bindParam(':idPub',$cut,PDO::PARAM_INT);
                    $resultcurtir->bindParam(':idConta',$id,PDO::PARAM_INT);
                    $resultcurtir->execute();
                    $curtirr = "UPDATE publicacoes SET likes=likes+1 WHERE id=$cut";
                    $curtirre = $conect->prepare($curtirr);
                    $curtirre->execute();
                }
            }catch(PDOException $e){}
            header("Refresh:0");
        }
        
    ?>
</div>