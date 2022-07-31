@extends('main.layouts.master')

@section('title', 'پروفایل')

@section('content')


            <div class=" mt-5">

            </div>
            @if($articles->count() != 0)
                <div style="margin-top: -50px;">
                    <select form="search" style="width: 100px;float: right"  name="orderBy" class="custom-select custom-select-sm form-control form-control-sm">
                        <option value="newest" {{request()->query('orderBy') == "newest"?'selected':''}}>جدیدترین</option>
                        <option value="name" {{request()->query('orderBy') == "name"?'selected':''}}>اسم</option>
                        <option value="likes" {{request()->query('orderBy') == "likes"?'selected':''}}>محبوب ترین</option>
                    </select>
                        <button form="search" type="submit" class="btn btn-primary float-end me-4" style="font-size: 10px">اعمال</button>
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
                            <img class="profile" src="{{is_null($user->profile_image)?'/uploads/defaults/profile.png':'/uploads/images/'.$user->profile_image}}"  >
                        </a>
                        </div>
                        <div class="me-2 ms-3 mt-1 float-start" >
                            <i  class=" @if(in_array($article->id,$bookmarks)) fa @else fa-thin @endif fa-bookmark articles-bookmark " id="{{$article->slug}}" @if(auth()->check()) onclick="bookmark(this) @endif "></i>
                        </div>
                        <div class="me-2 ms-4 mt-1 float-start" >
                            <div class="me-2 ms-4 mt-1 float-start" >
                                @if(auth()->check() and (auth()->id() == $user->id))
                                    <form id="destroy_article" action="{{route('article.destroy', $article->slug)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <button type="submit" form="destroy_article" class="articles-bookmark text-danger" style="border: none;background: none;font-size: 13px">حذف</button>
                                @endif
                            </div>
                            </div>
                        </div>

                    <div class="col-7 col-lg-8  col-sm-6 col-md-7 pt-2 pb-2 pe-0" >
                        <div class="h-75">
                        <a class="custom-a" href="{{route('article.show', ['user' => $user->username,'article' => $article->slug])}}">
                            <h5 class="Tanha">{{$article->title}}</h5>
                        </a>
                            <p class="vazir-rb">{{$article->description}}</p>
                        </div>
                    <hr>
                        <a  href="{{route('article.show', ['user' => $user->username,'article' => $article->slug])}}"  class="read-more" aria-label="Read More">ادامه مطلب</a>

                    </div>

                    <div class="article-details col-5  col-lg-4 col-sm-6 col-md-5 pe-0">
                        <a class="custom-a" href="{{route('article.show', ['user' => $user->username,'article' => $article->slug])}}">
                        <div class="img-bg" style="background-image: url({{is_null($article->thumbnail)?'/uploads/defaults/article-png.jpg':'/uploads/imgs/'.$article->thumbnail}});"></div>
                        </a>

                    </div>
                </div>

                @endforeach
            @else
                <div class="justify-content-center text-center vazir-rb" dir="rtl">
                    <h3 >
                        هیچ مقاله ای یافت نشد!
                    </h3>
                </div>
            @endif

    <div class="mt-5">
            {{$articles->links()}}
    </div>



@endsection



