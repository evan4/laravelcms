<article class="post-comments" id="post-comments">
        <h3><i class="fa fa-comments"></i> {{ $post->commentsNumber('Comment') }}</h3>

        <div class="comment-body padding-10">
            <ul class="comments-list">
                @foreach($postComments as $comment)
                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                        <h4>{{ $comment->author_name }} <small>{{ $comment->date }}</small></h4>
                        </div>
                    </div>
                    <div class="comment-content">{!! $comment->body_html !!}</div>
                </li>
                @endforeach()
            </ul>
            <nav>
                {!! $postComments->links() !!}
            </nav>
        </div>
        @if (session('message'))
            <div class="alert alert-info">{{ session('message') }}</div>
        @endif
        <div class="comment-footer padding-10">
            <h3>Leave a comment</h3>
            <form action="{{ route('blog.comments', ['slug'=>$post->slug]) }}" method="post">
                @csrf
                <div class="form-group required {{ $errors->has('author_name') ? 'has-error' : '' }}">
                    <label for="author_name">Name</label>
                    <input type="text" name="author_name" id="author_name" class="form-control">
                    @if($errors->has('author_name'))
                    <span class="help-block">{{ $errors->first('author_name') }}</span> 
                    @endif
                </div>
                <div class="form-group required {{ $errors->has('author_email') ? 'has-error' : '' }}">
                    <label for="author_email">Email</label>
                    <input type="email" name="author_email" id="author_email" class="form-control">
                    @if($errors->has('author_email'))
                    <span class="help-block">{{ $errors->first('author_email') }}</span> 
                    @endif
                </div>
                <div class="form-group">
                    <label for="author_url">Website</label>
                    <input type="text" name="author_url" id="author_url" class="form-control">
                </div>
                <div class="form-group required {{ $errors->has('body') ? 'has-error' : '' }}">>
                    <label for="body">Comment</label>
                    <textarea name="body" id="body" rows="6" class="form-control"></textarea>
                    @if($errors->has('body'))
                    <span class="help-block">{{ $errors->first('body') }}</span> 
                    @endif
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <input type="submit" class="btn btn-lg btn-success" value="Leave a comment">
                    </div>
                    <div class="pull-right">
                        <p class="text-muted">
                            <span class="required">*</span>
                            <em>Indicates required fields</em>
                        </p>
                    </div>
                </div>
            </form>
        </div>

    </article>