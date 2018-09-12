@extends('layouts.backend.main') 
@section('title', 'MyBlog | Edit post') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Blog
            <small>Edit post</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('backend.blog.index') }}">Blog</a>
            </li>
            <li class="active">
                Edit post
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="{{ route('backend.blog.update', ['id' => $post->id]) }}" method="post" class="box-body" 
            id="post-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @include('backend.blog.form')
            </form>
        </div>
    </section>
</div>
@endsection

@include('backend.blog.scripts')
