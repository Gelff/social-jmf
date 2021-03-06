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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../perfil/style.css">
    <link rel="icon" type="image/x-icon" href="/content/img/alunos/<?php echo $pFoto; ?>">
</head>
<body>
    <section class="main">    
        <?php include("../content/pages/caminhos.html"); ?>
    
    </section>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Inform??tica</th>
                    <th>Enfermagem</th>
                    <th>Secretaria Escolar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        1?? ano<br>
                        - Informatica b??sica.<br>
                        - Arquitetura e manuten????o de computadores.<br>
                        - Gest??o do tempo.<br>
                        - HTML/CSS.<br>
                        - L??gica de programa????o.<br>
                        2?? ano<br>
                        - No????es de rob??tica.<br>
                        - P.O.O/JAVA.<br>
                        - Programa????o web( JS, PHP E MYSQL ).<br>
                        - Sistemas operacionais.<br>
                        - Design.<br>
                        - Gerenciador de conte??dos/ banco de dados.<br>
                        - Programa????o web II.<br>
                        - Redes de computadores.<br>
                        3?? ano<br>
                        - Profiss??o e forma????o.<br>
                        - Laborat??rio de software.<br>
                        - Laborat??rio de web.<br>
                        - Laborat??rio de hardware.<br>
                    </th>
                    <th>
                        1?? ano<br>
                        - Informatica b??sica.<br>
                        - Anatomia e fisiologia humana b??sica.<br>
                        - Introdu????o ?? profiss??o, legisla????o e bio??tica.<br>
                        - Pol??tica de sa??de.<br>
                        - Promo????o, preven????o e vigil??ncia em sa??de.<br>
                        2?? ano<br>
                        - Prepara????o para realiza????o de exames.<br>
                        - Sa??de da crian??a e do escolar.<br>
                        - Sa??de do homem adolescente, adulto e idoso.<br>
                        - Sa??de mental.<br>
                        - Sa??de da mulher adolescente, adulta e idosa.<br>
                        - Semiologia e semiot??cnica.<br>
                        3?? ano<br>
                        - Assist??ncia ao paciente cir??rgico.<br>
                        - Laborat??rio de pr??ticas da enfermagem I.<br>
                        - Laborat??rio de pr??ticas da enfermagem II.<br>
                    </th>
                    <th>
                        1?? ano<br>
                        - Express??o oral e escrita.<br>
                        - Fundamentos da educa????o.<br>
                        - Introdu????o ao curso t??cnico e ??tica profissional.<br>
                        - Qualidade no atendimento p??blico.<br>
                        - Rela????es interpessoais.<br>
                        2?? ano<br>
                        - Gest??o administrativa da secretaria escolar.<br>
                        - Gest??o educacional.<br>
                        - Legisla????o da educa????o do ensino fundamental.<br>
                        - Legisla????o da educa????o do ensino m??dio e profissional.<br>
                        - Organiza????o da secretaria escolar e acad??mia.<br>
                        - Escritura????o escolar.<br>
                        - Legisla????o do conselho nacional de educa????o.<br>
                        - Organiza????o escolar curr??culo e avalia????o.<br>
                        - T??cnica da secretaria escolar l.<br>
                        3?? ano<br>
                        - Instrumento ger??nciais da escola.<br>
                        - T??cnica da secretaria escolar ll.<br>
                        - T??cnicas de arquivamento.<br>
                        - Est??tistica aplicada ao trabalho do secret??rio escolar.<br>
                    </th>
                </tr>
                </tr>
            </tbody>
        </table>
        
        
        
        
        
    </div>
</body>
</html>