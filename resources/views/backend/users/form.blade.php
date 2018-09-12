<div class="col-xs-12">
    <div class="box">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}"> 
            @if($errors->has('title'))
            <span class="help-block">{{ $errors->first('name') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{$user->slug}}"> 
            @if($errors->has('title'))
            <span class="help-block">{{ $errors->first('slug') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}"> 
            @if($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" 
            value=""> 
            @if($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span> @endif
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" class="form-control" name="password_confirmation" 
            id="password_confirmation" 
            value=""> 
            @if($errors->has('password_confirmation'))
            <span class="help-block">{{ $errors->first('password_confirmation') }}</span> @endif
        </div>
        
        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
            <label for="role">Role</label>
            @if($user->exists && 
                ($user->id === config('cms.default_user_id') || isset($hideRole) ) )
            <p>{{$user->roles->first()->display_name }}</p>
            <input type="hidden" name="role" value="{{ $user->roles->first()->id}}">
            @else
            <select name="role" id="role" class="form-control">
                <option value="">Choose a role</option>
                @foreach($roles as $key => $value)
                @if($user->exists && $user->roles->first()->id === $key)
                <option value="{{ $key }}" selected>{{ $value }}</option>
                @else
                <option value="{{ $key }}">{{ $value }}</option>
                @endif
                @endforeach
            </select>
            @endif
            @if($errors->has('role'))
            <span class="help-block">{{ $errors->first('role') }}</span> 
            @endif
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" name="bio" id="bio">{{$user->bio}}</textarea>
        </div>
    </div>
    <div class="box-footer">
        <div class="form-grpup">
        <input type="submit" class="btn btn-primary"  value="{{ $user->exists ? 'Update' : 'Save'}}">
        <a href="{{ route('backend.users.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>