<x-admin icon="fa-cog" title="Importar Productos (3/3)" action="import-products" :message="isset($message) ? $message : null">
    <div class="row">
        <div class="col-3">
            <div class="card shadow mb-4">
                <div class="card-header">
                    Productos
                </div>
                <div class="card-body">
                    <div class="table-responsive small">
                        <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>SKU</th>
                                </tr>
                            </thead>
                            @push('styles')
                            <style>
                                tr.selected {
                                    background-color: rgb(0,0,0,0.8) !important;
                                    color: white !important;
                                }
                            </style>
                            @endpush
                            <tbody style="cursor:pointer">
                                @foreach( $products as $product )
                                <tr data-index="{{$product->id}}" onclick="trOnClick(event)">
                                    <td>{{json_decode($product->name,true)['es']}}</td>
                                    <td>{{$product->sku}}</td>
                                </tr>                               
                                @endforeach
                            </tbody>
                        </table>
                        @push('scripts')
                        <script>
                            const products = <?php echo json_encode($products) ?>;
                            $(document).ready(function() {
                                $('#dataTable').DataTable();
                            });
                            function trOnClick( e ) {
                                var target = $(e.target).closest("tr");
                                $("tr.selected").removeClass('selected');
                                target.addClass('selected');
                                var i = $(e.target).closest("tr").attr('data-index');
                                //console.log(products);
                                if( typeof products[i].productsku === 'string' )
                                    $("input[name=product-sku]").val(products[i].productsku);
                                else
                                    $("input[name=product-sku]").val('');
                                $("input[name=product-name-es]").val(products[i].productname);
                                $("input[name=product-slug-es]").val(products[i].slug);
                                if( typeof products[i].description === 'string' )
                                    $("textarea[name=product-description-es]").val(products[i].description);
                                else
                                    $("textarea[name=product-description-es]").val('');
                                $("input[name=product-price]").val(products[i].price);
                                if( typeof products[i].saleprice !== 'object' )
                                    $("input[name=product-sale-price]").val(products[i].saleprice);
                                else
                                    $("input[name=product-sale-price]").val('');
                                if( typeof products[i].quantity !== 'object' )
                                    $("input[name=product-stock]").val(products[i].quantity);
                                else
                                    $("input[name=product-stock]").val('');
                                if( typeof products[i].weight !== 'object' )
                                    $("input[name=product-weight]").val(products[i].weight);
                                else
                                    $("input[name=product-weight]").val('');
                                if( typeof products[i].height !== 'object' )
                                    $("input[name=product-dimensions]").val(products[i].height+'x'+products[i].width+'x'+products[i].length);
                                else
                                    $("input[name=product-dimensions]").val('');
                                // Images
                                var input = '[{"file":null,"src":"'+products[i].featuredimage+'"}';
                                if( typeof products[i].productgallery === 'string' ) {
                                    var gallery = products[i].productgallery.split('|');
                                    gallery.forEach( function(item){
                                        input += ',{"file":null,"src":"'+item+'"}';
                                    });
                                }
                                input += ']';
                                productImages.set(input);
                                // SEO
                                console.log(products[i]);
                                if( typeof products[i]["wordpressseo-seotitle"] === 'string' )
                                    $("input[name=product-seo-title-es]").val(products[i]["wordpressseo-seotitle"]);
                                else
                                    $("input[name=product-seo-title-es]").val('');
                                if( typeof products[i]["wordpressseo-metadescription"] === 'string' )
                                    $("input[name=product-seo-description-es]").val(products[i]["wordpressseo-metadescription"]);
                                else
                                    $("input[name=product-seo-description-es]").val('');

                            }
                        </script>
                        @endpush
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-9">
            @include('layouts.admin.product-card')
        </div>
    </div>
</x-admin>