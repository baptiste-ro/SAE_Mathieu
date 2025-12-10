import { show_stat_page } from "./admin.js";

// Récupération des objets qui ont été stockés dans le stockage local.
const code_liaison = localStorage.getItem('code_liaison');
const departure = localStorage.getItem('departure');
const destination = localStorage.getItem('destination');

// Ici, on récupère une chaine de caractère qui correspond à un objet JSON. Il est donc nécessaire d'utiliser JSON.parse() pour récupérer l'objet JSON.
const cruise =  JSON.parse(localStorage.getItem('cruise'));

// Récupération du dive qui va contenir les informations liées à la liaison choisie.
const liaison_div = document.querySelector('.liaison');

// Ajout d'un eventListener qui se déclenchera lorsque la page aura finit de charger.
document.addEventListener('DOMContentLoaded', () => {
    show_stat_page();
    // Implémentation du code correspondant aux informations relatives à la liaison.
    liaison_div.innerHTML = `<p class="in_liaison">Liaison n° : ${code_liaison}</p>
            <p class="in_liaison">Port de départ : ${departure}</p>
            <p class="in_liaison">Port d'arrivée : ${destination}</p>`

    // Récupération des div contenant les informations relatives à la traversée choisie.
    // Cependant, on ne récupère que ceux où l'on a déjà accès aux informations, c'est à dire l'ID, la date, l'heure et le nom du bateau.
    const cruise_id = document.querySelectorAll('.c1')[1];
    const cruise_date = document.querySelectorAll('.c2')[1];
    const cruise_time = document.querySelectorAll('.c3')[1];
    const cruise_boat = document.querySelectorAll('.c4')[1];

    // Implémentation des informations dans leur div respectifs.
    cruise_id.innerHTML = cruise.id;
    cruise_date.innerHTML = cruise.date;
    cruise_time.innerHTML = cruise.time;
    cruise_boat.innerHTML = cruise.boat;

    // Appel en AJAX du fichier 'reservation.places_left.php'
    fetch('reservation.places_left.php', {
        // Appel en méthode 'POST'
        method: 'POST',
        headers: {
            // Précision du type de données envoyées : du texte brut
            'Content-type': 'text/plain'
        },
        // Passage en paramètre de l'ID de la traversée.
        body: cruise.id
    })
    .then(response => {
        // Vérification que la réponse du fetch est ok.
        if (response.ok) {
            return response.json();
        } else {
            // Sinon en renvoie une erreur.
            console.error('Problem sur le premier fetch');
        }
    })
    .then(data => {
        // Récupération des derniers champs relatifs à la traversée qu'il faut remplir.
        const cat_A = document.querySelectorAll('.c5')[1];
        const cat_B = document.querySelectorAll('.c6')[1];
        const cat_C = document.querySelectorAll('.c7')[1];

        // Implémentation des informations récupérées dans leur divs respectifs.
        cat_A.innerHTML = data[0].cat_A;
        cat_B.innerHTML = data[0].cat_B;
        cat_C.innerHTML = data[0].cat_C;

        // Appel en AJAX du fichier 'reservation.prices.php'
        fetch('reservation.prices.php', {
            // Appel en méthode 'POST'
            method: 'POST',
            headers: {
                // Précision du type de données envoyées : du texte brut
                'Content-type': 'text/plain'
            },
            // Passage en paramètre de l'ID de la traversée.
            body: cruise.id
        })
        .then(response => {
            // On vérifie que la réponse du fetch est ok.
            if (response.ok) {
                return response.json();
            } else {
                // Sinon on renvoie une erreur.
                console.error('Probleme sur le deuxième fetch');
            }
        })
        .then(prices_list => {
            // Récupération des espaces où seront inscrits les totaux des catégories, des inputs où seront inscrites les quantités, ainsi que de l'emplacement où sera écrit la somme totale.
            const written_prices = document.querySelectorAll('.prices');
            const inputs = document.querySelectorAll('.number');
            const total = document.querySelector('.total');

            // Création d'une boucle afin d'ajouter un eventListener à chaque input pour qu'il puisse récupérer la valeur de l'input et afficher le prix dans sont emplacement correspondant.
            for (let idx = 0; idx < inputs.length; idx++) {
                // Mise à 0 de tous les prix.
                written_prices[idx].innerHTML = `${prices_list[idx].price * inputs[idx].value}.00 €`;

                // Ajout de l'eventListener qui se déclenchera lorsque l'on changera le prix (avec les flèches).
                inputs[idx].addEventListener('change', () => {
                    // Mise à jour du div où est inscrit le prix changé
                    written_prices[idx].innerHTML = `${prices_list[idx].price * inputs[idx].value}.00 €`;

                    // Initialisation d'une variable correspondant au prix total.
                    let total_value = 0;

                    // Initialisation d'une variable correspondant au prix total.
                    written_prices.forEach(individual_price => {
                        total_value += parseFloat(individual_price.innerHTML.substring(0, individual_price.innerHTML.length - 5));
                    })

                    // Initialisation d'une variable correspondant au prix total.
                    total.innerHTML = `${total_value}.00 €`;
                })

                // Ajout de l'eventListener qui se déclenchera lorsque l'utilisateur écrira dans le champs.
                inputs[idx].addEventListener('input', () => {
                    // Mise à jour du div où est inscrit le prix changé
                    written_prices[idx].innerHTML = `${prices_list[idx].price * inputs[idx].value}.00 €`;

                    // Initialisation d'une variable correspondant au prix total.
                    let total_value = 0;

                    // Initialisation d'une variable correspondant au prix total.
                    written_prices.forEach(individual_price => {
                        total_value += parseFloat(individual_price.innerHTML.substring(0, individual_price.innerHTML.length - 5));
                    })
                    
                    // Initialisation d'une variable correspondant au prix total.
                    total.innerHTML = `${total_value}.00 €`;
                })
            }
        })
    })
})