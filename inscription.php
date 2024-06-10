<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8','root','');
} catch(Exception $e) { 
    die('Erreur : '.$e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = $_POST['password'] ;
    $password2 = $_POST['confirm-mdp'];
    $adress = htmlspecialchars($_POST['adress']);
    $tel = htmlspecialchars($_POST['phone']);

    $req = $bdd->query("SELECT email FROM client WHERE email = '$mail'"); 
    $count = $req->rowCount(); 

    if ($count !== 0) {
        die("email deja present");
        header('location : Connexion.php ' );
    }

    if (($password !== $password2)){
        die("les mots de passes ne sont pas identiques");
    }
    $insertmbr = $bdd->prepare('INSERT INTO client(email,mdp,nom,prenom,telephone,adresse, date_inscription, admin) values(:mail, :mdp, :nom, :prenom, :tel, :adresse, NOW(), 0)');
    $insertmbr->execute(array('mail'=> $mail, 'mdp' => password_hash($password, PASSWORD_DEFAULT), 'nom'=> $name, 'prenom' => $username, 'tel' => $tel, 'adresse' => $adress));
    header('Location: Connexion.php ');
}         
?>
<!DOCTYPE html>
<html lang="FR">  
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="style.css">
    </head> 
    <header>
        <?php include('Navigation.php') ?>
    </header>
    <body style="text-align: center;">
    <div class="box-co">
        <div class="nd-from">
        <form action="inscription.php" method="post">
                <label class="label" for="name">Nom </label>
                <input class="form" type="text" name="name" placeholder="Entrez votre nom*" required>

                <label class="label" for="username">Prenom</label>
                <input class="form" type="text" name="username" placeholder="Entrez votre Prenom*" required>

                <label class="label" for="phone">Téléphone </label>
                <input class="form" type="tel" name="phone" placeholder="Entrez votre téléphone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" maxlength="10" minlength="10">

                <label class="label" for="adress">Adresse</label>
                <input class="form" type="text" name="adress" placeholder="Entrez votre adresse">

                <label class="label" for="mail">Mail </label>
                <input class="form" type="email" name="mail" placeholder=" exemple@gmail.com*" pattern=".+@gmail\.com" max="40" required>

                <label class="label" for="password">Mot de passe</label>
                <input class="form" type="password" name="password" placeholder="Entrez votre mot de passe*" required>

                <label class="label" for="confirm-mdp">Confirmer mot de passe</label>
                <input class="form" type="password" name="confirm-mdp" placeholder="Confirmer votre mot de passe *" required>

                <input class="btnco" type="submit" name="inscription"  value="Inscription">
        </div>
            <div class="btnbelec">
                <a href="connexion.php"> retour</a>
            </div>
        </form>
    </div>

    </body>
</html>
 