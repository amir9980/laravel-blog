@extends('Admin.layouts.master')

@section('title','کاربران')

@section('content')
    <div>
        <h4>جستجو</h4>
        <form action="#">
            <div class="row align-items-center">
                <div class="col-md-2 form-group">
                    <label>نام کاربری</label>
                    <input class="form-control" name="username" type="text">
                </div>
                <div class="col-md-2 form-group">
                    <label>وضعیت</label>
                    <select name="status" class="form-control">
                        <option value="">انتخاب کنید</option>
                        <option value="active">فعال</option>
                        <option value="inactive">غیرفعال</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label>نقش</label>
                    <select name="role" class="form-control">
                        <option value="">انتخاب کنید</option>
                        <option value="user">کاربر</option>
                        <option value="writer">نویسنده</option>
                        <option value="watcher">بازرس</option>
                        <option value="admin">مدیر</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label>آخرین تاریخ ثبت</label>
                    <input class="form-control" name="end_date" type="text" id="persianDatePicker">
                </div>
                <div class="col-md-2 form-group">
                    <button type="submit" class="btn btn-sm btn-info">فیلتر</button>
                </div>
            </div>

        </form>
    </div>

    <table class="table table-bordered table-striped text-center mt-5">
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
                        @can('role',$user)
                            <a href="{{route('admin.user.edit',$user->username)}}" class="btn btn-sm btn-secondary"
                               title="ویرایش"><span class="oi oi-cog"></span></a>
                        @endcan
                        <a href="{{route('admin.user.articles',$user->username)}}" class="btn btn-sm btn-secondary"
                           title="مشاهده مقالات"><span class="oi oi-list"></span></a>
                        <a href="{{route('admin.user.comments',$user->username)}}" class="btn btn-sm btn-secondary"
                           title="مشاهده نظرات"><span
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


@section('script')



@endsection
