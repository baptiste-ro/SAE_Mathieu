import { results_search_list_handler } from "./liaison_results_handler.js";

export function secteur_search_list_handler(event, inputRechercheSecteur) {
    // Récupération du contenu des trois inputs (pour le dernier .then)
    const departure_content = document.querySelector('#search2').value;
    const arrival_content = document.querySelector('#search3').value;

    // Récupération du contenu de l'input
    const content_to_send = {
        content: event.target.value,
        table: 'secteur',
        forbidden: ''
    }

    // Vérification du contenu, pour voir s'il est vide
    if (content_to_send.content === '') {
        // Récupération du nav où se trouve la liste
        const listToComplete = event.target.nextElementSibling;

        // Retrait de l'affichage du nav
        listToComplete.classList.add("hide");
    } else {
        // Appel en AJAX vers le fichier "liaison.php"
        fetch('liaison.php', {
            method: 'POST',
            headers: {
                // Indique que l'on envoie du texte brut
                'Content-Type': 'text/plain' 
            },
            // Envoie la chaîne de caractères "contenu"
            body: JSON.stringify(content_to_send)
        })
        .then(response => {
            // Vérifie que le fetch ne renvoie pas d'erreurs
            if (response.ok) {
                // Lecture de la réponse au format .json
                return response.json();
            } else {
                // Si le fetch a renvoyé des erreurs, renvoie une erreur.
                throw new Error(`Erreur réseau !`);
            }
        })
        .then(data => {
            // Récupération du nav où se situe la liste
            const listToComplete = event.target.nextElementSibling;

            // Affichage du nav si 'data' n'est pas vide
            if (data.length > 0) {
                listToComplete.classList.remove("hide");
            } else {
                listToComplete.classList.add("hide");
            }

            // Récupération de la liste
            const ul = listToComplete.querySelector('ul');

            // Vidage du contenu de la liste
            ul.innerHTML = "";

            // Remplissage du contenu de la liste
            data.forEach(element => {
                ul.innerHTML += `<li class="input-search-result darkens-when-hovered">${element.Nom_Secteur}</li>`
            });
        })
        .then(nextStep => {
            // Récupération du nav pour le cacher si une option est sélectionnée
            const nav_to_hide = event.target.nextElementSibling;

            // Récupération de la liste des propositions
            const list_entries = nav_to_hide.querySelectorAll('li');
            
            // Ajout à chaque proposition d'un eventListener au click
            list_entries.forEach(entry => {
                entry.addEventListener('click', (event) => {
                    // Empêche un rechargement de page au click (par sécurité)
                    event.preventDefault();

                    // Met dans l'input la valeur de la proposition clickée
                    inputRechercheSecteur.value = event.target.innerHTML;

                    // Cache les propositions
                    nav_to_hide.classList.add('hide');
                    
                    // Permet d'afficher les résultats lorsque l'on clique sur une des propositions (il ne le fait pas sans)
                    results_search_list_handler(event.target.innerHTML, departure_content, arrival_content);
                })
            })
        })
        .catch(error => {
            // Si le fetch a échoué (c'est à dire qu'il ne peut pas atteindre le lien donné, que ce soit à cause d'un erreur dans le lien ou par manque de droits), écrit une erreur dans la console.
            console.error(`Erreur :`, error);
        });
    }
}