<?php session_start(); ?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
        <title>Nos chambres</title> 
        <link href="style.css" rel="stylesheet" type="text/css"/>  <!-- lier avec le fichier css "style.css"-->
    </head>
    <body style="background-color: rgb(230,230,255)" style="text-align: center;">
        <header>
            <?php include('Navigation.php') ?>
        </header>
        <?php 
        try // connexion à la bdd (base de donnée)
        {
            $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', '');
        }

        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        function estReserver($id_chambre) {
        	$bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', '');
		    $req = $bdd->prepare('SELECT dateD_reservation, dateF_reservation FROM reservation WHERE id_chambre = ?');
		    $req->execute(array($id_chambre));
		    if ($req->rowCount()==0) { // Si c'est la première reservation de la chambre on est bon
	            return False;          	
		    }
		    while ($donnees = $req->fetch()) {
		    	if(((strcmp($donnees['dateD_reservation'], date('Y-m-d'))>=0 && strcmp(date('Y-m-d'), $donnees['dateD_reservation'])>=0) || (strcmp($donnees['dateF_reservation'], date('Y-m-d'))>=0 && strcmp(date('Y-m-d'), $donnees['dateF_reservation'])>=0) || ((strcmp(date('Y-m-d'), $donnees['dateD_reservation'] )>=0 && strcmp($donnees['dateF_reservation'], date('Y-m-d'))>=0)))) {
		    		return True;
		    	}
		    }
		    return False;
        }

		if (isset($_GET['id'])) {
		    $id_chambre=htmlspecialchars($_GET['id']); // sécurité
		    $req = $bdd->prepare('SELECT id FROM Chambre WHERE id = ?');
		    $req->execute(array($id_chambre));
		    $count = $req->rowCount();
		    if ($count == 1) { // un id unique par chambre, pas plus pas moins d'où le ' == 1 '
		        // Récupération des infos de la chambre
		        $req = $bdd->prepare('SELECT * FROM Chambre WHERE id = ?');
		        $req->execute(array($id_chambre));
		        $donnees = $req->fetch();
		        if(!estReserver($id_chambre)) {
		        	$message='Cette chambre est actuellement libre';
		        } else {
		        	$message='Cette chambre est actuellement occupée';
		        }
		        ?>
		        <h1>Découvrez notre chambre numéro <?php echo  htmlspecialchars($donnees['Numero']); ?></h1>
		        <div class="chambre">
		            <h3>Chambre numéro <?php echo htmlspecialchars($donnees['Numero']); ?>
		            </h3>
		            <p>
		                <strong> Theme : </strong><?php echo $donnees['Theme'];?><br /><br />
		                <strong>Nombre de lits : </strong><?php echo $donnees['Nb_lits']; ?><br /><br />
		                <strong> Prix : </strong><?php echo htmlspecialchars($donnees['Prix']);?>€<br /><br />
		                <strong> <?php echo $message; ?></strong>
		            </p>
		        </div>                     
		        <br /><br />
		        <form class="recherche" action="Reservation.php?id= <?php echo $id_chambre; ?>" method="post">
		            <p>
		            <label for="DateD">Date de début de réservation :</label>
		            <input type="date" name="DateD" value="<?php echo date('Y-m-d'); ?>" /><br />
		            <label for="DateF">Date de fin de réservation :</label>
		            <input type="date" name="DateF" value="<?php echo date('Y-m-d'); ?>" /><br />
		            <input type="submit" value="Reserver cette chambre" id="publier" name="reserver"/> 
		            </p>
		        </form> 

		        <?php 
		        $req->closeCursor(); // on libère le curseur pour la prochaine requête
		        $req = $bdd->prepare('SELECT dateD_reservation, dateF_reservation FROM reservation WHERE id_chambre = ?');
		        $req->execute(array($id_chambre));
		        $donnees = $req->fetch();
		        function isDate($date, $format = 'Y-m-d'){
				    $dt = DateTime::createFromFormat($format, $date);
				    return $dt && $dt->format($format) === $date;
				}
		        if (isset($_POST['DateD']) AND isset($_POST['DateF']) AND isset($_POST['reserver'])) { // si on a envoyé le form de reservation
		            $DateD = htmlspecialchars($_POST['DateD']);
		            $DateF = htmlspecialchars($_POST['DateF']);
		            if ($req->rowCount()==0) { // Si c'est la première reservation de la chambre on est bon
	            		$req = $bdd->prepare('INSERT INTO reservation (id_client, id_chambre, dateD_reservation, dateF_reservation) VALUES(:client, :chambre, :dateD, :dateF)');
            			$req->execute(array('client'=> 1, 'chambre' => $id_chambre, 'dateD'=> $DateD, 'dateF' => $DateF));
            			echo "<h3>Chambre reservée avec succès !</h3>";
            			die();         	
		            }
		            if(strcmp($DateF, $DateD)>=0 && strcmp($DateD, date('Y-m-d'))>=0 && isDate($DateD) && isDate($DateF)) { // On vérifie la cohérence des données envoyées
		            	if(((strcmp($donnees['dateD_reservation'], $DateD)>=0 && strcmp($DateF, $donnees['dateD_reservation'])>=0) || (strcmp($donnees['dateF_reservation'], $DateD)>=0 && strcmp($DateF, $donnees['dateF_reservation'])>=0) || ((strcmp($DateD, $donnees['dateD_reservation'] )>=0 && strcmp($donnees['dateF_reservation'], $DateF)>=0)))) { // On vérifie que la chambre n'est pas occupée 
							echo "<h3>Cette chambre est occupée pendant cette période</h3>";
		            		die();
		            	} else {
		            		$req = $bdd->prepare('INSERT INTO reservation (id_client, id_chambre, dateD_reservation, dateF_reservation) VALUES(:client, :chambre, :dateD, :dateF)');
	            			$req->execute(array('client'=> 1, 'chambre' => $id_chambre, 'dateD'=> $DateD, 'dateF' => $DateF)); 
	            			echo "<h3>Chambre reservée avec succès !</h3>";
		            	}		            
		            }
		        }
		    } else {
		    echo "<h3>Cet identifiant de chambre ne figure pas dans notre bdd</h3>";
		    }
		} else {
		    echo"Mauvaise URL (error 404 page not found)";
		} ?>
    </body>
</html>