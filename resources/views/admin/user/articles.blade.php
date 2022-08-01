@extends('admin.layouts.master')

@section('title','مقالات')

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
                        <option value="inactive" @if(request()->query('status') == 'inactive') selected @endif>غیرفعال
                        </option>
                    </select>
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
                        @if($article->status == 'new')جدید
                        @elseif($article->status == 'inactive')غیرفعال
                        @elseif($article->status == 'active')فعال
                        @endif
                    </td>
                    <td>{{\Morilog\Jalali\Jalalian::forge($article->created_at)->format('%A, %d %B %y')}}</td>
                    <td class="d-flex justify-content-around">
                        @if($article->status == 'active')
                            <form action="{{route('admin.article.status',$article->slug)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="deactivate">
                                <button type="submit" class="btn btn-sm btn-danger">غیر فعال سازی</button>
                            </form>
                        @else
                            <form action="{{route('admin.article.status',$article->slug)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="activate">
                                <button type="submit" class="btn btn-sm btn-success">فعال سازی</button>
                            </form>
                        @endif
                        @can('update',$article)
                            <a href="{{route('admin.article.edit',$article->slug)}}" class="btn btn-sm btn-secondary"
                               title="ویرایش"><span class="oi oi-cog"></span></a>
                        @endcan
                        <a href="{{route('admin.article.comments',$article->slug)}}" class="btn btn-sm btn-secondary"
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
        {{$articles->onEachSide(1)->links()}}
    </div>

@endsection
