<ul class="list-group list-group-flush">
    @foreach($categories as $category)
        <li class="list-group-item ms-3">
            <div class="d-flex">
                <span>{{$category->title}}</span>
                <div class="actions ms-2">
                    <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-sm btn-info" href="">ویرایش</a>
                </div>
            </div>
            @if($category->category->count())
                @include('Admin.layouts.categories',['categories'=>$category->category])
            @endif
        </li>
    @endforeach
</ul>
