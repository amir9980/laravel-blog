@extends('Admin.layouts.master')
@section('title','همه مقالات')

@section('content')

    <div>
        <h4>جستجو</h4>
        <form action="#">
            <div class="row align-items-center">
                <div class="col-md-2 form-group">
                    <label>عنوان</label>
                    <input class="form-control" name="title" type="text" value="{{request()->query('title')}}">
                </div>
                <div class="col-md-2 form-group">
                    <label>وضعیت</label>
                    <select name="status" class="form-control">
                        <option value="">انتخاب کنید</option>
                        <option value="active" @if(request()->query('status') == 'active') selected @endif>فعال</option>
                        <option value="inactive" @if(request()->query('status') == 'inactive') selected @endif>غیرفعال</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label>آخرین تاریخ ثبت</label>
                    <input class="form-control" name="end_date" type="text" id="persianDatePicker" value="{{request()->query('end_date')}}">
                </div>
                <div class="col-md-2 form-group">
                    <button type="submit" class="btn btn-sm btn-info">فیلتر</button>
                </div>
            </div>

        </form>
    </div>


    <div class="table-responsive mt-5">
        <table class="table table-bordered table-striped text-center">

            <thead>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>تعداد نظرات</th>
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
                        <td>{{$article->title}}</td>
                        <td>{{$article->comments_count}}</td>
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
{{--                            @can('update',$article)--}}
{{--                                <a href="{{route('admin.article.edit',$article->slug)}}" class="btn btn-sm btn-secondary"--}}
{{--                                   title="ویرایش"><span class="oi oi-pencil"></span></a>--}}
{{--                            @endcan--}}
                                @can('delete',$article)
                                <form action="{{route('article.destroy', $article->slug)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger"><span class="oi oi-trash"></span></button>
                                </form>
                                @endcan
                            <a href="{{route('admin.article.comments',$article->slug)}}"
                               class="btn btn-sm btn-secondary"
                               title="مشاهده نظرات"><span
                                    class="oi oi-comment-square"></span></a>

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

        <div class="d-flex justify-content-center">
            {{$articles->links()}}
        </div>

@endsection
