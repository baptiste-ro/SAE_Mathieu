<?php
//Ouvre une session
 session_start();
 //Vérifie si un paramètre code est passé dans l’URL 
$code_liaison = isset($_GET['code']) ? htmlspecialchars($_GET['code']) : 'Inconnu';

// Connexion à la base de données
include "../getRacine.php";
include "$racine/bdd/bdd.php";

// Vérifier la connexion
if (!$conn) {
    die('Erreur de connexion : ' . $conn->connect_error);
}

// Récupérer les traversées
$request = "SELECT 
    t.Id_Traversee,
    t.date_Traversee,
    t.HeureDepart_Trav,
    b.Nom_Bat,
    p1.Libelle_Port as port_depart,
    p2.Libelle_Port as port_arrivee,
    s.Nom_Secteur
FROM traversee t
JOIN bateau b ON t.Id_Bat = b.Id_Bat
JOIN liaison l ON t.Code_Liaison = l.Code_Liaison
JOIN port p1 ON l.Id_Port = p1.Id_Port
JOIN port p2 ON l.Id_Port_1 = p2.Id_Port
JOIN secteur s ON l.Id_Secteur = s.Id_Secteur
ORDER BY t.date_Traversee";

//Exécute la requête SQL stockée dans la variable $request
//Résultat stocké dans la variable $result
$result = $conn->query($request);
//Crée un tableau vide pour stocker les données formatées de chaque traversée
$traversees = [];
//Vérifie si la requête a renvoyé au moins une ligne.
if ($result->num_rows > 0) {
    //Boucle qui lit chaque ligne renvoyée par la requête.
    while ($row = $result->fetch_assoc()) {
        $traversees[] = [
            'id_Traversee' => $row['Id_Traversee'],
            'nom_traversee' => $row['Nom_Bat'] . ' - ' . $row['port_depart'] . ' → ' . $row['port_arrivee'] . ' (' . $row['Nom_Secteur'] . ')',
            'date' => $row['date_Traversee'],
            'heure' => $row['HeureDepart_Trav']
        ];
    }
}
?>
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
  <link rel="stylesheet" href="../css/tarifs.css">

  <!-- Lien avec le css -->
  <link href="../css/style.css" rel="stylesheet">
  <script type="module" src="../js/tarifs.js" defer></script>
</head>

<body>

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
               <!-- Pour avoir le logo et le nom de la compagnie en haut a gauche + redirection vers index.php!-->
               <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i><a href="../index.php">Mariteam</a></h1>
               <!-- <img src="img/logo.png" alt="Logo"> -->

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                        <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                        <a href="liaisons.html.php" class="nav-item nav-link">Liaisons</a>
                        <a href="tarifs.html.php" class="nav-item nav-link active">Tarifs</a>
                        <a href="horaire.html.php" class="nav-item nav-link">Horaires</a>
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
                        <h1 class="display-3 text-white animated slideInDown">Tarifs</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Tarifs</li>
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

    //Par défaut, tous les secteurs sont récupérés depuis la table secteur
    //Requête : 
    $allsecteurs = $conn->query('SELECT * FROM secteur');

    if(isset($_GET['s']) AND !empty($_GET['s'])){ // Verifie si l'utilisateur a bien lancer sa recherche
        $recherche = htmlspecialchars($_GET['s']); // Stockage de la recherche dans une variable (ici recherche), et précaution pour éviter que l'utilisateur rentre du html dans la recherche
        // Requête preparée pour plus de sécurité (evite les failles SQL)
        //Prépare une requête SQL pour chercher les secteurs dont le nom contient la chaîne recherchée.
        $stmt = $conn->prepare("SELECT Nom_Secteur FROM secteur WHERE Nom_Secteur LIKE ?");
        $searchTerm = "%".$recherche."%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $allsecteurs = $stmt->get_result();

    }
    ?>


<!-- Navbar & Hero End -->
    <!-- Barre de recherhe -->
    <div class="container mt-4">
    <div class="mb-3">
        <h3> Selectionnez votre Traversee : </h3>
    </div>
    <div class="mb-3 d-flex justify-content-center">
        <div class="input-group rounded-pill" style="width: 35%; border-radius: 20px; overflow: hidden;">
            <select type="text" id="liste_container" class="form-control search-bar2" placeholder="Votre Traversee" style="border-radius: 20px 0 0 20px;">
                <option value="">Sélectionnez une traversée</option>
                <?php foreach ($traversees as $traversee): ?>
                    <option value="<?php echo $traversee['id_Traversee']; ?>">
                        <?php echo $traversee['nom_traversee']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<br>
<br>
<!-- Ce tableau affiche les tarifs liés à la traversée sélectionnée.-->
<div class="container mt-4" id="results-container-tarifs">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Période</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="text-center">Sélectionnez une traversée pour voir les tarifs</td>
                </tr>
            </tbody>
        </table>
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
                   <a href="rgpd.html">RGPD</a> <br>


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
                       <!-- Permet d'ecrire et d'indiquer les droits-->
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