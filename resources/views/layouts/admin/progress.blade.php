<pre>{{$text}}</pre>
<div class="progress">
    <div class="progress-bar" role="progressbar" style="width:{{(($value/$total)*100)}}%" aria-valuenow="{{$value}}" aria-valuemin="0" aria-valuemax="{{$total}}"></div>
</div>
<input type="hidden" name="value" value="{{$value}}">
<script>
    var data = $("#target").serializeArray();
    data.push( { "name" : "cmd", "value" : "step"} );
    $("#progress").load( $("#target").attr("action"),data,function( response, status, xhr ) {
        if(status == 'error') {
            $('#progress').html(xhr.responseText);
        }
    });    
</script>