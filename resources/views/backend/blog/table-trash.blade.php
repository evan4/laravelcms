<table class="table table-bordered">
    <thead>
        <tr>
            <td width="80">Action</td>
            <td>Title</td>
            <td width="120">Author</td>
            <td width="150">Category</td>
            <td width="170">Date</td>
        </tr>
    </thead>
    <tbody>
        <?php  $request = request(); ?>
        @foreach($posts as $post)
        <tr>
            <td>
                <form action="{{ route('backend.blog.force-destroy', ['id' => $post->id]) }}"
                    method="post" class="pull-right">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    @if( check_user_permissions($request, 'blog@forceDestroy', $post->id))
                    <button type="submit" titke="Delete permanent" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                    @else
                    <button type="button" titke="Delete permanent" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-times"></i>
                    </button>
                    @endif
                </form>
                <form action="{{ route('backend.blog.restore', ['id' => $post->id]) }}"
                    method="post" class="pull-right">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    @if( check_user_permissions($request, 'blog@restore', $post->id))
                    <button type="button" title="Restore" href="{{ route('backend.blog.restore', $post->id) }}" 
                        class="btn btn-xs btn-default pull-left disabled">
                        <i class="fa fa-refresh"></i>
                    </button>
                    @else
                    <button type="submit" title="Restore" href="{{ route('backend.blog.restore', $post->id) }}" 
                        class="btn btn-xs btn-default pull-leftd">
                        <i class="fa fa-refresh"></i>
                    </button>
                    @endif
                </form>
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
        </tr>

        @endforeach
    </tbody>
</table>