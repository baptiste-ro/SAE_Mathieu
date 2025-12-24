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
    <link href="../css/horaire.css" rel="stylesheet">
    <script type="module" src="../js/horaire.js" defer></script>
    <script type="module" src="../js/horaire_input_handler.js" defer></script>
    <script type="module" src="../js/admin.js" defer></script>
</head>

<body>
<?php session_start(); ?>

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="reservation.html.php" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Mariteam</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
          
   
					<!-- Navbar !-->
           
               <!-- Sert a former la navbar, a separer les éléments, ne pas les superposer et avoir le fond (photo) !-->
            </a>
               <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                        <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                        <a href="liaisons.html.php" class="nav-item nav-link">Liaisons</a>
                        <a href="tarifs.html.php" class="nav-item nav-link">Tarifs</a>
                        <a href="horaire.html.php" class="nav-item nav-link active">Horaires</a>
                </div>
                <?php
                //On vérifie ici si la session $_SESSION["connecté"] n'existe pas.
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
                        <h1 class="display-3 text-white animated slideInDown active">Horaires</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="../index.html.php">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page" id="AAA">Horaires</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Booking Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container switcher">
            <div class="booking p-5 scroller">
                <div class="row g-5 align-items-center page left">
                    <div class="col-md-6 text-white">
                        <h6 class="text-white text-uppercase">Horaires</h6>
                        <h1 class="text-white mb-4">Trouvez vos horaires !</h1>
                        <p class="mb-4">Trouvez les traversées qui correspondront à vos envies !</p>
                    </div>
                    <div class="col-md-6">
                        <h1 class="text-white mb-4">Bouclez votre voyage au plus vite !</h1>
                        <form id="form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent" id="name" placeholder="Your Name">
                                        <label for="name">Votre lastName</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
								<!-- Pour indiquer son mail afin de recevoir son billet !-->
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-transparent" id="email" placeholder="Your Email">
                                        <label for="email">Votre mail</label>
                                    </div>
                                </div>
								<!-- Va permettre d'indiquer la date souhaiter !-->
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="date" class="form-select bg-transparent" id="date"/>
                                        <label for="datetime">Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="btn btn-outline-light w-100 py-3" id="reset">X</p>
                                </div>    
								<!-- Va permettre de choisir son heure de depart !-->
								<div class="col-md-6">
                                    <div class="form-floating date" id="heure" data-target-input="nearest">
                                        <input type="time" class="form-select bg-transparent" id="time"/>
                                        <label for="datetime">Heure</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="btn btn-outline-light w-100 py-3" id="reset">X</p>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-transparent" id="departure" required>
                                        </select>
                                        <label for="select1">Provenance</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-transparent" id="arrival" required>
                                        </select>
                                        <label for="select1">Destination</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Voir les traversées</button>
                                </div>
                                <div class="col-12" id="add_button_container">
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="g-5 page left" id="result_page">
                </div>
            </div>
            <div>
                <button class="switcher_button">
                    <svg height="40px" width="40px" viewBox="-4 -0.5 35 35">
                        <g id="SVGRepo_iconCarrier"> 
                            <path fill="#EEEEEE" stroke-width="1" d="M2.5,12.5 L10,5 Q12.5,2.5 15,5 L22.5,12.5 C25,15 22.5,17.5 20,15 L13.75,8.75 Q12.5,7.5 11.25,8.75 L5,15 C3,17 0.5,14.5 2.5,12.5 M2.5,22.5 L10,15 Q12.5,12.5 15,15 L22.5,22.5 C25,25 22.5,27.5 20,25 L13.75,18.75 Q12.5,17.5 11.25,18.75 L5,25 C3,27 0.5,24.5 2.5,22.5"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
        
    </div>
    <!-- Booking Start -->

    <div class="background_popup hidden">
        <div class="popup" id="log">
            <form id="add_form" style="width:100%;display: flex;flex-flow: column;align-items: center;">
                <br>
                <h1 style="text-align: center;">Ajouter une horaire</h1>
                <br>
                <div style="display:flex; flex-flow:row; " bis_skin_checked="1">
                    <div class="form-floating date" id="date3" data-target-input="nearest" bis_skin_checked="1" style="width: 100%">
                        <input type="date" class="form-select bg-transparent" id="date" min="2025-05-16" value="2025-05-16">
                        <label for="datetime">Date</label>
                    </div>
                    <p class="btn btn-outline-light w-100 py-3" id="reset" style="width:fit-content;max-width:fit-content;margin-left: 20px; transition: 0s">Reset</p>
                </div>
                <div style="display:flex; flex-flow:row; " bis_skin_checked="1">
                    <div class="form-floating date" id="heure" data-target-input="nearest" style="width: 100%">
                        <input type="time" class="form-select bg-transparent" id="time"/>
                        <label for="datetime">Heure</label>
                    </div>
                    <p class="btn btn-outline-light w-100 py-3" id="reset" style="width:fit-content;max-width:fit-content;margin-left: 20px; transition: 0s">Reset</p>
                </div>
                <div style="display:flex; flex-flow:row; ; margin-bottom:1rem" bis_skin_checked="1">
                    <div class="form-floating" style="width: 100%">
                        <select class="form-select bg-transparent" id="boat" required>
                        </select>
                        <label for="select1">Bateau</label>
                    </div>
                </div>
                <div style="display:flex; flex-flow:row; ; margin-bottom:1rem" bis_skin_checked="1">
                    <div class="form-floating" style="width: 100%">
                        <select class="form-select bg-transparent" id="link" required>
                        </select>
                        <label for="select1">Liaison</label>
                    </div>
                </div>
                <div style="display:flex; flex-flow:row; ; margin-bottom:1rem" bis_skin_checked="1">
                    <div class="form-floating" style="width: 100%">
                        <select class="form-select bg-transparent" id="price" required>
                        </select>
                        <label for="select1">Tarif</label>
                    </div>
                </div>
                <div style="display:flex; flex-flow:row; justify-content: space-between; margin-bottom:1rem" bis_skin_checked="1">
                    <p class="btn btn-outline-light w-100 py-3" id="validate_add" style="width: 48%;max-width: 100%;background-color: rgb(0 255 18 / 25%);margin-left:0px; transition: 0s">Valider</p>
                    <p class="btn btn-outline-light w-100 py-3" id="cancel" style="width:48%;max-width: 100%;background-color: rgb(255 0 0 / 25%); transition: 0s">Annuler</p>
                </div>
            </form>
        </div>
    </div>
     <!-- Footer Start -->

    <!-- Permet de placer les éléments -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <!-- Permet de fmettre la grande bande noir du bas -->
       <div class="container py-5">
           <!-- Permet de placer les éléments -->
           <div class="row g-5">
               <!-- Permet de ne pas faire d'espace entre chaque éléments -->
               <div class="col-lg-3 col-md-6">
                   <!-- Met le titre -->
                   <h4 class="text-white mb-3">Mariteam</h4>
                   <!-- Lien vers les autres pages du site sous le titre-->
                   <a href="../index.html.php">Accueil</a> <br>
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
               <!-- Permt de placer " Nous contacter" a droite des liens -->
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
                       &copy; <a class="border-bottom" href="../index.html.php">Mariteam</a>, All Right Reserved.
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
