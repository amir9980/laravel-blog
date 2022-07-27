@extends('Admin.layouts.master')

@section('title','مقالات')

@section('content')

    <table class="table table-bordered table-striped text-center">
        <thead>
        <th>ردیف</th>
        <th>عنوان</th>
        <th>توضیحات</th>
        <th>وضعیت</th>
        <th>تاریخ ثبت</th>
        <th>عملیات</th>
        </thead>

        <tbody>
        @if(count($articles) > 0)
            @php $iteration = ($articles->currentPage()-1) * $articles->count();  @endphp
            @foreach($articles as $article)
                @php $iteration++; @endphp
                <tr>
                    <td>{{$iteration}}</td>
                    <td><a href="#">{{\Illuminate\Support\Str::limit($article->title,30)}}</a></td>
                    <td>{{\Illuminate\Support\Str::limit($article->description,30)}}</td>
                    <td>
                        {{$article->is_active ? 'فعال' : 'غیر فعال'}}
                    </td>
                    <td>{{\Morilog\Jalali\Jalalian::forge($article->created_at)->format('%A, %d %B %y')}}</td>
                    <td class="d-flex justify-content-around">
                        @if($article->is_active)
                            <form action="{{route('admin.article.status',$article->slug)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-danger">غیر فعال سازی</button>
                            </form>
                        @else
                            <form action="{{route('admin.article.status',$article->slug)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">فعال سازی</button>
                            </form>
                        @endif
                        <a href="{{route('admin.article.edit',$article->slug)}}" class="btn btn-sm btn-secondary" title="ویرایش"><span class="oi oi-cog"></span></a>
                        <a href="{{route('admin.article.comments',$article->slug)}}" class="btn btn-sm btn-secondary" title="مشاهده نظرات"><span
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
        {{$articles->links()}}
    </div>

@endsection
