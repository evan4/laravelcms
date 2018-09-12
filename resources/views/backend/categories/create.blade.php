@extends('layouts.backend.main') 
@section('title', 'MyBlog | Category create') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Categories
            <small>Add new Category</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('backend.categories.index') }}">Categories</a>
            </li>
            <li class="active">
                Add new
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="{{ route('backend.categories.store') }}" method="post" class="box-body" id="post-form">
                @csrf
               @include('backend.categories.form')
            </form>
        </div>
    </section>
</div>
@endsection

@include('backend.categories.scripts')