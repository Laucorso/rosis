<x-admin icon="fa-list" title="Categorias" action="/categories">
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Categorias</h6>
            <button class="btn btn-sm btn-success float-right" name="cmd" value="save">Guardar</button>
        </div>
        <div class="card-body">
            <textarea id="code" name="code" style="display:none;">{{$content}}</textarea>
        </div>
    </div>
@push('styles')
<link href="{{ asset('css/codemirror.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ asset('js/codemirror.js') }}"></script>
<script src="{{ asset('js/matchbrackets.js') }}"></script>
<script src="{{ asset('js/htmlmixed.js') }}"></script>
<script src="{{ asset('js/xml.js') }}"></script>
<script src="{{ asset('js/javascript.js') }}"></script>
<script src="{{ asset('js/css.js') }}"></script>
<script src="{{ asset('js/clike.js') }}"></script>
<script src="{{ asset('js/php.js') }}"></script>
<script>
$(document).ready(function() {
    var myCodeMirror = CodeMirror.fromTextArea(code,{
        lineNumbers: true,
        matchBrackets: true,
        mode: {
            name: 'php',
            startOpen: true
        },
        indentUnit: 4,
        indentWithTabs: true
    });
    myCodeMirror.setSize(null,800);
});
</script>
@endpush
</x-admin>