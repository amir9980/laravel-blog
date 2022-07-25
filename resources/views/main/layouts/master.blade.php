<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield("title")</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('link')
</head>
@yield('style')
<body>
    @include("main.layouts.includes.header")

    <div>
        <div>
            @include("main.layouts.includes.sidebar")
            <div class="@yield('body-class')" style="background-image: url('/defaults/@yield("bg-url")'); background-repeat: no-repeat; background-size: cover">

                <div class="">
                    <div class="">

                        @yield("content")
                    </div>
                </div>

            </div>
        </div>
    </div>

@include("main.layouts.includes.footer")

    <script src="/bootstrap/js/bootstrap.min.js" ></script>
    <script src="/js/jquery-3.6.0.min.js"></script>

    @yield('script')
</body>
</html>
