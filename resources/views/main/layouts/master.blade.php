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
    <link rel="stylesheet" href="/fonts/fontawesome/css/all.css" >

    @yield('link')
</head>
@yield('style')
<body>
    @include("main.layouts.includes.header")

    <div>
        <div>
            @include("main.layouts.includes.sidebar")
            <div class="@yield('body-class')" style="background-image: url('/defaults/@yield("bg-url")'); background-repeat: no-repeat; background-size: cover">

                <div class="py-0">

                    <div class="row me-1">
                        <!-- sidebar -->
                        <section class=" sidebar-section mt-5  col-lg-3 col-md-4 d-none d-lg-block  d-xl-block d-xxl-block" dir="rtl">
                <span class="sidebar-title">
                    برترین های هفته
                </span>
                            <ul class="block-list mt-3 tops-ul">
                                @foreach(\App\Models\Article::all()->where("likes", ">=", 1)->sortByDesc("likes")->take(10) as $article)
                                    @php
                                        $user = $article->user;
                                    @endphp
                                    <li class="list-group mt-4">
                                        <div class="d-flex">
                                            <a class="custom-a" href="{{route('article.show', $article->slug)}}" >
                                                <img class="profile" src="{{asset('/uploads/defaults/profile.png')}}" alt="{{$user->name}}">
                                            </a>
                                            <div class="Posts-info">
                                                <div class="me-2">
                                                <a class="custom-a small-font " href="{{route('article.show', $article->slug)}}" title="{{$article->title}}">{{$article->title}}</a>
                                                </div>
{{--                                                <br>--}}
                                                <a class="custom-a sidebar-username me-3" href="{{route('article.show', $article->slug)}}" title="{{$user->name}}">{{$user->name}}</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>

                        </section>

                        <!-- articles section -->
                    <div class=" col-lg-8 col-md-12 ps-md-4 col-12 m-auto row mt-5  justify-content-end" >
                        @yield("content")
                    </div>
                </div>

            </div>
        </div>
    </div>

@include("main.layouts.includes.footer")

    <script src="/bootstrap/js/bootstrap.min.js" ></script>
    <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/custom.js"></script>
    @yield('script')
</body>
</html>
