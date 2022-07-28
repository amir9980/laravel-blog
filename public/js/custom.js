function bookmark(item) {
    if (item.className === "  fa-thin fa-bookmark articles-bookmark ") {
        item.className = "  fa fa-bookmark articles-bookmark ";
        apply(item.id, 'bookmark', `post`)
    } else {
        item.className = "  fa-thin fa-bookmark articles-bookmark ";
        apply(item.id, 'bookmark', `delete`)

    }
}

function heart(item) {
    if (item.className === "  fa-thin fa-heart articles-bookmark ") {
        item.className = "  fa fa-heart articles-bookmark ";
        apply(item.id, 'like', `post`)

    } else {
        item.className = "  fa-thin fa-heart articles-bookmark ";
        apply(item.id, 'like', `delete`)

    }
}
