import { results_search_list_handler } from "./liaison_results_handler.js";

export function port_search_list_handler(event, current_input, other_input) {
    // Récupération du contenu des trois inputs (pour le dernier .then)
    const secteur_content = document.querySelector('#search1').value;
    const departure_content = document.querySelector('#search2').value;
    const arrival_content = document.querySelector('#search3').value;

    // Récupération du contenu de l'input
    const content_to_send = {
        content: event.target.value,
        table: 'port',
        forbidden: other_input.value
    }

    // Vérification du contenu, pour voir s'il est vide
    if (content_to_send.content === '') {
        // Récupération du nav où se trouve la liste
        const listToComplete = event.target.nextElementSibling;

        // Retrait de l'affichage du nav
        listToComplete.classList.add("hide");
    } else {
        /*
         Appel en AJAX vers le fichier "liaison.php"
         (Précisions au cas où) : 
         - fetch(string:lien-a-fetch)   => permet de faire un appel en get/post à des liens où à des fichiers.
                                        => Ici, on appelle le fichier "liaison.php"
                                        => Si on veut faire un appel en get, on peut juste faire "fetch('lien-à-fetch)" sans mettre de deuxième paramètre.
                                        => Le fetch va récupérer le renvoie de ce qu'il va appeler. Dans notre cas, il appelle un fichier .php, donc il va récupérer ce que le fichier aurait dû afficher.
         - .then(answer => {...})       => Le contenu du premier .then() se fera TOUJOURS après exécution complète du fetch.
                                        => Les autres se feront à la suite de la même façon. Leurs exécutions sont synchrones.
                                        => Le paramètre "answer" peut se nommer de n'importe quelle façon. Mais il est mieux de lui donner un nom qui reflète ce qu'il contient.
                                        => Ce paramètre contiendra toujours le retour de la fonction d'au-dessus.
                                        => Le premier ".then()" aura dans son paramètre le contenu du fetch().
                                        => Un ".then()" n'a pas forcément besoin de paramètre. Dans ce cas, on peut directement mettre le code que l'on veut lui faire exécuter.
        */
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
                ul.innerHTML += `<li class="input-search-result darkens-when-hovered">${element.Libelle_Port}</li>`
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
                    current_input.value = event.target.innerHTML;

                    // Cache les propositions
                    nav_to_hide.classList.add('hide');

                    // Permet d'afficher les résultats lorsque l'on clique sur une des propositions (il ne le fait pas sans)
                    if (current_input.id === 'search2') {
                        results_search_list_handler(secteur_content, event.target.innerHTML, arrival_content);
                    } else {
                        results_search_list_handler(secteur_content, departure_content, event.target.innerHTML);
                    }
                })
            })
        })
        .catch(error => {
            // Si le fetch a échoué (c'est à dire qu'il ne peut pas atteindre le lien donné, que ce soit à cause d'un erreur dans le lien ou par manque de droits), écrit une erreur dans la console.
            console.error(`Erreur :`, error);
        });
    }
}