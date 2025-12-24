const firstName = document.querySelector("#first_name_field");
const lastName = document.querySelector("#last_name_field");
const address = document.querySelector("#address_field");
const old_password = document.querySelector("#old_password_field");
const new_password = document.querySelector("#new_password_field");
const confirm_password = document.querySelector("#confirm_password_field");
const email = document.querySelector("#email_field");
const validate = document.querySelector('.validate');

function verifierMdp() {
    // Si au moins un des champs de mot de passe est rempli
    if (new_password.value !== '' || confirm_password.value !== '') {
        // Vérifie si les deux champs sont identiques
        if (new_password.value !== confirm_password.value) {
            // Si ce n’est pas le cas, affiche une alerte à l’utilisateur
            alert("Les nouveaux mots de passe ne correspondent pas.");
        } else {
            const sender = {
                email: email.value,
                password: old_password.value
            }

            fetch("/sae/profil/verify-password", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(sender)
            })
            .then(answer => {
                if (answer.ok) {
                    return answer.text();
                } else {
                    console.error("A problem occured with the password verification.");
                }
            })
            .then(result => {
                console.log(result);
                const verif = (result == "true");

                if (verif) {
                    const sender2 = {
                        firstName: firstName.value,
                        lastName: lastName.value,
                        email: email.value,
                        address: address.value,
                        password: new_password.value
                    }

                    console.log(sender2);

                    fetch("/sae/profil/modify-information", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(sender)
                    })
                    .then(answer => {
                        if (answer.ok) {
                            return answer.json();
                        } else {
                            console.error("The process of modifying informations of the user.");
                        }
                    })
                    .then(result => {
                        console.log(result);
                    })
                }
            })
        }
    }
}

validate.addEventListener('click', (event) => {
    event.preventDefault();
    verifierMdp();
})