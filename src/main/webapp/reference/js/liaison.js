// Import des fonctions pour récupérer les listes de propositions
import { secteur_search_list_handler } from "./secteur_handler.js";
import { port_search_list_handler } from "./port_handler.js";
import { results_search_list_handler } from "./liaison_results_handler.js";
import { show_stat_page } from "./admin.js";

// Récupération des inputs de Secteur, Port de départ, et Port d'arrivée
let inputRechercheSecteur;
let inputRecherchePortDepart;
let inputRecherchePortArrivee;

// Récupérations des div contenant les input
let search_divs = document.querySelectorAll('.search-div');

// Dès que la page a fini de charger, permet l'ajout des évènements liés au remplissage des input de la page liaison.
document.addEventListener('DOMContentLoaded', () => {
    show_stat_page();
    // Récupération des éléments.
    inputRecherchePortArrivee = document.querySelector('#search3');
    inputRecherchePortDepart = document.querySelector('#search2');
    inputRechercheSecteur = document.querySelector('#search1');

    // Affichage par défaut de toutes les liaisons. 
    // Quand les inputs sont vides, la page de résultats va afficher les liaisons dans l'ordre de leurs ajouts (se référer à la table 'liaison')
    results_search_list_handler(inputRechercheSecteur.value, inputRecherchePortDepart.value, inputRecherchePortArrivee.value);

    // Ajout d'un eventListener lorsque l'on écrit dans les inputs
    inputRechercheSecteur.addEventListener('input', (event) => {
        // Appel de la fonction permettant d'afficher les secteurs correspondants à ce qui est écrit dans l'input
        secteur_search_list_handler(event, inputRechercheSecteur);

        // Appel de la fonction permettant d'afficher les résultats correspondant aux valeurs des inputs
        results_search_list_handler(inputRechercheSecteur.value, inputRecherchePortDepart.value, inputRecherchePortArrivee.value);
    });
    inputRecherchePortDepart.addEventListener('input', (event) => {
         // Appel de la fonction permettant d'afficher les ports correspondants à ce qui est écrit dans l'input
        port_search_list_handler(event, inputRecherchePortDepart, inputRecherchePortArrivee);

        // Appel de la fonction permettant d'afficher les résultats correspondant aux valeurs des inputs
        results_search_list_handler(inputRechercheSecteur.value, inputRecherchePortDepart.value, inputRecherchePortArrivee.value);
    });
    inputRecherchePortArrivee.addEventListener('input', (event) => {
         // Appel de la fonction permettant d'afficher les ports correspondants à ce qui est écrit dans l'input
        port_search_list_handler(event, inputRecherchePortArrivee, inputRecherchePortDepart);

        // Appel de la fonction permettant d'afficher les résultats correspondant aux valeurs des inputs
        results_search_list_handler(inputRechercheSecteur.value, inputRecherchePortDepart.value, inputRecherchePortArrivee.value);
    });

    // Ajout d'un eventListener lorsque l'on clique en dehors des inputs
    inputRechercheSecteur.addEventListener('focus', (event) => {
        // Cache les propositions des autres inputs lorsque cet input a le focus (que l'on peut écrire dedans)
        inputRecherchePortDepart.nextElementSibling.classList.add('hide');
        inputRecherchePortArrivee.nextElementSibling.classList.add('hide');

        // Réaffiche les propositions correspondants à ce qui est écrit dans l'input
        secteur_search_list_handler(event, inputRechercheSecteur);
    });
    inputRecherchePortDepart.addEventListener('focus', (event) => {
        // Cache les propositions des autres inputs lorsque cet input a le focus (que l'on peut écrire dedans)
        inputRechercheSecteur.nextElementSibling.classList.add('hide');
        inputRecherchePortArrivee.nextElementSibling.classList.add('hide');

        // Réaffiche les propositions correspondants à ce qui est écrit dans l'input
        port_search_list_handler(event, inputRecherchePortDepart, inputRecherchePortArrivee);
    })
    inputRecherchePortArrivee.addEventListener('focus', (event) => {
        // Cache les propositions des autres inputs lorsque cet input a le focus (que l'on peut écrire dedans)
        inputRecherchePortDepart.nextElementSibling.classList.add('hide');
        inputRechercheSecteur.nextElementSibling.classList.add('hide');

        // Réaffiche les propositions correspondants à ce qui est écrit dans l'input
        port_search_list_handler(event, inputRecherchePortArrivee, inputRecherchePortDepart);
    })
})

// Ajout d'un evenement au click sur le document
document.addEventListener('click', (event) => {
    // Cache les propositions du div qui perd le focus.
    search_divs.forEach(div => {
        if(!div.contains(event.target)) {
            div.querySelector('nav').classList.add('hide');
        }
    })

    // Vérification de si l'élément cliqué contient la classe ".tarif_link"
    // (Un addEventListener sur les éléments en question aurait été plus simple)
    if (event.target.classList.contains('tarif_link')) {
        // Appel en AJAX du fichier "first_cruise/get_first_cruise.php"
        fetch('first_cruise/get_first_cruise.php', {
            method: 'POST',
            headers: {
                'Content-type': 'text/plain'
            },
            body: event.target.id
        })
        .then(answer => {
            // Vérification de l'état de la réponse
            if (answer.ok) {
                // Si l'état est valide, renvoie la réponse au format String
                return answer.text();
            } else {
                // Si l'état n'est pas valide, renvoie une erreur
                console.error('Erreur à la récupération de l\'ID');
            }
        })
        .then(data => {
            // Ajout au stockage de l'id de la liaison cliquée
            localStorage.setItem('loaded_id', parseInt(data));      
            
            // Redirection vers la page tarifs
            window.location.replace('tarifs.html.php')
        })
    }
})