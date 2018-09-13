@isset($categoryName)
<div class="alert alert-info">
    <p>Category <syrong>{{ $categoryName }}</syrong></p>
</div>
@endisset

@isset($authorName)
<div class="alert alert-info">
    <p>Author <syrong>{{ $authorName }}</syrong></p>
</div>
@endisset

@if($term = request('term'))
<div class="alert alert-info">
    <p>Search result for  <syrong>{{ $term }}</syrong></p>
</div>
@endisset