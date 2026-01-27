function get_count(elt, res) {
    for (const e of res) {
        if (are_same_dates(elt, e.date)) {            
            return e.count;
        }
    }
    return 0;
}

export default get_count;

function are_same_dates(d1,d2) {
    const split1 = d1.split("-");
    const split2 = d2.split("-");
    return split1[0] == split2[0] && split1[2] == split2[2] && (split1[1].length == 1 ? "0" + split1[1] : split1[1]) == (split2[1].length == 1 ? "0" + split2[1] : split2[1])
}