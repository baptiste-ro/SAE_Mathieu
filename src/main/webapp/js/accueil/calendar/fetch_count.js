import set_background from "./set_background.js";

function fetch_count(year, month) {
    fetch("/sae/appointment/get-appointment-count", {
        method: 'POST',
        headers: {
            'Content-Type': 'test/plain'
        },
        body: `${year}-${month+1}-01`
    })
    .then(answer => {
        if (answer.ok) {
            return answer.json();
        } else {
            console.error('erreur de chargement du nombre de réservations par jour.');
        }
    })
    .then(result => {
        console.log(result)
        set_background(year, month, result.list);
    })
}

export default fetch_count;