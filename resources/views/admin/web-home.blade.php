<x-admin icon="fa-home" title="Página de Inicio" action="web-home">
    <div class="card shadow">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="header-tab" data-toggle="tab" href="#header" role="tab" aria-controls="header" aria-selected="true"><i class="fa fa-h-square"></i> Cabecera</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="buquets-tab" data-toggle="tab" href="#buquets" role="tab" aria-controls="buquets" aria-selected="false"><i class="xf xf-bunch-flowers"></i> Ramos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="plants-tab" data-toggle="tab" href="#plants" role="tab" aria-controls="plants" aria-selected="false"><i class="fa fa-leaf"></i> Plantas</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="donations-tab" data-toggle="tab" href="#donations" role="tab" aria-controls="donations" aria-selected="false"><i class="fa fa-euro-sign"></i> Donaciones</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="popup-tab" data-toggle="tab" href="#popup" role="tab" aria-controls="popup" aria-selected="false"><i class="fa fa-square"></i> Popup</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false"><i class="fa fa-search"></i> SEO</a>
                </li>
            </ul>
            <div class="tab-content border border-top-0 rounded-bottom small bg-white">
                {{-- HEADER --}}
                <div class="p-4 tab-pane fade show active" id="header" role="tabpanel" aria-labelledby="header-tab">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Titulo</label>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                                    </div>
                                    <input type="text" class="form-control" name="header-title-es" value="{{$settings['header-title-es']}}" autofocus>
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                                    </div>
                                    <input type="text" class="form-control" name="header-title-ca" value="{{$settings['header-title-ca']}}">
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                                    </div>
                                    <input type="text" class="form-control" name="header-title-en" value="{{$settings['header-title-en']}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Subtitulo</label>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                                    </div>
                                    <input type="text" class="form-control" name="header-subtitle-es" value="{{$settings['header-subtitle-es']}}">
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                                    </div>
                                    <input type="text" class="form-control" name="header-subtitle-ca" value="{{$settings['header-subtitle-ca']}}">
                                </div>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                                    </div>
                                    <input type="text" class="form-control" name="header-subtitle-en" value="{{$settings['header-subtitle-en']}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @for( $n = 0; $n < 6; $n++ )
                        <div class="form-group col-2">
                            <label for="header-product-1">Producto {{$n+1}}</label>
                            <select class="custom-select custom-select-sm" id="header-product-{{$n+1}}" name="header-product-{{$n+1}}">
                                <option value="0">Seleccionar producto...</option>
                                @foreach( $products as $product )
                                <option value="{{$product->id}}"{{ isset($settings['promotes'][$n]['id']) && $product->id == $settings['promotes'][$n]['id'] ? ' selected' : ''}}>{{json_decode($product->name,true)['es']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endfor
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Imagen de fondo</label>
                            <div id="header-background">
                                <img src="{{$settings['header-background']}}">
                            </div>
                        </div>                                
                    </div>
                </div>
                @push('scripts')
                <script>
                    new XMMDropbox('header-background',{extensions:['webp','gif','png','jpg','svg'],preview:true})
                </script>
                @endpush
                {{-- BOUQUETS --}}
                <div class="p-4 tab-pane fade" id="buquets" role="tabpanel" aria-labelledby="buquets-tab">
                    <div class="row">
                        @for( $n=1; $n <= 4; $n++ )
                        <div class="form-group col-sm-3">
                            <label for="bouquet{{$n}}">Ramo {{$n}}</label>
                            <select id="bouquet{{$n}}" class="custom-select" name="bouquet-{{$n}}">
                                <option value="0">Seleccionar producto...</option>
                                @foreach( $products as $product )
                                @if( $product->isBouquet() )
                                    <option value="{{$product->id}}"{{ isset($settings['bouquet-'.$n]) && $product->id == $settings['bouquet-'.$n] ? ' selected' : ''}}>{{json_decode($product->name,true)['es']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        @endfor
                    </div>
                </div>
                {{-- PLANTS --}}
                <div class="p-4 tab-pane fade" id="plants" role="tabpanel" aria-labelledby="plants-tab">
                    <div class="row">
                        @for( $n=1; $n <= 4; $n++ )
                        <div class="form-group col-sm-3">
                            <label for="plant{{$n}}">Planta {{$n}}</label>
                            <select id="plant{{$n}}" class="custom-select" name="plant-{{$n}}">
                                <option value="0">Seleccionar producto...</option>
                                @foreach( $products as $product )
                                @if( $product->isPlant() )
                                    <option value="{{$product->id}}"{{ isset($settings['plant-'.$n]) && $product->id == $settings['plant-'.$n] ? ' selected' : ''}}>{{json_decode($product->name,true)['es']}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        @endfor
                    </div>
                </div>
                {{-- DONATIONS --}}
                <div class="p-4 tab-pane fade" id="donations" role="tabpanel" aria-labelledby="donations-tab">
                    <div class="form-group">
                        <label for="donations-amount">Importe Donado</label>
                        <input type="number" class="form-control" id="donations-amount" name="donations-amount" value="7500" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="donations-icons">Imagenes Asociaciones</label>
                        <div id="donations-icons"></div>
                    </div>    
                </div>
                @push('scripts')
                <script>
                    var donations = new XMMDropbox('donations-icons',{extensions:['webp','gif','png','jpg','svg'],preview:true,multiple:true})
                    var input = '[{"file":null,"src":"images/association-1.png"},{"file":null,"src":"images/association-2.png"}]';
                    donations.set(input);
                </script>
                @endpush
                {{-- POPUP --}}
                <div class="p-4 tab-pane fade" id="popup" role="tabpanel" aria-labelledby="popup-tab">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">activo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="popup-background">Imagen</label>
                        <div id="popup-background"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Contenido</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></span>
                            </div>
                            <textarea class="form-control form-control-sm" aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></span>
                            </div>
                            <textarea class="form-control form-control-sm" aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></span>
                            </div>
                            <textarea class="form-control form-control-sm" aria-label="With textarea"></textarea>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><img width="24" src="{{asset('images/ru.svg')}}"></span>
                            </div>
                            <textarea class="form-control form-control-sm" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                </div>
                @push('scripts')
                <script>
                    var db1 = new XMMDropbox('popup-background',{extensions:['webp','gif','png','jpg','svg'],preview:true})
                </script>
                @endpush
                {{-- SEO --}}
                <div class="p-4 tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    <div class="form-group">
                        <label>Titulo (máx. 60)</label>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo-title-es" maxlength="60" autofocus>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo-title-ca">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo-title-en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción (máx. 160)</label>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo-description-es" maxlength="160" autofocus>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo-description-ca">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo-description-en">
                        </div>
                    </div>
                </div>                                
            </div>
            <button class="btn btn-primary float-right mt-3" name="cmd" value="save">Guardar Cambios</button>
        </div>
    </div>
</x-admin>