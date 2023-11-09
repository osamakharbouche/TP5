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
           //établir la connexion avec la BD
           $pdo=new PDO("mysql:host=localhost;dbname=espace_membre","root","");
           //préparer une requête
           $stm=$pdo->prepare("select * from MEMBRES where email=?");
            $stm->execute([$_POST["email"]]);
            $ligne=$stm->fetch();
          if($ligne==false){
                $stm=$pdo->prepare("insert into MEMBRES(NOM,PRENOM,EMAIL,MPASS,GENRE,PAYS)
                values(?,?,?,?,?,?)");
                // exécuter une requête
               $stm->execute([$_POST["nom"],
                            $_POST["prenom"],
                            $_POST["email"],
                            password_hash($_POST["mpass"],PASSWORD_DEFAULT),
                            $_POST["genre"],
                            $_POST["pays"]]);  
                echo "Inscription effectué avec succès <a href='authentification.html'>Connexion</a>";               
          }else{
              echo "Il y a déjà un compte avec cet email !!!";
          }
           
       }
    ?>
</body>
</html>