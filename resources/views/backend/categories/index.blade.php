@extends('layouts.backend.main') 
@section('title', 'MyBlog | Categories') 
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small>Display All Categories</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li class="active">
                <a href="{{ route('backend.categories.index') }}">Categories</a>
            </li>
            <li>All Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    @if(!$categoriesCount)
                    <div class="alert alert-danger">
                        <strong>No records found</strong>
                    </div>
                    @else
                    <div class="box-header clearfix ">
                        <div class="pull-left">
                            <a href="{{ route('backend.categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>Add new</a>
                        </div>
                        <div class="pull-right">
                           
                        </div>
                    </div>
                    <div class="box-body ">
                    @include('backend.partials.message') 
                    
                    @include('backend.categories.table')
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-left">
                            {{ $categories->appends(Request::query())->render() }}
                        </div>
                        <div class="pull-right">
                            <small>{{ $categoriesCount }} {{ str_plural('Item', $categoriesCount) }}</small>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
@endsection
