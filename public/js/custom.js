function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function apply(item, url, method) {
    var slug = item.id;
    var token = document.getElementById('_token').content;
    $.ajax({
        method: 'POST',
        url: '/articles/' + slug + '/' + url,
        dataType: 'json',
        data: {_token:token,_method:method},
        success: function (response) {
            var status = response.status;

        }, complete: function () {
            sleep(1500).then(() => {
                item.className = item.className.replace('loader', '')
                if (item.className.includes("fa-thin")) {
                    item.className = item.className.replace(' fa-thin', 'fa');
                } else {
                    item.className = item.className.replace(' fa', 'fa-thin')
                }
                item.setAttribute('onclick', url+'(this)');
            });

        }
    });
}

function bookmark(item) {
    item.removeAttribute('onclick');
    item.classList += ' loader';
    apply(item, 'bookmark', `post`)
}

function like(item) {
    item.removeAttribute('onclick');
    item.classList += ' loader';
    apply(item, 'like', `post`)

}
