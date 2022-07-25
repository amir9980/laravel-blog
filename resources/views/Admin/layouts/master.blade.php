<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
{{--    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet" />--}}
    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.rtl.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('panel/css/open-iconic-bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('panel/css/admin.css')}}" />

    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar sticky-top bg-white navbar-expand-md navbar-light p-0">
    <div class="d-flex align-items-center">
        <a href="#" class="navbar-brand bg-light m-0 py-3 px-5"
        >پنل مدیریت</a
        >
        <span
            class="oi oi-menu ms-4"
            data-toggle="collapse"
            data-target="#sidebar"
        ></span>
    </div>

    <div class="collapse navbar-collapse justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a href="#" class="nav-link">داشبورد</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">اعضا</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">تنظیمات</a>
            </li>
        </ul>

        <div class="me-3">
            <button type="button" class="btn btn-sm btn-primary">
                ایمیل های جدید <span class="badge bg-light text-dark">9</span>
            </button>
            <button type="button" class="btn btn-sm btn-success">
                نظرات جدید <span class="badge bg-light text-dark">9</span>
            </button>
            <button type="button" class="btn btn-sm btn-danger">
                خروج <span class="badge bg-light text-dark">9</span>
            </button>
        </div>
    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div
            class="col-12 col-md-2 bg-dark text-light collapse show"
            id="sidebar"
        >
            <div class="py-2">منو اصلی</div>
            <ul class="nav flex-column px-3">
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-dashboard"></span>
                    <a href="#" class="nav-link my-1 w-100">داشبورد</a>
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
                                <a href="#" class="nav-link my-1 w-100">مشاهده همه</a>
                            </li>
                            <li class="nav-item w-100">
                                <a
                                    href="#"
                                    class="nav-link my-1 w-100 collapsed"
                                    data-toggle="collapse"
                                    data-target="#articlesSubmenu2"
                                >ارسال مقاله
                                    <span class="oi oi-chevron-left float-end"></span>
                                </a>
                                <div class="collapse" id="articlesSubmenu2">
                                    <ul class="nav px-3">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link my-1 w-100"
                                            >مقاله کوتاه</a
                                            >
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link my-1 w-100">مقاله بلند</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-video"></span>
                    <a href="#" class="nav-link my-1 w-100">دوره ها</a>
                </li>
            </ul>
            <div>متفرقه</div>
            <ul class="nav flex-column px-3">
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-person"></span>
                    <a href="#" class="nav-link my-1 w-100">اعضا</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-comment-square"></span>
                    <a href="#" class="nav-link my-1 w-100">نظرات</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <span class="oi oi-dashboard"></span>
                    <a href="#" class="nav-link my-1 w-100">تنظیمات</a>
                </li>
            </ul>
        </div>

        <div class="col-12 col-md-10 ms-md-auto p-4 bg-light" id="main">

            <div
                class="d-flex justify-content-between align-items-center my-3 border-bottom pb-2"
            >
                <h1 class="h2">داشبورد</h1>
                <div class="btn-toolbar">
                    <div class="btn-group me-2">
                        <button class="btn btn-sm btn-outline-secondary">
                            اشتراک گذاری
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            خروجی گرفتن
                        </button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        این هفته
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center my-4">
                <h1 class="h2">آخرین مقالات</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="table-secondary">
                        <th>عنوان مقالات</th>
                        <th>تعداد نظرات</th>
                        <th>مقدار بازدید</th>
                        <th>تنظیمات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                        </td>
                        <td>0</td>
                        <td>30</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary">ویرایش</button>
                                <button class="btn btn-sm btn-danger">حذف</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('panel/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
{{--<script src="js/script.js"></script>--}}

<script
    src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"
></script>



</body>
</html>