<div id="paypal-button-container"></div>
<a class="btn btn-b mt-3 w-100" href="{{localized_route('pay')}}">{{__('Cancelar')}}</a>
<script id="paypal_script" src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR"></script>
<script>

waitForFnc();

function waitForFnc() {
    if (typeof paypal == "undefined") {
        window.setTimeout(waitForFnc, 50);
    } else {
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: {{$amount}}
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    var element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    //Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    }
}    
</script>