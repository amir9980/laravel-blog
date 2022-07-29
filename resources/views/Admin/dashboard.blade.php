@extends('admin.layouts.master')

@section('title','پنل مدیریت')
@section('content')

    <div class="card d-flex flex-column w-25 text-center">
        <img class="card-img-top" src="
        {{is_null(\Illuminate\Support\Facades\Auth::user()->profile_img)
 ? asset('uploads/defaults/profile.png')
 : asset(\Illuminate\Support\Facades\Auth::user()->profile_img)}}"
             alt="user profile">
        <div class="card-body">
        <h5 class="card-title">{{\Illuminate\Support\Facades\Auth::user()->username}}</h5>
        <span>نقش: {{\Illuminate\Support\Facades\Auth::user()->role->title}}</span>
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

@endsection
