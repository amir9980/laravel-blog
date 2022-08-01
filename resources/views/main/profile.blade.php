@extends('main.layouts.master')

@section('title', 'خانه')


@section('content')



        <div class="row d-flex justify-content-center">

            <div class="col-10">

                <div class="card p-3 py-4" style="background:none;border:none">

                    <div class="text-center">
                        <img src="{{is_null($user->profile_image)?'/uploads/defaults/profile.png':'/uploads/imgs/'.$user->profile_image}}"  class="rounded-circle profile">
                    </div>

                    <div class="text-center mt-3">
{{--                        <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span>--}}
                        <h5 class=" mb-1">{{$user->name}}</h5>
                        <small>{{"@".$user->username}}</small>

                        <div class="px-4 mt-1">
                            <p class="fonts "> {{$user->profile->bio}}</p>

                        </div>
                        <ul class="social-list">
                            @if(! is_null($user->profile->social_media))
                                @foreach(json_decode($user->profile->social_media) as $key=>$value)
                                    <li><a  href="{{$value}}" class="decoration-none"><span class="fab fa-{{$key}}"></span></a></li>

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
                        <img class="profile" src="{{is_null($user->profile_image)?'/uploads/defaults/profile.png':'/uploads/imgs/'.$user->profile_image}}"  >
                    </a>
                </div>
                <div class="me-2 ms-3 mt-1 float-start" >
                    <i  class=" @if(in_array($article->id,$bookmarks)) fa @else fa-thin @endif fa-bookmark articles-bookmark " id="{{$article->slug}}" onclick="bookmark(this)"></i>
                </div>
                <div class="me-2 ms-4 mt-1 float-start" >
                    @if(auth()->check() and auth()->id() == $user->id)
                    <form id="destroy_article" action="{{route('article.destroy', $article->slug)}}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                    <button type="submit" form="destroy_article" class="articles-bookmark text-danger" style="border: none;background: none;font-size: 13px">حذف</button>
                    @endif
                </div>

            </div>

            <div class="col-7 col-lg-8  col-sm-6 col-md-7 pt-2 pb-2 pe-0" >
                <div class="h-75">
                    <a class="custom-a" href="{{route('article.show',['user' => $user->username,'article' => $article->slug])}}">
                        <h5>{{$article->title}}</h5>
                    </a>
                    <p>{{$article->description}}</p>
                </div>
                <hr style="margin-top: -30px;">
                <a  href="{{route('article.show',['user' => $user->username,'article' => $article->slug])}}"  class="read-more" aria-label="Read More">ادامه مطلب</a>

            </div>

            <div class="article-details col-5  col-lg-4 col-sm-6 col-md-5 pe-0">
                <a class="custom-a" href="{{route('article.show',['user' => $user->username,'article' => $article->slug])}}">
                    <div class="img-bg" style="background-image: url({{is_null($article->thumbnail)?'/uploads/defaults/article-png.jpg':'/uploads/imgs/'.$article->thumbnail}});"></div>
                </a>

            </div>
            </div>

        @endforeach

        <div class="mt-5">
            {{$articles->links()}}
        </div>




@endsection



