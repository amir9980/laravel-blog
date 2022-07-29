@extends('main.layouts.master')
@section('title', 'ایجاد مقاله')
@section('link')
    <script src="/js/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="#" method="post" id="create_article">
        @csrf
    </form>
    <div  style="min-height: 1500px" dir="rtl" >
        <div class="row">
            <div class="col-12 mt-3" >
                <label for="title"><h3 class="Tanha">عنوان</h3></label>
                <input form="create_article" dir="auto" type="text" name="title" id="title" class="form-control w-75 h-75 Tanha" style="font-size: 25px;">
            </div>
            <div class="col-12 mt-5">
                <label for="description"><h3 class="Tanha">توضیحات</h3></label>
                <textarea rows="5" form="create_article" dir="rtl" type="text" name="description" id="description" class="form-control w-50 vazir-rb"></textarea>
            </div>
            <div class="col-12 mt-5">
                <label for="body"><h3 class="Tanha">متن مقاله</h3></label>
                <textarea rows="5" form="create_article" dir="rtl" type="text" name="body" id="body" class="form-control w-100 vazir-rb"></textarea>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        CKEDITOR.replace( 'body',{filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
    </script>
@endsection
