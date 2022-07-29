@extends('main.layouts.master')

@section('title', 'خانه')

<style>

</style>
@section('content')



        <div class="row d-flex justify-content-center">

            <div class="col-10">

                <div class="card p-3 py-4" style="background:none;border:none">

                    <div class="text-center">
                        <img src="{{asset("/uploads/defaults/profile.png")}}" width="100" class="rounded-circle">
                    </div>

                    <div class="text-center mt-3">
{{--                        <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span>--}}
                        <h5 class=" mb-1">{{$user->name}}</h5>
                        <small>{{"@".$user->username}}</small>

                        <div class="px-4 mt-1">
                            <p class="fonts "> {{$user->profile->bio}}</p>

                        </div>

                        <ul class="social-list">
                            @if(! is_null($user->profile->scocial_media))

                                @foreach($user->profile->social_media as $key=>$value)

                                    <li><a  href="?{{$key.'/'.$value}}"><i class="fa fa-{{$key}}"></i></a></li>
                                @endforeach
                            @endif
{{--                            <li><i class="fa fa-dribbble"></i></li>--}}
{{--                            <li><i class="fa fa-instagram"></i></li>--}}
{{--                            <li><i class="fa fa-linkedin"></i></li>--}}
{{--                            <li><i class="fa fa-google"></i></li>--}}
                        </ul>

{{--                        <div class="buttons">--}}

{{--                            <button class="btn btn-outline-primary px-4">Message</button>--}}
{{--                            <button class="btn btn-primary px-4 ms-3">Contact</button>--}}
{{--                        </div>--}}


                    </div>
                </div>

            </div>

        </div>




        @foreach($articles as $article)
            @php
                $user = $article->user;
            @endphp
            <div class=" row letter article-card" style="@if($article == $articles->first()) margin-top: 0 @endif;">
                <div class="col-12">
                    <div class="mt-1 d-flex float-end" >

                        <div class="me-2">

                            <a class="custom-a" href="{{route("user.profile", $user->username)}}">
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
                    <a class="custom-a " href="{{route("user.profile", $user->username)}}">
                        <img class="profile" src="{{asset("/uploads/defaults/profile.png")}}"  >
                    </a>
                </div>
                <div class="me-2 ms-3 mt-1 float-start" >
                    <i  class=" @if(in_array($article->id,$bookmarks)) fa fa-bookmark articles-bookmark @else fa-thin fa-bookmark articles-bookmark @endif" id="{{$article->slug}}" onclick="bookmark(this)"></i>
                </div>
                <div class="me-2 ms-4 mt-1 float-start" >

                    <i class=" @if(in_array($article->id,$likes)) fa fa-heart articles-bookmark @else fa-thin fa-heart articles-bookmark @endif" id="{{$article->slug}}" onclick="heart(this)"></i>
                </div>

            </div>

            <div class="col-7 col-lg-8  col-sm-6 col-md-7 pt-2 pb-2 pe-0" >
                <div class="h-75">
                    <a class="custom-a" href="{{route('article.show', $article->slug)}}">
                        <h5>{{$article->title}}</h5>
                    </a>
                    <p>{{$article->description}}</p>
                </div>
                <hr style="margin-top: -30px;">
                <a  href="{{route('article.show', $article->slug)}}"  class="read-more" aria-label="Read More">ادامه مطلب</a>

            </div>

            <div class="article-details col-5  col-lg-4 col-sm-6 col-md-5 pe-0">
                <a class="custom-a" href="{{route('article.show', $article->slug)}}">
                    <div class="img-bg" style="background-image: url({{asset('/uploads/defaults/article-png.jpg')}});"></div>
                </a>

            </div>
            </div>

        @endforeach

        <div class="mt-5">
            {{$articles->links()}}
        </div>




@endsection



