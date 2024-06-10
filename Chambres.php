<?php session_start(); ?>
<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
        <title>Nos chambres</title> 
        <link href="style.css" rel="stylesheet" type="text/css"/>  <!-- lier avec le fichier css "style.css"-->
    </head>
    <body style="background-color: rgb(230,230,255)">
        <header>
            <?php include('Navigation.php') ?>
        </header>
        <h1>Découvrez nos chambres !</h1>
        <div class="recherche">
            <form action="Chambres.php" method="GET">
                <label for="theme">Theme :</label>
                <select class="form" name="theme" >
                        <option value="Corail">Corail</option>
                        <option value="Ocean">Ocean</option>
                        <option value="Plage">Plage</option>
                        <option value="Bateau">Bateau</option>
                        <option value="Coquillage">Coquillage</option>
                        <option value="Aquarium">Aquarium</option>
                        <option value="Pirate">Pirate</option>
                        <option value="Autre">Autre</option>
                        <option value="" selected >Tout</option>
                </select><br />
                <label for="search">Rechercher une chambre : </label>
                <input type="search" name="search" placeholder="Recherche..." size="50" /><br />
            </form>
        </div>
        <?php 
        try // connexion à la bdd (base de donnée)
        {
            $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', '');
        }

        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        if (isset($_GET['theme']) && isset($_GET['search']))  {
            // Pour le système de pagination 
            if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0) { 
                $pageCourante = intval($_GET['page']); // pour transformer $_GET['page'] en int (nb entier)
            } else {
                $pageCourante = 1;
            }
            $billetsParPage = 5;
            $depart = ($pageCourante-1)*$billetsParPage;

            if (!empty($_GET['search']) && !empty($_GET['theme'])) {
                $theme=htmlspecialchars($_GET['theme']); // sécurité
                $search=htmlspecialchars($_GET['search']); // sécurité
                $req = $bdd->prepare('SELECT id FROM Chambre WHERE Theme = ? AND id IN (SELECT id FROM Chambre WHERE Theme LIKE "%'.$search.'%") ORDER BY Numero '); // LIKE va permettre de rechercher un Numero approximatif (les % signifie qu'il peut y avoir des caractères avant ou après ce qu'on à recherché: $search)
                $req->execute(array($theme));
                $count = $req->rowCount();
                if($count == 0) { // si aucun résultat, on regarde le Numero + le theme
                    $req = $bdd->prepare('SELECT id FROM Chambre WHERE Theme = ? AND id IN (SELECT id FROM Chambre WHERE Numero LIKE "%'.$search.'%") ORDER BY Numero ');
                    $req->execute(array($theme));
                }
            }
            elseif (!empty($_GET['theme'])) { // Si on à cliqué sur un thème précis (dans le formulaire)
                $theme=htmlspecialchars($_GET['theme']); // sécurité
                $req = $bdd->prepare('SELECT id FROM Chambre WHERE Theme = ? ORDER BY Numero ');
                $req->execute(array($theme));
            }
            elseif (!empty($_GET['search'])) {
                $search=htmlspecialchars($_GET['search']); // sécurité
                $req = $bdd->query('SELECT id FROM Chambre WHERE Numero LIKE "%'.$search.'%" ORDER BY Numero '); // LIKE va permettre de rechercher un Numero approximatif (les % signifie qu'il peut y avoir des caractères avant ou après ce qu'on à recherché: $search)
                $count = $req->rowCount();
                if($count == 0) { // si aucun résultat, on regarde le Numero + le theme
                    $req = $bdd->query('SELECT id FROM Chambre WHERE Theme LIKE "%'.$search.'%" ORDER BY Numero ');
                }
            } else {
                $req = $bdd->query('SELECT * FROM Chambre ORDER BY Numero ');
            }
            $count = $req->rowCount();
            if ($count > 0) { 
                //système de pagination
                $billetsTotaux = $count;
                $pagesTotales = ceil($billetsTotaux/$billetsParPage);

                if (!empty($_GET['search'])) {
                    echo '<h4> Récultats correspondants à : <i>' . $search . '</i></h4>';
                    $req = $bdd->query('SELECT * FROM Chambre WHERE Numero LIKE "%'.$search.'%" ORDER BY Numero  LIMIT ' .$depart. ',' . $billetsParPage);
                    $count = $req->rowCount();
                    if($count == 0) { // si aucun résultat, on regarde le Numero + le theme
                        $req = $bdd->query('SELECT * FROM Chambre WHERE Theme LIKE "%'.$search.'%" ORDER BY Numero  LIMIT ' .$depart. ',' . $billetsParPage);
                    }
                }
                if (!empty($_GET['theme'])) {
                    echo '<h4> Découvrez nos chambres sur le theme ' . $theme .' :)</h4>';
                    $req = $bdd->prepare('SELECT * FROM Chambre WHERE Theme = ? ORDER BY Numero LIMIT '. $depart .',' . $billetsParPage);
                    $req->execute(array($theme));
                }
                if (!empty($_GET['search']) && !empty($_GET['theme'])) {
                    $req = $bdd->prepare('SELECT  * FROM Chambre WHERE Theme = ? AND id IN (SELECT id FROM Chambre WHERE Theme LIKE "%'.$search.'%") ORDER BY Numero LIMIT ' .$depart. ',' . $billetsParPage); // LIKE va permettre de rechercher un Numero approximatif (les % signifie qu'il peut y avoir des caractères avant ou après ce qu'on à recherché: $search)
                    $req->execute(array($theme));
                    $count = $req->rowCount();
                    if($count == 0) { // si aucun résultat, on regarde le Numero + le theme
                        $req = $bdd->prepare('SELECT  * FROM Chambre WHERE Theme = ? AND id IN (SELECT id FROM Chambre WHERE Numero LIKE "%'.$search.'%") ORDER BY Numero  LIMIT ' .$depart. ',' . $billetsParPage);
                        $req->execute(array($theme));
                    }
                }
                if (empty($_GET['search']) && empty($_GET['theme'])) {
                    $req = $bdd->query('SELECT * FROM Chambre ORDER BY Numero  LIMIT ' .$depart. ',' . $billetsParPage);
                }
                while ($donnees = $req->fetch()) { ?>
                    <div class="chambre">
                        <h3>
                            <a href="Reservation.php?id= <?php echo $donnees['id']; ?>">Chambre numéro <?php echo htmlspecialchars($donnees['Numero']); ?></a>
                            <em class="prix"> Au prix de <?php echo htmlspecialchars($donnees['Prix']); ?> €</em>
                        </h3> 
                        <p>
                            Cette magnifique chambre possède <?php echo htmlspecialchars($donnees['Nb_lits']); ?> lits
                            <br />                            
                            <img class="photo_chambre" src="https://www.oceaniahotels.com/media/cache/slideshow/media/upload/7eb2d50e38ef92ef2f67b305b32f83e1/1/1800x/ql2edd/70/Hotel_4_etoiles_Montpellier_-_Hotel_Oceania_Le_Metropole_(27).jpg" width="40%">
                            <br />
                            <a class="bouton" href="Reservation.php?id= <?php echo $donnees['id']; ?>">Reserver cette chambre</a> <!-- lien vers la page qui permet de reserver -->
                            <em class="theme">Thème : <?php echo $donnees['Theme']; ?></em> 
                        </p>
                    </div>
                    <?php
                }
                $req -> closeCursor(); // pour liberer le curseur 
            } else { // si aucune chambre n'a ce thème (ou si l'utilisateur un mis un faux thème dans l'url)
                echo"<h3>Aucune chambre ne correspond à cette recherche</h3>";
                die();
            }

        } else { 
            echo"Mauvaise URL (error 404 page not found)";
            die();
        }
        echo '<div class="pagination">';
            for ($i=1;$i<=$pagesTotales;$i++) { // affichage de liens pour naviguer entre les pages 
                if ($i == $pageCourante) {
                    echo '<a id="PageCourante" href="#"> ' .$i. ' </a>';
                } else {
                    echo '<a href="Chambres.php?theme=&search=&page=' .$i. '"> ' .$i. ' </a>'; 
                } 
            }
        echo '</div>'; ?>
    </body>
</html>