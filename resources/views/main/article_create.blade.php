@extends('main.layouts.master')
@section('title', 'ایجاد مقاله')
@section('link')
    <script src="/js/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="{{route("article.store")}}" method="post" id="create_article" enctype="multipart/form-data">
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
                <div class="">
                    <div>
                        <label for="formFile"><h3 class="Tanha">تصویر شاخص</h3></label><br>
                        <span id="upload_image" type="button" class="fa fa-upload btn btn-link" style="height: 30px;font-size: 20px;width: 120px" onclick="document.getElementById('formFile').click()">بارگذاری</span>
                        <img id="frame" class=" mt-5" width="150px" src="" >
                    </div>
                    <div class="container col-md-6">
                        <div class="mb-5">

                            <input form="create_article" class="form-control" name="thumbnail" type="file" accept="image/*" id="formFile" onchange="preview()" style="display: none">
                        </div>
                    </div>
                </div>
                <button id="remove_image" style="display: none;height: 30px" onclick="clearImage()" class="btn btn-danger btn-sm mt-3">حذف</button>

            </div>
            <div class="col-12 mt-3" >
                <label for="tags"><h3 class="Tanha">تگ ها</h3></label>
                <input  onkeyup="toTag(this)" form="create_article" dir="auto" type="text" name="tags" id="tags" class="form-control w-75 h-50 Tanha" >
            </div>
            <div class="col-12 mt-3" >
                <label for="category_id"><h3 class="Tanha">موضوع</h3></label>
                <select form="create_article" name="categories" id="category_id" class="form-control w-75 h-50 Tanha">
                    <option>انتخاب کنید</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-12 mt-5" dir="rtl">
                <label for="body"><h3 class="Tanha">متن مقاله</h3></label>
                <textarea rows="5" form="create_article" dir="rtl" type="text" name="body" id="body" class="form-control w-100 vazir-rb"></textarea>
            </div>
            <div class="col-12 mt-5" dir="rtl">
                <button  form="create_article" dir="rtl" type="submit" class="btn btn-success w-50 vazir-rb">ارسال</button>
            </div>
        </div>

    </div>
@endsection
@section('script')
        <script>
        function preview() {
            document.getElementById('frame').src = "";
            document.getElementById('remove_image').style.display = 'block';
            document.getElementById('upload_image').style.display = 'none';
            var img_src = URL.createObjectURL(event.target.files[0]);
            frame.src = img_src;
            document.getElementById('formFile').value = img_src;

        }
        function clearImage() {
            document.getElementById("remove_image").style.display = "none";
            document.getElementById('upload_image').style.display = 'block';
            var img_src = '';
            frame.src = img_src;
        }

        function toTag(input) {
            input.value = input.value.replace(" ", ",");
        }
    </script>
    <script>
        CKEDITOR.replace( 'body',{filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
    </script>
@endsection
