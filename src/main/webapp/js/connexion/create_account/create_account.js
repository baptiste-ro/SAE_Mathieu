const first_name_field = document.querySelector("#first_name");
const last_name_field = document.querySelector("#last_name");
const address_field = document.querySelector("#address");
const email_field = document.querySelector("#email");
const role_field = document.querySelector('input[name="role"]:checked');
const pwd_field = document.querySelector("#password");
const confirm_pwd_field = document.querySelector("#confirm_pwd");

document.addEventListener('DOMContentLoaded', () => {
    const li = [
        first_name_field,
        last_name_field,
        address_field,
        email_field,
        role_field,
        pwd_field,
        confirm_pwd_field
    ]

    li.forEach(elt => {
        elt.addEventListener('input', (event) => {
            checkForCharacters(event);
        });
    });
})

const validate_button = document.querySelector('#validate');

validate_button.addEventListener('click', (event) => {
    event.preventDefault();
    if (pwd_field.value == confirm_pwd_field.value) {

        const form_body = {
                firstName: first_name_field.value,
                lastName: last_name_field.value,
                password: pwd_field.value,
                address: address_field.value,
                email: email_field.value,
                role: role_field.value,
                admin: false,
                profilePicture: "default.png"
            }            
        fetch('connection/account_management/creation', {
            method: "POST",
            headers: {
            'Content-type': 'application/json'
            },
            body: JSON.stringify(form_body)
        })
        .then(response => {
            if (response.ok) {
                console.log('All is fine')
                window.location.href = "Connexion.jsp";
            } else {
                console.log(response.text());
            }
        })
    } else {
        window.alert("Bitch, same password is needed.")
    }
})

function correctCharacter(c) {
    if ("<>:\"/\\|*".indexOf(c) >= 0) {
        return false;
    } else {
        return true;
    }
}

function checkForCharacters (event) {
    event.preventDefault();
    if (correctCharacter(event.currentTarget.value[event.currentTarget.value.length-1])) {
        event.currentTarget.value = event.currentTarget.value;
    } else {
        event.currentTarget.value = event.currentTarget.value.substring(0, event.currentTarget.value.length-2);
    }
}
