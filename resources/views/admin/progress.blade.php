<x-admin :icon="$icon" :title="$title" :action="$action">
    <div id="progress">
    @isset( $text )
        <pre>{{$text}}</pre>
    @endisset
    @isset( $data )
        <input type="hidden" name="data" value="{{$data}}">
    @endisset
    @isset( $layout )
        @include( 'layouts.'.$layout )
    @else
        <button class="btn btn-success" onclick="startFn(event)">{{$button??'Empezar'}}</button>
    @endisset
    <input type="hidden" name="cmd" value="start">
    </div>
    <script>
        function startFn(e) {
            e.preventDefault();
            var formData = new FormData(document.getElementById('target'));
            $.ajax({
                url: $('#target').attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#progress').html(data);
                },
                error: function(xhr,text,error) {
                    $('#progress').html('<div class="alert alert-danger" role="alert">'+xhr.responseJSON.message+'</div>');
                }
            });
        };
    </script>
</x-admin>