<x-admin.modal icon='fa-qrcode' title='Código QR' id="{{$item->id ?? 0}}" validate>
    <input type="hidden" name="id" value="{{$item->id ?? 0}}">
    <div class="row">
        <div class="form-group col-12">
            <label class="mb-0">Código</label>
            <input type="text" class="form-control form-control-sm" name="name" value="{{$item->name ?? ''}}" autofocus required>
        </div>
    </div>
</x-admin.modal>