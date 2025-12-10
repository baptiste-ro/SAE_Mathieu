// Instanciation de la variable contenant la popup permettant l'ajout d'une horaire de traversée
const popup = document.querySelector('.background_popup');

// Instanciation de la variable contenant l'input pour la date de la nouvelle horaire
const popup_date = document.querySelector('.background_popup').querySelector('#date');

// Instanciation de la variable contenant l'input pour l'heure de la nouvelle horaire
const popup_time = document.querySelector('.background_popup').querySelector('#time');

// Instanciation et export de variables contenant la date et l'heure sous forme de chaine de caractère dans un format personnalisé
// Date au format 'yyyy-mm-dd'
export const date_string = new Date().toISOString().split("T")[0];
// Heure au format 'hh:mm'
export const time_string = new Date().toLocaleString().split(" ")[1].substring('0', new Date().toLocaleString().split(" ")[1].length-3)

// Instanciation de la variable contenant le bouton d'annulation de l'ajout de l'horaire
const cancel_add = document.querySelector('#cancel')

// Instanciation de la variable contenant le bouton de validation de l'ajout de l'horaire
const validate_add = document.querySelector('#validate_add');

// Fonction permettant la modification des horaires déjà présentes
// L'identifiant des traversées ne sont pas modifiables
// @param { HTMLElement } button - Bouton "modifier" précédemment cliqué
export function edit_links(button) {
    // Instanciation de la variable qui contient le div où se trouve les données à modifier
    const content_to_edit = button.previousElementSibling;

    // Instanciation d'un tableau contenant les champs de la traversée à modifier
    const fields = [
        // Champ de la date de départ
        content_to_edit.querySelector('.c2'),

        // Champ de l'heure de départ
        content_to_edit.querySelector('.c3'),

        // Champ du nom du bateau
        content_to_edit.querySelector('.c4'),

        // Champ du nombre de places restantes
        content_to_edit.querySelector('.c5')
    ];

    // Instanciation d'un tableau contenant les valeurs pré-modifications de la traversée à modifier.
    const values = [
        // Champ de la date de départ
        fields[0].innerHTML,
        
        // Champ de l'heure de départ
        fields[1].innerHTML,
        
        // Champ du nom du bateau
        fields[2].innerHTML,
        
        // Champ du nombre de places restantes
        fields[3].innerHTML
    ]

    // Instanciation d'une variable de type date
    const today = new Date();

    // ForEach permettant de transformer chaque champs, en inputs, tout en gardant leur valeur originale, au cas où aucune modification n'est apportée
    fields.forEach(field => {
        // Instanciation d'une variable contenant un élément créé de type <input>
        const new_field = document.createElement('input');

        // Ajout des classes de l'ancien élément, à l'élément précédemment créé.
        field.classList.forEach(elt => {
            new_field.classList.add(elt);
        })

        // Ajout d'un ID au nouvel élément
        new_field.id = 'edit_inputs';

        // Multiple vérifications afin d'ajouter certains paramètres au nouvel élément, en fonction de quel champ il remplace
        // Cas du champ de la date
        if (field.classList.contains('c2')) {
            // Paramétrage de l'input en type date
            new_field.type = 'date';

            // Conservation de la valeur originale
            new_field.defaultValue = field.innerHTML;

            // Ajout d'une date minimale afin d'empêcher un ajout de date déjà passée
            new_field.min = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

        // Cas du champ de l'heure
        } else if (field.classList.contains('c3')) {
            // Paramétrage de l'input en type time
            new_field.type = 'time';

            // Conservation de la valeur originale
            new_field.defaultValue = field.innerHTML;

        // Cas du champ du nom de bateau
        } else if (field.classList.contains('c4')) {
            // Conservation de la valeur originale
            new_field.defaultValue = field.innerHTML;

        // Cas du champ du nombre de places restantes
        } else if (field.classList.contains('c5')) {
            // Paramétrage de l'input en type nombre
            new_field.type = 'number';

            // Conservation de la valeur originale
            new_field.defaultValue = field.innerHTML;

            // Ajout d'un minimum à 0 pour empêcher les valeurs négatives
            new_field.min = 0;

            // Ajout d'un maximum pour empêcher les valeurs trop grandes (la valeur maximale était stockée dans l'ID du champ)
            new_field.max = field.id;

            // Création d'un eventListener sur l'écriture de ka valeur
            new_field.addEventListener('input', () => {
                // Vérification de la valeur entrée
                if (new_field.value > new_field.max) {
                    // Si la valeur entrée est supérieur au maximum, la valeur est mise au maximum
                    new_field.value = new_field.max;

                } else if (new_field.value < 0) {
                    // Si la valeur est négative, remise à 0
                    new_field.value = 0;
                }
            })
        }

        // Remplacement de l'ancien élément par le nouvel élément créé
        field.parentNode.replaceChild(new_field, field);
    })
}

// Fonction permettant d'ajouter d'ajouter aux éléments <select> les options qu'il convient.
export function add_schedule_form() {
    // Instanciation de variables contenant les éléments <select> de la popup pour ajouter une horaire
    // Champ du nom du bateau
    const boat = document.querySelector('#boat');

    // Champ de la liaison
    const link = document.querySelector('#link');

    // Champ des tarifs (les tarifs ne peuvent pas être aisément affichable, donc on n'écrit que leur ID)
    const price = document.querySelector('#price');

    // Appel en AJAX de ajout_horaire/bateau.php
    fetch('ajout_horaire/bateau.php')
    .then(answer => {
        // Vérification de l'état de la réponse
        if (answer.ok) {
            // Si l'état est valide, renvoie de la réponse sous format JSON
            return answer.json();
        } else {
            // Sinon renvoie une erreur
            console.error('Problème de bateau');
        }
    })
    .then(data => {
        // Vide le contenu du select pour le nom du bateau
        boat.innerHTML = "";

        // Ajout des options pour le champ du nom du bateau
        data.forEach(elt => {
            boat.innerHTML += `<option value="${elt.id}">${elt.id} - ${elt.name}</option>`
        })
    })

    // Appel en AJAX de ajout_horaire/liaison.php
    fetch('ajout_horaire/liaison.php')
    .then(answer => {
        // Vérification de l'état de la réponse
        if (answer.ok) {
            // Si l'état est valide, renvoie de la réponse sous format JSON
            return answer.json();
        } else {
            // Sinon renvoie une erreur
            console.error('Problème de liaison');
        }
    })
    .then(data => {
        // Vide le contenu du select pour la liaison
        link.innerHTML = "";

        // Ajout des options pour le champ de la liaison
        data.forEach(elt => {
            link.innerHTML += `<option value="${elt.code}">${elt.departure} - ${elt.arrival}</option>`
        })
    })

    // Appel en AJAX de ajout_horaire/tarifs.php
    fetch('ajout_horaire/tarifs.php')
    .then(answer => {
        // Vérification de l'état de la réponse
        if (answer.ok) {
            // Si l'état est valide, renvoie de la réponse sous format JSON
            return answer.json();
        } else {
            // Sinon renvoie une erreur
            console.error('Problème de tarif');
        }
    })
    .then(data => {
        // Vide le contenu du select pour le tarif
        price.innerHTML = "";

        // Ajout des options pour le champ du tarif
        data.forEach(elt => {
            price.innerHTML += `<option value="${elt.id}">${elt.id}</option>`
        })
    })
}


// Fonction permettant d'ajouter à la base de données la nouvelle traversée
export function add_schedule() {
    // Instanciation d'une variable contenant le formulaire dans la popup d'ajout des horaires
    const form = document.querySelector('#add_form');

    // Récupération des valeurs entrée par l'admin
    const date = form.querySelector('#date').value;
    const time = form.querySelector('#time').value;
    const boat = form.querySelector('#boat').value;
    const link = form.querySelector('#link').value;
    const price = form.querySelector('#price').value;

    // Création d'un objet JSON pour l'envoyer au fichier php
    const form_content = {
        date: date,
        time: time,
        boat: boat,
        link: link,
        price: price
    }

    // Appel en AJAX du fichier "ajout_horaire/ajout_horaire.php"
    fetch('ajout_horaire/ajout_horaire.php', {
        method: 'POST',
        headers: {
            'Content-type': 'text/plain'
        },
        body: JSON.stringify(form_content)
    })
    .then(answer => {
        // Vérification de l'état de la réponse
        if (!answer.ok) {
            // Si l'état n'est pas valide, renvoie une erreur
            console.error('Problème d\'ajout de traversee');
        }
    })
}

// Paramétrage de la valeur minimale et par défaut de l'input de type 'date' à la date d'aujourd'hui
popup_date.min = date_string;
popup_date.defaultValue = date_string;

// Paramétrage de la valeur minimale et par défaut de l'input de type 'time' à l'heure actuelle
popup_time.defaultValue = time_string;
popup_time.min = time_string;

// Création d'un eventListener sur l'input de type date pour éviter que l'on sélectionne une heure déjà passée
// L'eventListener se déclenche au quelconque changement de l'input
popup_time.addEventListener('input', () => {
    // Vérification de si la date sélectionnée est celle d'aujourd'hui, et que la date est inférieure à celle actuelle
    if (popup_date.value == date_string && popup_time.value < time_string) {
        // Si c'est le cas, alors on ajoute une classe qui permet de faire sortir du select
        popup_time.classList.add('invalide');

        // Ajout d'un message d'erreur de non-validité personnalisé
        popup_time.setCustomValidity("Veuillez sélectionner une horaire qui n'est pas déjà dépassée.")

        // Affichage du message d'erreur
        popup_time.reportValidity();

        // Remise à la valeur par défaut
        popup_time.value = time_string;

        // Mise à jour de la valeur minimum à l'heure actuelle
        popup_time.min = time_string;

        // Retrait de la classe faisant sortir du select
        popup_time.classList.remove('invalide');
    } else if (popup_date.value == date_string) {
        // Si jamais l'heure est valide, mais la date est celle d'aujourd'hui, met en valeur minimum l'heure actuelle
        popup_time.min = time_string;
    } else {
        // Sinon, mise en valeur minimale "00:00"
        popup_time.min = "00:00";
    }
})

// Création d'un eventListener au click sur le bouton d'annulation pour annuler l'ajout et enlever la popup
cancel_add.addEventListener('click', (event) => {
    event.preventDefault();
    // Cache la popup
    popup.classList.add('hidden');
})

// Création d'un eventListener au click sur le bouton de validation pour ajouter l'horaire et enlever la popup
validate_add.addEventListener('click', (event) => {
    event.preventDefault();

    // Appel de la fonction permettant l'ajout de l'horaire
    add_schedule();

    // Cache la popup
    popup.classList.add('hidden');
})

// Création d'un eventListener sur l'arrière plan de la popup au click, permettant d'enlever la popup si on clique dessus
popup.addEventListener('click', (event) => {
    // Vérification de si le clique se trouve directement sur l'arrière plan
    if (event.target === event.currentTarget) {
        event.preventDefault();

        // Cache la popup
        popup.classList.add('hidden');
    }
})