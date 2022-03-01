<x-web solid transaction="{{$order->reference}}">
    <div class="main">
        <section class="module-small mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h1 class="module-title font-alt mb-2" style="color:#8c2c13">{{__('Pago')}}</h1>
                    </div>
                </div>
                <hr class="divider-w pt-3">
                <div class="row">
                    <div class="col-sm-10 offset-sm-1">
                        <h4 class="font-alt mb-2 text-center">{{__('Su pago se ha realizado con éxito')}}</h4>
                        <h5 class="font-alt mb-2 text-center">Total {{number_format($order->total,2)}} €</h5>
                        <h5 class="font-alt mb-2 text-center">Pedido Nº: {{$order->reference}}</h5>
                        <h5 class="font-alt mb-2 text-center">Código de Autorización: {{$order->authorization_code}}</h5>
                    </div>
                </div>
                <form method="post" action="commands">
                    @csrf
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <div class="row mt-30">
                        <div class="col-12 align-center"><button class="btn btn-success btn-lg rounded-pill" name="cmd" value="order">{{__('Descargar Albarán')}}</button></div>
                    </div>
                    @if( $order->invoice )
                    <div class="row mt-30">
                        <div class="col-12 align-center"><button class="btn btn-success btn-lg rounded-pill" name="cmd" value="invoice">{{__('Descargar Factura')}}</button></div>
                    </div>
                    @endif
                </form>
            </div>
        </section>
        <hr class="divider-d">
        @include('layouts.last-section')
    </div>
</x-web>