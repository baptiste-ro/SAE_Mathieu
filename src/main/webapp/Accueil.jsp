<!DOCTYPE html>
<html lang="fr">
<%@ page isELIgnored="false" %>
<%@ page contentType="text/html; charset=UTF-8" import="tools.*" %>
<%@ page errorPage="erreur.jsp" %>
<%@ page import="com.saeweb.database.entity.users.Users" %>
<%
    Users user = (Users) session.getAttribute("currentUser");
    boolean connected = (user != null) ? true : false;
%>

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

    <script type="module" src="js/accueil/index.js" defer></script>
    <script type="module" src="js/accueil/images_management.js" defer></script>
	<script type="module" src="js/accueil/calendar/calendar.js"></script>
</head>

<body>
    <!-- Pour ne pas avoir de superposition de texte !-->
    <div class="container-fluid position-relative p-0">
        <!-- Permet d'avoir la navbar en haut a droite -->
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <!-- Pour avoir le logo et le nom de la compagnie en haut a gauche !-->
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Mariteam</h1>


            <!-- Navbar !-->

            <!-- Sert a former la navbar, a separer les éléments, ne pas les superposer et avoir le fond (photo) !-->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Navbar pour naviguer et selectionner la page que l'ont souhaite visiter !-->
                    <a href="index.php" class="nav-item nav-link active">Accueil</a>
                </div>
                <%
                    if (!connected) {
                        out.println("<a href='Connexion.jsp' class='btn btn-primary rounded-pill py-2 px-4'>Se connecter</a>");
                    } else {
                        out.println("<a id='" + user.getID() + "' href='Profil.jsp' class='btn btn-primary rounded-pill py-2 px-4 user-id'>" + user.getFirstName() + "</a>");
                    }
                %>
            </div>
        </nav>

        <!-- Permet d'avoir la barre de recherche + d'afficher la photo en fond !-->
        <div class="container-fluid bg-primary py-5 mb-5 hero-header background">
            <!-- Mise en forme !-->
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown"></h1>
                        <p class="fs-4 text-white mb-4 animated slideInDown"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Navbar -->

    <div>

	<link rel="dns-prefetch" href="//unpkg.com" />
	<link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
	<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

	<style>
		[x-cloak] {
			display: none;
		}
	</style>

<div class="antialiased sans-serif bg-gray-100">
	<div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
		<div class="container mx-auto px-4 py-2 md:py-24">

			<!-- <div class="font-bold text-gray-800 text-xl mb-4">
				Schedule Tasks
			</div> -->

			<div class="bg-white rounded-lg shadow overflow-hidden">

				<div class="flex items-center justify-between py-2 px-6">
					<div>
						<span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
						<span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
					</div>
					<div class="border rounded-lg px-1" style="padding-top: 2px;">
						<button
							type="button"
							class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
							@click="prevMonth()">
							<svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
							</svg>
						</button>
						<div class="border-r inline-flex h-6"></div>
						<button
							type="button"
							class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
							@click="nextMonth()">
							<svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
						</button>
					</div>
				</div>

				<div class="-mx-1 -mb-1">
					<div class="flex flex-wrap" style="margin-bottom: -40px;">
						<template x-for="(day, index) in DAYS" :key="index">
							<div style="width: 14.26%" class="px-2 py-2">
								<div
									x-text="day"
									class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
							</div>
						</template>
					</div>

					<div class="flex flex-wrap border-t border-l">
						<template x-for="blankday in blankdays">
							<div
								style="width: 14.28%; height: 120px"
								class="text-center border-r border-b px-4 pt-2"
							></div>
						</template>
						<template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
							<div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative cursor-pointer calendar-date"
                                :data-date="date"
								@click="showEventModal(date)">
								<div
									x-text="date"
									class="inline-flex w-6 h-6 items-center justify-center text-center leading-none rounded-full transition ease-in-out duration-100"
									:class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700': isToday(date) == false }"
								></div>
							</div>
						</template>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
			<div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 mt-24">
				<div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
					x-on:click="openEventModal = !openEventModal"
					style="z-index: 1;top: 50px;">
					<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path
							d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
					</svg>
				</div>

				<div class="shadow w-full rounded-lg bg-white w-full block p-8" style="position: relative;top: 50px;">

					<h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Prenez rendez-vous</h2>

					<div class="mb-4">
						<label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Horaire</label>
						<select type="text" class="form-control search-bar2" placeholder="Votre Traversee" style="border-radius: 20px 0 0 20px;">
							<option value="08:00">8:00</option>
							<option value="08:30">8:30</option>
							<option value="09:00">9:00</option>

							<option value="09:30">9:30</option>
							<option value="10:00">10:00</option>
							<option value="10:30">10:30</option>
							<option value="11:00">11:00</option>
							<option value="11:30">11:30</option>

							<option value="12:00">12:00</option>
							<option value="12:30">12:30</option>
							<option value="13:00">13:00</option>
							<option value="13:30">13:30</option>
							<option value="14:00">14:00</option>

							<option value="14:30">14:30</option>
							<option value="15:00">15:00</option>
							<option value="15:30">15:30</option>
							<option value="16:00">16:00</option>
							<option value="16:30">16:30</option>

							<option value="17:00">17:00</option>
							<option value="17:30">17:30</option>
							<option value="18:00">18:00</option>
							<option value="18:30">18:30</option>

							<option value="19:00">19:00</option>
							<option value="19:30">19:30</option>
							<option value="20:00">20:00</option>
							<option value="20:30">20:30</option>
							
						</select>
					</div>

					<div class="mb-4">
						<label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Date</label>
						<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
					</div>

					<div class="mt-8 text-right">
						<button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
							Annuler
						</button>
						<button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm" @click="addEvent()">
							Confirmer
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /Modal -->
	</div>
  </div>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- row : Crée une ligne Bootstrap pour placer plusieurs colonnes côte à côte.
            g-5 : Ajoute un espacement (gutter) entre les colonnes (ici un espace moyen/large). -->
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <!-- Permet de placer l'image a gauche ainsi que de choisir sa taille -->
                    <div class="position-relative h-100">
                        <!-- Permet d'afficher l'image-->
                        <img class="img-fluid position-absolute w-100 h-100 description" src="https://marieteam.louiseisabel.fr/public/bateau.png" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">A propos de nous</h6>
                    <h1 class="mb-4">Bienvenue chez <span class="text-primary spring-title"></span></h1>
                    <!-- Permet de mettre du texte a coter de l'image -->
                    <p class="mb-4 spring-description"></p>
                    <!-- Cette nouvelle ligne, permet de faire un nouveau paragraphe-->
                    <p class="mb-4 spring-description"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->

    <div class="container-xxl py-5">
        <div class="container">
            <!-- Sert à afficher un en-tête de section "Services", centré et animé, en utilisant Bootstrap et une bibliothèque d’animations -->
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Nos Services</h1>
            </div>
            <!-- row : Lance une grille Bootstrap pour aligner les éléments horizontalement (en colonnes).
            g-4 : Ajoute des espacements (gutter) uniformes entre les colonnes (taille moyenne : 4)-->
            <div class="row g-4 service-div">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <!-- Permet de placer les icones de Services cote a cote-->
                    <div class="service-item rounded pt-3">
                        <div class="p-4">

                            <!-- Permet de faires un lien vers la page, via l' icone-->
                            <a href="Vue/liaisons.html.php">
                                <h5 class="spring-services-title"></h5>
                            </a>
                            <p class="spring-services-description"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-hotel text-primary mb-4"></i>
                            <!-- Permet de faires un lien vers la page, via l' icone-->
                            <a href="Vue/tarifs.html.php">
                                <h5 class="spring-services-title"></h5>
                            </a>
                            <p class="spring-services-description"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <!-- Permet de faires un lien vers la page, via l' icone-->
                            <a href="Vue/horaire.html.php">
                                <h5 class="spring-services-title"></h5>
                            </a>
                            <p class="spring-services-description"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <!-- Permet de faires un lien vers la page, via l' icone-->
                            <a href="Vue/creerUnCompte.html">
                                <h5 class="spring-services-title"></h5>
                            </a>
                            <p class="spring-services-description"></p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Footer Start -->

    <!-- Ce <div> crée un conteneur large (pleine largeur) pour le pied de page avec plusieurs classes CSS -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <!-- Ce div recentre le contenu à l'intérieur d'un conteneur fixe (centré) -->
        <div class="container py-5">
            <!-- Crée une ligne de grille Bootstrap avec un gutter (g-5) = espace entre les colonnes. -->
            <div class="row g-5">
                <!-- Colonne qui permet un responsive design  -->
                <div class="col-lg-3 col-md-6">
                    <!-- Met le titre -->
                    <h4 class="text-white mb-3">MarieTeam</h4>
                    <!-- Ces balises <a> sont des liens de navigation vers les différentes pages du site-->
                    <a href="index.php">Accueil</a> <br>
                    <a href="Vue/liaisons.html.php">Liaisons</a> <br>
                    <a href="Vue/tarifs.html.php">Tarifs</a> <br>
                    <a href="Vue/horaire.html.php">Horaires</a> <br>
                    <a href="Connexion.jsp"> Se connecter</a> <br>
                    <a href="Vue/rgpd.html"> RGPD</a> <br>


                </div>
                <!-- Permt de placer " Nous contacter" a droite des liens -->
                <div class="col-lg-3 col-md-6">
                    <!--  Titre de cette section, en blanc, avec une marge en bas. -->
                    <h4 class="text-white mb-3">Nous contacter</h4>
                    <!-- Indique le mail sous le titre -->
                    <p class="mb-2 spring-contact-mail"></p>

                </div>
            </div>
        </div>
        <!--  Ce div recentre le contenu horizontalement et lui donne une largeur limitée (centrée dans la page). -->
        <div class="container">
            <!--  div servant à regrouper le texte des droits d’auteur -->
            <div class="copyright">
             <!--  Début d’une ligne Bootstrap (grille) pour répartir le contenu en colonnes si besoin. -->
                <div class="row">
                    <!-- Crée une colonne qui s’adapte selon la taille de l’écran -->
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <!-- Peremt d'ecrire et d'indiquer les droits-->
                        &copy; <a class="border-bottom" href="index.php">Mariteam</a>, All Right Reserved.
                        Designed By Tom Lelievre, Axel Wilfart, Baptiste Royer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
   <!-- jQuery : une bibliothèque JavaScript populaire qui simplifie la manipulation du DOM, les événements, les requêtes AJAX, etc. -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap JS : permet les fonctionnalités interactives de Bootstrap (menus déroulants, modales, carrousels…) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- WOW.js : active les animations CSS (comme fadeIn, slideIn) lorsque les éléments apparaissent à l’écran pendant le défilement. -->
    <script src="lib/wow/wow.min.js"></script>
    <!-- jQuery Easing : ajoute des effets de transition plus fluides et variés (accélération/décélération) lors des animations. -->
    <script src="lib/easing/easing.min.js"></script>
   <!-- Waypoints.js : déclenche des fonctions quand on fait défiler la page jusqu’à un certain élément -->
    <script src="lib/waypoints/waypoints.min.js"></script>
    <!-- Owl Carousel : permet de créer des carrousels (sliders) d’images, de témoignages, etc., facilement configurables et responsive. -->
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Tempus Dominus : une bibliothèque de sélecteurs de date et d'heure intégrée à Bootstrap.
        moment.min.js et moment-timezone.min.js sont des dépendances pour gérer les dates et fuseaux horaires.
        tempusdominus-bootstrap-4.min.js affiche le calendrier interactif. -->
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


<!-- Pop-up Cookies -->
<div id="cookie-popup" class="hidden">
<!-- Conteneur interne pour styliser le contenu (boîte blanche, ombrage, centrage, etc.). -->
    <div class="cookie-popup-content">
        <p>Ce site utilise des cookies pour améliorer l'expérience, conformément à notre <a href="Vue/rgpd.html" style="text-decoration-line: underline;">Politique de confidentialité.</a></p>
        <button id="accept-cookies">Accepter</button>
        <button id="reject-cookies">Refuser</button>
    </div>
</div>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>