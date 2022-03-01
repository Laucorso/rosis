<x-admin icon="fa-cog" title="Importar Productos" action="import-products" :message="isset($message) ? $message : null">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-12">
                    <label>Seleccione el fichero XLM a importar</label>
                    @push('styles')
                    <style>
                        .xmmdropbox {
                            min-height: 100px !important;
                        }
                    </style>
                    @endpush
                    <div id="importFile"></div>
                </div>                                
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <button class="btn btn-success">Subir Fichero</button>
                    <input type="hidden" name="cmd" value="load-file">
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        new XMMDropbox('importFile',{extensions:['xml'],preview:false});
    </script>
    @endpush
</x-admin>