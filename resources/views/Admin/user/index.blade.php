@extends('Admin.layouts.master')

@section('title','کاربران')

@section('content')

    <table class="table table-bordered table-striped text-center">
        <thead>
        <th>ردیف</th>
        <th>نام کاربری</th>
        <th>نقش</th>
        <th>وضعیت</th>
        <th>مقاله ها</th>
        <th>نظرات</th>
        <th>عملیات</th>
        </thead>

        <tbody>
        @if(count($users) > 0)
            @php $iteration = ($users->currentPage()-1) * $users->count();  @endphp
            @foreach($users as $user)
                @php $iteration++; @endphp
                <tr>
                    <td>{{$iteration}}</td>
                    <td><a href="#">{{$user->username}}</a></td>
                    <td>
                        @switch($user->role_id)
                            @case(1)
                                <span class="badge bg-warning text-dark">کاربر</span>
                                @break
                            @case(2)
                                <span class="badge bg-info text-dark">نویسنده</span>
                                @break
                            @case(3)
                                <span class="badge bg-warning text-dark">بازرس</span>
                                @break
                            @case(4)
                                <span class="badge bg-warning text-dark">مدیر</span>
                                @break
                        @endswitch
                    </td>
                    <td>
                        {{$user->is_active ? 'فعال' : 'غیر فعال'}}
                    </td>
                    <td>{{$user->articles_count}}</td>
                    <td>{{$user->comments_count}}</td>
                    <td class="d-flex justify-content-around">
                        @if($user->is_active)
                            <form action="{{route('admin.user.status',$user->username)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger">غیر فعال سازی</button>
                            </form>
                        @else
                            <form action="{{route('admin.user.status',$user->username)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">فعال سازی</button>
                            </form>
                        @endif
                        <a href="{{route('admin.user.edit',$user->username)}}" class="btn btn-sm btn-secondary" title="ویرایش"><span class="oi oi-cog"></span></a>
                        <a href="{{route('admin.user.articles',$user->username)}}" class="btn btn-sm btn-secondary" title="مشاهده مقالات"><span class="oi oi-list"></span></a>
                        <a href="{{route('admin.user.comments',$user->username)}}" class="btn btn-sm btn-secondary" title="مشاهده نظرات"><span
                                class="oi oi-comment-square"></span></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">موردی یافت نشد!</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{$users->links()}}
    </div>
@endsection
