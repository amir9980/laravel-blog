<script src="/bootstrap/js/bootstrap.min.js" ></script>
<script src="/js/jquery-3.6.0.min.js"></script>


<script>
    function apply(slug, url, method) {
        $.ajax({
            method: 'POST',
            url: 'articles/' + slug + '/' + url,
            dataType: 'json',
            data: {_token:`{{ csrf_token() }}`,_method:method},
            success: function (response) {
                console.log(response);
            }
        });
    }
</script>

<script src="/js/custom.js"></script>
