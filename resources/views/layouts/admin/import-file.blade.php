<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-12">
                <label>Seleccione el fichero XLM a importar</label>
                @push('styles')
                <style>
                    .xmmdropbox {
                        min-height: 110px !important;
                    }
                </style>
                @endpush
                <div id="import_file"></div>
            </div>                                
        </div>
        <button class="btn btn-success" onclick="startFn(event)">Importar</button>
    </div>
</div>
@push('scripts')
<script>
    new XMMDropbox('import_file',{extensions:['xml'],preview:false});
</script>
@endpush
