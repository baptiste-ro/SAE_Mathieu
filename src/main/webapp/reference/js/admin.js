// Initialisation d'une variable permettant de savoir si l'utilisateur est admin ou non
let is_admin = localStorage.getItem('admin');

// Fonction permettant de vérifier si l'utilisateur connecté est admin ou non
export async function set_admin() {
    // Vérifie d'abord si l'utilisateur n'a pas déjà été identifié comme étant admin
    if (is_admin != 't') {
        // Appel en AJAX vers le fichier php qui va permettre de récupérer les données nécessaires.
        fetch('admin.php')
        .then(response => {
            // Vérification de l'état de la réponse
            if (response.ok) {
                // Si l'état est bon, renvoie les données du fetch sous format String
                return response.text();
            } else {
                // Sinon renvoie une erreur
                console.error('First fetch error');
            }
        })
        .then(isAdmin => {
            // Met à jour le statut d'admin.
            is_admin = isAdmin;

            // Met également la valeur stockée en local à jour
            localStorage.setItem('admin', isAdmin);

            // Renvoie vers la page d'accueil
            window.location.replace('../index.php');
        })
    }
}

// Fonction permettant de déterminer si les boutons réservés à l'admin peuvent être montrés ou non.
// @return { boolean } - validation du statut de l'utilisateur
export function show_admin_buttons() {
    // Vérification de si l'utilisateur est admin
    if (is_admin === 't') {
        // Si oui, renvoie true
        return true;
    } else {
        // Si non, renvoie false
        return false;
    }
}

// Fonction permettant de montrer ou non la page des statistiques, en fonction de si 
// @param { String } repository - (facultatif) répertoire dans lequel se trouve la page stats. (Utilisé par index, qui se trouve dans un dossier parent)
export function show_stat_page(repository = "") {
    // Vérification de si l'utilisateur est admin
    if (is_admin === 't' && document.querySelector('#statsLink') == null) {
        // Si oui, alors l'onglet 'Statistiques' s'affiche
        document.querySelector('.navbar-nav').innerHTML += `<a href="${repository}statAdmin.php" class="nav-item nav-link" id="statsLink">Statistiques</a>`
    }
}