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

                        <img src="{{is_null($user->profile_image)?'/uploads/defaults/profile.png':'/uploads/images/'.$user->profile_image}}" class="rounded-circle profile">
                        </a>

                    </div>
                </div>

        </div>
        <hr>
        <div class=" mt-1" dir="rtl">
            <h2 class="Tanha">{{$article->title}}</h2>
            <p class="vazir-rb "> {!!  $article->body !!}</p>
            @foreach(json_decode($article->tags, true) as $tag)
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
                @error('commented')
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @enderror
                @error('comment_destroy')
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{route('comment.store', $article->slug)}}" id="algin-form" class="text-right row" method="post">
                    @csrf
                    <div class="form-group col-12">

                        <label class="float-end mb-1" for="title">عنوان</label>
                        <input dir="rtl" class="float-end form-control" id="title" name="title" type="text" >

                    </div>
                    @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form-group col-12 mt-4" >
                        <label class="float-end Tanha mb-1" for="message">:دیدگاه شما</label>
                        <textarea name="body" id="message" cols="30" dir="rtl" rows="5" class="form-control vazir-rb" ></textarea>
                        @error('body')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" id="post" class="btn btn-outline-primary w-25 float-start">ارسال</button>
                    </div>
                </form>
            </div>
        </div

    @if($article->comments->count() != 0)

        <div class="col-1 ">
            <h3 class="text-end " dir="rtl">{{$article->comments->count()}} نظر </h3>


            @foreach($article->comments->sortByDesc("id") as $comment)
                <div class="media col-10">
                    <a class="pull-left" href="#"></a>
                    <div class="media-body  float-end">
                        <h6 class="media-heading text-end"><a class="text-decoration-none text-black-50" href="{{route('user.profile', $comment->user()->first()->username)}}">{{$comment->user()->first()->name}}</a></h6>
                        <h5 class="text-end mt-3">{{$comment->title}}</h5>
                        <p dir="rtl">{{$comment->body}}</p>


                    </div>

                </div>
                <ul class="list-unstyled list-inline media-detail text-start col-10 d-flex">
                    <li class="text-start">{{$comment->created_at}}<i class="fa fa-calendar"></i></li>

                    @if(auth()->check() and auth()->id() == $comment->user_id)
                        <form class="d-none" id="destroy_comment" action="{{route('comment.destroy', $comment->id)}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        <li><button type="submit"  form="destroy_comment" class="text-decoration-none button-none text-danger vazir-rb">حذف</button></li>
                    @endif
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
