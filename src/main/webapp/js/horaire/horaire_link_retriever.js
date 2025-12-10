// Import d'une partie du code qui sera implémentée. On l'importe parce que ça sera toujours le même.
import { header } from './horaire_results_header.js'

// Import de la fonction qui va permettre de modifierles liens
import { edit_links } from './horaire_admin.js'
import { show_admin_buttons } from './admin.js';

// Initialisation de deux variables min et max qui permettront d'afficher les résultats 4 par 4.
// Ils serviront de repères pour les indices des résultats à afficher.
let min = 0;
let max = 4;

// Initialisation d'une variable permettant de savoir si l'on doit afficher le formulaire pour rentrer nos données ou s'il faut afficher les résultats (en lien avec le scrolling)
let curr_id = 1;

let preventScroll = false;

// Initialisation d'une variable qui contiendra les deux pages : celle avec le formulaire, et celle avec les résultats.
const pagess = document.querySelectorAll('.page');

// Initialisation d'une variable qui contiendra le bouton permettant de repasser des résultats au formulaire (ne s'affiche que lorsque l'utilisateur est sur la page des résultats.)
const Elderscroll_button = document.querySelector('.switcher_button');

let local_form;
let local_page;

// Fonction permettant de récupérer les résultats. 
// Le fait que l'on parle de lien correspond au fait que les résultats seront clickables pour rediriger vers la page réservation.html.php
// @param {balise} form - formulaire contenant les informations à récupérer.
// @param {balise} page - page où seront écris les résultats

export function retrieve_link(form, page) {
    local_form = form;
    local_page = page;

    // Les variables doivent être réinitialisées à chaque fois qu'une nouvelle recherche est effectuée.
    min = 0;
    max = 4;

    // Dans le cas où la date et l'heure ne sont pas précisées, on va récupérer la date actuelle.
    const today = new Date();

    // Initialisation d'une variable contenant uniquement soit la date indiquée dans le formulaire, soit la date actuelle.
    const date = form.querySelector('#date').value || `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

    // Initialisation d'une variable contenant uniquement soit l'heure indiquée dans le formulaire, soit l'heure 00:00.
    const time = form.querySelector('#time').value || '00:00';

    // Initialisation d'une variable contenant le port de départ indiqué dans le formulaire.
    const departure = form.querySelector('#departure').value;

    // Initialisation d'une variable contenant le port d'arrivée indiqué dans le formulaire.
    const arrival = form.querySelector('#arrival').value;

    // Création d'un objet JSON qui sera envoyé dans le fetch, contenant le port de départ et d'arrivée.
    const form_data = {
        departure: departure,
        arrival: arrival
    }

    fetch('horaire.php', {
        // Appel en method 'POST'
        method: 'POST',
        headers: {
            // Précision du type de données envoyées : du texte brut
            'Content-type': 'text/plain'
        },
        // Transformation en texte brut de 'form_data'
        body: JSON.stringify(form_data)
    })
    .then(response => {
        // Vérification que le fetch s'est bien déroulé.
        if (response.ok) {
            return response.json();
        } else {
            // Sinon, on renvoie une erreur.
            throw new Error('Erreur de fetch');
        }
    })
    .then(data => {
        // Si jamais on ne trouve pas de liaison avec les port choisis par l'utilisateur, on affiche juste une alerte disant qu'il n'existe pas la liaison demandée.
        if (data.length == 0) {
            // Permet d'envoyer l'alerte
            alert('Aucune liaison trouvée.')
        } else {
            // Appel en AJAX de horaire_results.php si la liaison a bien été trouvée (il ne peut pas y avoir plusieurs liaisons.)
            fetch('horaire_results.php', {
                // Appel en méthode 'POST'
                method: 'POST',
                headers: {
                    // Précision du type de données envoyées : du texte brut
                    'Content-type': 'text/plain'
                },
                // Transformation en texte brut d'un objet JSON contenant le code de liaison de la liaison, la date et l'heure qui a été choisie/définie par défaut.
                body: JSON.stringify({code: data[0].code_liaison, date, time})
            })
            .then(response => {
                // Vérification que le fetch s'est bien déroulé.
                if(response.ok) {
                    return response.json();
                } else {
                    // Sinon on renvoie une erreur.
                    throw new Error('Erreur de deuxième fetch');
                }
            })
            .then(data2 => {
                fetch('horaire/get_coast_names.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'text/plain'
                    },
                    body: JSON.stringify({dep: departure,arr: arrival})
                })
                .then(answer => {
                    if (answer.ok) {
                        return answer.json();
                    } else {
                        console.error('Problème de fetch sur la récupération des ports');
                    }
                })
                .then(data3 => {
                  // Appel de la fonction qui va permettre d'écrire les traversées trouvées.
                    write_results(data[0].code_liaison, data3['dep'], data3['arr'], page, data2);  
                })
            })
            // Appel de la fonction scroll qui permet de passer du formulaire à la page de résultats.
            scroll();
        }
    })
    // En cas d'erreur dans le fetch, on renvoie une erreur.
    .catch(error => {
        console.error(error);
    });
}

// Fonction permettant d'écrire la page de résultats.
// @param {number} code - code de liaison
// @param {string} departure - nom du port de départ
// @param {string} arrival - nom du port d'arrivée
// @param {balise} page - balise contenant la page de résultats où il faut écrire
// @param {JSON object} datas - objet JSON contenant le résultat de la requête SQL
function write_results(code, departure, arrival, page, datas) {
    // Ajout du header en faisant appel à la fonction permettant d'afficher le header.
    // On passe en paramètre le code de liaison, le port de départ et d'arrivée, ainsi que des valeurs qui vont correspondre à la page de résultat à afficher, et le nombre max de page.
    // Par exemple, si l'on passe 4 et 8, alors ça veut dire que l'on va afficher la 4e page de résultats sur les 8.
    let max_page;

    if (datas.length % 4 != 0) {
       max_page = (Math.trunc(datas.length/4) + 1)
    } else {
        max_page = datas.length/4
    }

    page.innerHTML = header(code, departure, arrival, (min/4)+1, max_page);

    // Création d'un index à la valeur de min pour savoir à partir de quel ième résultat il faut les afficher.
    let index = min;

    // Boucle pour afficher les résultats en question.
    while (index < max && index < datas.length) {
        // Un peu comme dans un forEach(), on récupère le indexième élément de datas.
        const element = datas[index];

        // Dans le fichier horaire.css, il y a des effets de styles qui sont attribués à l'ID 'grayed'.
        // Un élément sera grisé uniquement si le nombre de places restantes pour les passagers et de 0.
        // Le résultat restera tout de même affiché pour montrer qu'il existe (au cas où il y aurait des annulations.)
        let grayed = '';
        if (element.places <= 0) {
            grayed = ' id="grayed"';
        }

        let admin_buttons = "";

        if (show_admin_buttons()) {
            admin_buttons = `<div class="icon_box flexbox bold clickable" id="edit_button">
                                    Modifier
                                </div>
                                <div class="icon_box hide bold clickable" id="validate">
                                    <img src="../public/check-mark.png" class="icon">
                                </div>
                                <div class="icon_box hide bold clickable" id="delete">
                                    <img src="../public/trash.png" class="icon">
                                </div>`
        }

        // Ajout du indexième résultat.
        page.innerHTML += `<div style="display:flex;flex-flow:row">
                                <div class="col-12 traversees result clickable"${grayed}>
                                    <p class="in_liaison c1">${element.id}</p>
                                    <p class="in_liaison c2">${element.date}</p>
                                    <p class="in_liaison c3">${element.time}</p>
                                    <p class="in_liaison c4">${element.boat}</p>
                                    <p class="in_liaison c5" id="${element.max_places}">${element.places}</p>
                                </div>
                                ${admin_buttons}
                            </div>`

        // Incrémentation de l'index.
        index++;
    }

    const edit_buttons = document.querySelectorAll('#edit_button');
    edit_buttons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            if (button.classList.contains('clickable')) {
                button.previousElementSibling.classList.remove('clickable');
                edit_buttons.forEach(element => {
                    element.classList.remove('clickable');
                });
                button.classList.replace('flexbox', 'hide')

                edit_links(button);

                const check = button.nextElementSibling;
                const trash = button.nextElementSibling.nextElementSibling;
                
                check.classList.replace('hide', 'flexbox');
                trash.classList.replace('hide', 'flexbox');

                check.addEventListener('click', (event) => {
                    event.preventDefault();

                    const current_id = {
                        id: button.previousElementSibling.querySelector('.c1').innerHTML,
                        date: button.previousElementSibling.querySelector('.c2').value,
                        time: button.previousElementSibling.querySelector('.c3').value,
                        boat: button.previousElementSibling.querySelector('.c4').value,
                        places: button.previousElementSibling.querySelector('.c5').value
                    }

                    console.log(current_id)
                    fetch('validate_horaire_modification.php', {
                        method: 'POST',
                        headers: {
                            'Content-type': 'text/plain'
                        },
                        body: JSON.stringify(current_id)
                    })
                    .then(update_response => {
                        if (!update_response.ok) {
                            console.error('Problème de mise à jour')
                        } else {
                            return update_response.text();
                        }
                    })
                    .then(printer => {
                        console.log(printer)
                    })
                    .catch(error => {
                        console.error(error);
                    })
                    preventScroll = true;
                    return retrieve_link(local_form, local_page);
                })

                trash.addEventListener('click', (event) => {
                    event.preventDefault();

                    const id = button.previousElementSibling.querySelector('.c1').innerHTML;

                    fetch('delete_horaire.php', {
                        method: 'POST',
                        headers: {
                            'Content-type': 'text/plain'
                        },
                        body: id
                    })
                    .then(response => {
                        if (!response.ok) {
                            console.error('Problème de suppression');
                        } else {
                            return response.text();
                        }
                    })
                    .then(delete_response => {
                        console.log(delete_response )
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    // preventScroll = true;
                    return retrieve_link(local_form, local_page);
                })
            }
        })
    })

    // Récupération des boutons permettant de naviguer à travers les pages de résultats.
    const next = document.querySelector('.next_btn');
    const prev = document.querySelector('.prev_btn');

    // Ajout d'un eventListener au click sur le bouton 'next' afin de pouvoir accéder au jeu de résultats suivant.
    next.addEventListener('click', (event) => {
        // Pour empêcher un éventuel rechargement de page.
        event.preventDefault();

        // On s'assure que l'on puisse continuer à récupérer de nouveaux résultats.
        if (min + 4 < datas.length) {
            // Réajustement des repères pour correspondre au bon set de résultats.
            min += 4;
            max += 4;

            // Réajustement des repères pour correspondre au bon set de résultats.
            return write_results(code, departure, arrival, page, datas);
        }
    });

    // Ajout d'un eventListener au click sur le bouton 'prev' afin de pouvoir accéder au jeu de résultats suivant.
    prev.addEventListener('click', (event) => {
        // Pour empêcher un éventuel rechargement de page.
        event.preventDefault();
        if (min - 4 >= 0) {
            // Réajustement des repères pour correspondre au bon set de résultats.
            min -= 4;
            max -= 4;

            // Réajustement des repères pour correspondre au bon set de résultats.
            return write_results(code, departure, arrival, page, datas);
        }
    })

    // Récupération des résultats pour les rendre clickables.
    const results = document.querySelectorAll('.result');

    // Création d'un forEach pour rendre chacun des résultats clickables.
    results.forEach(element => {
        element.addEventListener('click', () => {
            if (element.classList.contains('clickable')) {
                // Mise en stockage de différentes valeurs qui vont être utilisées dans la page 'reservation.html.php'
                localStorage.setItem('code_liaison', code);
                localStorage.setItem('departure', departure);
                localStorage.setItem('destination', arrival);
                const cruise = {
                    id: element.querySelector('.c1').innerHTML,
                    date: element.querySelector('.c2').innerHTML,
                    time: element.querySelector('.c3').innerHTML,
                    boat: element.querySelector('.c4').innerHTML,
                }

                // Ici, comme on a un objet JSON, on le transforme d'abord en chaine de caractère pour éviter les soucis.
                localStorage.setItem('cruise', JSON.stringify(cruise));

                // Redirection vers la page 'reservation.html.php'
                window.location.href = "reservation.html.php";
            }
        })
    })
}

// Fonction permettant de passer de la page du formulaire à la page des résultats.
export function scroll() {
    if (!preventScroll) {
        // Vérification de si l'on est dans la page de résultats.
        if (curr_id === 0) {
            // Si on passe à la page de formulaire, alors on cache le bouton de scroll.
            Elderscroll_button.classList.add('hide');

            // La page de résultats devient alors cachée.
            pagess[1].classList.remove('active');
            pagess[1].classList.add('bottom');

            // Et la page de formulaire est affichée.
            pagess[0].classList.add('active');
            pagess[0].classList.remove('top');
        } else {
            // Si on passe à la page des résultats, alors on montre le bouton de scroll.
            Elderscroll_button.classList.remove('hide');

            // La page de formulaire devient alors cachée.
            pagess[0].classList.remove('active');
            pagess[0].classList.add('top');

            // Et la page de résultats est affichée.
            pagess[1].classList.add('active');
            pagess[1].classList.remove('bottom');
        }

        // Finalement, on    l'id de page qui est affichée.
        curr_id = (curr_id + 1) % 2;
    } else {
        preventScroll = false;
    }
}