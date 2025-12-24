// Instanciation d'une variable contenant le bouton de validation du formulaire de connexion
const valid_form = document.querySelector('#valid_form');
const wrong_credential_bow = document.querySelector('#wrong_credential_box');

// Création d'un eventListener au click sur le bouton de validation
valid_form.addEventListener('click', (event) => {
    // Annulation de l'effet initial du bouton, pour éviter qu'il ne valide le formulaire.
    event.preventDefault();

    // Création d'un objet JSON qui sera envoyé au fichier connect.php
    const sender = {
        // Valeur de l'input du mail
        email: document.querySelector('#email').value,
        // valeur de l'input du mot de passe
        password: document.querySelector('#password').value
    }

    // Appel en AJAX du fichier "connect.php"
    fetch('connection/connection', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json'
        },
        // Transformation en chaine de caractère de l'objet JSON à envoyer.
        body: JSON.stringify(sender)
    })
    .then(response => {
        // Vérification de l'état de l'appel
        if (response.ok) {
            // Si l'état est valide, redirige vers la page d'accueil
            return response.text();
        } else {
            // Sinon, renvoie une erreur
            console.error('Problème de fetch.');
            console.error(response.text());
        }
    })
    .then(redirect => {
        if (redirect == "Connexion.jsp") {
            document.querySelector('#username').value = "";
            document.querySelector('#password').value = "";
            wrong_credential_bow.classList.remove('hide');
        } else {
            window.location.href = redirect;
        }
    })
})