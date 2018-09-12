@section('scripts') @parent
<script>
    jQuery(function($) {
        "use strict";
        var simplemde1 = new SimpleMDE({
          autoDownloadFontAwesome: false,
          spellChecker: false,
          element: $("#excerpt")[0] 
        });
      var simplemde2 = new SimpleMDE({ 
        autoDownloadFontAwesome: false,
        spellChecker: false,
        element: $("#body")[0] 
      });
    
      $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        showClear: true
      });

      $('#draft-btn').on('click', function(e){
        e.preventDefault();
        $('#published_at').val('');
        $('#post-form').submit();
      })
    });

</script>
@endsection