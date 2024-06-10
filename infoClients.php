<?php session_start(); ?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
        <title>Informations clients</title> 
        <link href="style.css" rel="stylesheet" type="text/css"/>  <!-- lier avec le fichier css "style.css"-->
    </head>
    <body style="background-color: rgb(230,230,255)">
        <header>
            <?php include('Navigation.php') ?>
        </header>
        <h1>Information sur nos clients !</h1>
        <?php 

        // connexion à la bdd (base de donnée)
        try 
        {
            $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', '');
        }

        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        // fonctions
        function supprimer($id_client, $bdd) {
            $req = $bdd->prepare('DELETE FROM client WHERE id= ?'); 
            $req->execute(array($id_client));
        }

        function modifier($id_client, $bdd) { 
            $req = $bdd->prepare('SELECT * FROM client WHERE id= ?'); 
            $req->execute(array($id_client));
            $donnees = $req->fetch() ?>
            <form action="infoClients.php?id=<?php echo $donnees['id']; ?>" method="post">
                <label for="email">Email </label>
                <input type="email" name="email" value="<?php echo $donnees['email']; ?>" required>

                <label for="nom">Nom</label>
                <input type="text" name="nom" value="<?php echo $donnees['nom']; ?>" required>

                <label for="prenom">Prenom </label>
                <input type="text" name="prenom" value="<?php echo $donnees['prenom']; ?>" required>

                <label for="Tel">Telephone</label>
                <input type="text" name="Tel" value="<?php echo $donnees['telephone']; ?>" required>

                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" value="<?php echo $donnees['telephone']; ?>" required><br/>
                <input type="submit" name="Modification"  value="Modifier">
            </form> 
<?php 
        }

        function modification($id_client, $bdd) {
            $mail = htmlspecialchars($_POST['email']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $telephone = htmlspecialchars($_POST['Tel']);
            $adresse = htmlspecialchars($_POST['adresse']);
            $req = $bdd->prepare('UPDATE client SET email= :email, nom= :nom, prenom= :prenom, telephone= :telephone, adresse= :adresse WHERE id= :id'); 
            $req->execute(array('email'=> $mail, 'nom' => $nom, 'prenom' => $prenom, 'telephone' => $telephone, 'adresse' => $adresse, 'id' => $id_client));
        } 


        function tri($bdd){
            $tri =htmlspecialchars($_POST['tri']);
            if($tri =='id'){
                return $req = $bdd->query('SELECT * FROM client ORDER BY id');
            }
            elseif($tri =='nom'){
                return $req = $bdd->query('SELECT * FROM client ORDER BY nom');
            }
            elseif($tri =='prenom'){
                return $req = $bdd->query('SELECT * FROM client ORDER BY prenom');
            }
            elseif($tri =='date'){
                return $req = $bdd->query('SELECT * FROM client ORDER BY date_inscription');
            }
        }

        // affichage des clients

?>
        <form action="infoClients.php" method="post">
            <label for="tri">Trier par : </label>
            <select name="tri">
                <option value="id">Identifiant</option>
                <option value="nom">Nom</option>
                <option value="prenom">Prenom</option>
                <option value="date">Date d'inscription</option>
            </select>
            <input type="submit" name="trie" value="Trier"/>
        </form> <br /><br />
        <form action="infoClients.php" method="post">
                <input type="submit" name="Ajouter" value="Ajouter un client"/>
        </form> <?php
        if(isset($_POST['trie'])){
            $req = tri($bdd);
        } else {
            $req = $bdd->query('SELECT * FROM client');             
        }

        while ($donnees = $req->fetch()) {  ?>
                    <div style="display: flex; align-items: baseline;">
                        <form action="infoClients.php?id=<?php echo $donnees['id']; ?>" method="post" style="margin-right: 10px;">
                                <input type="submit" name="Supprimer" value="Supprimer"/>
                                <input type="submit" name="Modifier" value="Modifier"/>
                        </form>
                        
                        <p>
                            Personne N°<?php echo htmlspecialchars($donnees['id']); ?> | 
                            Nom : <?php echo htmlspecialchars($donnees['nom']); ?> | 
                            Prenom :<?php echo htmlspecialchars($donnees['prenom']); ?> | 
                            Email : <?php echo $donnees['email'];?> |
                            Telephone : <?php echo htmlspecialchars($donnees['telephone']); ?> | 
                            Adresse : <?php echo htmlspecialchars($donnees['adresse']); ?> | 
                            Date d'inscription : <?php echo htmlspecialchars($donnees['date_inscription']); ?>
                            <br />
                        </p>
                    </div>
<?php   }   

        //appel des fonctions 
        if(isset($_POST['Supprimer']) && isset($_GET['id'])){
            supprimer($_GET['id'],$bdd);
            header('Location: infoClients.php');
        }

        if(isset($_POST['Modifier']) && isset($_GET['id'])){
            modifier($_GET['id'],$bdd);
        } 

        if(isset($_POST['Modification']) && isset($_GET['id'])){
            modification($_GET['id'],$bdd);
            header('Location: infoClients.php');
        }

        if(isset($_POST['Ajouter'])){
            header('Location: inscription.php');
        } ?>
    </body>
</html>