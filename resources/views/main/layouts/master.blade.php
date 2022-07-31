<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->

    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield("title")</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/fonts/fontawesome/css/all.css">

    @yield('link')
</head>
@yield('style')
<body>

<div class="loader-div" style="animation: fadeBackground 6s;">
    <span class="main-loader"></span>

</div>
@include("main.layouts.includes.header")

<div>
    <div>
        <div class="@yield('body-class')"
             style="background-image: url('/defaults/@yield("bg-url")'); background-repeat: no-repeat; background-size: cover">

            <div class="py-0">

                <div class="row me-1">
                    @if(! in_array(request()->route()->getName(),['user.profile', 'register', 'login', 'article.create', 'user.edit']))
                        <!-- sidebar -->
                        @include("main.layouts.includes.sidebar")
                    @endif

                    <!-- articles section -->
                    <div class=" col-lg-8 col-md-12 ps-md-4 col-12 m-auto row mt-5  justify-content-end">
                        @yield("content")
                    </div>
                </div>

            </div>
        </div>
    </div>

@include("main.layouts.includes.footer")



@yield('script')
</body>
</html>
