@extends('admin.layouts.master')
@section('title','دسته بندی ها')

@section('content')

    @include('admin.layouts.categories',['categories'=>$categories])

@endsection
