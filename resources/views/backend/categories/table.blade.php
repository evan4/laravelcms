<table class="table table-bordered">
    <thead>
        <tr>
            <td width="80">Action</td>
            <td>Category name</td>
            <td width="120">Post count</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>
                <a href="{{ route('backend.categories.edit', $category->id) }}" class="btn btn-xs btn-default pull-left">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('backend.categories.destroy', ['id' => $category->id]) }}"
                     method="post" class="pull-right">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    @if($category->id == config('cms.default_category_id'))
                    <button type="submit" class="btn btn-xs btn-danger" disabled>
                        <i class="fa fa-times"></i>
                    </button>
                    @else
                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                    @endif
                </form>
            </td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->posts->count() }}</td>
        </tr>

        @endforeach
    </tbody>
</table>