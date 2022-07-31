@extends('admin.layouts.master')
@section('title','ویرایش دسته بندی')

@section('content')

    <form action="{{route('admin.category.update',$category->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-6">
                <label>عنوان</label>
                <input type="text" class="form-control" name="title" value="{{$category->title}}">
            </div>
            <div class="form-group col-md-6">
                <label>دسته بالایی</label>
                <select name="parent" class="form-control">
                    <option>انتخاب کنید</option>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-info mt-3">ثبت</button>
    </form>

@endsection
