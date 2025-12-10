// Import des fonction permettant de récupérer toutes les informations pour la page. Que ce soit les ports dans les select, ou la page de résultats.
// Également import de la fonction de scroll.
import { retrieve_link } from '../js/horaire_link_retriever.js'
import { scroll } from '../js/horaire_link_retriever.js'
import { add_schedule_form } from './horaire_admin.js';
import { show_stat_page, show_admin_buttons } from './admin.js';
import { date_string } from './horaire_admin.js';
import { time_string } from './horaire_admin.js';

// Récupération de l'input contenant la date inscrite dans le formulaire.
const date_input = document.querySelector('#date');

// Récupération de l'input contenant l'heure inscrite dans le formulaire.
const time_input = document.querySelector('#time');

// Récupération de l'input contenant la date dans le formulaire d'ajout d'horaire
const date_add_input = document.querySelector('#add_form').querySelector('#date');

// Récupération de l'input contenant l'heure dans le formulaire d'ajout d'horaire
const time_add_input = document.querySelector('#add_form').querySelector('#time');

// Récupération de l'élément contenant la popup d'ajout d'horaire
const popup = document.querySelector('.background_popup');

// Récupération de l'input qui va permettre de réinitialiser les input précédemment récupérés.
const reset = document.querySelectorAll('#reset');
        
// Récupération du formulaire contenant les informations entrées par l'utilisateur.
const form = document.querySelector('#form');

// Récupération du div qui contiendra la page de résultats.
const result_pages = document.querySelector('#result_page');

// Récupération du bouton de scroll.
const scroll_button = document.querySelector('.switcher_button');

// Récupération des deux div correspondant au formulaire et à la page de résultats.
const pages = document.querySelectorAll('.page');

// Fonction permettant de personnaliser les actions réalisées lorsque le formulaire est envoyé.
// @param {event} event - correspond à l'évènement qui aura été déclenché
function submit_form(event) {
    // Empêche un éventuel rafraîchissement de page.
    event.preventDefault();

    // Appel de la fonction qui va permettre l'affichage des résultats mais aussi la récupération des ports de départ et d'arrivée.
    retrieve_link(form, result_pages);
}

// Ajout d'un eventListener qui se déclenchera lorsque la page aura finit de se charger.
document.addEventListener('DOMContentLoaded', () => {
    show_stat_page();
    // Le bouton est caché par défaut vu que l'on commence par la page de formulaire.
    scroll_button.classList.add('hide');

    // Affichage de la page du formulaire.
    pages[0].classList.add('active');

    // Ajout d'un eventListener qui se déclenche au click sur le bouton de scroll, permettant de changer de page.
    scroll_button.addEventListener('click', scroll);

    // Ajout d'un eventListener qui permet de rediriger l'envoi du formulaire vers la fonction 'submit_form'
    form.addEventListener('submit', submit_form);

    // Appel de la fonction permettant de remplir les <select> du formulaire d'ajout d'horaire
    add_schedule_form();

    // Vérification de si l'utilisateur est admin
    if (show_admin_buttons()) {
        // Si oui alors ajout du bouton permettant de montrer la popup d'ajout d'horaire
        document.querySelector('#add_button_container').innerHTML = `<p class="btn btn-outline-light w-100 py-3" id="add_button">Ajouter une horaire de traversée</p>`;

        // Récupération du bouton d'affichage de la popup
        const add_button = document.querySelector('#add_button');

        // Création d'un eventListener au click sur le bouton d'affichage
        add_button.addEventListener('click', (event) => {
            event.preventDefault();

            // Montre la popup
            popup.classList.remove('hidden');
        })
    }
});

// Ajout d'un eventListener sur le bouton permettant de remettre la valeur par défaut de l'input de date du formulaire de recherche d'horaire
reset[0].addEventListener('click', function(event) {
    event.preventDefault();

    // Réinitialise la valeur de l'input
    date_input.value = "";
})

// Ajout d'un eventListener sur le bouton permettant de remettre la valeur par défaut de l'input d'heure du formulaire de recherche d'horaire
reset[1].addEventListener('click', (event) => {
    event.preventDefault();

    // Réinitialise la valeur de l'input
    time_input.value = "";
})

// Ajout d'un eventListener sur le bouton permettant de remettre la valeur par défaut de l'input de date du formulaire d'ajout d'horaire
reset[2].addEventListener('click', function(event) {
    event.preventDefault();

    // Remet la valeur de l'input à la date d'aujourd'hui
    date_add_input.value = date_string;
})

// Ajout d'un eventListener sur le bouton permettant de remettre la valeur par défaut de l'input d'heure du formulaire d'ajout d'horaire
reset[3].addEventListener('click', (event) => {
    event.preventDefault();
    // Vérification de si la date saisie est celle d'aujourd'hui
    if (date_add_input.value == date_string) {
        // Si oui, met l'heure à celle actuelle
        time_add_input.value = time_string;
    } else {
        // Si non, met l'heure à "00:00"
        time_add_input.value = "00:00"
    }
})