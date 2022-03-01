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
                <x-shop-gallery-item :item="$item"/>
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