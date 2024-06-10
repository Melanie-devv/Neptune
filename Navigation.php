<nav>
  <ul class="menu">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="Chambres.php?theme=&search=">Reserver</a></li>
    <li><a href="Restaurant.php">Restaurant</a></li>
    <li><a href="Newsletter.php">Newsletter</a></li>
    <li><a href="EnSavoirPlus.php">En savoir plus</a></li>
    <li><a href="Contact.html">Contact</a></li>
<?php
if(isset($_SESSION["id"])){ // On vérifie si l'utilisateur est connecté. Si oui on lui affiche : ?> 
    <li class="right"><a href="profil.php">Page membre</a></li>

<?php  
    try 
  {
      $bdd = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', '');
  }

  catch(Exception $e)
  {
      die('Erreur : '.$e->getMessage());
  }

  $req = $bdd->prepare('SELECT admin FROM client WHERE id= ?'); 
  $req->execute(array($_SESSION["id"]));
  $donnees = $req->fetch();

  if($donnees['admin']){ // On vérifie si l'utilisateur est connecté. Si oui on lui affiche : ?> 
      <li class="right"><a href="/PROJET_NEPTUNE/admin_backup/index.html">Page admin</a></li>

<?php } } else { // Si l'utilisateur n'est pas connecté, il a un bouton "se connecter" aulieu de "page membre" : ?>
    <li class="right"><a href="Connexion.php">Se connecter</a></li>

<?php } ?>

  </ul>
</nav>