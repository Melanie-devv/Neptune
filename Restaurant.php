<?php session_start(); ?>
<!doctype html>
<html lang="Fr">
  <head>
    <meta charset="utf-8">

    <title>Hôtel Neptune - Restaurant</title>

    <link href="bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      ul.menu {
    font-family: Arial;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #6640FF;
    font-weight: bold;
}

ul.menu li {
    float: left;
    padding-top: 10px;
    padding-bottom: 10px;
}

ul.menu li a {
    display: block;
    color: white;
    text-align: center;
    padding: 10px 16px;
    text-decoration: none;
    transition: all ease-in 200ms;
}

ul.menu li a:hover {
    background-color: #C0B1FF;
    border-radius: 20px;
    color: #382685;
    font-weight: bold;
}

ul.menu li.right {
    float: right;
    padding-right: 5%;
}

ul.menu li.right a {
    color: orange;
    border:  2px solid orange;
    border-radius: 20px;
}

ul.menu li.right a:hover {
    background-color:#382685 ;
}   
    </style>

    
  </head>
  <body>
    
    <header>

      <nav>
      <?php include("Navigation.php") ?>
      </nav>
    </header>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Restaurant de l'Hôtel Neptune</h1>
        <p class="lead text-muted">Savourez mets et merveilles cuisinez par nos meilleurs cuisiniers.<br>L'hôtel Neptune et son équipe vous souhaite une bon appétit..</p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production4/d1027/eb1465c4-ecd7-4f27-b549-db86226e9027.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Cassoulet">

            <div class="card-body">
              <p class="card-text">Un cassoulet sur son lit de pépite d'or, l'incontournable de la région montpelliéraine, un grand classique inventé durant la guerre.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">27,90€</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production177/d623/ada63b4e-4eb9-4bda-9d96-273be309b243.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Cagarolettes">

            <div class="card-body">
              <p class="card-text">Les cagarolettes. Des escargots à la vinaigrette épicée, une cuisine typique de la France, adapté à la localité de chez nous.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">34,70€</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production86/d1686/7bd9b9ad-3d19-42e8-92a3-62cf4401ed88.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Tiel de Sett">

            <div class="card-body">
              <p class="card-text">La tielle sétoise, Une tourte épicée aux calamars et aux poulpes, des saveurs de mer pour un voyage au fond de l'océan.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">10,25€</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production105/d1777/a83a5186-95c5-4089-bdbb-ef46e8fdb856.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Moules">

            <div class="card-body">
              <p class="card-text">La brasucade de moules, de la grillade et une sauce piquante venant relevé le tout dans le but que vous vous souveniez du Sud.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">24,60€</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production18/d1052/3b13046c-108b-420f-a591-94d41a10c027.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Chichoumeille">

            <div class="card-body">
              <p class="card-text">La chichoumeille, un plat végétarien remplis d'arômes et de localités, n'attendais plus, optez pour la simplicitée.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">14,00€</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production32/d836/754eba52-2dfc-4199-a19d-7fc892dddc93.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Rouille de sèche">

            <div class="card-body">
              <p class="card-text">Rouille de seiche, des pâtes, une seiche, et de la sauce piquante à souhait, de quoi vous faire découvrir un nouvel horizon de saveur.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">16,80€</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production9/d1119/debd8386-65b2-4359-84c3-fa1c9476f958.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Viande et poissons à la grille">

            <div class="card-body">
              <p class="card-text">Viande et poisson grillé au beurre de Montpellier, un double menu pour deux fois plus de plaisir au papilles, laisser vous bercez par le terre mer. </p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">39,10€</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production104/d302/dbca96fd-068f-420e-b8bf-46b49be62ef0.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Râgout">

            <div class="card-body">
              <p class="card-text">Le ragoût d’escoubilles, de la viande et des légumes, de quoi tenir chaud en cet hiver si glacial. Un plat saisonier à assaisonner.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">15,00€</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
          <img class="bd-placeholder-img card-img-top" src="https://a.cdn-hotels.com/gdcs/production53/d647/44313be6-17b5-4489-b4f9-1c41ac2e2c01.jpg?impolicy=fcrop&w=1600&h=1066&q=medium" alt="Fougasse">

            <div class="card-body">
              <p class="card-text">La fougasse aux fritons, Une pâte feuilletée à la margarine garnie de porc, un petit encas temps à autres n'a jamais fais de mal.</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">8,00€</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="mb-1">Hôtel Neptune</p>
    <p class="mb-0">Un restaurant aux couleurs de notre sud</p>
  </div>
</footer>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
