<!DOCTYPE html>
<html lang="fr">
<%@ page isELIgnored="false" %>
<%@ page contentType="text/html; charset=UTF-8" import="tools.*" %>
<%@ page import="com.saeweb.database.entity.users.Users" %>
<%@ page errorPage="erreur.jsp" %>
<%
    Users user = (Users) session.getAttribute("currentUser");
    boolean connected = (user != null) ? true : false;
%>

<%
    if (!connected) {
        String redirectURL = "Connexion.jsp";
        response.sendRedirect(redirectURL);
    }
%>

<head>

</head>

<head>
    <!-- Indique l'encodage des caractères utilisé par la page, ici UTF-8, ce qui permet d'afficher correctement des caractères spéciaux comme les accents français (é, è, à...) -->
    <meta charset="utf-8">
    <!-- Définit le titre de la page, affiché dans l’onglet du navigateur ou dans les résultats de recherche. -->
    <title></title>
    <!-- Rend la page responsive. -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">



    <!-- Permet de faire apparaitre les elements progressivement -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />


    <!-- Lien avec le css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien avec le css -->
    <link href="css/style.css" rel="stylesheet">
	<link href="css/accueil/Background.css" rel="stylesheet">
    <link href="css/profil/profil.css" rel="stylesheet">
    <link href="css/horaire/horaire.css" rel="stylesheet">

    <script type="module" src="js/accueil/images_management.js" defer></script>
    <script type="module" src="js/connexion/disconnection.js" defer></script>
    <script type="module" src="js/profile/profile.js" defer></script>
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
                </div>
                <p style="background-color: #e36355;border-color: #e36355;" class="btn btn-primary rounded-pill py-2 px-4" id="disconnect">Se déconnecter</p>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header background">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Profil</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">profil</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <div class="background_popup hidden">
        <div class="popup" id="log">
            <form method="post" enctype="multipart/form-data" action="/sae/image/upload" id="pfp_form" style="width:100%;display: flex;flex-flow: column;align-items: center;">
                <br>
                <h1 style="text-align: center;">Changer de photo de profil</h1>
                <br>
                <p style="margin:0px">Voulez-vous sélectionner cette image comme photo de profil ?</p>
                <br>
                <input type="file" style="display:none"/>
                <div style="padding:20px;display:flex;justify-content:center">
                    <img src="" alt="image-profil" class="preview_pfp" style="height:100px; width:100px;border-radius:100%;cursor:pointer">
                </div>
                <br>
                <div style="display:flex; flex-flow:row; justify-content: space-between; margin-bottom:1rem" bis_skin_checked="1">
                    <input type="submit" name="pfp_file" id="pfp_file" style="display:none" />
                    <label class="btn btn-outline-light w-100 py-3" for="pfp_file" style="width: 48%;max-width: 100%;background-color: rgb(0 255 18 / 25%);margin-left:0px; transition: 0s;margin-bottom:16px">Valider</label>
                    <p class="btn btn-outline-light w-100 py-3" id="cancel" style="width:48%;max-width: 100%;background-color: rgb(255 0 0 / 25%); transition: 0s">Annuler</p>
                </div>
            </form>
        </div>
    </div>

   
    <div class="informations_compte" style="display: flex; flex-direction: column; align-items: center;">
           
        <div class="infos-regroupés" style="display: flex;margin-bottom:10px">
            <div style="display: flex; flex-direction: column; justify-content:center; align-items: flex-start;" id="pfp_div">
                <input type="file" name="file" id="file" class="inputfile" style="border-radius:100%" />
                <label for="file" style="border-radius:100%"><img src="" alt="image-profil" class="profil_pic" id="profil_pic" style="height:100px; width:100px;border-radius:100%;cursor:pointer"></label>
            </div>
        </div>
        <div class="infos-dispersés" style="display: flex; flex-direction: column; align-items: stretch; font-size: 15px; background-color: #B2CCCE; padding: 12px; border-radius: 4px;">
            <div class="name-account">
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;">Votre nom : Nom</p>
            </div>

            <div class="firstname-account">
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;">Votre prenom : Prenom</p>
            </div>

            <div class="mail-account">
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;">Votre email : email</p>
            </div>

            <div class="change_info" style="display:flex">
                <a href="Modify_Information.jsp" style="color:white; background-color: #4D7EDD; border-radius: 4px; padding:5px;margin-bottom:1rem;height:32.5px">Modifiez vos informations</a>
            </div>

            <div class="erase_account">
                <p style="color:white; background-color: #E36355; border-radius: 4px; padding:5px;margin-bottom:0px">Supprimez votre compte</p>
            </div>
            
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
                   <a href="connexion.html.php"> Se connecter</a> <br>


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