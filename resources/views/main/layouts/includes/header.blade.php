
<div class="main-header">
    <section class="navbar navbar-light container-md ">

        <div class="col-6 mr-3 justify-content-between">
            <div class="dropdown ms-4 float-start" >
            @auth
                @php
                $user = \App\Models\User::find(auth()->id());
                @endphp

                        <a class="btn btn-primary text-decoration-none" href="{{route('user.profile', $user->username)}}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            پروفایل
                        </a>
                        <div class="dropdown-menu profile-link" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{route("article.create")}}">ایجاد مقاله</a>
                            <a class="dropdown-item" href="{{route("user.edit", $user->username)}}">ویرایش</a>
                            <hr>
                            <form action="{{route('logout')}}" method="post" class="d-none" id="logout">
                                @csrf
                            </form>
                            <button type="submit" form="logout" class="dropdown-item text-danger" >خروج</button>
                        </div>


            @else

                    <a class="btn decoration-none register-button" href="{{route('register')}}">
                        <small>ثبت نام</small>
                    </a>
                    <a class="link-muted decoration-none login-nav-link"  href="{{route('login')}}">
                        <small>ورود</small>
                    </a>
            @endauth
            </div>

        <div>
            <span class="fa fa-search  modal-search-btn"   data-bs-toggle="modal" data-bs-target="#exampleModal"></span>
        </div>
    </div>


<!-- Button trigger modal -->


    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}

                    <form class="form-inline d-flex" id="search" action="{{route('home')}}">
{{--                        <button class="btn btn-outline-success btn-search" type="submit">جستجو</button>--}}
                            <div class="search">
                                <input class="search_input" value="{{request()->query('search')}}" type="search" name="search" placeholder="جستجو...">
                                <button type="submit" href="#" class="search_icon"><i class="fa fa-search"></i></button>
                            </div>
                    </form>


                    <button type="button" class="btn btn-secondary close-modal mt-4 btn-md w-25 pull-right"  data-bs-dismiss="modal">انصراف</button>

            </div>
        </div>
    </div>


        <div class="col-3 col-xs-12 d-flex logo-section">
            <a class="nav-link d-flex" href="{{route("home")}}">
            <span class="mt-4 logo-text">
                Johar
            </span>
                <img src="{{asset('/uploads/defaults/logo.png')}}" class="navbar-brand pull-right" alt="johar.ir">
            </a>
        </div>
    </section>
    @if(request()->route()->getName() != 'user.profile')

    <nav class="navbar navbar-expand-sm navbar-bg" >
        <div class="container-fluid" >
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars" ></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav mb-2 ms-auto" >
                    <li class="nav-item ms-auto">
                        <a class="nav-link active" aria-current="page" href="#">جدیدترین</a>
                    </li>
                    <li class="nav-item dropdown " >
                        <a class="nav-link dropdown-toggle float-end " href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            برنامه نویسی
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark child-drop-down"  aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">پایتون</a></li>
                            <li><a class="dropdown-item" href="#">پی اچ پی</a></li>
                            <li><a class="dropdown-item" href="#">لاراول</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="#">کسب وکار</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="#" >کتاب</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="#">خلاقیت</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
        @endif
</div>

