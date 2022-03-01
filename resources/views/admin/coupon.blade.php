<x-admin.modal icon='fa-tag' title='Cupón' id="{{$coupon->id ?? 0}}" validate>
    <div class="row">
        <input type="hidden" name="id" value="{{$coupon->id ?? 0}}">
        <div class="form-group col-sm-12">        
            <label class="small mb-0">Código</label>
            <input type="text" class="form-control form-control-sm" name="reference" value="{{$coupon->reference ?? ''}}" required autofocus>
            <div class="invalid-feedback">
                El código es necesario y debe ser único.
            </div>
        </div>
        <div class="form-group col-sm-12">        
            <label class="small mb-0">Nombre</label>
            <input type="text" class="form-control form-control-sm" name="name" value="{{$coupon->name ?? ''}}">
        </div>
        <div class="form-group col-sm-12">        
            <label class="small mb-0">Email</label>
            <input type="email" class="form-control form-control-sm" name="email" value="{{$coupon->email ?? ''}}" required>
        </div>
        <div class="form-group col-sm-12">        
            <label class="small mb-0">Valor</label>
            <div class="input-group input-group-sm">
                <input type="number" class="form-control form-control-sm" name="value" value="{{$coupon->value ?? ''}}" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">%</span>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <label class="small mb-0">Válido desde el día</label>
            <input type="text" class="form-control form-control-sm datepicker" data-date-format="dd-mm-yyyy" data-date-language="es" name="starts" value="{{isset($coupon->starts) ? $coupon->starts->format('d-m-Y') : ''}}">
        </div>
        <div class="form-group col-sm-6">
            <label class="small mb-0">hasta el día</label>
            <input type="text" class="form-control form-control-sm datepicker" data-date-format="dd-mm-yyyy" data-date-language="es" name="ends" value="{{isset($coupon->ends) ? $coupon->ends->format('d-m-Y') : ''}}">
        </div>
        <div class="form-group col-sm-12">
            <div class="custom-control custom-switch">
                <input type="checkbox" name="active" class="custom-control-input" id="activeSwitch" {{$coupon->active?'checked':''}}>
                <label class="custom-control-label small" for="activeSwitch">activo</label>
            </div>
        </div>
    </div>
    <script>
        $('.datepicker').datepicker();
    </script>
</x-admin.modal>