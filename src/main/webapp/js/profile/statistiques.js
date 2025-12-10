// Instanciation d'une variable contenant le select permettant la sélection d'une période
const periode = document.querySelector('#selectPeriode');

// Création d'une variable qui contiendra une chaine de caractère correspondant à la période sélectionnée
let currPeriod;

// Instanciation de variables contenant les différentes cases des statistiques
// Case de la période
const divPeriode = document.querySelector("#periode");
// Case du chiffre d'affaire
const CA = document.querySelector("#CA");
// Case du total de places
const Total = document.querySelector("#Total");
// Case du total de places en catégorie A
const CatA = document.querySelector("#CatA");
// Case du total de places en catégorie B
const CatB = document.querySelector("#CatB");
// Case du total de places en catégorie C
const CatC = document.querySelector("#CatC");

// Ajout d'un eventListener au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    // Appel en AJAX du fichier "Stats/stats/php"
    fetch('Stats/stats.php')
    .then(response => {
        // Vérification de l'état de la réponse
        if (response.ok) {
            // Si l'état est valide, renvoie la réponse au format JSON
            return response.json();
        } else {
            // Sinon, renvoie une erreur
            console.error('Problème de fetch.')
        }
    })
    .then(data => {
        // Instanciation de la variable currPeriod, avec la chaine de caractère qui correspond à la première période dans le select
        currPeriod = `${data[0].start}   -   ${data[0].end}`;

        // Effacement du contenu des cases du tableau des valeurs de l'analyse statistique
        periode.innerHTML = "";

        // Ajout des options du select contenant les périodes
        data.forEach(elt => {
            periode.innerHTML += `<option value="${elt.id}">${elt.start} &nbsp;&nbsp;-&nbsp;&nbsp; ${elt.end}</option>`;
        });

        // Sélection de la première option du select
        periode.querySelector('option').selected = true;

        // Appel de la fonction permettant de mettre à jour les statistiques
        getStats(data[0].id);
    })

    // Création d'un eventListener au changement de valeur
    periode.addEventListener('change', (event) => {
        event.preventDefault();

        // Modification de la variable contenant le format String de la période sélectionnée
        currPeriod = periode.options[periode.selectedIndex].text;

        // Appel de la fonction permettant de mettre à jour les statistiques
        getStats(periode.value);
    })
})

// Fonction permettant la mise à jour des statistiques
// @param { int } value - Valeur de l'ID de la période courante
function getStats(value) {
    // Appel en AJAX du fichier Stats/getStats.php
    fetch('Stats/getStats.php', {
        method: 'POST',
        headers: {
            'Content-type': 'text/plain'
        },
        body: value
    })
    .then(response => {
        // Vérification de l'état de la réponse
        if (response.ok) {
            // Si la réponse est valide, retourne la réponse au format JSON
            return response.json();
        } else {
            // Sinon, renvoie une erreur
            console.error('Problème de récupération des stats.')
        }
    })
    .then(data => {
        // Création de variables qui contiendront les valeurs à afficher dans le tableau
        let total;
        let totCatA = 0;
        let totCatB = 0;
        let totCatC = 0;
        // Ici, on ajoute une valeur inexistante pour éviter d'avoir une nullPointerException
        const ids = [-1];
        
        // Ajout des IDs dans le tableau, et ajout des totaux dans chaque catégorie.
        data.forEach(elt => {
            // Ajout de l'ID de l'élément courant
            ids.push(elt.id)
            // Ajout du total de la catégorie A de l'élément courant
            totCatA += elt.CatA;
            // Ajout du total de la catégorie B de l'élément courant
            totCatB += elt.CatB;
            // Ajout du total de la catégorie C de l'élément courant
            totCatC += elt.CatC;
        })

        // Instanciation du total de places sur toutes les catégories regroupées
        total = totCatA + totCatB + totCatC;

        // Appel en AJAX du fichier "Stats/getRevenue.php" (nécessaire pour récupérer le chiffre d'affaire)
        fetch('Stats/getRevenue.php', {
            method: 'POST',
            headers: {
                'Content-type': 'text/plain'
            },
            // Envoie de la liste des IDs de traversée
            body: ids.toString()
        })
        .then(response2 => {
            // Vérification de l'état de la réponse
            if (response2.ok) {
                // Si l'état est valide, retourne la réponse au format String
                return response2.text();
            } else {
                // Sinon renvoie une erreur
                console.error('Problème de récupération du CA.')
            }
        })
        .then(revenue => {
            // Mets à jour les champs du tableau avec les bonnes valeurs
            divPeriode.innerHTML = currPeriod;
            CA.innerHTML = revenue + " €";
            Total.innerHTML = total;
            CatA.innerHTML = totCatA;
            CatB.innerHTML = totCatB;
            CatC.innerHTML = totCatC;
        })
        
    })
}