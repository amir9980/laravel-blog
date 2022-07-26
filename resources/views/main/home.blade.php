@extends('main.layouts.master')

@section('title', 'خانه')
@section('style')
@endsection
@section('content')

    <div class="py-0">

        <div class="row me-1">
            <!-- sidebar -->
            <section class=" sidebar-section mt-5  col-lg-3 col-md-4 d-none d-lg-block  d-xl-block d-xxl-block" dir="rtl">
                <span class="sidebar-title">
                    برترین های هفته
                </span>
                <ul class="block-list mt-3 tops-ul">
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
            <div class=" col-lg-8 col-md-12 ps-md-4 col-12 m-auto row mt-5  justify-content-end" >
            @foreach($articles as $article)
                @php
                    $user = $article->user;
                @endphp
                <div class=" row letter article-card" style="@if($article == $articles->first()) margin-top: 0 @endif;">
                    <div class="col-12">
                        <div class="mt-1 d-flex float-end" >

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
                                    <div class="me-4 ms-3 text-black-50 float-start" >
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
                        <div class="me-2 ms-3 mt-1 float-start" >
                            <i class="fa fa-bookmark articles-bookmark"></i>
                        </div>
                    </div>

                    <div class="col-7 col-lg-8  col-sm-6 col-md-7 pt-2 pb-2 pe-0" >

                        <a class="custom-a" href="#?">
                            <h5>{{$article->title}}</h5>
                        </a>
                            <p>{{$article->description}}</p>


                    </div>

                    <div class="article-details col-5  col-lg-4 col-sm-6 col-md-5 pe-0">
                        <a class="custom-a" href="#?">
{{--                            article-png.jpg--}}
                        <div class="img-bg" style="background-image: url({{asset('/uploads/defaults/article-png.jpg')}});"></div>
                        </a>
                    </div>


            </div>

                @endforeach

        </div>


    </div>
@endsection

@section('script')
@endsection
