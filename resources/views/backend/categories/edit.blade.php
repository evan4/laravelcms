@extends('layouts.backend.main') 
@section('title', 'MyBlog | Edit category') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Blog
            <small>Edit category</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('backend.categories.index') }}">Categories</a>
            </li>
            <li class="active">
                Edit category
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="{{ route('backend.categories.update', ['id' => $category->id]) }}" method="post" class="box-body" 
            id="post-form">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @include('backend.categories.form')
            </form>
        </div>
    </section>
</div>
@endsection
