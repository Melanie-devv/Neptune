<?php session_start(); ?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
        <title>Informations reservations</title> 
        <link href="style.css" rel="stylesheet" type="text/css"/>  <!-- lier avec le fichier css "style.css"-->
    </head>
    <body style="background-color: rgb(230,230,255)">
        <header>
            <?php include('Navigation.php') ?>
        </header>
        <h1>Information sur nos reservations !</h1>
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
        function supprimer($id_reservation, $bdd) {
            $req = $bdd->prepare('DELETE FROM reservation WHERE id= ?'); 
            $req->execute(array($id_reservation));
        }

        function tri($bdd){
            $tri =htmlspecialchars($_POST['tri']);
            if($tri =='id'){
                return $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client ORDER BY reservation.id');
            }
            elseif($tri =='dateD'){
                return $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client ORDER BY reservation.dateD_reservation');
            }
            elseif($tri =='dateF'){
                return $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client ORDER BY reservation.dateF_reservation');
            }
            elseif($tri =='num'){
                return $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client ORDER BY chambre.numero');
            }
            elseif($tri =='nom'){
                return $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client ORDER BY personne');
            }
        }

        // affichage des reservation

?>
        <form action="infoReservations.php" method="post">
            <label for="tri">Trier par : </label>
            <select name="tri">
                <option value="id">Identifiant</option>
                <option value="dateD">Date de début de reservation</option>
                <option value="dateF">Date de fin de reservation</option>
                <option value="num">Numéro de chambre</option>
                <option value="nom">Nom du client</option>
            </select>
            <input type="submit" name="trie" value="Trier"/>
        </form> <br /><br /><?php
        if(isset($_POST['trie'])){
            $req = tri($bdd);
        } else {
            $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client');             
        }
        while ($donnees = $req->fetch()) {  ?>
                    <div style="display: flex; align-items: baseline;">
                        <form action="infoReservations.php?id=<?php echo $donnees['id']; ?>" method="post" style="margin-right: 10px;">
                                <input type="submit" name="Supprimer" value="Supprimer"/>
                        </form>
                        
                        <p>
                            Reservation de la chambre N°<?php echo htmlspecialchars($donnees['Numero']); ?>| 
          <!--                  Par :<?php echo htmlspecialchars($donnees['personne']); ?>|     -->
                            A partir du :<?php echo htmlspecialchars($donnees['dateD_reservation']); ?>| 
                            Jusqu'au :<?php echo $donnees['dateF_reservation'];?>|
                            Id de la reservation : <?php echo htmlspecialchars($donnees['id']); ?>
                            <br />
                        </p>
                    </div>
<?php   }   

        //appel des fonctions 
        if(isset($_POST['Supprimer']) && isset($_GET['id'])){
            supprimer($_GET['id'],$bdd);
            header('Location: infoReservations.php');
        }?>
    </body>
</html>