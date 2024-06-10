<nav>
  <ul class="menu">
    <li><a href="Index.html">Accueil</a></li>
    <li><a href="Chambres.php?theme=&search=">Reserver</a></li>
    <li><a href="Restaurant.html">Restaurant</a></li>
    <li><a href="Newsletter.html">Newsletter</a></li>
    <li><a href="EnSavoirPlus.html">En savoir plus</a></li>
    <li><a href="Contact.html">Contact</a></li>
<?php
if(isset($_SESSION["id"])){ // On vérifie si l'utilisateur est connecté. Si oui on lui affiche : ?> 
    <li class="right"><a href="profil.php">Page membre</a></li>

<?php  } else { // Si l'utilisateur n'est pas connecté, il a un bouton "se connecter" aulieu de "page membre" : ?>
    <li class="right"><a href="Connexion.php">Se connecter</a></li>

<?php } ?>

  </ul>
</nav>