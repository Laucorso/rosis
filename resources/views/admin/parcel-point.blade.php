<x-admin icon="fa-gift" title="Paquetes" action="/parcel-point">
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-database"></i> Paquetes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Número</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form id="target" method="post" action="{{ secure_url('/complements') }}" enctype="multipart/form-data">
        @csrf
    </form>

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>
@endpush
</x-admin>