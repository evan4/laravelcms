@extends('layouts.backend.main') 
@section('title', 'MyBlog | Blog index') 
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blog
            <small>Display All blog posts</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li class="active">
                <a href="{{ route('backend.blog.index') }}">Blog</a>
            </li>
            <li>
                All Posts
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    @if(!$postsCount)
                    <div class="alert alert-danger">
                        <strong>No records found</strong>
                    </div>
                    @else
                    <div class="box-header clearfix ">
                        <div class="pull-left">
                            <a href="{{ route('backend.blog.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>Add new</a>
                        </div>
                        <div class="pull-right">
                            <ul class="list-inline">
                                <?php $links = []; ?>
                                @foreach($statusList as $key => $value)
                                    @if($value)
                                        <?php $selected = Request::get('status') == $key ? 'selected-status' : ''; ?>
                                        <?php $links[] = "<li><a class=\"{$selected}\" href=\"?status={$key}\">".ucwords($key)." ({$value})</a></li>"; ?>
                                    @endif
                                @endforeach
                                {!! implode('', $links); !!}
                            </ul>
                        </div>
                    </div>
                    <div class="box-body ">
                        @include('backend.partials.message') 
                        @if($onlyTrashed)
                        @include('backend.blog.table-trash') 
                        @else
                        @include('backend.blog.table')
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="pull-left">
                            {{ $posts->appends(Request::query())->render() }}
                        </div>
                        <div class="pull-right">
                            <?php $postsCount ?>
                            <small>{{ $postsCount }} {{ str_plural('Item', $postsCount) }}</small>
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