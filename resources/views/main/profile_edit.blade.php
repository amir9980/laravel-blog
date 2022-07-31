@extends('main.layouts.master')
@section('title', 'ویرایش پروفایل')
@section('content')
    <div class="container">
    @error('require')
    <ul>
        <li class="bg-danger">
            <span>
                $message
            </span>
        </li>
    </ul>
    @enderror
    <div class=" rounded bg-white mt-5 mb-5">
        <div class="row justify-content-center" dir="rtl">
            <div class="col-md-6 border-right ">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <div class="d-flex">
                        <span id="upload_image" type="button" class="fa fa-edit btn btn-link" style="height: 30px;font-size: 25px;width: 120px" onclick="document.getElementById('formFile').click()"></span>
                        <button id="remove_image" style="display: none;height: 30px" onclick="clearImage()" class="btn btn-danger btn-sm mt-3">حذف</button>
                        <img id="frame" class=" mt-5" width="150px" src="{{is_null($user->profile_image)?'/uploads/defaults/profile.png':'/uploads/imgs/'.$user->profile_image}}">
                    </div>
                    <span class="font-weight-bold" style="margin-right:120px;">{{$user['name']}}</span>
                    <span class="text-black-50" style="margin-right:120px;">{{$user['email']}}</span>
                    <div class="container col-md-6">
                        <div class="mb-5">
                            <input form="profile_form" class="form-control" name="profile_image" type="file" accept="image/*" id="formFile" onchange="preview()" style="display: none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 border-right  mt-3">

                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">ویرایش اطلاعات</h4>
                    </div>

                    <form id="profile_form" action="{{route('user.update', $user->username)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")

                        <div class="col-md-12">
                            <label class="labels">نام</label><input type="text" class="form-control"  value="{{$user->name}}" name="name">
                            @error("name")
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2" >
                            <label class="labels">نام کاربری</label><input dir="ltr" type="text" class="form-control"  value="{{$user->username}}" name="username">
                            @error("username")
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-2" >
                            <label class="labels">ایمیل</label><input dir="ltr" type="text" class="form-control" value="{{$user['email']}}" name="email">
                            @error("email")
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-12 mt-2">
                            <label class="labels">بیو</label>
                            <textarea rows="5" type="text" class="form-control" placeholder="" name="bio">{{$user->profile->bio}}</textarea>
                            @error("bio")
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            @php
                            $medias = json_decode($user->profile->social_media, true);
                            @endphp
                        @foreach(['instagram' => 'اینستاگرام','telegram' => 'تلگرام','linkedin' => 'لینکدین','github' => 'گیت هاب',] as $key=>$value)
                                <label class="labels mt-2">{{$value}}</label><input dir="ltr" type="text" class="form-control" value="{{((! is_null($medias)) and key_exists($key, $medias))?$medias[$key]:''}}" name="social_media[]">
                            @endforeach
                        </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary w-75 profile-button" style="margin-top: -50px;" type="submit">ذخیره</button></div>
                    </form>
                </div>

            </div>
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
            var img_src = `{{is_null($user->profile_image)?"/uploads/defaults/profile.png":"/uploads/images/".$user->profile_image}}`;
            frame.src = img_src;

        }
    </script>
@endsection
