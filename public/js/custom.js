function bookmark(item) {
    if (item.className === "fa-thin fa-bookmark articles-bookmark") {
        item.className = "fa fa-bookmark articles-bookmark";
    } else {
        item.className = "fa-thin fa-bookmark articles-bookmark";
    }
}

function heart(item) {
    if (item.className === "fa-thin fa-heart articles-bookmark") {
        item.className = "fa fa-heart articles-bookmark";

    } else {
        item.className = "fa-thin fa-heart articles-bookmark";

    }
}
