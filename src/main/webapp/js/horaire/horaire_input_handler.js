let departure;
let arrival;

document.addEventListener('DOMContentLoaded', () => {
    // Attribution aux variables des select correspondant respectivement au départ et à l'arrivée de la liaison.
    departure = document.querySelector('#departure');
    arrival = document.querySelector('#arrival');

    // Appel de la fonction set_inputs, qui gère la création des options dans les select
    set_inputs();
})

// Fonction permettant UNIQUEMENT l'initialisation des options dans le select du point de départ de la liaison.
function set_departure() {
    // Appel en AJAX du fichier horaire_options.php permettant de récupérer le nom des ports de départ.
    fetch('horaire_options.php', {
        // Appel en méthode POST pour pouvoir envoyer des données
        method: 'POST',
        headers: {
            // Précision du type de données envoyées : du texte brut
            'Content-type': 'text/plain'
        },
        // Transformation en texte brut de d'un objet JSON contenant le nom de colonne "departure" et d'une valeur interdite (pas utilisée pour l'instant car pas nécessaire (pour l'instant))
        body: JSON.stringify({
            column: "departure",
            forbidden: arrival.value
        })
    })
    .then(response => {
        // Vérification du bon fonctionnement du fetch, avec une vérification de la réponse.
        if (response.ok) {
            return response.json();
        } else {
            // Si ça ne passe pas, en renvoie une erreur.
            console.error('Fetch problem occured')
        }
    })
    .then(data => {
        // Ajout des véritables options qui pourront être sélectionnées.
        data.forEach(element => {
            departure.innerHTML += `<option value="${element.id}" id="is_option">${element.libelle}</option>`
        });
    })
}

// Fonction permettant UNIQUEMENT l'initialisation des options dans le select du point de départ de la liaison.
function set_arrival() {
    fetch('horaire_options.php', {
        // Appel en AJAX du fichier horaire_options.php permettant de récupérer le nom des ports d'arrivée.
        method: 'POST',
        headers: {
            // Précision du type de données envoyées : du texte brut
            'Content-type': 'text/plain'
        },
        // Transformation en texte brut de d'un objet JSON contenant le nom de colonne "arrival" et d'une valeur interdite (pas utilisée pour l'instant car pas nécessaire (pour l'instant))
        body: JSON.stringify({
            column: "arrival",
            forbidden: departure.value
        })
    })
    .then(response => {
        // Vérification du bon fonctionnement du fetch, avec une vérification de la réponse.
        if (response.ok) {
            return response.json();
        } else {
            // Si ça ne passe pas, en renvoie une erreur.
            console.error('Fetch problem occured')
        }
    })
    .then(data => {
        // Ajout des véritables options qui pourront être sélectionnées.
        data.forEach(element => {
            arrival.innerHTML += `<option value="${element.id}" id="is_option">${element.libelle}</option>`
        });
    })
}

// Fonction permettant l'initialisation des deux selects en même temps 
// Le but plus tard sera de faire en sorte que lorsque l'on sélectionne un port de départ ou d'arrivée, l'autre select ne montre que les ports qui peuvent former une liaison.
function set_inputs() {
    set_departure();
    set_arrival();
}