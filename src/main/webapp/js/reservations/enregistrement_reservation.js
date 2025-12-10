// Instanciation de la variable qui contient le bouton permettant d'affiche la popup de demande de confirmation de la réservation
const show_popup = document.querySelector('#show_popup');

// Instanciation de la valeur correspondant à la première popup (celle de demande de confirmation de la réservation)
const popup = document.querySelector('.background_popup');

// Instanciation des variables correspondant aux case où seront affichés le nombre de la catégorie en question, dans la popup de demande de confirmation
// Catégorie Adulte
const adults = document.querySelector('#adults');
// Catégorie Junior
const juniors = document.querySelector('#juniors');
// Catégorie Enfant
const kids = document.querySelector('#kids');

// Catégorie Voiture de moins de 4m
const short_cars = document.querySelector('#short_cars');
// Catégorie Voiture de moins de 5m
const long_cars = document.querySelector('#long_cars');

// Catégorie Fourgon
const vans = document.querySelector('#vans');
// Catégorie Camping-Car
const motorhomes = document.querySelector('#motorhomes');
// Catégorie Camion
const trucks = document.querySelector('#trucks');

// Instanciation de la variable qui contient la popup qui confirme que la réservation est bien passée
const book_successful_popup = document.querySelector('.background_popup_2')

// Instanciation de la variable qui contient le bouton permettant de confirmer la réservation 
const book_button = document.querySelector('#book_button');
// Instanciation de la variable qui contient le bouton permettant de revenir en arrière, au lieu de confirmer la commande.
const return_button = document.querySelector('#return');

// Instanciation des variables contenant les inputs des différentes catégories
// Catégorie Adulte
const adults_input = document.querySelector('#nb_of_adults');
// Catégorie Junior
const juniors_input = document.querySelector('#nb_of_juniors');
// Catégorie Enfant
const kids_input = document.querySelector('#nb_of_kids');

// Catégorie Voiture de moins de 4m
const short_cars_input = document.querySelector('#nb_of_short_cars');
// Catégorie Voiture de moins de 5m
const long_cars_input = document.querySelector('#nb_of_long_cars');

// Catégorie Fourgon
const vans_input = document.querySelector('#nb_of_vans');
// Catégorie Camping-Car
const motorhomes_input = document.querySelector('#nb_of_motorhomes');
// Catégorie Camion
const trucks_input = document.querySelector('#nb_of_trucks');

// Instanciation de la variable contenant le total affiché sur la page
const total = document.querySelector('.total');

// Instanciation de la variable contenant le total affiché sur la popup de demande de confirmation
const total_2 = document.querySelector('.total_2');

// Instanciation des variables contenant les éléments où sont affichés le maximum de chaque grande catégorie.
// Catégorie A
const max_A = document.querySelector('#max_A');
// Catégorie B
const max_B = document.querySelector('#max_B');
// Catégorie C
const max_C = document.querySelector('#max_C');

// Instanciation de la variable qui contient l'élément ou est affiché l'ID de la traversée actuelle.
const id = document.querySelector('#id');

// Création d'un eventListener au click afin de permettre l'affichage de la popup de demande de confirmation
show_popup.addEventListener('click', (event) => {
    // Au cas où, pour éviter que le bouton n'empêche le bon fonctionnement du code
    event.preventDefault();
    
    // Vérification qu'il y ai bien au moins un passager de la catégorie A
    if (!(adults_input.value + juniors_input.value + kids_input.value > 0)) {
        // S'il n'y en a pas, alors la page bloque la validation et affiche une réservation.
        w.alert('La réservation doit contenir au moins 1 passager.');
    } else {
        // Si les conditions son respectées :
        // Affichage de la popup
        popup.classList.remove('hidden');

        // Ajout du nombre de places ajoutées par l'utilisateur dans les différentes catégories, dans la popup de confirmation
        // Catégorie Adulte
        adults.innerHTML = adults_input.value;
        // Catégorie Junior
        juniors.innerHTML = juniors_input.value;
        // Catégorie Enfant
        kids.innerHTML = kids_input.value;

        // Catégorie Voiture de moins de 4m
        short_cars.innerHTML = short_cars_input.value;
        // Catégorie Voiture de moins de 5m
        long_cars.innerHTML = long_cars_input.value;
        
        // Catégorie Fourgon
        vans.innerHTML = vans_input.value;
        // Catégorie Camping-Car
        motorhomes.innerHTML = motorhomes_input.value;
        // Catégorie Camion
        trucks.innerHTML = trucks_input.value;

        // Ajout du prix total
        total_2.innerHTML = total.innerHTML;
    }
})

// Création d'un EventListener sur le bouton de retour sur la première popup
return_button.addEventListener('click', (event) => {
    event.preventDefault();
    // Cache la popup
    popup.classList.add('hidden');
})

// Création d'un eventListener sur le bouton de validation de la première popup, afin de permettre l'ajout de la réservation
book_button.addEventListener('click', (event) => {
    event.preventDefault();

    // Série de vérification afin de s'assurer que la réservation est possible
    if (adults_input.value + juniors_input.value + kids_input.value > parseInt(max_A.innerHTML)) {
        // Envoie une alerte si la limite des passagers de Catégorie A est dépassée
        window.alert('La limite de passagers (Catégorie A) est dépassée !');
        
    } else if (short_cars_input.value + long_cars_input.value > parseInt(max_B.innerHTML)) {
        // Envoie une alerte si la limite des passagers de Catégorie B est dépassée
        window.alert('La limite de véhicules bas (Catégorie B) est dépassée !');

    } else if (vans_input.value + motorhomes_input.value + trucks_input.value > parseInt(max_C.innerHTML)) {
        // Envoie une alerte si la limite des passagers de Catégorie C est dépassée
        window.alert('La limite de véhicules hauts (Catégorie C) est dépassée !');

    } else {
        // Préparation du contenu à envoyer pour ajouter la réservation
        const content_sent = {
            id: parseInt(id.innerHTML),
            adults: parseInt(adults_input.value) || 0,
            juniors: parseInt(juniors_input.value) || 0,
            kids: parseInt(kids_input.value) || 0,
            short_cars: parseInt(short_cars_input.value) || 0,
            long_cars: parseInt(long_cars_input.value) || 0,
            vans: parseInt(vans_input.value) || 0,
            motorhomes: parseInt(motorhomes_input.value) || 0,
            trucks: parseInt(trucks_input.value) || 0
        }

        // Appel en AJAX du fichier ajout_reservation/ajout_reservation.php
        fetch('ajout_reservation.php', {
            method: 'POST',
            headers: {
                'Content-type': 'text/plain'
            },
            body: JSON.stringify(content_sent)
        })
        .then(answer => {
            // Vérification de l'état de l'appel
            if (answer.ok) {
                // Si l'était est valide, renvoie le résultat sous forme de texte
                return answer.text();
            } else {
                // Sinon renvoie une erreur
                console.error('Erreur de fetch');
            }
        })
        .then(data => {
            // Affiche la popup de confirmation de la réservation
            book_successful_popup.classList.remove('hidden');

            // Création d'un eventListener pour rediriger automatiquement vers la page 'Horaires'
            document.querySelector('#back_to_horaires').addEventListener('click', (event) => {
                event.preventDefault();
                window.location.replace("./horaire.html.php");
            })
        })
    }
})
