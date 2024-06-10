<?php session_start(); 
if (!$_SESSION["admin"]){
header('location: ../index.php');
}?>
<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Informations reservations</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div class="container">
		<div class="navigation">
			<ul>
				<li><!-- nav bar  -->
					<a href="#">
						<span class="icon"><ion-icon name="logo-apple"></ion-icon></span>
						<span class="title" style="font-size: 1.5em;font-weight: 500;">hotel Neptune</span>
					</a>
				</li>
				<li class="hovered">
					<a href="index.html">
						<span class="icon"><ion-icon name="home-outline"></ion-icon></span>
						<span class="title">Dashboard</span>
					</a>
				</li>
				<li>
					<a href="infoclient.php">
						<span class="icon"><ion-icon name="people-outline"></ion-icon></span>
						<span class="title">Client</span>
					</a>
				</li>
				<li>
					<a href="inforeservation.php">
						<span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
						<span class="title">Reservation</span>
					</a>
				</li>
				<li>
					<a href="infochambre.php">
						<span class="icon"><ion-icon name="help-outline"></ion-icon></span>
						<span class="title">Chambre</span>
					</a>
				</li>
				<li>
					<a href="deconnexion.php">
						<span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
						<span class="title">Deconnexion</span>
					</a>
				</li>
			</ul>
		</div>

		<!-- main qui delimitte la bar de gauche  -->
		<div class="main">
			<div class="topbar">
				<div class="toggle">
					<ion-icon name="menu-outline"></ion-icon>
				</div>
			
			<!-- cards pour les chiffre -->
			<div class="cardBox">
				<div class="card">
					<div>
						<div class="numbers">variable a mettre</div>
						<div class="cardName">chambre total/chambre occupé</div>
					</div>
					<div class="iconBx">
						<ion-icon name="eye-outline"></ion-icon>
					</div>
				</div>
				<div class="card">
					<div>
						<div class="numbers">Variable a mettre</div>
						<div class="cardName">revenu estimé /jours</div>
					</div>
					<div class="iconBx">
						<ion-icon name="cart-outline"></ion-icon>
					</div>
				</div>
				<div class="card">
					<div>
						<div class="numbers">Variable a mettre</div>
						<div class="cardName">compte sur le site</div>
					</div>
					<div class="iconBx">
						<ion-icon name="chatbubbles-outline"></ion-icon>
					</div>
				</div>
			</div>

			<div class="details">
				<!-- order ou achat-->
				<div class="recentOrders">
					<div class="cardHeader">
						<h2><h1>Information sur les reservations !</h1></h2>
					</div>
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
<form action="inforeservation.php" method="post">
    <label for="tri">Trier par : </label>
    <select name="tri">
        <option value="id">Identifiant</option>
        <option value="dateD">Date de début de reservation</option>
        <option value="dateF">Date de fin de reservation</option>
        <option value="num">Numéro de chambre</option>
        <option value="nom">Nom du client</option>
    </select>
    <input type="submit" name="trie" value="Trier"/>
</form><?php
if(isset($_POST['trie'])){
    $req = tri($bdd);
} else {
    $req = $bdd->query('SELECT chambre.Numero, CONCAT(client.nom,\' \', client.prenom) AS personne, reservation.* FROM chambre, client, reservation WHERE chambre.id = reservation.id_chambre AND client.id = reservation.id_client');             
}
while ($donnees = $req->fetch()) {  ?>
            <div style="display: flex; align-items: baseline;">
                <form action="inforeservation.php?id=<?php echo $donnees['id']; ?>" method="post" style="margin-right: 10px;">
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
}?>
				</div>

				<!-- New Customers -->
				<div class="recentCustomers">
					<div class="cardHeader">
						<h2>dernier compte
							
						</h2>
					</div>
					<table>
						<tr>
							<td width="60px"><div class="imgBx"><img src="img1.jpg"></div></td>
							<td><h4>David<br><span>Italy</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img2.jpg"></div></td>
							<td><h4>Muhammad<br><span>India</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img3.jpg"></div></td>
							<td><h4>Amelia<br><span>France</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img4.jpg"></div></td>
							<td><h4>Olivia<br><span>USA</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img5.jpg"></div></td>
							<td><h4>Amit<br><span>Japan</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img6.jpg"></div></td>
							<td><h4>Ashraf<br><span>India</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img7.jpg"></div></td>
							<td><h4>Diana<br><span>Malaysia</span></h4></td>
						</tr>
						<tr>
							<td><div class="imgBx"><img src="img8.jpg"></div></td>
							<td><h4>Amit<br><span>India</span></h4></td>
						</tr>

					</table>
				</div>


			</div>

		</div>
	</div>


	<script>
		// MenuToggle
		let toggle = document.querySelector('.toggle');
		let navigation = document.querySelector('.navigation');
		let main = document.querySelector('.main');

		toggle.onclick = function(){
			navigation.classList.toggle('active');
			main.classList.toggle('active');
		}

		// add hovered class in selected list item
		let list = document.querySelectorAll('.navigation li');
		function activeLink(){
			list.forEach((item) =>
			item.classList.remove('hovered'));
			this.classList.add('hovered');
		}
		list.forEach((item) => 
		item.addEventListener('mouseover',activeLink));
	</script>
</body>
</html>
