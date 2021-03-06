@extends('layouts.backend.main') 
@section('title', 'MyBlog | Users') 
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small>Display All Users</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li class="active">
                <a href="{{ route('backend.users.index') }}">Users</a>
            </li>
            <li>All Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header clearfix ">
                        <div class="pull-left">
                            <a href="{{ route('backend.users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>Add new</a>
                        </div>
                        <div class="pull-right">
                           
                        </div>
                    </div>
                    <div class="box-body ">
                    @include('backend.partials.message') 
                    
                    @include('backend.users.table')
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-left">
                            {{ $users->appends(Request::query())->render() }}
                        </div>
                        <div class="pull-right">
                            <small>{{ $usersCount }} {{ str_plural('Item', $usersCount) }}</small>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
@endsection
