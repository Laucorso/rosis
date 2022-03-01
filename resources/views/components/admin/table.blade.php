<x-admin :icon="$icon" :title="$title" :action="$action">
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa {{$icon}}"></i> {{$title}}</h6>
            @isset($item)
            <a class="btn btn-sm btn-success shadow-sm" onclick="sendPost('new',0)"><i class="fa fa-plus-circle"></i> Añadir {{$item}}</a>
            @endisset
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    {{$slot}}
                </table>
            </div>
        </div>
    </div>
    @isset( $modal )
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog {{$modal ?? ''}}" role="document">
            <div id="xcontents" class="modal-content">
                <div class="modal-header text-primary">
                    <h5 class="modal-title" id="ModalLabel">Conectando con el servidor...</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Cargando...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div id="xcontents" class="card shadow mb-4" style="display:none">
    </div>
    @endisset
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable( {
            initComplete: function () {
                this.api().columns().every( function () {
                    if( this.footer().textContent != '' ) {
                        var column = this;
                        var select = $('<select><option value=""></option></select>').appendTo( $(column.footer()).empty() ).on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search( val ? '^'+val+'$' : '', true, false ).draw();
                        });
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        });
                    }
                });
            }
        });
    });
    </script>
@isset($modal)
    <script>
    function sendPost( cmd, id ) {
        $('#Modal').modal('show');
        let data = $('#target').serializeArray();
        data.push( { "name" : "action", "value" : cmd } );
        data.push( { "name" : "id", "value" : id } );
        $('#Modal .modal-content').load( $('#target').attr('action'),data,function( response, status, xhr ) {
            if(status == 'error') {
                $('#Modal .modal-body div').html('ERROR');
            }
        });
    }
    $('#Modal').on('shown.bs.modal', function (event) {
        $("[autofocus]").focus();
    });
    </script>
@else
    <script>
    function sendPost( cmd, id ) {
        $('#Modal').modal('show');
        let data = $('#target').serializeArray();
        data.push( { "name" : "action", "value" : cmd } );
        data.push( { "name" : "id", "value" : id } );
        $('#xcontents').load( $('#target').attr('action'),data,function( response, status, xhr ) {
            $("[autofocus]").focus();
        });
    }
    </script>
@endisset
@endpush
</x-admin>