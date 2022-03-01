<x-web>
<style>
.video-titles {
	bottom: 230px;
	position: relative;
	display: block;
	width: 100%;
}
</style>
<div class="maain">
    <section class="home-section bg-dark-30" id="home" data-background="/images/ramos.jpg">
        <div class="video-player" data-property="{videoURL:'https://youtu.be/fxQd4KpWy2Y', containment:'.home-section', startAt:0, mute:false, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>
        <div class="video-controls-box">
          <div class="container">
            <div class="video-titles">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="module-title font-alt">Ramos de Flores</h1>
                    <div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>
                </div>
            </div>
            <div class="video-controls"><a class="fa fa-volume-up" id="video-volume" href="#">&nbsp;</a><a class="fa fa-pause" id="video-play" href="#">&nbsp;</a></div>
          </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,224L60,234.7C120,245,240,267,360,277.3C480,288,600,288,720,272C840,256,960,224,1080,197.3C1200,171,1320,149,1380,138.7L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    </section>
        <section class="module-small">
          <div class="container">
            <div class="row mb-4">
                <div class="col">
                <h4><a href="#" onclick="myFunction(event)">Filtros</a></h4>
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
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                      <label class="form-check-label" for="defaultCheck1">
                        XL 90-135cm
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                      <label class="form-check-label" for="defaultCheck1">
                        L 60-90cm
                      </label>
                    </div>
                    <hr class="divider-w">
                    <div class="custom-control custom-switch">
                      <label class="custom-control-label" for="customSwitch1">Pet friendy</label>
                      <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                    </div>
                    <hr class="divider-w">
                    <button type="button" class="btn btn-outline-success">Limpiar</button>
                </div>
                <div class="col">

            <div class="row multi-columns-row">
                @foreach ($bouquets as $item)
                <div class="col-6 col-md-3">
                    <div class="shop-item">
                        <div class="shop-item-image"><img width="300" height="375" src="{{asset('images/'.$item['image'])}}" alt="{{$item['name']}}"/>
                            <div class="shop-item-detail"><a class="btn btn-round btn-b" href="ramos-de-flores/{{$item['slug']}}"><i class="xf xf-cart"></i> Comprar</a></div>
                            @if( $item['tag'] == 'onsale' )
                                <span class="onsale">¡OFERTA!</span>
                            @endif
                        </div>
                        <div class="shop-item-title font-alt"><a href="ramos-de-flores/{{$item['slug']}}">{{$item['name']}}</a></div>
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

    $(function(){
        $(".video-player").mb_YTPlayer();
    });

    $('#video-play').click(function(event) {
        event.preventDefault();
        if ($(this).hasClass('fa-play')) {
            $('.video-player').playYTP();
        } else {
            $('.video-player').pauseYTP();
        }
        $(this).toggleClass('fa-play fa-pause');
        return false;
    });

    $('#video-volume').click(function(event) {
        event.preventDefault();
        if ($(this).hasClass('fa-volume-off')) {
            $('.video-player').YTPUnmute();
        } else {
            $('.video-player').YTPMute();
        }
        $(this).toggleClass('fa-volume-off fa-volume-up');
        return false;
    });
    </script>
@endpush
</x-web>