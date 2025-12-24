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
    <script type="module" src="../js/liaison.js" defer></script>
</head>

<body>

    <?php session_start(); ?>

    <!-- Pour ne pas avoir de superposition de texte !-->
    <div class="container-fluid position-relative p-0">
        <!-- Permet d'avoir la navbar en haut a droite -->
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <!-- Pour avoir le lastName de la compagnie en haut a gauche !-->
            <!-- Pour avoir le logo et le lastName de la compagnie en haut a gauche + redirection vers index.php!-->
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i><a href="../index.php">Mariteam</a></h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->


            <!-- Navbar !-->

            <!-- Sert a former la navbar, a separer les éléments, ne pas les superposer et avoir le fond (photo) !-->
            <div class="navbar-nav ms-auto py-0">
                <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                <a href="liaisons.html.php" class="nav-item nav-link active">Liaisons</a>
                <a href="tarifs.html.php" class="nav-item nav-link">Tarifs</a>
                <a href="horaire.html.php" class="nav-item nav-link">Horaires</a>
            </div>
            <?php
            if (!isset($_SESSION["connecté"])) {
                echo "<a href='connexion.html.php' class='btn btn-primary rounded-pill py-2 px-4'>Se connecter</a>";
            } else {
                echo "<a href='profil.php' class='btn btn-primary rounded-pill py-2 px-4'>Mon Profil</a>";
            }
            ?>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Liaisons</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Liaisons</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    //Requête qui affiche tous les secteurs dans la page (necesite une conn à la bdd)
    // Connexion à la base de données
    include "../getRacine.php";
    include "$racine/bdd/bdd.php";

    // Vérifier la connexion
    if (!$conn) {
        die('Erreur de connexion : ' . $conn->connect_error);
    }
    else{
        echo "<script>console.log(\"Connexion réussie !\")</script>";
    }

    //Requête : 
    $allsecteurs = $conn->query('SELECT * FROM secteur');

    if(isset($_GET['s']) AND !empty($_GET['s'])){ // Verifie si l'utilisateur a bien lancer sa recherche
        $recherche = htmlspecialchars($_GET['s']); // Stockage de la recherche dans une variable (ici recherche), et précaution pour éviter que l'utilisateur rentre du html dans la recherche
        // Requête preparée pour plus de sécurité (evite les failles SQL)
        $stmt = $conn->prepare("SELECT Nom_Secteur FROM secteur WHERE Nom_Secteur LIKE ?");
        $searchTerm = "%".$recherche."%";
        $stmt->bind_param("s", $searchTerm);
        //Exécution de la requête
        $stmt->execute();
        //récupère les résultats de la requête dans la variable $allsecteurs
        $allsecteurs = $stmt->get_result();

    }

    ?>



    <!-- Navbar End -->
    <!-- Barre de recherche -->
     <form method="GET">
        <div class="container mt-4">
            <div tabindex="0" class="mb-3 search-div" style="display: inline-block; width: 30%; vertical-align: top; position: relative;">
                <input type="text" name="s" id="search1" class="form-control search-bar" placeholder="Rechercher Secteur..." style="border-radius: 20px;">
                <nav class="scrolling hide">
                    <ul id="suggestions1" class="list-group mt-2" style="top: 100%; left: 0;"></ul>
                </nav>
            </div>
            <div tabindex="0" class="mb-3 search-div" style="display: inline-block; width: 30%; margin-left: 20px; vertical-align: top; position: relative;">
                <input type="text" name="s" id="search2" class="form-control search-bar" placeholder="Rechercher Port de départ..." style="border-radius: 20px;">
                <nav class="scrolling hide">
                    <ul id="suggestions2" class="list-group mt-2" style="top: 100%; left: 0;"></ul>
                </nav>
            </div>
            <div tabindex="0" class="mb-3 search-div" style="display: inline-block; width: 30%; margin-left: 20px; vertical-align: top; position: relative;">
                <input type="text" name="s" id="search3" class="form-control search-bar" placeholder="Rechercher Port d'arriver..." style="border-radius: 20px;">
                <nav class="scrolling hide">
                    <ul id="suggestions3" class="list-group mt-2" style="top: 100%; left: 0;"></ul>
                </nav>
                <!-- border-radius: 20px à chaque input pour arrondir les bordures des barres de recherche. -->
            </div>
        </div>
    </form>
    <br>
    <br>
    <div class="container mt-4" id="results-container">
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