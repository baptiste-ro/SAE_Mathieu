<!DOCTYPE html>
<html lang="fr">

<%@ page isELIgnored="false" %>
<%@ page contentType="text/html; charset=UTF-8" import="tools.*" %>
<%@ page errorPage="erreur.jsp" %>
<%@ page import="com.saeweb.database.entity.connection.Users" %>
<%
    Users user = (Users) session.getAttribute("currentUser");
    boolean connected = (user != null) ? true : false;
%>

<head>
      <meta charset="utf-8">
    <title>Mariteam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
 

    <!-- Permet de faire apparaitre les elements progressivement -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Lien avec le css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien avec le css -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/profil/profil.css" rel="stylesheet">

    <script type="module" src="js/profile/modify_information/modify_information.js"></script>
    <script type="module" src="js/accueil/images_management.js" defer></script>
</head>

<body>

<!-- Fin du Message d'erreur -->


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
                        <a href="Accueil.jsp" class="nav-item nav-link ">Accueil</a>
                </div>
                <a href="deconnect.php" style="background-color: #e36355;border-color: #e36355;" class="btn btn-primary rounded-pill py-2 px-4">Se déconnecter</a>

          </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header background">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown active">Modification du Profil</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="Accueil.jsp">Accueil</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">profil</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

<!-- Formulaire de modification du profil -->
<!-- Ajoute l'attribut onsubmit pour appeler la fonction JavaScript verifierMdp() avant l'envoi -->
<form style="display: flex; flex-direction: column; align-items: center;"  autocomplete="off">
    
    <div class="champs_modif" style="display: flex; flex-direction: column; align-items: stretch; font-size: 15px; background-color: #B2CCCE; padding: 12px; border-radius: 4px;">
     <!-- Champ pour modifier le prenom, prérempli avec le prenom actuel en session -->
    <div class="champ_prenom" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Prénom :</label>
        <input type="text" name="Prenom_Compte" id="first_name_field" autocomplete="off"><br>
    </div>
    <!-- Champ pour modifier le nom, prérempli avec le nom actuel en session -->
    <div class="champ_nom" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Nom :</label>
        <input type="text" name="Nom_Compte" id="last_name_field" autocomplete="off"><br>
    </div>
    <!-- Champ pour modifier l'e-mail, prérempli avec l'e-mail actuel en session -->
    <div class="champ_mail" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Adresse :</label>
        <input type="text" name="address" id="address_field"><br>
    </div>
    <!-- Champ pour entrer l'ancien mot de passe (obligatoire) -->
    <div class="champ_ancien-mdp" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Ancien mot de passe :</label>
        <input type="password" name="old_password_field" id="old_password_field" onfocus="this.removeAttribute('readonly');" readonly><br>
    </div>
    <!-- Champ pour entrer un nouveau mot de passe (facultatif) -->
    <div class="champ_new-mdp" style="display: flex; flex-direction: column; align-items: center;">
        <label style="color: black;">Nouveau mot de passe (facultatif) :</label>
        <input type="password" id="new_password_field" autocomplete="off" name="nouveau_mdp"><br>
    </div>  
    <!-- Champ pour confirmer le nouveau mot de passe -->
    <div class="champ_confirm-mdp" style="display: flex; flex-direction: column; align-items: center;"> 
        <label style="color: black;">Confirmer le nouveau mot de passe :</label>
        <input type="password" id="confirm_password_field" autocomplete="off" name="confirmer_mdp"><br>
    </div>
    <div class="email_field" style="display: flex; flex-direction: column; align-items: center;visibility:hidden;height:0px"> 
        <input type="text" id="email_field" value="<%= user.getEmail() %>" name="email"><br>
    </div>
    <!-- Bouton pour soumettre le formulaire -->
    <p class="validate" style="background-color: #4D7EDD; border-radius: 4px; padding:5px;">Mettre à jour</p>
    </div>
</form>

<!-- Script JavaScript qui vérifie que les deux nouveaux mots de passe sont identiques -->


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
                   <a href="Accueil.jsp">Accueil</a> <br>
                   <a href="Profil.jsp">Profil</a> <br>


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
                       &copy; <a class="border-bottom" href="Accueil.jsp">Mariteam</a>, All Right Reserved.
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
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
