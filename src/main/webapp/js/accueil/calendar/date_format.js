function date_format(date) {
    const date_split = date.split(" ");
    let month = "";
    switch (date_split[2]) {
        case "Janvier":
            month = "01";
            break;
        case "Fevrier":
            month = "02";
            break;
        case "Mars":
            month = "03";
            break;
        case "Avril":
            month = "04";
            break;
        case "Mai": 
            month = "05";
            break;
        case "Juin":
            month = "06";
            break;
        case "Juillet":
            month = "07";
            break;
        case "Aout": 
            month = "08";
            break;
        case "Septembre":
            month = "09";
            break;
        case "Octobre":
            month = "10";
            break;
        case "Novembre":
            month = "11";
            break;
        case "Decembre":
            month = "12";
            break;
    }
    return `${date_split[3]}-${month}-${date_split[1]}`
}

export default date_format;