const popup = document.querySelector(".background_popup");
const profil_pic = document.querySelector('#file');
const cancel_button = document.querySelector("#cancel");

const preview_pfp = document.querySelector(".preview_pfp");
const pfp_form = document.querySelector("#pfp_form");
const profil_pic_elt = document.querySelector("#profil_pic");

cancel_button.addEventListener('click', (event) => {
    event.preventDefault();
    popup.classList.add('hidden');
});

profil_pic.addEventListener('change', (event) => {
    event.preventDefault();
    popup.classList.remove('hidden');
    console.log(event.target.files);
    preview_pfp.src = URL.createObjectURL(event.target.files[0]);
    const clone = profil_pic.cloneNode();
    pfp_form.appendChild(clone);
});

document.addEventListener('DOMContentLoaded', function() {
    fetch("/sae/profil/get-profil-picture")
    .then(answer => {
        if (answer.ok) {
            return answer.text();
        } else {
            console.log("An error happened during the loading of the profil picture.");
        }
    })
    .then(result => {
        console.log(result);
        profil_pic_elt.src = `img/uploads/${result}`;
    })
})