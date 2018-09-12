@extends('layouts.backend.main') 
@section('title', 'MyBlog | User create') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Users
            <small>Add new user</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('backend.users.index') }}">user</a>
            </li>
            <li class="active">
                Add new
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="{{ route('backend.users.store') }}" method="post" class="box-body" id="post-form">
                @csrf
               @include('backend.users.form')
            </form>
        </div>
    </section>
</div>
@endsection