function get_count(elt, res) {
    for (const e of res) {
        if (elt == e.date) {
            return e.count;
        }
    }
    return 0;
}

export default get_count;