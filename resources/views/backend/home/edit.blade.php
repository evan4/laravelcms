@extends('layouts.backend.main') 
@section('title', 'MyBlog | Edit account') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Account
            <small>Edit account</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li class="active">Edit account</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            @include('backend.partials.message')

            <form action="{{ route('update-account', ['id' => $user->id]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                @include('backend.users.form', ['hideRole' => true])
            </form>
        </div>
    </section>
</div>
@endsection
