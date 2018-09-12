<div class="col-md-9">
    <div class="box">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}"> @if($errors->has('title'))
            <span class="help-block">{{ $errors->first('title') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{$post->slug}}"> @if($errors->has('slug'))
            <span class="help-block">{{ $errors->first('slug') }}</span> @endif
        </div>
        <div class="form-group excerpt {{ $errors->has('excerpt') ? 'has-error' : '' }}">
            <label for="excerpt">Excerpt</label>
            <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ $post->excerpt }}"> @if($errors->has('excerpt'))
            <span class="help-block">{{ $errors->first('excerpt') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" id="body">{!! $post->body !!}</textarea> @if($errors->has('body'))
            <span class="help-block">{{ $errors->first('body') }}</span> @endif
        </div>

    </div>
</div>
<div class="col-md-3">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Publish</h3>
        </div>
        <div class="box-body">
            <div class="form-group input-group date 
            {{ $errors->has('published_at') ? 'has-error' : '' }}" id='datetimepicker1'>
                <input type="text" class="form-control" name="published_at" id="published_at" placeholder="Y-m-d H:i:s">
                <span class="input-group-addon">
           <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <div>
                @if($errors->has('published_at'))
                <span class="help-block">{{ $errors->first('published_at') }}</span>
                @endif
                </div>
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-left">
                <a href="#" class="btn btn-default" id="draft-btn">Save Draft</a>
            </div>
            <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="Publish">
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Category</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Choose category</option>
                    @foreach($categories as $category)
                    @if($post->id)
                    <option value="{{ $category->id}}" selected>{{ $category->title}}</option>
                    @else
                    <option value="{{ $category->id}}">{{ $category->title}}</option>
                    @endif
                    @endforeach
                </select> @if($errors->has('category_id'))
                <span class="help-block">{{ $errors->first('category_id') }}</span> @endif
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Feature Image</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="{{ $post->image_thumb_url ? $post->image_thumb_url : '/img/200x150&text=No_Image.png' }}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" class="form-control" name="image" id="image">
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>

                @if($errors->has('image'))
                <span class="help-block">{{ $errors->first('image') }}</span> @endif
            </div>
        </div>
    </div>

</div>