@extends('admin.layouts.master')
@section('title','ویرایش نقش کاربر')

@section('content')

    <div class="container">
        <form action="{{route('admin.user.update',$user->username)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="my-3">نقش</label>
                <select name="role" class="form-control">
                    <option>انتخاب کنید</option>
                    @foreach(\App\Models\Role::all() as $role)
                        <option value="{{$role->title}}">
                            {{$role->farsi_name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-danger my-3">ثبت</button>
        </form>
    </div>

@endsection
