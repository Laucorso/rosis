<x-admin icon="fa-book" title="Productos" action="products" :message="isset($message) ? $message : null">
    <input type="hidden" name="datatable_page" value="{{$dataTablePage ?? 0}}">
    <div class="row">
        <div class="col-3">
            <div class="card shadow mb-4">
                <div class="card-header  d-flex align-items-center justify-content-between py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase"><i class="fa fa-book"></i> Selecciona un Producto</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive small">
                        <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
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
                                </tr>                               
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
        <div id="card" class="col-9">
            @include('layouts.admin.product-card')
        </div>
    </div>
@push('scripts')
    <script>
        const products = <?php echo json_encode($products) ?>;
        $(document).ready(function() {
            const dataTable = $('#dataTable').DataTable({
                lengthChange: false,
                pageLength: 15,
                //pagingType: 'simple',
                info: false,
                language: {
                    oPaginate: {
                        sNext: '<i class="fa fa-forward"></i>',
                        sPrevious: '<i class="fa fa-backward"></i>',
                        sFirst: '<i class="fa fa-step-backward"></i>',
                        sLast: '<i class="fa fa-step-forward"></i>'
                    }
                },
            });
            dataTable.page(parseInt($("input[name=datatable_page]").val())).draw('page');
            const dtwr = $('#dataTable_wrapper .row')[0];
            $(dtwr.childNodes[1]).removeClass('col-md-6');
            dtwr.childNodes[0].remove();
            $( "#target" ).submit(function( event ) {
                $("input[name=datatable_page]").val(dataTable.page());
            });
        });
        function trOnClick( e ) {
            var target = $(e.target).closest("tr");
            $("tr.selected").removeClass('selected');
            target.addClass('selected');
            var i = $(e.target).closest("tr").attr('data-index');
            $.post($("#target").attr("action"),{_token:"{{csrf_token()}}",cmd:"get",data:i},function(data){
                let prod = JSON.parse(data);
                $("#product_categories option").prop("selected", false);
                $.each(prod.categories.split("|"), function(i,e) {
                    $("#product_categories option[value='" + e + "']").prop("selected", true);
                });
                $('#product_categories').multiselect('refresh');

                $("input[name=id]").val(prod.id);
                if( prod.active )
                    $("input[name=active]").prop('checked',true);
                else
                    $("input[name=active]").prop('checked',false);

                $("select[name=product_type]").val(prod.type);
                $("select[name=product_type]").change();
                $("select[name=product_parent]").val(prod.parent_id);
                $("input[name=product_sku]").val(prod.sku);
                $("input[name=product_tags]").val(prod.tags);
                let name = JSON.parse(prod.name);
                $("input[name=product_name_es]").val(name.es);
                $("input[name=product_name_ca]").val(name.ca);
                $("input[name=product_name_en]").val(name.en);

                $("input[name=product_slug_es]").val(prod.es_slug);
                $("input[name=product_slug_ca]").val(prod.ca_slug);
                $("input[name=product_slug_en]").val(prod.en_slug);
                
                let desc = JSON.parse(prod.description);
                $("textarea[name=product_description_es]").val(desc.es);
                $("textarea[name=product_description_ca]").val(desc.ca);
                $("textarea[name=product_description_en]").val(desc.en);

                $("input[name=product_price]").val(Number(prod.price).toFixed(2)+' €');
                $("input[name=product_sale_price]").val(Number(prod.sale_price).toFixed(2)+' €');
                $("input[name=product_stock]").val(prod.stock);
                $("input[name=product_weight]").val(prod.weight);
                $("input[name=product_dimensions]").val(prod.dimensions);
                // Images
                var input = '[';
                var gallery = prod.images.split('|');
                if( prod.type == 'raw' ) {
                    gallery.forEach( function(item){
                        input += '{"file":null,"src":"'+item+'"},';
                    });
                } else {
                    gallery.forEach( function(item){
                        input += '{"file":null,"src":"resources/'+item+'"},';
                    });
                }
                if( prod.images != '' )
                    productImages.set(input.replace(/.$/,"]"));
                else
                    productImages.clear();
                // SEO
                if( prod.seo != '') {
                    let seo = JSON.parse(prod.seo);
                    $("input[name=product_seo_title_es]").val(seo.es.title);
                    $("input[name=product_seo_title_ca]").val(seo.ca.title);
                    $("input[name=product_seo_title_en]").val(seo.en.title);
                    $("input[name=product_seo_description_es]").val(seo.es.description);
                    $("input[name=product_seo_description_ca]").val(seo.ca.description);
                    $("input[name=product_seo_description_en]").val(seo.en.description);
                }
            });
        }
        $("#target").on('submit',function(event){
            event.preventDefault();
            var formData = new FormData(document.getElementById('target'));
            formData.append('cmd',event.originalEvent.submitter.value);
            $.ajax({
                url: $('#target').attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#card').html(data);
                },
                error: function(xhr,text,error) {
                    $('#card').html('<div class="alert alert-danger" role="alert">'+xhr.responseJSON.message+'</div>');
                }
            });
        });
        $('#product_categories').multiselect({
            enableCollapsibleOptGroups: true
        });
    </script>
@endpush
</x-admin>