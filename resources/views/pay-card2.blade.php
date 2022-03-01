<x-web solid>
    <div class="main">
        <section class="module-small">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h1 class="module-title font-alt mb-2" style="color:#8c2c13">{{__('Pago')}}</h1>
                    </div>
                </div>
                <hr class="divider-w pt-3">
                <iframe id="iframeId" frameBorder="0" name="iframeId" style="width:100%;height:600px;"></iframe>
                <button id="payButton" class="sr-only">Pagar</button>
                <a class="btn btn-b mt-3 w-100" href="{{localized_route('cart')}}">{{__('Cancelar')}}</a>
                @push('scripts')
                <script src="{{asset('js/rxp-hpp.js')}}"></script>
                <script>
                    $(document).ready(function() {
                        RealexHpp.setHppUrl('<?php echo config('addon-payments.serviceUrl'); ?>');
                        // For develop purpose, set to true this parameter
                        //RealexHpp.setDebugErrors(true);
                        RealexHpp.embedded.init("payButton", "iframeId", "addonpayments", <?php echo $json; ?>);
                        $("#payButton").click();
                    });   
                </script>
                @endpush
            </div>
        </section>
        <hr class="divider-d">
        @include('layouts.last-section')
    </div>
</x-web>