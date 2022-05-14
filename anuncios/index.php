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
                    <th>Informática</th>
                    <th>Enfermagem</th>
                    <th>Secretaria Escolar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        1° ano<br>
                        - Informatica básica.<br>
                        - Arquitetura e manutenção de computadores.<br>
                        - Gestão do tempo.<br>
                        - HTML/CSS.<br>
                        - Lógica de programação.<br>
                        2° ano<br>
                        - Noções de robótica.<br>
                        - P.O.O/JAVA.<br>
                        - Programação web( JS, PHP E MYSQL ).<br>
                        - Sistemas operacionais.<br>
                        - Design.<br>
                        - Gerenciador de conteúdos/ banco de dados.<br>
                        - Programação web II.<br>
                        - Redes de computadores.<br>
                        3° ano<br>
                        - Profissão e formação.<br>
                        - Laboratório de software.<br>
                        - Laboratório de web.<br>
                        - Laboratório de hardware.<br>
                    </th>
                    <th>
                        1° ano<br>
                        - Informatica básica.<br>
                        - Anatomia e fisiologia humana básica.<br>
                        - Introdução à profissão, legislação e bioética.<br>
                        - Política de saúde.<br>
                        - Promoção, prevenção e vigilância em saúde.<br>
                        2° ano<br>
                        - Preparação para realização de exames.<br>
                        - Saúde da criança e do escolar.<br>
                        - Saúde do homem adolescente, adulto e idoso.<br>
                        - Saúde mental.<br>
                        - Saúde da mulher adolescente, adulta e idosa.<br>
                        - Semiologia e semiotécnica.<br>
                        3° ano<br>
                        - Assistência ao paciente cirúrgico.<br>
                        - Laboratório de práticas da enfermagem I.<br>
                        - Laboratório de práticas da enfermagem II.<br>
                    </th>
                    <th>
                        1° ano<br>
                        - Expressão oral e escrita.<br>
                        - Fundamentos da educação.<br>
                        - Introdução ao curso técnico e ética profissional.<br>
                        - Qualidade no atendimento público.<br>
                        - Relações interpessoais.<br>
                        2° ano<br>
                        - Gestão administrativa da secretaria escolar.<br>
                        - Gestão educacional.<br>
                        - Legislação da educação do ensino fundamental.<br>
                        - Legislação da educação do ensino médio e profissional.<br>
                        - Organização da secretaria escolar e acadêmia.<br>
                        - Escrituração escolar.<br>
                        - Legislação do conselho nacional de educação.<br>
                        - Organização escolar currículo e avaliação.<br>
                        - Técnica da secretaria escolar l.<br>
                        3° ano<br>
                        - Instrumento gerênciais da escola.<br>
                        - Técnica da secretaria escolar ll.<br>
                        - Técnicas de arquivamento.<br>
                        - Estátistica aplicada ao trabalho do secretário escolar.<br>
                    </th>
                </tr>
                </tr>
            </tbody>
        </table>
        
        
        
        
        
    </div>
</body>
</html>