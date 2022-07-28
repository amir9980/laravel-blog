@extends('Admin.layouts.master')

@section('title','نظرات')

@section('content')

    <table class="table table-bordered table-striped text-center">
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
