@extends('main.layouts.master')

@section('title', 'خانه')
@section('style')
    <style>

        .letter {
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            max-width: 550px;
            width: 100%;
            padding: 24px;
            position: relative;
            z-index: 1;
            text-align: right;
            float: right;

        }
        .letter:before, .letter:after {
            content: "";
            height: 98%;
            position: absolute;
            width: 100%;
            z-index: -4;
        }
        .letter:before {
            background: #fafafa;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
            left: -5px;
            top: 4px;

            transform: rotate(-2.5deg);
        }
        .letter:after {
            background: #f6f6f6;
            box-shadow: 0 0 3px rgba(0,0,0,0.2);
            right: -3px;
            top: 1px;
            transform: rotate(1.4deg);
        }
        .img-bg {
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            float: right;
            width: 100%;
            max-width: 300px;
            height: 200px;
            overflow: hidden;
            margin-top: 10px;
            border-radius: 5px
        }

        .article-details {
            text-align: right;
        }
        .article-card {
            margin-top: 90px;
            float: right;
            max-width: 850px;
            min-height: 310px;
            max-height: 400px;
            background-color: rgba(255, 255, 255, 0.78);
            box-shadow: 0 10px 16px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
            border: 1px solid transparent
        }
        .profile {
            border-radius: 50%;width: 60px;height: 60px
        }
        .custom-a {
            text-decoration: none;
            color: black;
        }
        .small-font {
            font-size: 15px;
            font-weight: bold;
        }
        .sidebar-username {
            font-size: 13px;
        }
    </style>
@endsection
@section('content')

    <div class="py-0">

        <div class="row me-1">
            <!-- sidebar -->
            <section class="mt-5  col-lg-3 col-md-4 d-none d-lg-block  d-xl-block d-xxl-block" dir="rtl" style="margin-left: 70px;height: 100vh;border-radius: 10px">
                <span style="color: #363636;font-size: 20px;font-weight: 700;">
                    برترین های هفته
                </span>
                <ul class="block-list mt-3" style="padding: 0">
                    @foreach($tops as $article)
                        @php
                            $user = $article->user;
                        @endphp
                        <li class="list-group mt-4">
                            <div class="d-flex">
                                <a class="custom-a" href="#?{{$user->username}}" title="">
                                    <img class="profile" src="{{asset('/uploads/defaults/profile.png')}}" alt="{{$user->name}}">
                                </a>
                                <div class="Posts-info">
                                    <a class="custom-a small-font" href="#?{{$article->slug}}" title="{{$article->title}}">{{$article->title}}</a>
                                    <br>
                                    <a class="custom-a sidebar-username" href="#?{{$user->username}}" title="{{$user->name}}">{{$user->name}}</a>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </section>

            <!-- articles section -->
            <div class="col-lg-8 col-md-12 ps-md-4 col-12 m-auto row mt-5  " style="justify-content: right">
            @foreach($articles as $article)
                @php
                    $user = $article->user;
                @endphp
                <div class=" row letter article-card" style="@if($article == $articles->first()) margin-top: 0 @endif;">
                    <div class="col-12">
                        <div class="mt-1 d-flex" style="float: right">

                            <div class="me-2">

                                <a class="custom-a" href="#?{{$user->username}}">
                                    <span>
                                    {{$user->name}}
                                    </span>
                                    <br>
                                    <div class="mt-1">
                                        <small class="text-black-50"></small>
                                        {{'@'.$user->username}}
                                    </a>
                                    <div class="me-4 ms-3 text-black-50" style="float: left">
                                        <small>
                                            {{explode( " ",$article->created_at)[0]}}
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </small>
                                    </div>
                                    </div>

                            </div>
                        <a class="custom-a" href="#?@imalirezapy">
                            <img class="profile" src="{{asset("/uploads/defaults/profile.png")}}"  >
                        </a>
                        </div>
                        <div class="me-2 ms-3 mt-1" style="float: left">
                            <i class="fa fa-bookmark" style="font-size: 20px"></i>
                        </div>
                    </div>

                    <div class="col-7 col-lg-8  col-sm-6 col-md-7 pt-2 pb-2" style="padding-right: 0;">

                        <a class="custom-a" href="#?">
                            <h5>{{$article->title}}</h5>
                        </a>
                            <p>{{$article->description}}</p>


                    </div>

                    <div class="article-details col-5  col-lg-4 col-sm-6 col-md-5" style="padding-right: 0">
                        <a class="custom-a" href="#?">
{{--                            article-png.jpg--}}
                        <div class="img-bg" style="background-image: url({{asset('/uploads/defaults/article-png.jpg')}});"></div>
                        </a>
                    </div>


            </div>

                @endforeach

        </div>


    </div>
    </div>
@endsection
@section('script')
@endsection
