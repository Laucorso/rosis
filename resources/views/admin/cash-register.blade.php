<x-admin icon="fa-cash-register" title="Caja Registradora" action="cash-register">
    <div class="card shadow w-50">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cash-register"></i> Caja Registradora</h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12">
                    <input type="text" id="total" placeholder="Total" class="form-control form-control-lg text-right" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <input type="text" id="pagado" placeholder="Pagado" class="form-control form-control-lg text-right">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <input type="text" id="cambio" placeholder="Cambio" class="form-control form-control-lg text-right" disabled>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <button class="btn btn-success btn-lg w-100" onclick="calcular(event)">CALCULAR</button>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    function calcular( event ) {
        event.preventDefault();
        event.stopPropagation();
        let cambio = document.getElementById('pagado').value - document.getElementById('total').value;
        document.getElementById('cambio').value = parseFloat(cambio).toFixed(2);
    }
    document.addEventListener('keydown', function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            event.stopPropagation();
            if( event.originalTarget.id == 'total' )
                document.getElementById('pagado').focus();
            if( event.originalTarget.id == 'pagado' ) {
                let cambio = document.getElementById('pagado').value - document.getElementById('total').value;
                document.getElementById('cambio').value = parseFloat(cambio).toFixed(2);
            }
        }
    });
</script>
@endpush
</x-admin>