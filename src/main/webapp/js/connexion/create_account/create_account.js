const first_name_field = document.querySelector("#first_name");
const last_name_field = document.querySelector("#last_name");
const address_field = document.querySelector("#address");
const email_field = document.querySelector("#email");
const role_field = document.querySelector('input[name="role"]:checked');
const pwd_field = document.querySelector("#password");
const confirm_pwd_field = document.querySelector("#confirm_pwd");

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

        console.log(form_body);
            
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