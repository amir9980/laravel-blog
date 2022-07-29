@extends('main.layouts.master')
@section('title', 'ثبت نام')
@section('style')
<style>
    body {
        background-color: #eee;
    }
</style>
@endsection
@section('content')

<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-sm-10 col-lg-7 col-xl-5 order-2 order-lg-1">

                                <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 Tanha">ثبت نام</h3>

                                <form class="mx-1 mx-md-4" action="{{route('register')}}" method="post">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label float-end Tanha" for="form3Example1c">نام کاربری</label>
                                            <input   required type="text" name="username" id="form3Example1c" class="form-control @error('username') is-invalid @enderror " />
                                            @error('username')
                                                <strong class="text-danger vazir-rb float-end mt-1" dir="rtl" style="font-weight: 500;font-size: 15px">
                                                   {{$message}}
                                                </strong>
                                            @enderror
                                        </div>
                                        <i class="fa-thin auth-icon fa-user fa-lg ms-3 fa-fw"></i>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label float-end Tanha" for="form3Example1c">نام و نام خانوادگی</label>
                                            <input  required dir="auto" type="text" name="name" id="form3Example1c" class="form-control @error('name') is-invalid @enderror " />
                                            @error('name')
                                                <strong class="text-danger vazir-rb float-end mt-1" dir="rtl" style="font-weight: 500;font-size: 15px">
                                                   {{$message}}
                                                </strong>
                                            @enderror
                                        </div>
                                        <i class="fa-thin auth-icon fa-id-card fa-lg ms-3 fa-fw"></i>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label float-end Tanha" for="form3Example3c">پست الکترونیک</label>
                                            <input  required type="email" name="email" id="form3Example3c" class="form-control @error('email') is-invalid @enderror " />
                                            @error('email')
                                                <strong class="text-danger vazir-rb float-end mt-1" dir="rtl" style="font-weight: 500;font-size: 15px">
                                                   {{$message}}
                                                </strong>
                                            @enderror
                                        </div>
                                        <i class="fa-thin auth-icon fa-envelope fa-lg ms-3 fa-fw"></i>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label float-end Tanha" for="form3Example4c">رمزعبور</label>
                                            <input  required type="password" name="password" id="form3Example4c" class="form-control @error('password') is-invalid @enderror " />
                                            @error('password')
                                                <strong class="text-danger vazir-rb float-end mt-1" dir="rtl" style="font-weight: 500;font-size: 15px">
                                                   {{$message}}
                                                </strong>
                                            @enderror
                                        </div>
                                        <i class="fa-thin auth-icon fa-lock fa-lg ms-3 fa-fw"></i>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label float-end Tanha" for="form3Example4cd">تکرار رمز</label>
                                            <input  required type="password" name="password_confirmation" id="form3Example4cd" class="form-control" />
                                        </div>
                                        <i class="fa-thin auth-icon fa-key fa-lg ms-3 fa-fw"></i>
                                    </div>

{{--                                    <div class="form-check d-flex justify-content-center mb-5">--}}
{{--                                        <input required class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />--}}
{{--                                        <label class="form-check-label" for="form2Example3">--}}
{{--                                            I agree l statements in <a href="#!">Terms of service</a>--}}
{{--                                        </label>al--}}
{{--                                    </div>--}}

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">ثبت نام</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-sm-10 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="{{asset('/uploads/defaults/register.jpg')}}"
                                     class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
