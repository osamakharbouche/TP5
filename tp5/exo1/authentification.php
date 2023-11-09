<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       if(isset($_POST["btnEnvoyer"])){
        $pdo=new PDO("mysql:host=localhost;dbname=espace_membre","root","");
        $stm=$pdo->prepare("select * from MEMBRES where email=?");
        $stm->execute([$_POST["email"]]);
        $ligne=$stm->fetch();

        if($ligne!=false && password_verify($_POST["mpass"],$ligne["MPASS"])){
            echo "Bienvenue vous êtes connecté";
        }else{
            echo "Email ou mot de passe incorrect <a href='inscription.html'>Inscription </a>";
        }
       }
    ?>
</body>
</html>