@extends('layouts.backend.main') 
@section('title', 'MyBlog | Delete confirmation') 
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Users
            <small>Delete confirmation</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard </a>
            </li>
            <li>
                <a href="{{ route('backend.users.index') }}">user</a>
            </li>
            <li class="active">
                Delete confirmation
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="{{ route('backend.users.destroy', ['id' => $user->id]) }}" 
                method="post">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <div class="col-xs-8">
                    <div class="box">
                        <div class="box-body">
                            <p>You have specified this user for deletion</p>
                            <p>ID #({{$user->id}}) {{$user->name}}</p>
                            <p>What shoud be done with content own by this user?</p>

                            <div class="radio">
                                <label>
                                    <input type="radio" id="delete" name="delete_option" 
                                    value="delete" checked> Delete all content
                                </label>
                                <label>
                                    <input type="radio" id="attribute" name="delete_option" value="attribute">Attribute content to: 
                                    <select name="" id="">
                                        @foreach($users as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger">Delete confirmation</button>
                            <a href="{{ route('backend.users.index' )}}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
               
            </form>
        </div>
    </section>
</div>
@endsection