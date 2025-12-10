<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="utf-8">
    <title>Mariteam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
 

    <!-- Permet de faire apparaitre les elements progressivement -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Lien avec le css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien avec le css -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/reservation.css" rel="stylesheet">

    <script type="module" src="../js/reservation.js" defer></script>
    <script type="module" src="../js/enregistrement_reservation.js" defer></script>
</head>

<body>

<?php session_start(); ?>


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i><a href="../index.php">Mariteam</a></h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
          
   
					<!-- Navbar !-->
           
               <!-- Sert a former la navbar, a separer les éléments, ne pas les superposer et avoir le fond (photo) -->
               <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                        <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                        <a href="liaisons.html.php" class="nav-item nav-link">Liaisons</a>
                        <a href="tarifs.html.php" class="nav-item nav-link">Tarifs</a>
                        <a href="horaire.html.php" class="nav-item nav-link active">Horaires</a>
                </div>
                <?php
                    if(!isset($_SESSION["connecté"])) {
                        echo "<a href='connexion.html.php' class='btn btn-primary rounded-pill py-2 px-4'>Se connecter</a>";
                        
                       
                    }   else {
                        echo "<a href='profil.php' class='btn btn-primary rounded-pill py-2 px-4'>Mon Profil</a>";
                    }
                    ?>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Reservation</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Réservation</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
   
 <!-- Template Javascript -->
 <script src="../js/main.js"></script>

<!-- Horaires Disponibles -->
<div class="container mt-4">
    <div class="d-flex align-items-center gap-3">
        <h2 class="mb-0">Réservation</h2>
        <div class="col-12 liaison">
        </div>
    </div>
    <br>
    <div class="col-12 title left">
        <p class="in_liaison c1">ID</p>
        <p class="in_liaison c2">Date</p>
        <p class="in_liaison c3">Heure</p>
        <p class="in_liaison c4">Bateau</p>
        <p class="in_liaison c5">A - Passagers</p>
        <p class="in_liaison c6">B - Véhicules < 2m</p>
        <p class="in_liaison c7">C - Véhicules > 2m</p>
    </div>
    <div class="col-12 traversee left">
        <p class="in_liaison c1" id="id"></p>
        <p class="in_liaison c2"></p>
        <p class="in_liaison c3"></p>
        <p class="in_liaison c4"></p>
        <p class="in_liaison c5" id="max_A"></p>
        <p class="in_liaison c6" id="max_B"></p>
        <p class="in_liaison c7" id="max_C"></p>
    </div>
    <div class="col-12 preci left">
        <p class="in_liaison c1"></p>
        <p class="in_liaison c2"></p>
        <p class="in_liaison c3"></p>
        <p class="in_liaison c4"></p>
        <p class="in_liaison c8">(Places disponibles par catégories)</p>
    </div>
    <div class="d-flex align-items-center gap-3">
        <h2 class="mb-0 padding-bottom">Nombres de tickets : </h2>
    </div>
    <div class="parent">
        <div class="div1 border-right">Adulte</div>
        <div class="div2 border-right">Junior (8 à 18 ans)</div>
        <div class="div3 border-right">Enfant (0 à 7 ans)</div>
        <div class="div4 border-right center prices">0.00€</div>
        <div class="div5 border-right center prices">0.00€</div>
        <div class="div6 border-right center prices">0.00€</div>
        <div class="div7 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_adults">
        </div>
        <div class="div8 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_juniors">
        </div>
        <div class="div9 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_kids">
        </div>
        <div class="div10 border-right border-right">Voiture long < 4m</div>
        <div class="div11 border-right border-right">Voiture long < 5m</div>
        <div class="div13 border-right center prices">0.00€</div>
        <div class="div14 border-right center prices">0.00€</div>
        <div class="div16 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_short_cars">
        </div>
        <div class="div17 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_long_cars">
        </div>
        <!-- Chaque ligne affiche un type de véhicule. -->
        <div class="div19 border-right">Fourgon</div>
        <div class="div20 border-right">Camping Car</div>
        <div class="div21 border-right">Camion</div>
        <!-- Ces blocs contiennent le prix pour chaque type de véhicule. -->
        <div class="div22 border-right center prices">0.00€</div>
        <div class="div23 border-right center prices">0.00€</div>
        <div class="div24 border-right center prices">0.00€</div>
        <!-- permettent à l’utilisateur d’entrer le nombre de véhicules qu’il souhaite réserver. -->
        <div class="div25 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_vans">
        </div>
        <div class="div26 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_motorhomes">
        </div>
        <div class="div27 center">
            <input type="number" min="0" max="400" class="number" id="nb_of_trucks">
        </div>
    </div>
    <!-- affiche le prix total de la réservation. -->
    <div class="d-flex align-items-bottom gap-3">
        <h1 class="mb-0">Total : </h2>
        <h2 class="mb-0 blue total">0.00 € </h2>
    </div>
    <br>
    <?php
        if (!isset($_SESSION["connecté"])) {
            echo "<a href='connexion.html.php' class='btn btn-primary rounded-pill py-2 px-4 ms-1'>Réserver cet horaire</a>";
            echo "<a href='horaire.html.php' class='btn return rounded-pill py-2 px-4 ms-1'>Retour</a>";
        } else {
            echo "<button class='btn btn-primary rounded-pill py-2 px-4 ms-1' id='show_popup'>Réserver cet horaire</button>";
            echo "<a href='horaire.html.php' class='btn return rounded-pill py-2 px-4 ms-1'>Retour</a>";
        }    
    ?>
    <!-- C’est un paragraphe vide qui servira à afficher un message d’erreur via JavaScript -->
    <p id="error_p"></p>
    <div class="background_popup hidden">
        <!-- Bloc contenant le contenu principal de la popup. -->
        <div class="popup" id="log">
            <br>
            <!-- Titre de la popup, centré. -->
            <h1 style="text-align: center;">Récapitulatif</h1><br>
            <div class="col-12 liaison" style="margin:0px;width:90%">
                <!-- Message de confirmation affiché à l’utilisateur. -->
                <p class="in_liaison" style="text-align:center;width:100%;">Merci d'avoir réservé sur Mariteam !</p>
            </div>
            <!-- Un paragraphe qui introduit les détails de la commande. -->
            <p class="in_liaison" style="width:90%;padding-left:0px;padding-bottom: 30px;padding-top: 30px;">Récapitulatif de votre commande : </p>
            <div class="container">
                <!-- Bloc contenant une grille de type CSS Grid avec les détails de la réservation. -->
                <div class="popup_parent">
                    <!-- Ces lignes affichent les noms des catégories (passagers et véhicules).-->
                    <div class="div1 border-left">Adulte</div>
                    <div class="div2 border-left">Junior</div>
                    <div class="div3 border-left">Enfant</div>
                    <div class="div4 border-left">Voiture long < 4m</div>
                    <div class="div5 border-left">Voiture long < 5m</div>
                    <div class="div6 border-left">Fourgon</div>
                    <div class="div7 border-left">Camping Car</div>
                    <div class="div8 border-left">Camion</div>
                    <div class="div9 border-left" style="text-align:center" id="adults"></div>
                    <div class="div10 border-left" style="text-align:center" id="juniors"></div>
                    <div class="div11 border-left" style="text-align:center" id="kids"></div>
                    <div class="div12 border-left" style="text-align:center" id="short_cars"></div>
                    <div class="div13 border-left" style="text-align:center" id="long_cars"></div>
                    <div class="div14 border-left" style="text-align:center" id="vans"></div>
                    <div class="div15 border-left" style="text-align:center" id="motorhomes"></div>
                    <div class="div16 border-left" style="text-align:center" id="trucks"></div>
                </div>
                <div class="d-flex align-items-bottom gap-3">
                    <h1 class="mb-0">Total : </h2>
                    <!-- Affiche le total actuel de la commande -->
                    <h2 class="mb-0 blue total_2">0.00 € </h2>
                </div>
                <br>
                <!-- Conteneur flexible sur toute la largeur. -->
                <div  style="display:flex;width:100%">
                    <!-- Bouton "Valider" la réservation. -->
                    <button class='btn btn-primary rounded-pill py-2 px-4 ms-1' id='book_button' style="width:25%;transition:0s">Valider</button>
                    <!-- Bouton "Retour" pour fermer la popup et revenir à la sélection. -->
                    <button class='btn btn-primary rounded-pill py-2 px-4 ms-1 return' id='return' style="width:25%;margin-left:32.5px;transition:0s">Retour</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Deuxième superposition (apparaît après validation). -->
    <div class="background_popup_2 hidden">
        <!-- Contenu de la popup de confirmation. Flexbox utilisé pour organiser le contenu. -->
        <div class="popup_2" id="log" bis_skin_checked="1" style="display: flex;justify-content: space-between;">
            <!-- Message de confirmation affiché en gros titre. -->
            <h1 style="text-align: center;padding: 1rem;">Réservation confirmée !</h1>
            <!-- Petit message informant l’utilisateur qu’il va être redirigé automatiquement. -->
            <div class="col-12 liaison" style="margin:0px;width:90%" bis_skin_checked="1">
                <p class="in_liaison" style="text-align:center;width:100%;">Vous allez être redirigé vers la page : Horaires</p>
            </div>
            <div style="display:flex;width:100%;justify-content: center;" bis_skin_checked="1">
                <!-- Bouton "Confirmer" pour finaliser la popup et retourner à la page des horaires.-->
                <button class="btn btn-primary rounded-pill py-2 px-4 ms-1" id="back_to_horaires" style="width:25%;transition:0s;margin: 1rem;">Confirmer</button>
            </div>
        </div>
    </div>
</div>
     <!-- Footer Start -->

    <!-- Permet de placer les éléments -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <!-- Permet de mettre la grande bande noir du bas -->
       <div class="container py-5">
           <!-- Permet de placer les éléments -->
           <div class="row g-5">
               <!-- Permet de ne pas faire d'espace entre chaque éléments -->
               <div class="col-lg-3 col-md-6">
                   <!-- Met le titre -->
                   <h4 class="text-white mb-3">Mariteam</h4>
                   <!-- Lien vers les autres pages du site sous le titre-->
                   <a href="../index.php">Accueil</a> <br>
                   <a href="liaisons.html.php">Liaisons</a> <br>
                   <a href="tarifs.html.php">Tarifs</a> <br>
                   <a href="horaire.html.php">Horaires</a> <br>
                   <?php
                    // Cette condition vérifie si la variable de session $_SESSION["connecté"] n'est pas définie (c’est-à-dire que l’utilisateur n’est pas connecté).
                    if (!isset($_SESSION["connecté"])) {
                        //Si l'utilisateur n'est pas connecté, on affiche un bouton "Se connecter" qui redirige vers la page de connexion (connexion.html.php).
                        echo "<a href='connexion.html.php'>Se connecter</a>";
                        // Sinon, donc si l'utilisateur est connecté
                    } else {
                        //on affiche un lien vers la page de profil de l'utilisateur (profil.php), avec le même style de bouton.
                        echo "<a href='profil.php'>Mon Profil</a>";
                    }
                    ?> <br>
                   <a href="rgpd.html"> RGPD</a> <br>


               </div>
               <!-- Permet de placer " Nous contacter" a droite des liens -->
               <div class="col-lg-3 col-md-6">
                   <!-- Met le titre -->
                   <h4 class="text-white mb-3">Nous contacter</h4>
                   <!-- Indique le mail sous le titre -->
                   <p class="mb-2"><i class="fa fa-envelope me-3"></i>Mariteam@voyage.com</p>
                  
               </div>
           </div>
       </div>
       <!-- Permet de mettre le texte au milieu -->
       <div class="container">
           <!-- Permet de mettre le texte dans la meme couleur -->
           <div class="copyright">
               <div class="row">
                   <!-- Permet de mettre le texte en dessous de la barre du bas -->
                   <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                       <!-- Peremt d'ecrire et d'indiquer les droits-->
                       &copy; <a class="border-bottom" href="../index.php">Mariteam</a>, All Right Reserved.
                       Designed By Tom Lelievre, Axel Wilfart, Baptiste Royer</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>