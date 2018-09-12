<div class="col-xs-12">
    <div class="box">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{$category->title}}"> @if($errors->has('title'))
            <span class="help-block">{{ $errors->first('title') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{$category->slug}}"> @if($errors->has('slug'))
            <span class="help-block">{{ $errors->first('slug') }}</span> @endif
        </div>
    </div>
    <div class="box-footer">
        <div class="form-grpup">
        <input type="submit" class="btn btn-primary"  value="{{ $category->exists ? 'Update' : 'Save'}}">
        <a href="{{ route('backend.categories.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>