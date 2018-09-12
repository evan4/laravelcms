@extends('layouts.backend.main') 
@section('title', 'MyBlog | Edit user') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Blog
            <small>Edit user</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('backend.users.index') }}">Users</a>
            </li>
            <li class="active">
                Edit user
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="{{ route('backend.users.update', ['id' => $user->id]) }}" method="post" class="box-body" 
            id="post-form">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @include('backend.users.form')
            </form>
        </div>
    </section>
</div>
@endsection
