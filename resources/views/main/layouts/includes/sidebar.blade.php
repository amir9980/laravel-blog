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
                    <a class="custom-a" href="{{route('article.show',['user' => $user->username,'article' => $article->slug])}}" >
                        <img class="profile" src="{{is_null($user->profile_image)?'/uploads/defaults/profile.png':'/uploads/imgs/'.$user->profile_image}}" alt="{{$user->name}}">
                    </a>
                    <div class="Posts-info">
                        <div class="me-2 tops-title">
                            <a class="custom-a Tanha" href="{{route('article.show',['user' => $user->username,'article' => $article->slug])}}" title="{{$article->title}}">{{$article->title}}</a>
                        </div>
                        {{--                                                <br>--}}
                        <a class="custom-a sidebar-username me-3" href="{{route('article.show',['user' => $user->username,'article' => $article->slug])}}" title="{{$user->name}}">{{$user->name}}</a>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>

</section>
