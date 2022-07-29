@extends('Admin.layouts.master')

@section('title','نظرات')

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
                    <label>آخرین تاریخ ثبت</label>
                    <input class="form-control" name="end_date" type="text" id="persianDatePicker"
                           value="{{request()->query('end_date')}}">
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
        <th>متن</th>
        <th>وضعیت</th>
        <th>تاریخ ثبت</th>
        <th>عملیات</th>
        </thead>

        <tbody>
        @if(count($comments) > 0)
            @php $iteration = ($comments->currentPage()-1) * $comments->count();  @endphp
            @foreach($comments as $comment)
                @php $iteration++; @endphp
                <tr>
                    <td>{{$iteration}}</td>
                    <td><a href="#">{{\Illuminate\Support\Str::limit($comment->title,30)}}</a></td>
                    <td>{{\Illuminate\Support\Str::limit($comment->body,30)}}</td>
                    <td>
                        {{$comment->is_active ? 'فعال' : 'غیر فعال'}}
                    </td>
                    <td>{{\Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%A, %d %B %y')}}</td>
                    <td class="d-flex justify-content-around">
                        @can('status',$comment)
                            @if($comment->is_active)
                                <form action="{{route('admin.comment.status',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger">غیر فعال سازی</button>
                                </form>
                            @else
                                <form action="{{route('admin.comment.status',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success">فعال سازی</button>
                                </form>
                            @endif
                        @endcan
                        @can('delete',$comment)
                            <form action="{{route('admin.comment.delete',$comment->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><span class="oi oi-trash"></span>
                                </button>
                            </form>
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
        {{$comments->links()}}
    </div>

@endsection
