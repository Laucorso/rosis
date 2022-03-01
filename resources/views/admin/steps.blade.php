<x-admin icon="fa-cog" title="Importar Productos" action="import-products" :message="isset($message) ? $message : null">
    <pre>{{$label}}</pre> 
    <input type="hidden" name="cmd" value="steps">
    <input type="hidden" name="step" value="{{$num}}">
    <input type="hidden" name="data" value="{{$data}}">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{($num/$total)*100}}%" aria-valuenow="{{($num/$total)*100}}" aria-valuemin="0" aria-valuemax="{{$total}}"></div>
    </div>
    @push('scripts')
    <script>
        $("#target").submit();
    </script>
    @endpush
</x-admin>