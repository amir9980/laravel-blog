<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {{--    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet" />--}}
    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.rtl.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('panel/css/open-iconic-bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('panel/css/jalalidatepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('panel/css/admin.css')}}"/>

    <title>@yield('title')</title>
</head>
<body>
<div class="loader-div">
    <span class="loader"></span>
</div>
<nav class="navbar sticky-top bg-white navbar-expand-md navbar-light p-0">
    <div class="d-flex align-items-center">
        <a href="#" class="navbar-brand bg-light m-0 py-3 px-5">
            پنل مدیریت
        </a>
        <span
            class="oi oi-menu ms-4"
            data-toggle="collapse"
            data-target="#sidebar"
        ></span>
    </div>

    <div class="collapse navbar-collapse justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">بلاگ</a>
            </li>
            <li class="nav-item active">
                <a href="{{route('admin.dashboard')}}" class="nav-link">داشبورد</a>
            </li>
            <li class="nav-item">
                <a href="{{route('user.edit',\Illuminate\Support\Facades\Auth::user()->username)}}" class="nav-link">پروفایل</a>
            </li>
        </ul>

        <div class="me-3 d-flex">
            <a href="{{route('admin.notification.users')}}" class="btn btn-sm btn-primary">
                کاربران جدید <span
                    class="badge bg-light text-dark">{{$usersNotification}}</span>
            </a>
            <a href="{{route('admin.notification.comments')}}" class="btn btn-sm btn-success me-2">
                نظرات جدید <span
                    class="badge bg-light text-dark">{{$commentsNotification}}</span>
            </a>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">خروج</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div
            class="col-12 col-md-2 bg-light text-dark collapse show "
            id="sidebar"
        >
            <ul class="nav flex-column px-3">
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-dashboard"></span>
                    <a href="{{route('admin.dashboard')}}" class="nav-link my-1 w-100">داشبورد</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-person"></span>
                    {{--                    <a href="{{route('admin.user.index')}}" class="nav-link my-1 w-100 ">اعضا</a>--}}
                    <a type="button" class="nav-link my-1 w-100 usersIndex">اعضا</a>
                </li>
                <li class="nav-item">
                    <div class="d-flex align-items-center">
                        <span class="oi oi-book"></span>
                        <a
                            href="#"
                            class="nav-link my-1 w-100 collapsed"
                            data-toggle="collapse"
                            data-target="#articlesSubmenu"
                        >مقالات
                            <span class="oi oi-chevron-left float-end"></span>
                        </a>
                    </div>
                    <div class="collapse" id="articlesSubmenu">
                        <ul class="nav px-3">
                            <li class="nav-item">
                                <a href="{{route('admin.article.index')}}" class="nav-link my-1 w-100">مشاهده همه</a>
                            </li>
                            <li class="nav-item w-100">
                                <a
                                    href="{{route('article.create')}}"
                                    class="nav-link my-1 w-100 collapsed"

                                >ارسال مقاله
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-comment-square"></span>
                    <a href="{{route('admin.comment.index')}}" class="nav-link my-1 w-100">نظرات</a>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-grid-two-up"></span>
                    <a href="#" class="nav-link my-1 w-100" data-toggle="collapse"
                       data-target="#catsSubmenu"><span class="oi oi-chevron-left float-end"></span>دسته بندی ها</a>
                </li>

                <div class="collapse" id="catsSubmenu">
                    <ul class="nav px-3">
                        <li class="nav-item">
                            <a href="{{route('admin.category.index')}}" class="nav-link my-1 w-100">مشاهده همه</a>
                        </li>
                        <li class="nav-item w-100">
                            <a
                                href="{{route('admin.category.create')}}"
                                class="nav-link my-1 w-100 collapsed"

                            >ایجاد دسته بندی</a>
                        </li>
                    </ul>
                </div>

            </ul>
        </div>

        <div class="col-12 col-md-10 ms-md-auto p-4 bg-light" id="main">
            @include('admin.includes.errors')
            @yield('content')


        </div>
    </div>
</div>


<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('panel/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('panel/js/jalalidatepicker.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $(".loader-div").hide();
        jalaliDatepicker.startWatch();

        $(".usersIndex").on("click", function () {
            fetch("/admin/user/index", {}).then(response => {
                return response.json();
            }).then(jsonResponse => {
                let main = $("#main");
                main.text('');
                let table = $("<table>", {
                    class: "table table-bordered table-striped text-center mt-5"
                });

                table.html(`<thead>
                    <th>ردیف</th>
                <th>نام کاربری</th>
                <th>نقش</th>
                <th>وضعیت</th>
                <th>مقاله ها</th>
                <th>نظرات</th>
                <th>تاریخ ثبت</th>
                <th>عملیات</th>
            </thead>
`);
                let tbody = $("<tbody>");

                jsonResponse.data.forEach((user) => {
                    let tr = $("<tr>");
                    let actionsTd = $("<td>",{
                        class: "d-flex justify-content-around"
                    });
                    if (user.status === 'active'){
                        actionsTd.append($("<button>",{
                            class: 'btn btn-sm btn-danger',
                            text: 'غیرفعال سازی'
                        }));
                    }else{
                        actionsTd.append($("<button>",{
                            class: 'btn btn-sm btn-success',
                            text: 'فعال سازی'
                        }))
                    }

                    tr.html(`
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td><span class="badge bg-warning text-dark">${user.role.farsi_name}</span></td>
                        <td>${user.status}</td>
                        <td>${user.articles_count}</td>
                        <td>${user.comments_count}</td>
                        <td>${user.created_at}</td>
`);
                    tr.append(actionsTd);
                    $(tbody).append(tr);
                });
                table.append(tbody);
                main.append(table);


            });
        });

    });


</script>

<script
    src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"
></script>


@yield('script')

</body>
</html>
