@extends('main.layouts.master')
@section('title', 'ورود')
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

                                    <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4 Tanha">ورود</h3>

                                    <form class="mx-1 mx-md-4" action="{{route('login')}}" method="post">
                                        @csrf
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
                                                <label class="form-label float-end Tanha" for="password">رمزعبور</label>
                                                <div class="input-icons">
                                                <input  required type="password" name="password" id="password" class="form-control password-field @error('password') is-invalid @enderror " />
                                                    <i class="fa fa-eye visible-icon" id="toggle-password" onclick="visible(this)">
                                                    </i>
                                                </div>
                                                @error('password')
                                                <strong class="text-danger vazir-rb float-end mt-1" dir="rtl" style="font-weight: 500;font-size: 15px">
                                                    {{$message}}
                                                </strong>
                                                @enderror
                                            </div>
                                            <i class="fa-thin auth-icon fa-lock fa-lg ms-3 fa-fw"></i>
                                        </div>

                                            <div class="form-check d-flex justify-content-center mb-5">
                                                <input  class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                                <label class="form-check-label" for="form2Example3">
                                                    من را به خاطر بسپار
                                                </label>
                                            </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">ورود</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-sm-10 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="{{asset('/uploads/defaults/login.jpg')}}"
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
