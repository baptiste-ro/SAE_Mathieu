const title = document.querySelector(".website-name")

const input = document.querySelector(".search-bar")

document.addEventListener('DOMContentLoaded', () => {
    setHeaders();
})

function setHeaders() {
    fetch('/sae/index/header')
    .then(response => {
        // Vérification du bon fonctionnement du fetch, avec une vérification de la réponse.
        if (response.ok) {
            return response.json();
        } else {
            // Si ça ne passe pas, en renvoie une erreur.
            console.error('Fetch problem occured')
        }
    })
    .then(result => {
        console.log(result)
        title.innerHTML = result.title;
    })
    .catch(error => {
        console.error("Oskour");
        console.log(error)
    })
}

input.addEventListener("input", (event) => {
    event.preventDefault();
    title.innerHTML = input.value;
})