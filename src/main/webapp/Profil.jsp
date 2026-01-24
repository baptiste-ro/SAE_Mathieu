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
    <script type="module" src="js/accueil/index.js" defer></script>
	<script type="module" src="js/accueil/calendar/calendar.js"></script>
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
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;margin-bottom:16px">Votre prénom : <%= user.getFirstName() %></p>
            </div>

            <div class="firstname-account">
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;margin-bottom:16px">Votre nom : <%= user.getLastName() %></p>
            </div>

            <div class="mail-account">
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;margin-bottom:16px">Votre email : <%= user.getEmail() %></p>
            </div>

            <div class="mail-account">
                <p style="color:black; background-color: #EEEEEE; border-radius: 4px; padding:5px;margin-bottom:16px">Votre adresse : <%= user.getAddress() %></p>
            </div>

            <div class="change_info" style="display:flex">
                <a href="Modify_Information.jsp" style="color:white; background-color: #4D7EDD; border-radius: 4px; padding:5px;margin-bottom:1rem;height:32.5px;width:100%;text-align:center">Modifiez vos informations</a>
            </div>

            <div class="erase_account">
                <p style="color:white; background-color: #E36355; border-radius: 4px; padding:5px;margin-bottom:0px;text-align:center">Supprimez votre compte</p>
            </div>
            
        </div>
    </div>


<%-- Personal calendar start --%>

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
        <div>
            <%-- Month view --%>
            <h1 class="your_appointments">Vos rendez-vous</h1>
            <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                <div class="container mx-auto px-4 py-2 md:py-24" style="padding-top:2rem">

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

                            </div>
                        </div>
                    </div>
                    <!-- /Modal -->
                    <div class="daily_calendar">
                        <div class="parent1">
                            <div class="div1_ row">08h00</div>
                            <div class="div2_ row">09h00</div>
                            <div class="div3_ row">10h00</div>
                            <div class="div4_ row">11h00</div>
                            <div class="div5_ row">12h00</div>
                            <div class="div6_ row">13h00</div>
                            <div class="div7_ row">14h00</div>
                            <div class="div8_ row">15h00</div>
                            <div class="div9_ row">16h00</div>
                            <div class="div10_ row">17h00</div>
                            <div class="div11_ row">18h00</div>
                            <div class="div12_ row">19h00</div>
                            <div class="div13_ row">20h00</div>
                        </div>
                        <div class="parent">
                            <div class="div1 row row_">
                                <div class="rdv">
                                    08h00 - 08h30 : Mr Park
                                </div>
                            </div>
                            <div class="div2 row row_">
                                <div class="rdv">
                                    08h30 - 09h00 : Mr Park
                                </div>
                            </div>
                            <div class="div3 row row_">

                            </div>
                            <div class="div4 row row_">

                            </div>
                            <div class="div5 row row_">

                            </div>
                            <div class="div6 row row_">

                            </div>
                            <div class="div7 row row_">

                            </div>
                            <div class="div8 row row_">

                            </div>
                            <div class="div9 row row_">

                            </div>
                            <div class="div10 row row_">

                            </div>
                            <div class="div11 row row_">

                            </div>
                            <div class="div12 row row_">

                            </div>
                            <div class="div13 row row_">

                            </div>
                            <div class="div14 row row_">

                            </div>
                            <div class="div15 row row_">

                            </div>
                            <div class="div16 row row_">

                            </div>
                            <div class="div17 row row_">

                            </div>
                            <div class="div18 row row_">

                            </div>
                            <div class="div19 row row_">

                            </div>
                            <div class="div20 row row_">

                            </div>
                            <div class="div21 row row_">
                                
                            </div>
                            <div class="div22 row row_">

                            </div>
                            <div class="div23 row row_">

                            </div>
                            <div class="div24 row row_">

                            </div>
                            <div class="div25 row row_">

                            </div>
                            <div class="div26 row row_">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <%--  --%>

        


        <%--  --%>

     <!-- Footer Start -->

    <!-- Permet de placer les éléments -->
    <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s">
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