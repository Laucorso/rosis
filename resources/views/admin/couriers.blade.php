<x-admin icon="fa-truck" title="Transportistas" action="/couriers">
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-database"></i> Transportistas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>
@endpush
</x-admin>