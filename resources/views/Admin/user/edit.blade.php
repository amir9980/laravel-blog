@extends('Admin.layouts.master')
@section('title','ویرایش کاربر')

@section('content')

    <div class="container">
        <form action="{{route('admin.user.update',$user->username)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="my-3">نقش</label>
                <select name="role" class="form-control">
                    <option>انتخاب کنید</option>
                    @foreach($roles as $role)
                        <option value="{{$role->title}}">
                            @switch($role->title)
                                @case('user')
                                    کاربر
                                @break
                                @case('writer')
                                    نویسنده
                                    @break
                                @case('watcher')
                                    بازرس
                                    @break
                                @case('admin')
                                    مدیر
                                    @break
                            @endswitch
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-danger my-3">ثبت</button>
        </form>
    </div>

@endsection
