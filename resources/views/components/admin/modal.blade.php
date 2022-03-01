<div class="modal-header text-primary ">
    <h5 class="modal-title" id="userModalLabel"><i class="fa {{$icon}}"></i> {{$title}}</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    {{$slot}}
</div>
<div class="modal-footer">
    <div id="buttons">
        @if( $id )
            <button type="submit" name="action" value="save" class="btn btn-primary btn-sm">Actualizar</button>
            <button id="confirm" class="btn btn-danger btn-sm">Eliminar</button>
        @else
            <button type="submit" name="action" value="save" class="btn btn-primary btn-sm">Añadir</button>
        @endif
    </div>
    <div id="sure" style="display: none;">
        <span>
            <b>¿Está seguro en eliminar este registro?</b>
            <button id="no" type="submit" name="action" value="cancel" class="btn btn-success btn-sm ml-2">No</button>
            <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Si</button>
        </span>
    </div>
    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cerrar</button>
</div>
@isset( $validate )
<input type="hidden" name="action">
<script>
    var validates = false;
    var form = $("#target");
    form.attr('novalidate',true);
    form.addClass('needs-validation');
    form.on('submit',function(event){
        if( typeof event.originalEvent !== 'undefined' )
            $("[name=action]").val(event.originalEvent.submitter.value);
        if( validates === false )
            postValidity();
        if( this.checkValidity() === false ) {
            validates = false;
        }
        if( validates === false ) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.addClass('was-validated');
    });
    $('#Modal').on('hidden.bs.modal', function (event) {
        form.removeClass('was-validated');
    });
    function postValidity() {
        let data = $('#target').serializeArray();
        data.push({"name":"action","value":"validate"});
        $.post($("#target").attr("action"),data,function(response){
            validates = response.validates;
            if( validates === true ) {
                $('#target').submit();
            }
            if( validates === false ) {
                let field = $('[name='+response.field+']')[0];
                field.setCustomValidity("invalid");
                $('[name='+response.field+']').parent().children('.invalid-feedback').text(response.message);
            }
        });
    }
</script>
@endisset
<script>
    $("#confirm").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        $("#sure").show();
        $("#buttons").hide();
    });
    $("#no").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        $("#sure").hide();
        $("#buttons").show();
    });
</script>
