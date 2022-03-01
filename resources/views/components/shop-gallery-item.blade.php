<div class="col-6 col-md-3 shop-item" data-search="{{$item['search'] ?? ''}}">
    <div class="shop-item-image"><img width="600" height="750" src="{{asset('resources/'.$item['image'])}}" loading="lazy" alt="{{$item['name-'.locale()]}}"/>
        <div class="shop-item-detail">
            @if( $item['tag'] != 'soldout' )
            <a class="btn btn-b mb-5 px-2 w-75" href="{{localized_route('buy/{id}',['id'=>$item['slug-'.locale()]])}}">
                <i class="xf xf-cart"></i> {{__('Comprar')}}
            </a>
            @endif
            <a class="btn btn-b px-2 w-75" href="{{localized_route('show/{id}',['id'=>$item['slug-'.locale()]])}}">
                <i class="xf xf-eye"></i> {{__('Ver más')}}
            </a>
        </div>
    @if( $item['tag'] == 'onsale' )
        <span class="onsale">{{__('¡OFERTA!')}}</span>
    @endif
    @if( $item['tag'] == 'soldout' )
        <span class="onsale">{{__('soldout')}}</span>
    @endif
    </div>
    <div class="shop-item-title font-alt"><a href="{{localized_route('show/{id}',['id'=>$item['slug-'.locale()]])}}">{{$item['name-'.locale()]}}</a></div>
    @if( $item['tag'] == 'onsale' )
        <div><del>{{number_format($item['prices'][1],2)}} €</del><span class="shop-item-price"> {{number_format($item['prices'][0],2)}} €</span></div>
    @else
        @if ( count($item['prices'] ) > 1 )
            <div class="shop-item-price">{{__('Desde')}} {{number_format($item['prices'][0],2)}} €</div>                               
        @else
            <div class="shop-item-price">{{number_format($item['prices'][0],2)}} €</div>                                
        @endif
    @endif
</div>                       
