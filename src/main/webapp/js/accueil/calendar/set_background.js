import get_count from "./get_count.js";

function set_background(year, month, list) {
    const dates = document.querySelectorAll(".calendar-date");
    dates.forEach(elt => {
        const count = get_count(`${year}-${month + 1}-${elt.dataset.date}`, list);
        if(count < 4) {
            elt.classList.remove("white__", "orange__", "orange_red__", "red__", "dark_red__", "black__");
            elt.classList.add("white__");
        } else if (count < 9) {
            elt.classList.remove("white__", "orange__", "orange_red__", "red__", "dark_red__", "black__");
            elt.classList.add("orange__");
        } else if (count < 14) {
            elt.classList.remove("white__", "orange__", "orange_red__", "red__", "dark_red__", "black__");
            elt.classList.add("orange_red__");
        } else if (count < 23) {
            elt.classList.remove("white__", "orange__", "orange_red__", "red__", "dark_red__", "black__");
            elt.classList.add("red__");
        } else if (count < 26) {
            elt.classList.remove("white__", "orange__", "orange_red__", "red__", "dark_red__", "black__");
            elt.classList.add("dark_red__");
        } else {
            elt.classList.remove("white__", "orange__", "orange_red__", "red__", "dark_red__", "black__");
            elt.classList.add("black__")
        }
    })
}

export default set_background;