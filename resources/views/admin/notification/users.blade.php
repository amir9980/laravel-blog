@extends('admin.layouts.master')

@section('title','کاربران جدید')

@section('content')
    <div>
        <h4>جستجو</h4>
        <form action="#">
            <div class="row align-items-center">
                <div class="col-md-2 form-group">
                    <label>نام کاربری</label>
                    <input class="form-control" name="username" type="text" value="{{request()->query('username')}}">
                </div>
                <div class="col-md-2 form-group">
                    <label>بازه زمانی ثبت</label>
                    <div class="input-group">
                        <input class="form-control" name="start_date" type="text" data-jdp
                               value="{{request()->query('start_date')}}" placeholder="از">

                        <input class="form-control" name="end_date" type="text" data-jdp
                               value="{{request()->query('end_date')}}" placeholder="تا">
                    </div>
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
        <th>تاریخ ثبت</th>
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
                    <td>{{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('%A, %d %B %y')}}</td>
                    <td class="d-flex justify-content-around">
                        @can('status',$user)
                            <form action="{{route('admin.user.status',$user->username)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="activate">
                                <button type="submit" class="btn btn-sm btn-success">فعال سازی</button>
                            </form>
                        @endcan
                        @can('role',$user)
                            <a href="{{route('admin.user.edit',$user->username)}}" class="btn btn-sm btn-secondary"
                               title="نقش"><span class="oi oi-cog"></span></a>
                        @endcan
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
        {{$users->onEachSide(1)->links()}}
    </div>
@endsection


@section('script')



@endsection
