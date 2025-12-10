// Récupération des titres du tableau des résultats
import { header1 } from './header_results.js'
import { header2 } from './header_results.js'

// Initialisation d'une chaine de caractère correspondant à un bouton pour afficher plus de résultats
const more_results_button = `<div style="display:flex;justify-content:center"><button id="more" class="more">Afficher plus</button></div>`

// Initialisation d'une chaine de caractère correspondant à un bouton pour afficher moins de résultats
const less_results_button = `<div style="display:flex;justify-content:center"><button id="less" class="more">Afficher moins</button></div>`

// Initialisation d'une chaine de caractère correspondant aux deux boutons réunis dans un div.
const both_results_button = `<div style="display:flex;justify-content:center"><button id="more" class="more" style="margin-right: 10px">Afficher plus</button><button id="less" class="more">Afficher moins</button></div>`

let data;

// Initialisation de la variable permettant de n'afficher que les 5 premiers résultats.
let count;

// Initialisation de la variable correspondant au maximum de résultat à afficher
let max_amount = 5;

export function results_search_list_handler(secteur_value, departure_value, arrival_value) {
    // Mise à 0 du compteur
    count = 0;

    // Récupération du div contenant l'ensemble des résultats
    const results_container = document.querySelector('#results-container');

    // Création d'une variable qui sera transmise à la base de données, contenant les valeurs des inputs.
    const input_contents = {
        secteur: secteur_value,
        departure: departure_value,
        arrival: arrival_value
    }

    // Appel en AJAX de 'resultsHandler.php' qui va gérer la récupération des liaisons correspondants aux valeurs des inputs.
    fetch('resultsHandler.php', {
        // Appel en method 'POST'
        method: 'POST',
        headers: {
            // Précision du type de données envoyées : du texte brut
            'Content-type': 'text/plain'
        },
        // Transformation en texte brut de 'input_contents'
        body: JSON.stringify(input_contents)
    })
    .then(response => {
        // Vérification de la réussite du fetch
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur de fetch');
        }
    })
    .then(result => {
        // Placement du résultat du fetch dans une variable externe data, pour pouvoir y accéder n'importe où.
        data = result;

        // Vidage du div container
        results_container.innerHTML = '';

        // Si le select n'a pas renvoyé de lignes, alors on n'affiche pas le container
        if (data.length <= 0) {
            results_container.innerHTML += header2;
            return;
        }

        // Affichage du titre tu tableau
        results_container.innerHTML += header1; 

        // Appel de la fonction permettant d'afficher les résultats
        printResults(results_container);
    })
    .catch(error => {
        // Si le fetch a échoué (c'est à dire qu'il ne peut pas atteindre le lien donné, que ce soit à cause d'un erreur dans le lien ou par manque de droits), écrit une erreur dans la console.
        console.error(`Erreur :`, error);
    });
}

function printResults(results_container) {
    // Création de la boucle permettant d'afficher les résultats
    while (count < max_amount && count < data.length) {
        // Récupération du [count]ième élément
        const element = data[count];
        // Ajout du résultat
        results_container.innerHTML += `<div class="results_list" id="${element.liaison}">
                                            <p class="text_in_blue">${element.secteur}</p>
                                            <p class="text_in_black" style="text-align: right">${element.depart}</p>
                                            <svg fill="#000000" height="59px" width="85px" viewBox="-100 0 1300 300" style="margin-left: 10px;margin-right: 10px">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier"> 
                                                    <!-- Je tape le premier qui touche à la balise <path> -->
                                                    <path id="XMLID_27_" d="M15,180h1083.787l-49.394,49.394c-5.858,5.857-5.858,15.355,0,21.213C1052.322,253.535,1056.161,255,1060,255 s7.678-1.465,10.606-4.394l75-75c5.858-5.857,5.858-15.355,0-21.213l-75-75c-5.857-5.857-15.355-5.857-21.213,0 c-5.858,5.857-5.858,15.355,0,21.213L1098.787,150H15c-8.284,0-15,6.716-15,15S6.716,180,15,180z"></path> 
                                                </g>
                                            </svg>
                                            <p class="text_in_black" style="text-align: left">${element.arrivee}</p>
                                            <p style="font-family:none" class="p_liaison tarif_link" id="${element.liaison}">Cliquez ici pour voir le tarif </p>
                                            <p style="color: #000000;font-size: 1rem;width: 325px">${element.distance}</p>
                                        </div>`
        count++;
    }

    // const results = document.querySelectorAll('input');
    // results.forEach(element => {
    //     console.log("a")
    //     element.addEventListener('click', () => {
    //         console.log('b')
    //         event.preventDefault();
    //         localStorage.setItem('num_liaison', event.target.id)
    //         window.location.href(`http://localhost/marieteam-web/Vue/tarifs.html.php`);
    //     })
    // });

    max_amount += 5;

    // Ajout d'un bouton "Afficher plus" permettant d'afficher soit 5 résultats supplémentaires, soit ceux restant s'il y en a moins
    // Dans le cas où tous les résultats n'ont pas été affichés, mais qu'il y en a plus que 5, c'est un bouton "Afficher moins" qui apparait en plus du bouton "Afficher plus", pour réinitialiser les résultats
    // Dans le cas où tous les résultats ont été affichés, seul le bouton "Afficher moins" apparait
    if (count < data.length - 1 && max_amount === 10) {
        // Ajout du bouton
        results_container.innerHTML += more_results_button;

        // Récupération du bouton
        const actual_button = document.querySelector('#more');

        // Ajout d'un évènement qui permet d'afficher 5 résultats supplémentaires, ou ceux restants s'il y en a moins.
        actual_button.addEventListener('click', (event) => {
            // Empêche un rechargement de page
            event.preventDefault();

            // Supprime l'élément
            event.target.remove();

            // Appel récursif pour afficher les nouveaux éléments
            printResults(results_container);
        })
    } else if (count < data.length - 1) {
        // Ajout du bouton "Afficher plus" et du bouton "Afficher moins"
        results_container.innerHTML += both_results_button;

        // Récupération du bouton "Afficher plus"
        const more_button = document.querySelector('#more');

        // Récupération du bouton
        const less_button = document.querySelector('#less');

        // Ajout d'un évènement qui permet d'afficher 5 résultats supplémentaires, ou ceux restants s'il y en a moins.
        more_button.addEventListener('click', (event) => {
            // Empêche un rechargement de page
            event.preventDefault();

            // Supprime les éléments
            more_button.remove();
            less_button.remove();

            // Appel récursif pour afficher les nouveaux éléments
            printResults(results_container);
        })

        // Ajout d'un évènement qui permet de réduire le nombre de résultats à 5
        less_button.addEventListener('click', (event) => {
            // Empêche un rechargement de page
            event.preventDefault();

            // Supprime les éléments
            more_button.remove();
            less_button.remove();

            // Suppression du contenu des résultats
            results_container.innerHTML = header1;

            // Remise à zéro du compteur
            count = 0;

            // Réinitialisation du nombre max de résultats à afficher
            max_amount = 5;

            // Appel récursif pour afficher les 5 premiers éléments
            printResults(results_container);
        });
    } else if (data.length <= 5) {
        return;
    } else {
        // Ajout du bouton "Afficher moins"
        results_container.innerHTML += less_results_button;
        
        // Récupération du bouton
        const actual_button = document.querySelector('#less');
        
        // Ajout d'un évènement qui permet de réduire le nombre de résultats à 5
        actual_button.addEventListener('click', (event) => {
            // Empêche un rechargement de page
            event.preventDefault();

            // Supprime l'élément
            event.target.remove();

            // Suppression du contenu des résultats
            results_container.innerHTML = header1;

            // Remise à zéro du compteur
            count = 0;

            // Réinitialisation du nombre max de résultats à afficher
            max_amount = 5;

            // Appel récursif pour afficher les 5 premiers éléments
            printResults(results_container);
        
        });
    }
}