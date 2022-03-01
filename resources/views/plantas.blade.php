<?php 
$filters = [

];
?>
<x-web>
<div class="maain">
    <section class="module bg-dark-60 shop-page-header" data-background="{{asset('images/plantas.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="module-title font-alt">Plantas</h1>
                    <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>
                </div>
            </div>
        </div>
    </section>
        <section class="module-small">
          <div class="container">
              <div class="row mb-4">
                    <div class="col">
                    <style>
                        #filter:hover {
                            color:chocolate;
                        }
                    </style>
                    <h4 id="filter" onclick="myFunction(event)" role="button"><i class="xf xf-filter xf-lg"></i>Filtros</h4>
                    </div>
              </div>
              <script>
                    function myFunction(e) {
                        e.preventDefault();
                        $("#filters").toggle();
                    }           
              </script>
              <div class="row">
                  <div id="filters" class="col-2">
                      <h6>Tamaño</h6>
                      <form>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          XL 90-135cm
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">
                          L 60-90cm
                        </label>
                      </div>
                      <hr class="divider-w">
                      <div class="custom-control custom-switch">
                        <label class="custom-control-label" for="customSwitch21">Pet friendy</label>
                        <input type="checkbox" class="custom-control-input" id="customSwitch21">
                      </div>
                      <hr class="divider-w">
                      <button type="button" class="btn btn-outline-success">Limpiar</button>
                    </form>
                  </div>
                  <div class="col">
                    <div class="row multi-columns-row">
                        @foreach ($plants as $item)
                        <div class="col-6 col-md-3">
                            <div class="shop-item">
                                <div class="shop-item-image"><img width="300" height="375" src="{{asset('images/'.$item['image'])}}" alt="{{$item['name']}}"/>
                                    <div class="shop-item-detail"><a class="btn btn-round btn-b" href="{{route('ramos')}}/{{$item['slug']}}"><i class="xf xf-cart"></i> Comprar</a></div>
                                    @if( $item['tag'] == 'onsale' )
                                        <span class="onsale">¡OFERTA!</span>
                                    @endif
                                </div>
                                <div class="shop-item-title font-alt"><a href="{{route('ramos')}}/{{$item['slug']}}">{{$item['name']}}</a></div>
                                @if( $item['tag'] == 'onsale' )
                                    <div><del>{{number_format($item['prices'][0],2)}} €</del><span class="shop-item-price"> {{number_format($item['prices'][1],2)}} €</span></div>
                                @else
                                    @if ( count($item['prices'] ) > 1 )
                                        <div class="shop-item-price">Desde {{number_format($item['prices'][0],2)}} €</div>                               
                                    @else
                                        <div class="shop-item-price">{{number_format($item['prices'][0],2)}} €</div>                                
                                    @endif
                                @endif
                            </div>
                        </div>                       
                        @endforeach
                    </div>
                    <div class="row">
              <div class="col-sm-12">
                <div class="pagination font-alt"><a href="#"><i class="fa fa-angle-left"></i></a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i class="fa fa-angle-right"></i></a></div>
              </div>
            </div>
          </div>
              </div>
          </div>
        </section>


    <hr class="divider-d">
    @include('layouts.last-section')
</div>
@push('scripts')
    <script>
        $("#filters").hide();
    </script>
@endpush
</x-web>