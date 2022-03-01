<?php $locale = locale(); ?>
<div class="shop-item p-2 rounded-lg" {{--style="background-color:#f1c40f80;box-shadow: 2px 8px 16px 2px rgba(0,0,0,1);"--}}>
    <div class="shop-item-image"><img width="300" height="375" src="{{asset('resources/'.$item['image'])}}" alt="{{$item['name-'.$locale]}}"/></div>
    <div class="shop-item-detail">
        <a class="btn btn-b mb-1 mb-sm-5 px-2 w-75" href="{{localized_route('buy/{id}',['id'=>$item['slug-'.$locale]])}}">
            <i class="xf xf-cart"></i><br><span> {{__('Comprar')}}</span>
        </a>
        <a class="btn btn-b px-2 w-75" href="{{localized_route('show/{id}',['id'=>$item['slug-'.$locale]])}}">
            <i class="xf xf-eye"></i><br><span> {{__('Ver más')}}</span>
        </a>
        <div class="shop-item-title font-alt"><a href="{{localized_route('show/{id}',['id'=>$item['slug-'.$locale]])}}">{{$item['name-'.$locale]}}</a></div>
        @if( $item['tag'] == 'onsale' )
            <div><del>{{number_format($item['prices'][0],2)}} €</del><span class="shop-item-price"> {{number_format($item['prices'][1],2)}} €</span></div>
        @else
            @if( count($item['prices'] ) > 1 )
                <div class="shop-item-price">{{__('Desde')}} {{number_format($item['prices'][0],2)}} €</div>                               
            @else
                <div class="shop-item-price">{{number_format($item['prices'][0],2)}} €</div>                                
            @endif
        @endif        
    </div>
</div>
