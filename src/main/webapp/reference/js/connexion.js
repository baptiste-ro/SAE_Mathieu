// Import de la fonction "set_admin"
import { set_admin } from "./admin.js";

// Instanciation d'une variable contenant le bouton de validation du formulaire de connexion
const valid_form = document.querySelector('#valid_form');

// Création d'un eventListener au click sur le bouton de validation
valid_form.addEventListener('click', (event) => {
    // Annulation de l'effet initial du bouton, pour éviter qu'il ne valide le formulaire.
    event.preventDefault();

    // Création d'un objet JSON qui sera envoyé au fichier connect.php
    const sender = {
        // Valeur de l'input du mail
        Mail_Compte: document.querySelector('#Mail_Compte').value,
        // valeur de l'input du mot de passe
        Mdp_Compte: document.querySelector('#Mdp_Compte').value
    }

    // Appel en AJAX du fichier "connect.php"
    fetch('connect.php', {
        method: 'POST',
        headers: {
            'Content-type': 'text/plain'
        },
        // Transformation en chaine de caractère de l'objet JSON à envoyer.
        body: JSON.stringify(sender)
    })
    .then(response => {
        // Vérification de l'état de l'appel
        if (response.ok) {
            // Si l'état est valide, renvoie la réponse sous format String
            return response.text();
        } else {
            // Sinon, renvoie une erreur
            console.error('Problème de fetch.');
        }
    })
    .then(data => {
        // Vérification de si l'utilisateur est bien connecté
        if (data === "true") {
            // Si oui, appel de la fonction permettant de vérifier l'état d'administrateur, puis qui redirige vers la page d'accueil
            set_admin();
        } else {
            // Sinon, affiche une alerte avec le message d'erreur
            window.alert(data);
        }
    })
})