<x-admin icon="fa-share-square" title="Redirecciones" action="{{route('admin.redirections')}}">
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-share-square"></i> Redirecciones</h6>
            <div class="btn btn-success btn-sm" role="button" onclick="event.preventDefault();$('#modal').modal('show')">Añadir</div>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Url origen</th>
                            <th>Url destino</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $redirections as $redirection )
                        <tr style="cursor:zoom-in" onclick="getRecord('{{$redirection->id}}')">
                            <td>{{$redirection->from}}</td>
                            <td>{{$redirection->to}}</td>
                            <td>{{$redirection->code}}<span style="cursor:pointer" class="float-right text-danger" onclick="deleteRecord(event,'{{$redirection->id}}')"><i class="fa fa-trash-alt"></i></span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary"><i class="fa fa-share-square"></i> Redirección</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <label class="form-label-sm">Url origen</label>
                        <input type="text" class="form-control form-control-sm" name="from" required>
                      </div>
                      <div class="form-group">
                        <label class="form-label-sm">Url destino</label>
                        <input type="text" class="form-control form-control-sm" name="to" required>
                      </div>
                      <div class="form-group">
                        <label class="form-label-sm">Tipo</label>
                        <select class="custom-select custom-select-sm" name="type">
                            <option value="301">301 Moved Permanently</option>
                            <option value="302">302 Found</option>
                            <option value="303">303 See Other</option>
                            <option value="307">307 Temporary Redirect</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" name="cmd" value="save" onclick="$('#modal').modal('hide');">Guardar</button>
                </div>
            </div>
        </div>
    </div>      
@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
$('#modal').on('shown.bs.modal', function (event) {
    $('input[name=from]').focus();
});
function getRecord( id ) {
    $.post("{{route('admin.redirections')}}",{_token:"{{csrf_token()}}",cmd:"get",id:id},function(data){
        $('input[name=id]').val(data.id);
        $('input[name=from]').val(data.from);
        $('input[name=to]').val(data.to);
        $('select[name=type]').val(data.code);
        $('#modal').modal('show');
    });
}
function deleteRecord( e, id ) {
    e.preventDefault();
    e.stopPropagation();
    $.post("{{route('admin.redirections')}}",{_token:"{{csrf_token()}}",cmd:"del",id:id},function(data){
        location.reload();
    });
}
</script>
@endpush
</x-admin>