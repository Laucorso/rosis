<x-web transaction="{{$background}}">
<div class="main">
    <section class="module bg-dark-60 shop-page-header" data-background="{{asset('images/'.$background)}}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="module-title font-alt">{{__($title)}}</h1>
                    {{--<div class="module-subtitle font-serif">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</div>--}}
                </div>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6">
                    @isset( $filters )
                    <style>
                        #filter:hover {
                            color:chocolate;
                        }
                    </style>
                    <h4 id="filter" onclick="myFunction(event)" role="button"><i class="xf xf-filter xf-lg"></i>Filtros</h4>
                    @endisset
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                        <input type="text" class="form-control form-control-lg" placeholder="{{__('Buscar...')}}" onkeyup="searchProduct(event)">
                    </div>
                </div>
            </div>
            <hr class="divider-w mb-4">
            <div class="row">
                @isset( $filters )
                <div id="filters" class="col-2">
                    <h6>Tamaño</h6>
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">XL 90-135cm</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">L 60-90cm</label>
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
                @endisset
                @if(0)
                <style>
                    .shop-item-image img {
                        -webkit-mask-image: url(images/heart.png);
                        mask-image: url(images/heart.png);
                        -webkit-mask-size:contain;
                        mask-size:contain;
                        -webkit-mask-position:center;
                        mask-position:center;
                        -webkit-mask-repeat: no-repeat;
                        mask-repeat: no-repeat;    
                    }
                </style>
                @endif
    
                <div class="col">
                    <div class="row multi-columns-row">                        
                        @foreach ($products as $item)
                        <x-shop-gallery-item :item="$item"/>
                        @endforeach
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
        function myFunction(e) {
            e.preventDefault();
            $("#filters").toggle();
        }           
        function searchProduct(e) {
            if( $(e.target).val() == '' ) {
                $('.shop-item').show();
            } else {
                $('.shop-item').each( function( index ){
                    if( $(this).data('search').toUpperCase().search($(e.target).val().toUpperCase()) == -1 )
                        $(this).hide()
                    else
                        $(this).show()
                });
            }
        }
    </script>
@endpush
</x-web>