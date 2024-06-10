<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Informations client</title>
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
					<a href="#">
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
						<h2><h1>Information sur les comptes clients !</h1></h2>
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
        function estReserver($id_chambre, $bdd) {
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

        function supprimer($id_chambre, $bdd) {
            $req = $bdd->prepare('DELETE FROM chambre WHERE id= ?'); 
            $req->execute(array($id_chambre));
        }

        function modifier($id_chambre, $bdd) { 
            $req = $bdd->prepare('SELECT * FROM chambre WHERE id= ?'); 
            $req->execute(array($id_chambre));
            $donnees = $req->fetch() ?>
            <form action="infochambre.php?id=<?php echo $donnees['id']; ?>" method="post">
                <label for="num">Numéro </label>
                <input type="number" name="num" value="<?php echo $donnees['Numero']; ?>" required>

                <label for="prix">Prix</label>
                <input type="number" name="prix" value="<?php echo $donnees['Prix']; ?>" required>

                <label for="lits">Nombre de lits </label>
                <input type="number" name="lits" value="<?php echo $donnees['Nb_lits']; ?>" required>

                <label for="theme">Theme</label>
                <input type="text" name="theme" value="<?php echo $donnees['Theme']; ?>" required><br/>
                <input type="submit" name="Modification"  value="Modifier">
            </form> 
<?php 
        }

        function modification($id_chambre, $bdd) {
            $num = htmlspecialchars($_POST['num']);
            $prix = htmlspecialchars($_POST['prix']);
            $lits = htmlspecialchars($_POST['lits']);
            $theme = htmlspecialchars($_POST['theme']);
            $req = $bdd->prepare('UPDATE chambre SET Numero= :numero,Prix= :prix,Nb_lits= :lits,Theme= :theme WHERE id= :id'); 
            $req->execute(array('numero'=> $num, 'prix' => $prix, 'lits' => $lits, 'theme' => $theme, 'id' => $id_chambre));
        } 

        function ajouter($bdd){ ?>
            <form action="infochambre.php" method="post">
                <label for="num">Numéro </label>
                <input type="number" name="num"  required>

                <label for="prix">Prix</label>
                <input type="number" name="prix" required>

                <label for="lits">Nombre de lits </label>
                <input type="number" name="lits"  required>

                <label for="theme">Theme</label>
                <input type="text" name="theme" required><br/>
                <input type="submit" name="Creation"  value="Ajouter">
            </form> 
<?php   }

        function creation($bdd){
            $num = htmlspecialchars($_POST['num']);
            $prix = htmlspecialchars($_POST['prix']);
            $lits = htmlspecialchars($_POST['lits']);
            $theme = htmlspecialchars($_POST['theme']);
            $req = $bdd->prepare('INSERT INTO chambre(Numero,Prix,Nb_lits,Theme) VALUES (:numero,:prix, :lits, :theme)'); 
            $req->execute(array('numero'=> $num, 'prix' => $prix, 'lits' => $lits, 'theme' => $theme));
        }

        function tri($bdd){
            $tri =htmlspecialchars($_POST['tri']);
            if($tri =='prixD'){
                return $req = $bdd->query('SELECT * FROM chambre ORDER BY Prix DESC');
            } /*else { // Ne marche pas jsp pk mais c chiant
                $req = $bdd->prepare('SELECT * FROM chambre ORDER BY :tri');
                $req->execute(array('tri'=> $tri));
            } */
            elseif($tri =='Prix'){
                return $req = $bdd->query('SELECT * FROM chambre ORDER BY Prix');
            }
            elseif($tri =='Numero'){
                return $req = $bdd->query('SELECT * FROM chambre ORDER BY Numero');
            }
            elseif($tri =='Nb_lits'){
                return $req = $bdd->query('SELECT * FROM chambre ORDER BY Nb_lits');
            }
            elseif($tri =='Theme'){
                return $req = $bdd->query('SELECT * FROM chambre ORDER BY Theme');
            }
            elseif($tri =='id'){
                return $req = $bdd->query('SELECT * FROM chambre ORDER BY id');
            }
        }

        function revenu($bdd){
            $req = $bdd->query('SELECT * FROM reservation');
            if ($req->rowCount()==0) { // Si aucune reservation
                return '0';           
            }
            $total = 0;
            while ($donnees = $req->fetch()) {
                if (estReserver($donnees['id_chambre'], $bdd)) {
                    $req2 = $bdd->prepare('SELECT chambre.prix FROM chambre, reservation WHERE chambre.id = reservation.id_chambre AND chambre.id = :id ');
                    $req2->execute(array('id'=> $donnees['id_chambre']));
                    $donnees2 = $req2->fetch();
                    $total+= $donnees2['prix'];
                    $req2 -> closeCursor();
                }
            }
            return $total;
        }

        function nbChambreReserver($bdd){
            $req = $bdd->query('SELECT * FROM reservation');
            if ($req->rowCount()==0) { // Si aucune reservation
                return '0';           
            }
            $total = 0;
            while ($donnees = $req->fetch()) {
                if (estReserver($donnees['id_chambre'], $bdd)) {
                    $total++;
                }
            }
            return $total;
        }

        // affichage des chambres

?>
        <p>Revenus de la journée : <?php echo revenu($bdd); ?> €</p>
        <p>Nombres de chambres réservées : <?php echo nbChambreReserver($bdd); ?> / 12</p> <!-- c'est écrit dans la consigne qu'il a 12 chambres-->
        <form action="infochambre.php" method="post">
            <label for="tri">Trier par : </label>
            <select name="tri">
                <option value="id">Identifiant</option>
                <option value="Prix">Prix croissant</option>
                <option value="prixD">Prix decroissant</option>
                <option value="Numero">Numéro de chambre</option>
                <option value="Nb_lits">Nombre de lits</option>
                <option value="Theme">Theme</option>
            </select>
            <input type="submit" name="trie" value="Trier"/>
        </form> 
        <form action="infochambre.php" method="post">
                <input type="submit" name="Ajouter" value="Ajouter une chambre"/>
        </form> <?php
        if(isset($_POST['trie'])){
            $req = tri($bdd);
        } else {
            $req = $bdd->query('SELECT * FROM chambre');             
        }

        while($donnees = $req->fetch()){ ?>
            <div style="display: flex; align-items: baseline;">
                        <form action="infochambre.php?id=<?php echo $donnees['id']; ?>" method="post" style="margin-right: 10px;">
                                <input type="submit" name="Supprimer" value="Supprimer"/>
                                <input type="submit" name="Modifier" value="Modifier"/>
                        </form>
                        
                        <p>
                            <a href="../Reservation.php?id=<?php echo $donnees['id']; ?>">Chambre N°<?php echo htmlspecialchars($donnees['Numero']); ?></a> | 
                            Au prix de <?php echo htmlspecialchars($donnees['Prix']); ?> € | 
                            Possède <?php echo htmlspecialchars($donnees['Nb_lits']); ?> lits | 
                            Thème : <?php echo $donnees['Theme']; 
                            if (estReserver($donnees['id'],$bdd)){
                                echo ' | Chambre occupée';
                            } else {
                                echo ' | Chambre libre';
                            }  ?><br />
                        </p>
                    </div>
<?php   }

        //appel des fonctions 
        if(isset($_POST['Supprimer']) && isset($_GET['id'])){
            supprimer($_GET['id'],$bdd);
        }

        elseif(isset($_POST['Modifier']) && isset($_GET['id'])){
            modifier($_GET['id'],$bdd);
        } 

        elseif(isset($_POST['Modification']) && isset($_GET['id'])){
            modification($_GET['id'],$bdd);
        }

        elseif(isset($_POST['Ajouter'])){
            ajouter($bdd);
        } 

        elseif(isset($_POST['Creation'])){
            creation($bdd);

        }

        ?>

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
