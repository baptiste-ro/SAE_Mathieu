<!DOCTYPE html>
<html lang="fr">
<%@ page isELIgnored="false" %>
<%@ page contentType="text/html; charset=UTF-8" import="tools.*" %>
<%@ page errorPage="erreur.jsp" %>
<%
    Boolean login = (Boolean) session.getAttribute("login");
    boolean connected = (login != null) ? login : false;
%>

<head>
    <meta charset="utf-8">
    <title>Mariteam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">



    <!-- Permet de faire apparaitre les elements progressivement -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />


    <!-- inclue la page de données des comptes -->

    <!-- Lien avec le css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien avec le css -->
    <link href="css/style.css" rel="stylesheet">
    <script src="js/connexion/create_account/create_account.js" type="module" defer></script>
</head>
<body>

     <!-- Navbar & Hero Start -->
     <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Mariteam</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->


					<!-- Navbar !-->

               <!-- Sert a former la navbar, a separer les éléments, ne pas les superposer et avoir le fond (photo) !-->
               <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page qu'on souhaite visiter !-->
                        <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                        <a href="liaisons.html.php" class="nav-item nav-link">Liaisons</a>
                        <a href="tarifs.html.php" class="nav-item nav-link">Tarifs</a>
                        <a href="horaire.html.php" class="nav-item nav-link ">Horaires</a>
                </div>
                <a href="connexion.html.php" class="btn btn-primary rounded-pill py-2 px-4">Se connecter</a>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Créer votre compte</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Formulaire Start -->

    <div class="container" style="color: black; display: flex; flex-direction: column; flex-wrap: nowrap; align-items: center;">
        <form action="" method="POST" style="background-color: #B2CCCE; padding: 12px; border-radius: 4px;">

            <div class="champ_prenom" style="color: black;display: flex; flex-direction: column; align-items: center;">
                <label for="username">Prenom :</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <br>

            <div class="champ_nom" style="color: black;display: flex; flex-direction: column; align-items: center;">
                <label for="username">Nom :</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <br>

            <div class="champ_email" style="color: black;display: flex; flex-direction: column; align-items: center;">
                <label for="username">Email :</label>
                <input type="mail" id="email" name="email_field" required>
            </div>
            <br>

            <div class="champ_adresse" style="color: black;display: flex; flex-direction: column; align-items: center;">
                <label for="email">Adresse :</label>
                <input type="text" id="address" name="address_field" required>
            </div>
            <br>

            <div class="champ_mdp" style="color: black; display: flex; flex-direction: column; align-items: center;">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>

            <div class="champ_mdp" style="color: black; display: flex; flex-direction: column; align-items: center;height:52.3px">
                <label for="password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm_pwd" name="confirm_pwd" required><br>
            </div>
            <br>

            <fieldset id="role_field">
                <div class="champ_mdp" style="color: black; display: flex; flex-direction: column; align-items: center;">
                    <div style="display:flex;flex-direction:row;width:100%">
                        <div style="display:flex;flex-direction:column;width:50%">
                            <label for="client" style="text-align:center">Client</label>
                            <input type="radio" id="client" value="client" name="role" required checked/>
                        </div>

                        <div style="display:flex;flex-direction:column;width:50%">
                            <label for="pro" style="text-align:center">Professionnel</label>
                            <input type="radio" id="pro" value="pro" name="role"/>
                        </div>
                    </div>
                </div>
            </fieldset>
            <br>

            <button id="validate" style="color: white; background-color: #4D7EDD; border-radius: 4px; padding:5px; margin-right: 5px;">Créer mon compte</button>
            <button type="reset" style="color: white; background-color: #4D7EDD; border-radius: 4px; padding:5px; margin-right: 5px;">Tout effacer</button> <br> <br>
            <a href="Connexion.jsp" style="color:black; display: flex; flex-direction: column; align-items: center;">Déjà un compte ? Se connecter</a>
        </form>
        </form>

        <div class="drop drop-1"></div>
        <div class="drop drop-2"></div>
        <div class="drop drop-3"></div>
        <div class="drop drop-4"></div>
        <div class="drop drop-5"></div>
    </div>

    <!-- Formulaire End -->


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
                   <a href="connexion.html.php"> Se connecter</a> <br>
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