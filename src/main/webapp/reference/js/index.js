import { show_stat_page } from "./admin.js";

// Ajout d'un eventListener sur la fin de chargement de la page, pour lancer les vérification de si l'utilisateur est admin ou non
document.addEventListener('DOMContentLoaded', () => {
    
    // Appel de la fonction qui permet d'afficher l'onglet des statistiques si l'utilisateur est admin
    show_stat_page("Vue/");
})