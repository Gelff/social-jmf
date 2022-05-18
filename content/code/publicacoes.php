<div class="publicacoes">
    <?php
        if(isset($_POST['publik'])){
            $textin = $_POST["textin"];
            if($textin!=""){
                $select = "INSERT INTO publicacoes(midia,texto,idConta,idPerfil) VALUES(:midia,:textin,:idc,:idpe)";
                try{
                    $formatPp = ["png","jpg","jpeg","JPG","gif"];
                    $extensaop = pathinfo($_FILES['fotopub']['name'],PATHINFO_EXTENSION);
                    if(in_array($extensaop, $formatPp)){
                        $pasta = "../content/img/pub/";
                        $temporario = $_FILES['fotopub']['tmp_name'];
                        $novoNome = md5($acID.$token.uniqid()).".jpg";
                        $uparp = move_uploaded_file($temporario, $pasta.$novoNome);
                    } if($novoNome==""){$novoNome="nil";}
                    $resultado = $conect->prepare($select);
                    $resultado->bindParam(':midia',$novoNome,PDO::PARAM_STR);
                    $resultado->bindParam(':textin',$textin,PDO::PARAM_STR);
                    $resultado->bindParam(':idc',$id,PDO::PARAM_STR);
                    $resultado->bindParam(':idpe',$acID,PDO::PARAM_STR);
                    $resultado->execute();


                    header("Refresh: 0");
                }catch(PDOException $e){}
                
            }else{
                echo "<b style='color:red; width:100%;text-align:center;'>Insira ao menos 1 palavra!</b>";
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

                    $quantidadecmt = "SELECT * FROM comentarios WHERE idPub=$acIDPub";
                    $quantidadecmta = $conect->prepare($quantidadecmt);
                    $quantidadecmta->execute();
                    $qtscmta = $quantidadecmta->rowCount();
                    ?>
    <div class="pub">
        <div style="margin-right:8px;"></div>
        <div>
            <div style="display:flex;flex-direction:column;align-items:flex-start;justify-content:center;">
                <?php
                    $cargo = ["","<button class='verificado1' style='margin-left:5px; width:15px;height:15px;'></button>"];
                    $dia = substr($show->data,8,-9);$mes = substr($show->data, 6,1);$ano = substr($show->data, 0,4);
                    $meses = [1 => 'Janeiro','Fev.','Março','Abril','Maio','Junho','Julho','Agosto','Set.','Out.','Nov.','Dez.'];
                    $data = $dia." de ".$meses[$mes]." de ".$ano." às ".substr($show->data,-8,5);
                ?>
                <div style="width:415px;">
                    <a style="display:flex;flex-direction:row;justify-content:space-between;width:100%;"><b><?php echo $acnome." ".$acsobrenome.$cargo[$acverificado]; ?></b><?php echo $data; ?></a>
                </div>
                
                <a class="textpub"><?php echo $show->texto; ?></a>
                <?php if($show->midia!="nil") { ?>
                    <img style="border-radius:10px;" width="410" src="/content/img/pub/<?php echo $show->midia; ?>">
                <?php } ?>
            </div>
            
            <form method="post">
                <div style="display:flex;flex-direction:column;align-items:center;">
                    <button name="curtir" class="curtir" id="curtir" value="<?php echo $acIDPub; ?>"></button>
                    <b><?php echo $show->likes ?></b>
                </div>
                <div style="display:flex;flex-direction:column;align-items:center;">
                    <button name="responder" class="responder" id="responder" value="<?php echo $acIDPub; ?>"></button>
                    <b><?php echo $qtscmta; ?></b>
                </div>
                <button class="compartilhar"></button>
                <?php if($acID==$id) { ?>
                    <button name="excluir" class="excluir" value="<?php echo $acIDPub; ?>"></button>
                <?php } ?>
            </form>
            <div class="comentarios">
                <form method="post">
                    <input type="text" placeholder="Comentar" name="textocoment<?php echo $acIDPub; ?>">
                    <input type="submit" value="<?php echo $acIDPub; ?>" class="responder" name="comentar<?php echo $acIDPub; ?>">
                </form>
                <?php
                    if(isset($_POST["comentar$acIDPub"])){
                        $comentar = $_POST["comentar$acIDPub"];
                        $textoc = $_POST["textocoment$acIDPub"];
                        $inserircomentario = "INSERT INTO comentarios(idConta,texto,likes,idPerfil,idPub) VALUES($id,:textoc,0,$acID,$comentar)";
                        try{
                            $newcmt = $conect->prepare($inserircomentario);
                            $newcmt->bindParam(':textoc',$textoc,PDO::PARAM_STR);
                            $newcmt->execute();
                            header("Refresh:0");
                        }catch(PDOException $e){}
                    }

                    $comentarios = "SELECT * FROM comentarios WHERE idPerfil=$acID AND idPub=$acIDPub ORDER BY id DESC";
                    try{
                        $rcomentarios = $conect->prepare($comentarios);
                        $rcomentarios->execute();
                        if($rcomentarios->rowCount()>0){
                            while($show2 = $rcomentarios->FETCH(PDO::FETCH_OBJ)){
                                $donocmt = "SELECT * FROM contas WHERE id=$show2->idConta";
                                $rdonocmt = $conect->prepare($donocmt);
                                $rdonocmt->execute();
                                $donok = $rdonocmt->FETCH(PDO::FETCH_OBJ);

                                $donocmt2 = "SELECT * FROM perfil WHERE id=$show2->idConta";
                                $rdonocmt2 = $conect->prepare($donocmt2);
                                $rdonocmt2->execute();
                                $donok2 = $rdonocmt2->FETCH(PDO::FETCH_OBJ);

                ?>
                <div class="coment">
                    <div>
                        <div>
                            <img src="/content/img/alunos/<?php echo $donok2->foto; ?>" width="30" height="30" style="border-radius:10px;">
                            <b style="margin-left:5px;"><a href="/perfil/<?php echo $donok->id; ?>"><?php echo $donok->nome." ".$donok->sobrenome.$cargo[$donok->verificado];; ?></a></b>
                        </div>
                        <a><?php echo substr($show2->datetime,11,5); ?></a>
                    </div>
                    <section>
                        <a><?php echo $show2->texto; ?></a>
                    </section>
                </div>
                <?php }}}catch(PDOException $e){} ?>

            </div>
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