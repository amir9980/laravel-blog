<ul class=" @if($isNavbar) navbar-nav @else dropdown-menu dropdown-menu-dark child-drop-down @endif " @if($isChild) aria-labelledby="dropdown{{$category->id}} @endif" dir="rtl" style="float:right">
    @foreach($categories as $category)
    <li class="nav-item dropdown  ms-auto " dir="rtl">
            <a class=" nav-link dropdown-toggle  ms-auto "  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >{{$category->title}}
             @if($category->category()->get()->count() != 0)
                <i class='fas fa-angle-down'></i>
            @endif

            </a>

        @if ($category->category()->get()->count() != 0)
{{--                @foreach($category->category()->get() as $child)--}}
                    @include('main.layouts.includes.categories-group', ['categories' => $category->category()->get(), 'isNavbar' => false])
{{--                @endforeach--}}

        @endif
    </li>
    @endforeach
</ul>


