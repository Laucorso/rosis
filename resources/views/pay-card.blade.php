<iframe id="iframeId" frameBorder="0" name="iframeId" class="mt-2" style="width:100%;height:610px;"></iframe>
<button id="payButton" class="sr-only">Pagar</button>
<a class="btn btn-b mt-3 w-100" href="{{localized_route('pay')}}">{{__('Cancelar')}}</a>
<script src="{{asset('js/rxp-hpp.js')}}"></script>
<script>
    RealexHpp.setHppUrl('<?php echo config('addon-payments.serviceUrl'); ?>');
    // For develop purpose, set to true this parameter
    //RealexHpp.setDebugErrors(true);
    RealexHpp.embedded.init("payButton", "iframeId", "addonpayments", <?php echo $json; ?>);
    $("#payButton").click();
</script>