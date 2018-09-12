@if(session('message'))
<div class="alert alert-info">
    {{ session('message') }}
</div>
@elseif(session('error-message'))
<div class="alert alert-danger">
    {{ session('message') }}
</div>
@elseif(session('trash-message'))
<div class="alert alert-info">
    <?php list($message, $postId) = session('trash-message'); ?>
    <form action="{{ route('backend.blog.restore', ['id' => $postId]) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        {{ $message }}
        <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i>Undo</button>
    </form>
</div>
@endif