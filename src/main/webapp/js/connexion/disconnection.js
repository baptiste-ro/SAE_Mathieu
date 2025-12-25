const disconnect_button = document.querySelector('#disconnect')

disconnect_button.addEventListener('click', (event) => {
    event.preventDefault();
    fetch('/sae/connection/disconnect')
    .then(answer => {
        if (answer.ok) {
            return answer.text();
        } else {
            console.error("A problem occured while trying to disconnect.")
            console.log(answer.text);
        }
    })
    .then(result => {
        window.location.href = result;
    })
})