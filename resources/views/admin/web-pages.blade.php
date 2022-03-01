<x-admin icon="fa-book" title="Páginas" action="web-pages" :message="isset($message) ? $message : null">
    <div id="xcontent">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive small">
                    <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Slug</th>
                                <th>Nombre</th>
                                <th>Categorias</th>
                                <th>Etiquetas</th>
                                <th>Activa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $web_pages as $web_page )
                            <tr role="button" onclick="sendCmd(event,'get',{{$web_page->id}})">
                                <td>{{$web_page->type}}</td>
                                <td>{{$web_page->es_slug}}</td>
                                <td>{{$web_page->getName()}}</td>
                                <td>{{$web_page->categories}}</td>
                                <td>{{$web_page->tags}}</td>
                                <td>{!! $web_page->active_icon !!}<span style="cursor:pointer" class="float-right text-danger" onclick="sendCmd(event,'del','{{$web_page->id}}')" title="Eliminar"><i class="fa fa-trash"></i></span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('#dataTable_filter').append("<div class='btn btn-sm btn-outline-success ml-2 mb-1' role='button' onclick='sendCmd(event,\"get\",0)'>Nueva Página</div>");
    });
    function sendCmd(e,cmd,data) {
        e.preventDefault();
        e.stopPropagation();
        $('.page-loader').show();
        if( cmd == 'del' ) {
            $.post('web-pages',{_token:"{{csrf_token()}}",cmd:cmd,data:data},function(){
                location.reload();
            });
        } else {
            $('#xcontent').load('web-pages',{_token:"{{csrf_token()}}",cmd:cmd,data:data},function(){
                $('.page-loader').hide();
            });
        }
    }
    </script>
@endpush
</x-admin>