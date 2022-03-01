<style>
    .btn-group {width: 100%;}
    .multiselect-container .multiselect-group:hover {background-color: white !important;}
    .group {text-transform: uppercase;font-weight: 800;font-size: 0.65rem;color: #b7b9cc;margin-bottom: -0.4rem;}
</style>
<div class="card">
    <div class="card-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li id="general_tab" class="nav-item" role="presentation">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fa fa-book"></i> General</a>
            </li>
            <li id="composition_tab" class="nav-item" role="presentation">
                <a class="nav-link" id="composition-tab" data-toggle="tab" href="#composition" role="tab" aria-controls="composition" aria-selected="true"><i class="fa fa-list"></i> Receta</a>
            </li>
            <li id="images_tab" class="nav-item" role="presentation">
                <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false"><i class="fa fa-images"></i> Imagenes</a>
            </li>
            <li id="seo_tab" class="nav-item" role="presentation">
                <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false"><i class="fa fa-search"></i> SEO</a>
            </li>
        </ul>
        
        <input type="hidden" name="id" value="{{$product->id ?? 0}}">
        <div class="tab-content border border-top-0 rounded-bottom small bg-white">
            {{-- GENERAL --}}
            <div class="p-4 tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="active" class="custom-control-input" id="customSwitch1" {{$product->active ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customSwitch1">activo</label>
                        </div>
                    </div>    
                </div>
    
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="product-type">Tipo</label>
                        <select class="custom-select custom-select-sm" id="product_type" name="product_type" onchange="productTypeChange(event)">
                            <option>Seleccionar tipo...</option>
                            <option value="simple" {{$product->type == 'simple' ? 'selected' : ''}}>Simple</option>
                            <option value="variable" {{$product->type == 'variable' ? 'selected' : ''}}>Variable</option>
                            <option value="variation"  {{$product->type == 'variation' ? 'selected' : ''}}>Variación</option>
                            <option value="raw" {{$product->type == 'raw' ? 'selected' : ''}}>Materia Prima</option>
                        </select>

                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-type">Producto Padre</label>
                        <select class="custom-select custom-select-sm" id="product_parent" name="product_parent" disabled>
                            <option value="0">Seleccionar padre...</option>
                            @foreach( $variables as $variable )
                            <option value="{{$variable->id}}" {{$variable->id==$product->parent_id?'selected':''}}>{{$variable->getLocalizedName('es')}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="product_categories">Categorias</label>
                        <select data-placeholder="Seleccionar categorias..." class="custom-select custom-select-sm" id="product_categories" name="product_categories[]" multiple="multiple">
                            @foreach( config('rosistirem.categories') as $cat=>$sub )
                            <optgroup label="{{$cat}}" class="group">
                                @foreach( $sub as $key=>$val )
                                <option value="0{{$key}}0" {{strpos($product->categories,'0'.$key.'0') !== false ? 'selected' : ''}}>{{$val}}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="product-order">Orden</label>
                        <input type="text" class="form-control form-control-sm" id="product-order" name="product_order" value="{{$product->order??''}}">
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="product-sku">Etiquetas (separadas por | ) (usado en los filtros de busqueda)</label>
                        <input type="text" class="form-control form-control-sm" id="product-tags" name="product_tags" value="{{$product->tags??''}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-type">Tipo Impositivo</label>
                        <select class="custom-select custom-select-sm" id="product_tax_type" name="product_tax_type">
                            <option value="10"{{$product->tax_type=='10'?' selected':''}}>10 %</option>
                            <option value="21"{{$product->tax_type=='21'?' selected':''}}>21 %</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="product-sku">SKU</label>
                        <input type="text" class="form-control form-control-sm" id="product-sku" name="product_sku" value="{{$product->sku??''}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-price">Precio</label>
                        <input type="text" class="form-control form-control-sm text-right" id="product-price" name="product_price" value="{{number_format($product->price??0,2)}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-sale-price">Precio Rebajado</label>
                        <input type="text" class="form-control form-control-sm text-right" id="product-sale-price" name="product_sale_price" value="{{number_format($product->sale_price??0,2)}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-weight">Peso (Kg)</label>
                        <input type="text" class="form-control form-control-sm text-right" id="product-weight" name="product_weight" value="{{$product->weight??''}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-dimensions">Dimensiones</label>
                        <input type="text" class="form-control form-control-sm" id="product-dimensions" name="product_dimensions" value="{{$product->dimensions??''}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-stock">Stock</label>
                        <input type="text" class="form-control form-control-sm text-right" id="product-stock" name="product_stock" value="{{$product->stock??''}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Nombre</label>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_name_es" value="{{$product->getLocalizedName('es')}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_name_ca" value="{{$product->getLocalizedName('ca')}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_name_en" value="{{$product->getLocalizedName('en')}}">
                            </div>
                            {{--<div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/ru.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_name_ru">
                            </div>--}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Slug</label>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_slug_es" value="{{$product->es_slug}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_slug_ca" value="{{$product->ca_slug}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_slug_en" value="{{$product->en_slug}}">
                            </div>
                            {{--<div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/ru.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="product_slug_ru">
                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Descripción</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="product_description_es">{!!$product->getLocalizedDescription('es')!!}</textarea>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="product_description_ca">{!!$product->getLocalizedDescription('ca')!!}</textarea>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="product_description_en">{!!$product->getLocalizedDescription('en')!!}</textarea>
                    </div>
                    {{--<div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/ru.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="product_description_ru"></textarea>
                    </div>--}}
                </div>
            </div>
            {{-- COMPOSITION --}}
            <div class="p-4 tab-pane fade" id="composition" role="tabpanel" aria-labelledby="composition-tab">
                <div class="row">
                    <div class="form-group col-sm-1">
                        <label for="quantity">Cantidad</label>
                        <input type="number" class="form-control form-control-sm" id="quantity" value="1">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="product-type">Subproducto</label>
                        <select class="custom-select custom-select-sm" id="product-subproduct">
                            <option value="0">Seleccionar...</option>
                            @foreach( $product->getRaw() as $item )
                            <option value="{{$item->id}}">{{$item->getLocalizedName('es')}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="donations-amount">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="name">
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Acción</label>
                        <button class="w-100 btn btn-outline-success btn-sm">Añadir</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="compositionTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:5%">Cantidad</th>
                                <th style="width:20%">Producto</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- IMAGES --}}
            <div class="p-4 tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                <div class="form-group">
                    <label for="product_images">Imagenes 4:5 ( La primera por la izquierda es la imagen principal )</label>
                    <div id="product_images"></div>
                </div>    
            </div>
            {{-- SEO --}}
            <div class="p-4 tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                <div class="form-group">
                    <label>Titulo (máx. 60)</label>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                        </div>
                        <input type="text" class="form-control" name="product_seo_title_es" value="{{$product->getLocalizedSEO('title','es')}}" maxlength="60" autofocus>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                        </div>
                        <input type="text" class="form-control" name="product_seo_title_ca" value="{{$product->getLocalizedSEO('title','ca')}}" maxlength="60">
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                        </div>
                        <input type="text" class="form-control" name="product_seo_title_en" value="{{$product->getLocalizedSEO('title','en')}}" maxlength="60">
                    </div>
                </div>
                <div class="form-group">
                    <label>Descripción (máx. 160)</label>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                        </div>
                        <input type="text" class="form-control" name="product_seo_description_es" value="{{$product->getLocalizedSEO('description','es')}}" maxlength="160" autofocus>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                        </div>
                        <input type="text" class="form-control" name="product_seo_description_ca" value="{{$product->getLocalizedSEO('description','ca')}}" maxlength="160">
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                        </div>
                        <input type="text" class="form-control" name="product_seo_description_en" value="{{$product->getLocalizedSEO('description','en')}}" maxlength="160">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary float-right mt-3" name="cmd" value="save">Guardar Cambios</button>
    </div>
</div>
<script>
    function productTypeChange( e ) {
        switch(e.target.value) {
            case 'simple':
                $("select[name=product-parent]").prop('disabled',true);
                $('#composition_tab').show();
                $('#seo_tab').show();
                $('#product_categories').multiselect('enable');
                $("input[name=product_price]").prop('disabled',false);
                $("input[name=product_sale_price]").prop('disabled',false);
                break;
            case 'variable':
                $("select[name=product-parent]").prop('disabled',true);
                $('#composition_tab').hide();
                $('#seo_tab').show();
                $('#product_categories').multiselect('enable');
                $("input[name=product_price]").prop('disabled',true);
                $("input[name=product_sale_price]").prop('disabled',true);
                break;
            case 'variation':
                $("select[name=product-parent]").prop('disabled',false);
                $('#composition_tab').show();
                $('#seo_tab').show();
                $('#product_categories').multiselect('disable');
                $("input[name=product_price]").prop('disabled',false);
                $("input[name=product_sale_price]").prop('disabled',false);
                break;
            case 'raw':
                $("select[name=product-parent]").prop('disabled',true);
                $('#composition_tab').hide();
                $('#seo_tab').hide();
                $('#product_categories').multiselect('disable');
                $("input[name=product_price]").prop('disabled',false);
                $("input[name=product_sale_price]").prop('disabled',true);
                break;
        }
    }
    $('#product_categories').multiselect({enableCollapsibleOptGroups:true});
    var productImages = new XMMDropbox('product_images',{extensions:['webp','gif','png','jpg','svg'],preview:true,multiple:true})
    var input = '[';
    var images = '{{$product->images}}';
    var gallery = images.split('|');
    gallery.forEach( function(item) {
        input += '{"file":"'+item+'","src":"resources/'+item+'"},';
    });
    if( images != '' )
        productImages.set(input.replace(/.$/,"]"));
</script>