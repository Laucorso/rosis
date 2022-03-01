<input type="hidden" name="product_type" value="{{$type}}">
<div class="card-header d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-magic"></i> Simple {{$type}}</h6>
    <div class="form-group float-right m-0">
        <div class="custom-control custom-switch">
            <input type="checkbox" name="active" class="custom-control-input" id="customSwitch1">
            <label class="custom-control-label" for="customSwitch1">activo</label>
        </div>
    </div>    
</div>
<div class="card-body">
    <div class="row mb-2">
        <div class="col-2">
            <input type="text" class="form-control form-control-sm" name="product_sku" placeholder="Referencia" autofocus>
        </div>
        <div class="input-group input-group-sm col-2">
            <input type="text" class="form-control text-right" name="product_price" placeholder="Precio">
            <div class="input-group-append">
                <div class="input-group-text">€</div>
            </div>
        </div>
        @isset($categories)
        <div class="col-2">
            <style type="text/css">
                .multiselect-container,.multiselect-native-select .btn-group
                {
                    width: 100%;
                }
            </style>
            <select data-placeholder="Seleccionar categorias..." class="custom-select custom-select-sm w-100" id="product_categories" name="product_categories[]" multiple="multiple">
                @foreach( $categories as $cat=>$sub )
                <optgroup label="{{$cat}}" class="group">
                    @foreach( $sub as $key=>$val )
                    <option value="0{{$key}}0">{{$val}}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
            <script>
                $('#product_categories').multiselect({
                    enableCollapsibleOptGroups: true
                });
            </script>
        </div>
        @else
        <div class="col-2"></div>
        @endisset
        <div class="col-6">
            <input type="text" class="form-control form-control-sm" name="product_tags" placeholder="Etiquetas">
        </div>
    </div>
    <div class="row mb-2">
        <div class="input-group input-group-sm col-4">
            <div class="input-group-prepend">
                <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
            </div>
            <input type="text" class="form-control" name="product_name_es" placeholder="Nombre">
        </div>
        <div class="input-group input-group-sm col-4">
            <div class="input-group-prepend">
                <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
            </div>
            <input type="text" class="form-control" name="product_name_ca" placeholder="Nom">
        </div>
        <div class="input-group input-group-sm col-4">
            <div class="input-group-prepend">
                <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
            </div>
            <input type="text" class="form-control" name="product_name_en" placeholder="Name">
        </div>
    </div>
    <div class="row mb-2">
        <div class="input-group input-group-sm col-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></span>
            </div>
            <textarea class="form-control form-control-sm" name="product_description_es" placeholder="Descripción"></textarea>
        </div>
        <div class="input-group input-group-sm col-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></span>
            </div>
            <textarea class="form-control form-control-sm" name="product_description_ca" placeholder="Descripció"></textarea>
        </div>
        <div class="input-group input-group-sm col-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></span>
            </div>
            <textarea class="form-control form-control-sm" name="product_description_en" placeholder="Description"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="product_images">Imagenes 4:5</label>
                <div id="product_images"></div>
            </div>    
        </div>
        <script>
            var productImages = new XMMDropbox('product_images',{extensions:['webp','gif','png','jpg','jpeg','svg'],preview:true,multiple:true})
        </script>
    </div>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-sm btn-success float-right" type="submit" name="cmd" value="create">Crear</button>
        </div>
    </div>
</div>
