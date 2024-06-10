<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Edu+VIC+WA+NT+Beginner:wght@600&family=Parisienne&family=Racing+Sans+One&family=Rock+Salt&family=Sofia&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
<title>Landing Page</title>
</head>
<body>
      <header id="header">

        <?php include('Navigation.php') ?>
        </nav>
      </header>

  <div class="container"></div>
    <section class="parallax" id="image1">
      <section id="sub-header">
        <h2>Hôtel Neptune : Vivez l'expérience !</h2>
        <form id="form" action="https://www.freecodecamp.com/email-submit">
        </form>
      </section>

      <div class="container">
        <section id="Our-Service">
          <div class="grid">
            <div class="icon"><i class="lni lni-tshirt"></i></div>
            <div class="description">
              <h2>Bienvenue dans notre hôtel</h2>
              <p>
                Si au fil des années le cadre de ce charmant hôtel près de Montpellier change afin de toujours maintenir un certain modernisme, l’esprit du lieu, lui, reste intact : « l’accueil, l’écoute, la disponibilité, un lieu de zénitude, de détente et de calme
              </p>
            </div>
          </div>
          <div class="grid">
            <div class="icon"><i class="lni lni-delivery"></i></div>
            <div class="description">
              <h2>La Boutique</h2>
              <p>
								Une boutique est disponible dans le hall de l'hôtel celle ci peut vous être livré sous 48h - 96h 
              </p>
            </div>
          </div>
          <div class="grid">
            <div class="icon"><i class="lni lni-briefcase"></i></div>
            <div class="description">
              <h2>Un confort inoubliable</h2>
              <p>
								Dans notre hôtel, vous y serez confortablement installer avec des lits pour tout les gôuts, vous être à quelque pas de la plage !
              </p>
            </div>
          </div>
        </section>															
        <section id="Making-a-Product">
					<iframe
          id="video" 
					width="560" 
					height="315" 
					src="https://www.youtube.com/embed/Q_p180GOnIU" 
					title="Video de l'hotel Neptune'" 
					frameborder="0" 
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
					allowfullscreen>
				</iframe>
        </section>
    </section>
    <div class="title-products">
      <h3>Ce que nous pouvons vous proposez</h3>
    </div>
        <section id="image2" class="parallax pricing">
            <div class="product" id="conjunto">
            <div class="image">
              <img src="Localisation.jpg" alt="Photo de la localisation">
            </div>
            <div class="level"><h3>Notre Localisation</h3></div>
            <h4>Au bord de mer</h4>
            <ul>
              <li>239, rue de l’Etang de l’Or</li>
              <li>Carnon Plage</li>
              <li>34130 Mauguio</li>
              <li>France</li>
            </ul>
          </div>
          <div class="product" id="body">
            <div class="image">
              <img src="Piscine.jpg" alt="Photo de la piscine">
            </div>
            <div class="level"><h3>Piscine et plage à quelques pas</h3></div>
            <h4>Un accès handicapé à étais mis à dispotition</h4>
            <ul>
              <li>Avec un forfait, vous aurez accès à notre magnifique piscine</li>
              <li>Celle ci est trés fréquenté surtout le matin au horore</li>
              <li>elle sera ouverte jusqu'à minuit</li>
              <li>Des lumières avec des effets rouge seront disponible la nuit pour une ambiance plus sympathique</li>
            </ul>
          </div>
          <div class="product" id="pijama">
            <div class="image">
              <img src="Chambre2.jpg" alt="Photo de chambre">
            </div>
            <div class="level"><h3>Exemple de quelques chambres</h3></div>
            <h4>Le prix peut varier suivant la chambre</h4>
            <ul>
              <li>Nous disposons de chambre simple</li>
              <li>Ainsi que de chambre double</li>
              <li>Et pour votre plus grand plaisir nous avons aussi une chambre familiale</li>
              <li>Alors quels chambrs vous tentera ?</li>
						</ul>
          </div>
          <div class="product" id="encajes">
            <div class="image">
              <img src="jetski2.jpg" alt="Photo de jet ski">
            </div>
            <div class="level"><h3>Les ativités que nous proposons</h3></div>
            <h4>Une durée de 2h</h4>
            <ul>
              <li>Nous pouvons vous proposer de faire des acivités comme du jet ski, des sorties en mer et bien plus !</li>
              <li>Ils sont plus de 30 moniteurs proche de l'hôtel à pouvoir vous faire découvrir des activités en tout genre</li>
              <li>On peut aussi vous proposez de vous baladez dans la ville avec notre guide</li>
              <li>Si vous n'êtes pas conquis après ca alors venez à nos soirés </li>
            </ul>
          </div>
        </section>
      </section>
      </div>
        <footer>
          <span>Hôtel Neptune, 239, rue de l’Etang de l’Or, Carnon Plage, 34130 Mauguio, France</span>
        </footer>
      </div>
    </div>
  </body>
</html>