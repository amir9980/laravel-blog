@extends('Admin.layouts.master')
@section('title','دسته بندی ها')

@section('content')

    @include('Admin.layouts.categories',['categories'=>$categories])

@endsection
