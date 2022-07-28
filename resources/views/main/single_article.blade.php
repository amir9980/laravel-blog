@extends('main.layouts.master')

@section('title', $article->title)
@section('style')
<style>
    body {
        background-color: #ffffff;
    }
</style>
@endsection
@section('content')

    <div class="row">

        <div class=" justify-content-end">

            <div class="me-2 ms-3 mt-1 float-start" >
                <i  class=" @if(in_array($article->id,$bookmarks)) fa fa-bookmark articles-bookmark @else fa-thin fa-bookmark articles-bookmark @endif" id="{{$article->slug}}" onclick="bookmark(this)"></i>
            </div>
                <div class="card p-3 py-4 flex-row float-end" style="background:none;border:none">

                    <a class="custom-a" href="{{route("user.profile", $user->username)}}">

                    <div class="text-end mt-4 me-3 col-auto">

                        {{--                        <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span>--}}
                        <h5 class=" mb-4">{{$user->name}}</h5>
                    </a>

                    {{$article->created_at}}
                        <span class="mt-1 fa fa-calendar"></span>

                    </div>

                    <div class="text-end col-2 float-end">
                        <a class="custom-a" href="{{route("user.profile", $user->username)}}">

                        <img src="{{asset("/uploads/defaults/profile.png")}}" width="100" class="rounded-circle">
                        </a>

                    </div>
                </div>

        </div>
        <hr>
        <div class=" mt-1" dir="rtl">
            <h2 class="Tanha">{{$article->title}}</h2>
            <p class="vazir-rb "> {{$article->body}}</p>
            @foreach($article->tags as $tag)
                <span class="badge rounded-pill bg-secondary">{{$tag}}</span>
            @endforeach

            <div class="me-2 ms-4 mt-1 float-start" >

                <i class=" @if(in_array($article->id,$likes)) fa fa-heart articles-bookmark @else fa-thin fa-heart articles-bookmark @endif" id="{{$article->slug}}" onclick="heart(this)"></i>
            </div>
        </div>
        </div>

    <hr class="mt-5 mb-5">
    <section class="kt-container me-auto ms-auto row justify-content-end" style="background: #fcfcfd" id="comments">

        <div class="col-8  ms-auto row " >
            <div class="comment-box text-center">
                <form action="#" id="algin-form" class="text-right row" method="post">
                    @csrf

                    <div class="form-group col-12" >
                        <label class="float-end" for="message">:دیدگاه شما</label>
                        <textarea name="msg" id=""msg cols="30" rows="5" class="form-control" style="background-color: #f6f6f6;"></textarea>
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" id="post" class="btn btn-outline-primary w-25">ارسال</button>
                    </div>
                </form>
            </div>
        </div
    @if($article->comments->count() != 0)

        <div class="col-1 ">
            <h3 class="text-end " dir="rtl">{{$article->comments->count()}} نظر </h3>


            @foreach($article->comments as $comment)
                <div class="media col-10">
                    <a class="pull-left" href="#"></a>
                    <div class="media-body  float-end">
                        <h4 class="media-heading text-end">{{$comment->user()->first()->name}}</h4>
                        <p dir="rtl">{{$comment->body}}</p>


                    </div>

                </div>
                <ul class="list-unstyled list-inline media-detail text-start col-10">
                    <li class="text-start">{{$comment->created_at}}<i class="fa fa-calendar"></i></li>
                    {{--                            <li class="pull-left" onclick="like(this, `{{$comment->id}}`)"><span>{{$comment->likes}}</span><i class="fa fa-thumbs-up {{(auth()->check() and in_array(auth()->id(),$comment->likes()->get()->pluck('user_id')->toArray()))?'text-success':''}}" ></i></li>--}}
                </ul>
            @endforeach

        </div>
    @else

        <div class="col-12 text-bold" style="text-align: center">
            <div class="w-75 border-top mr-auto ml-auto mb-3">

            </div>
            اولین نفری باشید که نظر میدهید
        </div>
        @endif

    </section>
@endsection
