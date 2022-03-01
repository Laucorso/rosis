<x-admin icon="fa-cog" title="Importar Productos (2/3)" action="import-products" :message="isset($message) ? $message : null">
    <input type="hidden" name="file" value="{{$file}}">
    <div class="card shadow mb-4">
        <div class="card-body">       
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" onchange="selectAll(event)"/></th>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>SKU</th>
                            <th>Slug</th>
                            <th>Categoría</th>
                            <th>Tipo</th>
                            <th>Precio</th>
                            <th>Rebajado</th>
                            <th>Neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td><input class="xcb" type="checkbox" name="id-{{$item['wordpressId']}}"/></td>
                            <td>{{$item['wordpressId']}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['sku']}}</td>
                            <td>{{$item['slug']}}</td>
                            <td>{{$item['category']}}</td>
                            <td>{{$item['type']}}</td>
                            <td>{{$item['price']}}</td>
                            <td>{{$item['saleprice']}}</td>
                            <td>{{$item['netprice']}}</td>
                        </tr>                               
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <button class="btn btn-success" name="cmd" value="import-file" onclick="myOnClick(event)">Importar</button>
                </div>
            </div>    
        </div>
    </div>
    @push('scripts')
    <script>
        var table;
        function selectAll(e) {
            console.log(e);
            $(".xcb").prop('checked',e.target.checked);
        }
        function myOnClick(e) {
            //e.preventDefault();
            $(".card").hide();
            table.destroy();
        }
        $(document).ready(function() {
            table = $('#dataTable').DataTable({
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "columnDefs": [ {"targets": 0, "orderable": false},{"targets": '_all', "orderable": true} ],
                "order": [[ 1, "asc" ]]
            });
        });
    </script>
    @endpush
</x-admin>