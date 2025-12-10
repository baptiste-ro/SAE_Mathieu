// Fonction permettant d'afficher l'entête des résultats de la page 'horaire.html.php'
// @param {int} code - code de la liaison prise en compte
// @param {string} departure - nom du port de départ
// @param {string} arrival - nom du port d'arrivée
// @param {int} min - numéro de la page de résultats à afficher
// @param {int} max - nombre de page totale de résultats
// @return {string} - une chaine de caractère correspondant à l'entête qu'il faudra implémenter
export function header(code, departure, arrival, min , max) {
    return `<h1 class="text-white title">Liaison trouvée</h1>
                    <div class="col-12 liaison">
                        <p class="in_liaison">Liaison n° : ${code}</p>
                        <p class="in_liaison">Port de départ : ${departure}</p>
                        <p class="in_liaison">Port d'arrivée : ${arrival}</p>
                    </div>
                    <br>
                    <div class="col-12 div_button">
                        <h1 class="text-white title">Résultats de la recherche</h1>
                    </div>
                    <div class="col-12 div_button">
                        <p class="in_liaison prev_btn" id="next"><</p>
                        <p class="in_liaison next_btn" id="next">></p>
                        <p class="in_liaison"> ${min} - ${max} </p>
                    </div>
                    <div style="display:flex;flex-flow:row">
                        <div class="col-12 traversees bold">
                            <p class="in_liaison c1">ID Traversée</p>
                            <p class="in_liaison c2">Date de départ</p>
                            <p class="in_liaison c3">Heure de départ</p>
                            <p class="in_liaison c4">Bateau</p>
                            <p class="in_liaison c5">Places Restantes</p>
                        </div>
                    </div>
                    <br>`
}