@extends('main.layouts.master')
@section('title', 'ایجاد مقاله')
@section('link')
    <script src="/js/ckeditor-s/ckeditor.js"></script>
@endsection
@section('content')
    @include('main.layouts.includes.errors')
    <form action="{{route("article.store")}}" method="post" id="create_article" enctype="multipart/form-data">
        @csrf
    </form>
    <div  style="min-height: 1500px" dir="rtl" >
        <div class="row">
            <div class="col-12 mt-3" >
                <label for="title"><h3 class="Tanha">عنوان</h3></label>
                <input value="{{old('title')}}" form="create_article" dir="auto" type="text" name="title" id="title" class="form-control w-75 h-75 Tanha" style="font-size: 25px;">
            </div>
            <div class="col-12 mt-5">
                <label for="description"><h3 class="Tanha">توضیحات</h3></label>
                <textarea rows="5" form="create_article" dir="rtl" type="text" name="description" id="description" class="form-control w-50 vazir-rb">{{old('description')}}</textarea>
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

                            <input value="{{old('thumbnail')}}" form="create_article" class="form-control" name="thumbnail" type="file" accept="image/*" id="formFile" onchange="preview()" style="display: none">
                        </div>
                    </div>
                </div>
                <button id="remove_image" style="display: none;height: 30px" onclick="clearImage()" class="btn btn-danger btn-sm mt-3">حذف</button>

            </div>
            <div class="col-12 mt-3" >
                <label for="tags"><h3 class="Tanha">تگ ها</h3></label>
                <input value="{{old('tags')}}"  onkeyup="toTag(this)" form="create_article" dir="auto" type="text" name="tags" id="tags" class="form-control w-75 h-50 Tanha" >
            </div>
            <div class="col-12 mt-3" >
                <label for="category_id"><h3 class="Tanha">موضوع</h3></label>
                <select form="create_article" name="category_id" id="category_id" class="form-control w-75 h-50 Tanha">
                    <option>انتخاب کنید</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option {{old('category_id') == $category->id?'selected':''}} value="{{$category->id}}">{{$category->title}}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-12 mt-5" dir="rtl">
                <label for="body"><h3 class="Tanha">متن مقاله</h3></label>
                <textarea rows="5" form="create_article" dir="rtl" type="text" name="body" id="body" class="form-control w-100 vazir-rb">{!! old('body') !!}</textarea>
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
        {{--// import {ClassicEditor} from "../../../public/js/ckeditor5/ckeditor";--}}

        {{--ClassicEditor--}}
        {{--    .create(document.getElementById('body'),{--}}
        {{--        ckfinder:{--}}
        {{--            uploadUrl: '{{route('ck.upload').'?_token='.csrf_token()}}',--}}
        {{--        },--}}
        {{--    })--}}
        {{--    .then(editor => {--}}
        {{--        console.log(editor);--}}
        {{--    })--}}
        {{--    .catch(error => {--}}
        {{--        console.error(error);--}}
        {{--    });--}}

        CKEDITOR.addCss('figure[class*=easyimage-gradient]::before { content: ""; position: absolute; top: 0; bottom: 0; left: 0; right: 0; }' +
            'figure[class*=easyimage-gradient] figcaption { position: relative; z-index: 2; }' +
            '.easyimage-gradient-1::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 66, 174, 234, .72 ) 100% ); }' +
            '.easyimage-gradient-2::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 228, 66, 234, .72 ) 100% ); }');

        CKEDITOR.replace('body', {
            extraPlugins: 'easyimage',
            removePlugins: 'image',
            removeDialogTabs: 'link:advanced',
            toolbar: [{
                name: 'document',
                items: ['Undo', 'Redo']
            },
                {
                    name: 'styles',
                    items: ['Format']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Strike','Rename', '-', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'insert',
                    items: ['EasyImageUpload']
                }
            ],
            height: 630,
            // uploadUrl: '/uploads/imgs',
            cloudServices_uploadUrl: 'https://33333.cke-cs.com/easyimage/upload/',
            // Note: this is a token endpoint to be used for CKEditor 4 samples only. Images uploaded using this token may be deleted automatically at any moment.
            // To create your own token URL please visit https://ckeditor.com/ckeditor-cloud-services/.
            cloudServices_tokenUrl: 'https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt',

            easyimage_styles: {
                gradient1: {
                    group: 'easyimage-gradients',
                    attributes: {
                        'class': 'easyimage-gradient-1'
                    },
                    label: 'Blue Gradient',
                    icon: 'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/gradient1.png',
                    iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/hidpi/gradient1.png'
                },
                gradient2: {
                    group: 'easyimage-gradients',
                    attributes: {
                        'class': 'easyimage-gradient-2'
                    },
                    label: 'Pink Gradient',
                    icon: 'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/gradient2.png',
                    iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/hidpi/gradient2.png'
                },
                noGradient: {
                    group: 'easyimage-gradients',
                    attributes: {
                        'class': 'easyimage-no-gradient'
                    },
                    label: 'No Gradient',
                    icon: 'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/nogradient.png',
                    iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/hidpi/nogradient.png'
                }
            },
            easyimage_toolbar: [
                'EasyImageFull',
                'EasyImageSide',
                'EasyImageGradient1',
                'EasyImageGradient2',
                'EasyImageNoGradient',
                'EasyImageAlt'
            ],
            removeButtons: 'PasteFromWord'
        });
    </script>
@endsection
