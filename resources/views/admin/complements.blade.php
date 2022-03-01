<x-admin icon="fa-gift" title="Complementos" action="/complements">
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-database"></i> Complementos</h6>
            <a class="btn btn-sm btn-success shadow-sm" plmd="0" data-toggle="modal" data-target="#Modal">Añadir Complemento</a>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Complemento</th>
                            <th>Para</th>
                            <th>Precio</th>
                            <th>Rebaja</th>
                            <th>Stock</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img width="32px" src="{{asset('images/complement-1.jpg')}}"> Moët & Chandon Ice imperial</td>
                            <td>Todos</td>
                            <td>44,90 €</td>
                            <td>0,00 €</td>
                            <td>14</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td><img width="32px" src="{{asset('images/complement-2.jpg')}}"> Moët & Chandon Ice imperial</td>
                            <td>Todos</td>
                            <td>44,90 €</td>
                            <td>0,00 €</td>
                            <td>14</td>
                            <td>Activo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form id="target" method="post" action="{{ secure_url('/complements') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-primary">
                        <h5 class="modal-title" id="ModalLabel">Connecting to server...</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
$('#Modal').on('show.bs.modal', function (event) {
    let id = $(event.relatedTarget).attr('plmd');
    let data = $('#target').serializeArray();
    data.push( { "name" : "action", "value" : "modal"} );
    data.push( { "name" : "id", "value" : id } );
    $('#Modal .modal-content').load( $('#target').attr('action'),data,function( response, status, xhr ) {
        if(status == 'error') {
            $('#Modal .modal-body div').html('ERROR');
        }
    });
});
</script>
@endpush
</x-admin>