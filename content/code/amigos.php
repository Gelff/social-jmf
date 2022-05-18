<div class="meusamigos">
    <?php 
        $select = "SELECT * FROM amigos WHERE pessoa1=$acID ORDER BY id DESC";
        try{
            $resultado = $conect->prepare($select);
            $resultado->execute();
            if($resultado->rowCount()>0){
                while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
                    $amigo = $show->pessoa2;
                    $idamigo = $show->id;
                    $getamigo = "SELECT * FROM contas WHERE id=$amigo";
                    $getamigoResult = $conect->prepare($getamigo);
                    $getamigoResult->execute();
                    $amigoinfo = $getamigoResult->FETCH(PDO::FETCH_OBJ);

                    $getamigoperfil = "SELECT * FROM perfil WHERE id=$amigoinfo->id";
                    $getamigoResultperfil = $conect->prepare($getamigoperfil);
                    $getamigoResultperfil->execute();
                    $amigoinfoperfil = $getamigoResultperfil->FETCH(PDO::FETCH_OBJ);
    ?>
    <div class="amigo">
        <div>
            <img src="/content/img/alunos/<?php echo $amigoinfoperfil->foto; ?>" width="70" height="70">
            <div><?php $status = ["<b style='color:gray;'>Ausente</b>","<b style='color:green;'>Online</b>","<b style='color:red;'>Ocupado</b>"]; $cargo = ["","<button class='verificado1' style='margin-left:3px;width:15px;height:15px;'></button>"]; ?>
                <b><a href="/perfil/<?php echo $amigoinfo->id; ?>"><?php echo $amigoinfo->nome." ".$amigoinfo->sobrenome.$cargo[$amigoinfo->verificado]; ?></a> <?php echo $status[$amigoinfo->status]; ?></b>
                <b><?php echo $amigoinfoperfil->biografia; ?></b>
            </div>
        </div>
        <div class="amigobtnkk">
            <button id="deletefriend<?php echo $idamigo; ?>"></button>
        </div>
        <div id="deleteask">

        </div>
        <script>
            deletefriend<?php echo $idamigo; ?> = document.getElementById("deletefriend<?php echo $idamigo; ?>");
            deleteask = document.getElementById("deleteask");
            deletefriend<?php echo $idamigo; ?>.addEventListener("click",()=>{
                console.log(deletefriend<?php echo $idamigo; ?>.id)
                deleteask.innerHTML=
                "<form method='post'><a>Deseja remover <b><?php echo $amigoinfo->nome." ".$amigoinfo->sobrenome; ?> </b>dos amigos?</a><div><input type='submit' name='excluirsim' value='<?php echo $idamigo; ?>'><input type='submit' name='excluirnao' value='Não'></div></form>"
                deleteask.style="width:100%;height:100%;"
            })
        </script>
        <?php
            if(isset($_POST["excluirsim"])){
                $excluiramg = $_POST["excluirsim"];
                $deleteamg = "DELETE FROM amigos WHERE id=$excluiramg";
                try{
                    $resultado = $conect->prepare($deleteamg);
                    $resultado->execute();
                    header("Refresh:0");
                }catch(PDOException $e){}
            }
            if(isset($_POST['excluirnao'])){header("Refresh:0");}
        ?>
    </div>
    <?php }}}catch(PDOException $e){ echo '<strong>ERRO DE PDO= </strong>'.$e->getMessage();} ?>
</div>