@push('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{asset('js/product.js')}}"></script>
@endpush        
<x-web solid title="{{$product->getLocalizedSEO('title')}}" description="{{$product->getLocalizedSEO('description')}}">
    <form id="target" method="post" action="{{localized_route('cart')}}">
        @csrf
        @if( $product->type == 'variable' )
        <input type="hidden" name="id" value="{{$product->getVariationId('BASIC')}}">
        @else
        <input type="hidden" name="id" value="{{$product->id}}">
        @endif
        <input type="hidden" name="items" value="">
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mb-sm-40">
                    <div class="flexslider">
                        <ul class="slides">
                        @foreach ( $product->getImages() as $image )
                            <li data-thumb="{{asset('resources/'.$image)}}" style="margin-left:0;"><img src="{{asset('resources/'.$image)}}" alt="Single Product"/></li>                        
                        @endforeach
                        </ul>
                    </div>
                    @if( count($product->getItems() ) )
                    <h5 class="font-alt">{{__('Se compone de:')}}</h5>
                    <div class="row">
                        @foreach( $product->getItems() as $item )
                        <div class="col-3 text-center">
                            <img src="{{asset($item['image'])}}" width="300" height="300" alt="{{$item['name']}}">
                            @if( $item['qty'] > 1 )
                                {{$item['qty'].' x '.$item['name']}}
                            @else
                            {{$item['name']}}
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="product-title font-alt">{{$product->getLocalizedName()}}<i class="xf xf-_f104" style="color: #794903;"></i></h2>
                            @if( !$product->active )
                            <h3>{{__('soldout')}}</h3>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            @if( $product->type == 'simple' && $product->sale_price && $product->sale_price < $product->price )
                            <h3 class="font-alt price">
                                <small><del>{{number_format($product->price,2)}} €</del></small> <b><span id="selected_price">{{number_format($product->sale_price,2)}}</span> €</b></h3>
                            @else
                            <h3 class="font-alt price">
                                @if( $product->type == 'variable' && $product->hasSizes() )
                                <span id="selected_option">BASIC </span>
                                @endif
                                <b><span id="selected_price">{{number_format($product->price,2)}}</span> €</b></h3>
                            @endif
                        </div>
                    </div>
                    @if( $product->type == 'variable' && $product->hasSizes() )
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <h5 class="font-alt">{{__('Elige un tamaño')}}</h5>
                            <div id="size_option" class="row mb-2">
                                <div class="col-4 work-item">
                                    <div class="border rounded-lg selected" onclick="optionClick(event,'BASIC',{{$product->getPrice('BASIC')}},{{$product->getVariationId('BASIC')}})">
                                        <div class="work-image"><img src="/images/rambasic.png" alt="Basic"></div>
                                        <div class="work-caption font-alt">
                                            <h3 class="work-title">Basic</h3>
                                            <div class="work-title">{{number_format($product->getPrice('BASIC'),2)}} €</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 work-item">
                                    <div class="border rounded-lg" onclick="optionClick(event,'PREMIUM',{{$product->getPrice('PREMIUM')}},{{$product->getVariationId('PREMIUM')}})">
                                        <div class="work-image"><img src="/images/rampremium.png" alt="Premium"></div>
                                        <div class="work-caption font-alt">
                                            <h3 class="work-title">Premium</h3>
                                            <div class="work-title">{{number_format($product->getPrice('PREMIUM'),2)}} €</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 work-item">
                                    <div class="border rounded-lg" onclick="optionClick(event,'SUPREME',{{$product->getPrice('SUPREME')}},{{$product->getVariationId('SUPREME')}})">
                                        <div class="work-image"><img src="/images/ramsupreme.png" alt="Supreme"></div>
                                        <div class="work-caption font-alt">
                                            <h3 class="work-title">Supreme</h3>
                                            <div class="work-title">{{number_format($product->getPrice('SUPREME'),2)}} €</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @isset($producto['variations'])
                            <select class="form-control input-lg" style="cursor: pointer;">
                            @foreach ( $producto['variations'] as $variation )
                                <option value="{{$variation['id']}}">{{$variation['name']}} {{number_format($variation['price'],2)}} €</option>
                            @endforeach
                            </select>
                            @endisset
                        </div>
                    </div>
                    @endif
                    @if( $product->active )
                    @if( count($product->getComplements()) )
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="font-alt">Añade Complementos</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mb-20">
                            <div class="owl-carousel">
                            @foreach( $product->getComplements() as $complement )
                                <div class="item" data-id="{{$complement['id']}}" data-price="{{$complement['prices'][0]}}">
                                    <img src="{{asset('resources/'.$complement['image'])}}" alt="Complement image"/>
                                    <div class="text">{{$complement['name']}}</div>
                                    <div class="price">{{number_format($complement['prices'][0],2)}}</div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row mb-20">
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-9 text-right">{{__('Precio de producto')}}</div>
                                <div class="col-sm-3 price text-right"><span id="price">0.00</span> €</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 text-right">{{__('Total de opciones adicionales')}}</div>
                                <div class="col-sm-3 price text-right"><span id="options_price">0.00</span> €</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 text-right">{{__('Total del pedido')}}</div>
                                <div class="col-sm-3 price text-right"><span id="total">0.00</span> €</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-4 mb-sm-20">
                            <div class="def-number-input number-input safari_only">
                                <button onclick="event.preventDefault();this.parentNode.querySelector('input[type=number]').stepDown();calc()" class="minus"></button>
                                <input class="quantity" min="0" name="qty" value="1" type="number"">
                                <button onclick="event.preventDefault();this.parentNode.querySelector('input[type=number]').stepUp();calc()" class="plus"></button>
                            </div>
                        </div>
                        <div class="col-8"><button class="btn btn-block btn-round btn-b" href="{{localized_route('cart')}}">Añade al Carrito</button></div>
                    </div>
                    @endif
                    <div class="row mb-20">
                        <div class="col-12 d-flex align-items-center mb-2">
                            <img width="64px" src="{{asset('images/hands.png')}}" alt="Imagen Manos">
                            <h6 class="ml-2">¿Sabías que comprando este producto haces del mundo un lugar mejor?</h6>
                        </div>
                        <div class="col-12">
                            Por cada compra, una parte económica se destina a organizaciones que apoyan a colectivos vulnerables u otros que emprenden iniciativas de impacto global. 
                            <a href="{{localized_route('about-us')}}">Más información</a>.
                        </div>
                    </div>
                    @if( $product->isBouquet() )
                    <div class="row">
                        <div class="col-sm-4">
                            <img width="64px" class="mx-auto d-block" src="{{asset('images/food.png')}}" alt="Imagen Nutrientes">
                            <div class="text-center">Bolsita de <b>nutrientes gratis</b> para que tu ramo se conserve más tiempo</div>
                        </div>
                        <div class="col-sm-4">
                            <img width="64px" class="mx-auto d-block" src="{{asset('images/truck.png')}}" alt="Imagen Transporte">
                            <div class="text-center">Entregamos los <b>365 días</b> del año. <b>Envío gratis de lunes a viernes</b> y envío urgente para el mismo día</div>
                        </div>
                        <div class="col-sm-4">
                            <img width="64px" class="mx-auto d-block" src="{{asset('images/info.png')}}" alt="Imagen Información">
                            <div class="text-center"><b>Cada flor es exclusiva</b> en su color y forma, por lo que podría variar respecto a la imagen</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @if( $desc = $product->getLocalizedDescription() )
            <div class="row mt-70">
                <div class="col-sm-12">
                    <h6 style="text-align: justify;text-justify: inter-word;"><?php echo $desc;?></h6>
                </div>
            </div>
            @endif
        </div>
    </section>
    </form>
    <hr class="divider-d"/>
    @include('layouts.last-section')
</x-web>