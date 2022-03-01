<x-admin.modal icon='fa-tag' title='Cuidados' id="{{$item->id ?? 0}}" validate>
    <input type="hidden" name="id" value="{{$item->id ?? 0}}">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fa fa-book"></i> General</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="content-ca-tab" data-toggle="tab" href="#content-ca" role="tab" aria-controls="content-ca" aria-selected="true"><img width="18" src="{{asset('images/ca.svg')}}"> Català</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="content-es-tab" data-toggle="tab" href="#content-es" role="tab" aria-controls="content-es" aria-selected="true"><img width="18" src="{{asset('images/es.svg')}}"> Español</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="content-en-tab" data-toggle="tab" href="#content-en" role="tab" aria-controls="content-en" aria-selected="true"><img width="18" src="{{asset('images/en.svg')}}"> English</a>
        </li>
    </ul>
    <div class="tab-content border border-top-0 rounded-bottom small bg-white">
        {{-- GENERAL --}}
        <div class="p-4 tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="mb-0">Producto Relacionado</label>
                    <select class="custom-select custom-select-sm" name="related_product">
                        <option value="0">Seleccionar producto...</option>
                        @foreach( $products as $product )
                        <option value="{{$product['id']}}" {{$product['id']==($item->related_product??'0') ? 'selected' : ''}}>{{$product['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label class="mb-0">Nombre Técnico</label>
                    <input type="text" class="form-control form-control-sm" name="tech_name" value="{{$item->tech_name ?? ''}}">
                </div>
                <div class="form-group col-sm-3">
                    <label class="mb-0">Familia</label>
                    <input type="text" class="form-control form-control-sm" name="family" value="{{$item->family ?? ''}}">
                </div>
                <div class="form-group col-sm-3">
                    <label class="mb-0">Ubicación</label>
                    <select class="custom-select custom-select-sm" name="ubication">
                        <option value="0">Seleccionar ubicación...</option>
                        <option value="1">Interior</option>
                        <option value="2">Exterior</option>
                        <option value="3">Interior y Exterior</option>
                    </select>
                </div>
                <div class="form-group col-sm-3">
                    <label class="mb-0">Complejidad</label>
                    <select class="custom-select custom-select-sm" name="complexity">
                        <option value="0">Seleccionar complejidad...</option>
                        <option value="1">Principiante</option>
                        <option value="2">Avanzado</option>
                        <option value="3">Experto</option>
                    </select>
                </div>
                <div class="form-group form-check col-sm-3 p-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="pet_friendly">
                    <label class="form-check-label" for="exampleCheck1">Pet Friendly?</label>
                </div>
                <div class="form-group col-12 col-md-3">
                    <label>Imagen 4:5</label>
                    <div id="header_image">
                        {{--
                            <img src="{{$web_page->header_image}}">
                        @endif
                        --}}
                    </div>
                </div>                                
            </div>
        </div>
        {{-- CATALÀ --}}
        <div class="p-4 tab-pane fade" id="content-ca" role="tabpanel" aria-labelledby="content-ca-tab">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>Nom</label>
                    <input type="text" class="form-control form-control-sm" name="name_ca" autofocus>
                </div>
                <div class="form-group col-sm-4">
                    <label>Nom Comú</label>
                    <input type="text" class="form-control form-control-sm" name="common_name_ca">
                </div>
                <div class="form-group col-sm-4">
                    <label>Origen</label>
                    <input type="text" class="form-control form-control-sm" name="origin_ca">
                </div>
                <div class="form-group col-sm-12">
                    <label>Cures / Característiques separades per |</label>
                    <input type="text" class="form-control form-control-sm" name="techs_ca">
                </div>
                <div class="form-group col-sm-12">
                    <label>Introdució</label>
                    <textarea class="form-control form-control-sm" name="intro_ca" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Llum i Temperatura</label>
                    <textarea class="form-control form-control-sm" name="care_1_ca" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Reg, Abonament i Trasplantament</label>
                    <textarea class="form-control form-control-sm" name="care_2_ca" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Malalties i Plagues</label>
                    <textarea class="form-control form-control-sm" name="care_3_ca" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Anotaciones d'en Jordi</label>
                    <textarea class="form-control form-control-sm" name="annotations_ca" rows="3"></textarea>
                </div>
            </div>
        </div>
        {{-- ESPAÑOL --}}
        <div class="p-4 tab-pane fade" id="content-es" role="tabpanel" aria-labelledby="content-es-tab">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="name_es" autofocus>
                </div>
                <div class="form-group col-sm-4">
                    <label>Nombre Común</label>
                    <input type="text" class="form-control form-control-sm" name="common_name_es">
                </div>
                <div class="form-group col-sm-4">
                    <label>Origen</label>
                    <input type="text" class="form-control form-control-sm" name="origin_es">
                </div>
                <div class="form-group col-sm-12">
                    <label>Cuidados / Características separadas por |</label>
                    <input type="text" class="form-control form-control-sm" name="techs_es">
                </div>
                <div class="form-group col-sm-12">
                    <label>Introducción</label>
                    <textarea class="form-control form-control-sm" name="intro_es" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Luz y Temperatura</label>
                    <textarea class="form-control form-control-sm" name="care_1_es" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Riego, Abonado y Trasplante</label>
                    <textarea class="form-control form-control-sm" name="care_2_es" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Enfermedades y Plagas</label>
                    <textarea class="form-control form-control-sm" name="care_3_es" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Anotaciones de Jordi</label>
                    <textarea class="form-control form-control-sm" name="annotations_es" rows="3"></textarea>
                </div>
            </div>
        </div>
        {{-- ENGLISH --}}
        <div class="p-4 tab-pane fade" id="content-en" role="tabpanel" aria-labelledby="content-en-tab">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>Name</label>
                    <input type="text" class="form-control form-control-sm" name="name_en" autofocus>
                </div>
                <div class="form-group col-sm-4">
                    <label>Common Name</label>
                    <input type="text" class="form-control form-control-sm" name="common_name_en">
                </div>
                <div class="form-group col-sm-4">
                    <label>Origin</label>
                    <input type="text" class="form-control form-control-sm" name="origin_en">
                </div>
                <div class="form-group col-sm-12">
                    <label>Care / Characteristics separated by |</label>
                    <input type="text" class="form-control form-control-sm" name="techs_en">
                </div>
                <div class="form-group col-sm-12">
                    <label>Introduction</label>
                    <textarea class="form-control form-control-sm" name="intro_en" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Lighting and Temperature</label>
                    <textarea class="form-control form-control-sm" name="care_1_en" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Watering, Fertilizing and Transplantation</label>
                    <textarea class="form-control form-control-sm" name="care_2_en" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Illnesses and Infestations</label>
                    <textarea class="form-control form-control-sm" name="care_3_en" rows="3"></textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label>Jordi's Annotations</label>
                    <textarea class="form-control form-control-sm" name="annotations_en" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
    <script>
    new XMMDropbox('header_image',{extensions:['webp','gif','png','jpg','svg'],preview:true})
    </script>
</x-admin.modal>