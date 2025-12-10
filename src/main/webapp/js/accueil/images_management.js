const background_image = document.querySelector(".background");
const description_image = document.querySelector(".description");

document.addEventListener('DOMContentLoaded', () => {
    retrieve_images();
})

function retrieve_images() {
    fetch('/sae/index/images')
    .then(answer => {
        if (answer.ok) {
            return answer.json();
        } else {
            console.error("Oups\n" + answer.error);
        }
    })
    .then(data => {
        background_image.style = `background: linear-gradient(rgba(20, 20, 31, .7), rgba(20, 20, 31, .7)), url(img/index/${data.images.background});background-position: center center;background-repeat: no-repeat;background-size: cover;`
        description_image.src = `img/index/${data.images.description}`;
    })
}