@extends('Admin.layouts.master')
@section('title','همه مقالات')

@section('content')

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


    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">

            <thead>
            <th>آیدی</th>
            <th>عنوان</th>
            <th>تعداد نظرات</th>
            <th>تعداد بازدید</th>
            <th>عملیات</th>
            </thead>
            <tbody>
            @if(count($articles) > 0)
                @foreach($articles as $article)
                    <tr>
                        <td class="align-items-center">{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>
                            <form action="#" method="POST" class="d-flex justify-content-between">
                                @csrf
                                <a href="{{route('article.edit',$article->slug)}}"
                                   class="btn btn-sm btn-success">ویرایش</a>
                                <button type="button" class="btn btn-sm btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">مقاله ای یافت نشد!</td>
                </tr>
            @endif
            </tbody>

        </table>

@endsection
