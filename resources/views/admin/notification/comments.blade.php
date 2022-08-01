@extends('admin.layouts.master')

@section('title','نظرات جدید')

@section('content')
    <div>
        <h4>جستجو</h4>
        <form action="#" method="get">
            <div class="row align-items-center">
                <div class="col-md-2 form-group">
                    <label>عنوان</label>
                    <input class="form-control" name="title" type="text" value="{{request()->query('title')}}">
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
        <th>متن</th>
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
                    <td>{{\Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%A, %d %B %y')}}</td>
                    <td class="d-flex justify-content-around">
                        @can('status',$comment)
                            <form action="{{route('admin.comment.status',$comment->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="activate">
                                <button type="submit" class="btn btn-sm btn-success">فعال سازی</button>
                            </form>
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


@section('script')



@endsection
