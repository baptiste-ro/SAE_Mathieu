// Import de la fonction permettant d'afficher l'onglet de la page "statistiques"
import { show_stat_page } from "./admin.js";

// Récupération du bouton de déconnexion
const disconnect_button = document.querySelector('#disconnect');

const change_information_button = document.querySelector('.change_info');

const profile_pic = document.querySelector('.profil_pic');

// Ajout d'un eventListener au click sur le bouton de déconnexion, pour déconnecter l'utilisateur
disconnect_button.addEventListener('click', (event) => {
    event.preventDefault();
    // Appel en AJAX du fichier "deconnect.php"
    fetch('deconnect.php')
    .then(answer => {
        // Vérification de l'état de la réponse
        if (answer.ok) {
            // Si l'état de la réponse est valide, ajoute au stockage local la suppression de l'état admin de l'utilisateur
            localStorage.setItem('admin', 'f');

            // Redirige vers la page d'accueil
            window.location.href = "../index.php";
        } else {
            // Sinon renvoie une erreur
            console.error('problème de déconnexion');
        }
    })
})

// Ajout d'un eventListener sur le chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    // Appel de la fonction qui permet d'afficher l'onglet des statistiques si l'utilisateur est admin
    show_stat_page("Vue/");
});



change_information_button.addEventListener('click', (event) => {
    event.preventDefault();
    // fetch('/sae/profile/change_information');
})