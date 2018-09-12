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
                @if( check_user_permissions($request, 'blog@edit', $post->id))
                <a href="{{ route('backend.blog.edit', $post->id) }}" class="btn btn-xs btn-default pull-left">
                    <i class="fa fa-edit"></i>
                </a>
                @else
                <a href="{{ route('backend.blog.edit', $post->id) }}" class="btn btn-xs btn-default pull-left disabled">
                    <i class="fa fa-edit"></i>
                </a>
                @endif
                <form action="{{ route('backend.blog.destroy', ['id' => $post->id]) }}"
                     method="post" class="pull-right">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    @if( check_user_permissions($request, 'blog@destroy', $post->id))
                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                    @else
                    <button type="button" class="btn btn-xs btn-danger disabled">
                        <i class="fa fa-trash"></i>
                    </button>
                    @endif
                </form>
            </td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title }}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>                                        | {!! $post->publicationLabel() !!}
            </td>
        </tr>

        @endforeach
    </tbody>
</table>