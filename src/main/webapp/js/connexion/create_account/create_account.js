const username_field = document.querySelector("#username");
const email_field = document.querySelector("#email");
const pwd_field = document.querySelector("#password");
const confirm_pwd_field = document.querySelector("#confirm_pwd");

const validate_button = document.querySelector('#validate');

validate_button.addEventListener('click', (event) => {
    event.preventDefault();
    if (pwd_field.value == confirm_pwd_field.value) {

        const form_body = {
                username: username_field.value,
                password: pwd_field.value,
                email: email_field.value,
                admin: true
            }
            
        fetch('connexion/account_management/creation', {
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