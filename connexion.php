<?php
$bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8','root','');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $requser = $bdd->prepare("SELECT * FROM client WHERE email = ?");
    $requser->execute([
        $_POST['mail'],
    ]);

    if (!$user = $requser->fetch()){
        header('Location: connexion.php');
    }

    if (!password_verify($_POST['password'], $user['mdp'])){
        die('password incorrect');
    }
    session_start();
    $_SESSION = $user;
    header('Location: profil.php?id='.$user['id']);
    exit;
}

if(isset($erreur))
{ 
    echo '<i style="color:red;font-size:20px;"> '.$erreur.' </i>';
}
?>
<!DOCTYPE html>
<html lang="FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Connexion</title>
    </head>
    <header>
        <?php include('Navigation.php') ?>
    </header>
    <body style="text-align: center;">

        <div class="box-co">

            <img id="icon" src="icon.png" alt="icon">
            <form action="connexion.php" method="POST" >
                <input class="form" type="email" name="mail" placeholder="Email" require>
                <br><br>
                <input class="form" type="password" name="password" placeholder="Mot de passe" require>
                <br><br>
                <input class="btnco" type="submit" name="connexion"  value="connexion">
                <br><br>
            <button class="btnco">
                <a href="inscription.php">incription</a>
            </button>
        </div>
    </body>
</html>
