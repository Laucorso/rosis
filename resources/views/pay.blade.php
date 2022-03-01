<x-web solid>
    <div class="main">
        <section class="module-small mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h1 class="module-title font-alt mb-2" style="color:#8c2c13">{{__('Pago')}}</h1>
                    </div>
                </div>
                <hr class="divider-w pt-3">
                <div class="row mb-2">
                    <div class="col-md-12 mb-2 mb-md-0">
                        <button data-toggle="modal" data-target="#shopModal" class="btn btn-outline-dark w-100" onclick="modalClick()">{{__('¿NECESITAS SEGUIR COMPRANDO?')}}</button>
                    </div>
                </div>
                @if(0)
                @guest
                <div class="row mb-5">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <button class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#loginModal">{{__('¿YA ERES CLIENTE DE ROSISTIREM?')}}</a>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-outline-dark w-100">{{__('¿TIENES UNA CUENTA DE AMAZON?')}}</a>
                    </div>
                </div>
                @endguest
                @endif
                <form id="formId" class="needs-validation" action="{{localized_route('pay')}}" method="post" novalidate>
                    @csrf
                    <input type="hidden" id="amount" name="amount" value="{{$data['total']}}">
                    <input type="hidden" id="delivery_date" name="delivery_date" value="{{session('delivery_date')}}">
                    <input type="hidden" id="reference" name="reference">
                    <div class="row">
                        <div class="col-md-6">
                            @guest
                            <div class="row">
                                <div class="col-sm-12">
                                    <b class="font-alt" style="color:#8c2c13">{{__('¿Quién lo compra?')}}</b>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <hr class="divider-w"/>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input class="form-control" type="text" name="sender_email" value="{{ session('sender_email') }}" placeholder="{{__('Correo electrónico')}}" required autofocus/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="sender_name" value="{{ session('sender_name') }}" placeholder="{{__('Nombre')}}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="sender_phone" value="{{ session('sender_phone') }}" placeholder="{{__('Teléfono')}}">
                                </div>
                                <div class="form-group col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="newsletter" name="newsletter" {{session('newsletter','checked')}}>
                                        <label class="custom-control-label" for="newsletter">{{('Suscríbete a nuestra newsletter')}}</label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="password">{{__('Crear una contraseña para la cuenta')}}</label>
                                    <input type="password" class="form-control" id="password" name="sender_password" placeholder="{{__('Contraseña')}}">
                                </div>
                                <div class="form-group col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="invoice" name="invoice" onchange="invoicefn(event)" {{session('sender_invoice') ? 'checked' :''}}>
                                        <label class="custom-control-label" for="invoice">{{('Deseo factura de la compra')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row invoice-form" style="display:none;">
                                <div class="form-group col-sm-12">
                                    <input class="invoice form-control" type="text" name="invoice_name" value="{{session('invoice_name')}}" placeholder="{{__('Nombre y Apellidos / Razón Social')}}" required disabled>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input class="invoice form-control" type="text" name="invoice_nif" value="{{session('invoice_nif')}}" placeholder="{{__('NIF')}}" required disabled>
                                </div>
                                <div class="form-group col-12">
                                    <input class="invoice form-control" type="text" name="invoice_address" value="{{session('invoice_address')}}" placeholder="{{_('Dirección')}}" required disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="invoice form-control" type="text" name="invoice_city" value="{{session('invoice_city')}}" placeholder="{{__('Población')}}" required disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="invoice form-control" type="text" name="invoice_zip" value="{{session('invoice_zip')}}" placeholder="{{__('Código Postal')}}" required disabled>
                                </div>
                            </div>
                            @endguest
                            <div class="row">
                                <div class="col-12">                                
                                    <b class="font-alt" style="color:#8c2c13">{{__('¿A quién se lo enviámos?')}}</b>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <hr class="divider-w"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="name" value="{{session('name')}}" placeholder="{{__('Nombre')}}" required/>
                                </div>        
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="phone" value="{{session('phone')}}" placeholder="{{__('Teléfono')}}" required/>
                                </div>        
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="address" value="{{session('address')}}" placeholder="{{__('Dirección')}}" required/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="city" value="{{session('city')}}" placeholder="{{__('Población')}}" required>
                                </div>        
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="zip" value="{{session('zip')}}" placeholder="{{__('Código Postal')}}" onchange="zipChange(event)" required>
                                </div>        
                                <div class="form-group col-sm-12">
                                    <textarea class="form-control" name="info" placeholder="{{__('Información Adicional (opcional)')}}">{{session('info')}}</textarea>
                                </div>
                                <div class="col-12">                                
                                    <b class="font-alt" style="color:#8c2c13">{{__('¿Cuándo lo entregamos?')}}</b>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <hr class="divider-w"/>
                                </div>
                                <div class="form-group col-sm-7 pr-0">                                    
                                    <label for="delivery">{{__('Selecciona dia y franja horaria de entrega')}}</label>
                                    <select class="form-control custom-select" name="delivery_type" id="delivery" onchange="deliveryChange(event,1)">
                                        <option value="0" selected>{{__('Próximo día gratuíto')}}</option>
                                        @if(today()->format('d') != 14 )
                                        <option value="1">{{__('Hoy')}} {{Str::title(\Date::parse('now')->format('l j F Y'))}} - {{number_format(config('rosistirem.shipping.price'),2)}} €</option>
                                        @else
                                        <option id="entrega_hoy" value="1" style="display:none">{{__('Hoy')}} {{Str::title(\Date::parse('now')->format('l j F Y'))}} - +0.00 €</option>
                                        @endif
                                        <option value="2">{{\App\Helpers\AppHelper::nextBusinessDay(false)}}</option>
                                        <option value="3">{{__('Otro dia')}}</option>
                                    </select>
                                    <div id="datepicker" style="display:none;"></div>
                                </div>
                                <div class="form-group col-sm-5 pl-0">                                    
                                    <label class="text-white" for="delivery">-</label>
                                    <select class="form-control custom-select" name="delivery_time" id="deliveryTime" onchange="deliveryChange(event,2)">
                                        <option value="0" selected>08:30-21:30 - +0.00 €</option>
                                        <option value="15.90">08:30-14:30 +15.90 €</option>
                                        <option value="8.90">15:00-21:30 +8.90 €</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="protected" class="row">
                                <div class="col-sm-12">
                                    <b class="font-alt" style="color:#8c2c13">{{__('Tu pedido')}}</b>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <hr class="divider-w"/>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-borderless table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{__('PRODUCTO')}}</th>
                                                <th class="text-right">{{__('SUBTOTAL')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products">
                                            @foreach ($data['items'] as $item)
                                            @php 
                                                if( $item['id'] == '192')
                                                    $rollo = true;
                                            @endphp
                                            <tr data-id="{{$item['id']}}" data-qty="{{$item['qty']}}" data-price="{{$item['price']}}">
                                                <td><i role="button" class="xf xf-delete" onclick="deleteItem(event)"></i><span <?php if(isset($rollo)) echo "role=\"button\" onclick=\"$('#rollo').modal('show');\""?>> {{strtoupper($item['name'])}} x {{$item['qty']}}</span></td>
                                                <td class="text-right price"><span>{{number_format($item['price']*$item['qty'],2)}}</span> €</td>
                                            </tr>                                                
                                            @endforeach
                                            @isset($rollo)
                                            @else
                                            <tr data-id="0" data-qty="1" data-price="{{config('rosistirem.dedication.price')}}">
                                                <td><i role="button" class="xf xf-delete" onclick="deleteItem(event)"></i> {{config('rosistirem.dedication.name_'.locale())}}</td>
                                                <td class="text-right price"><span id="d_price">4.90</span> €</td>
                                            </tr>
                                            @endisset                                                
                                        </tbody>
                                    </table>
                                    @isset($rollo)
                                        <input type="hidden" name="dedication">
                                    @else
                                    <div id="d_div" class="w-100" style="margin-left: 20px; margin-top:-20px;">
                                        <textarea id="d_text" name="dedication" style="width: 90%;line-height: 16px;" rows="1" placeholder="{{__('Escribe algo que emocione!')}}" oninput="dedicationChange(event)">{{session('dedication')}}</textarea>
                                    </div>
                                    @endisset
                                    <div class="row mt-2">
                                        <div class="form-group col-6 pr-0">
                                            <input id="coupon" class="form-control" type="text" name="coupon" value="" placeholder="{{__('Código de cupón')}}" oninput="inputCoupon()">
                                        </div>        
                                        <div class="form-group col-6 pl-0">
                                            <button id="coupon_button" class="btn btn-outline-dark w-100" style="height: 33px;" onclick="applyCoupon(event)" disabled>APLICAR CUPÓN</button>
                                        </div>
                                    </div>
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td class="bg-light">{{__('Subtotal')}}</td>
                                                <td id="subtotal" class="text-right price"><span>{{number_format($data['total'],2)}}</span> €</td>
                                            </tr>
                                            <tr id="discount">
                                                <td></td>
                                                <td class="bg-light dto">{{__('Descuento')}} <span></span>%</td>
                                                <td class="text-right price">-<span>{{number_format(0,2)}}</span> €</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="bg-light">{{__('Envío')}}</td>
                                                <td id="shipping" class="text-right price"><span>{{number_format(0,2)}}</span> €</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="bg-light"><b>{{__('Total')}}</b></td>
                                                <td id="total" class="text-right price"><b><span>{{number_format($data['total'],2)}}</span> €</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12">                                
                                    <b class="font-alt" style="color:#8c2c13">{{__('Forma de pago')}}</b>
                                </div>
                                <div class="col-sm-12 mb-2">
                                    <hr class="divider-w"/>
                                </div>

                                <div class="col-sm-12">
                                    <div class="payment p-2 bg-light rounded-lg">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="method_1" name="paying_method" value="card" class="custom-control-input" checked>
                                            <label class="custom-control-label w-100" for="method_1" style="height:32px;"><span>{{__('Tarjeta de crédito o débito')}}<img style="height:1.5rem;" class="float-right" src="{{asset('images/vimcax.png')}}"/></span></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="method_2" name="paying_method" value="paypal" class="custom-control-input">
                                            <label class="custom-control-label w-100" for="method_2" style="height:32px;"><span>{{__('PayPal')}}<img style="height:1.5rem;" class="float-right" src="{{asset('images/paypal.png')}}"/></span></label>
                                        </div>
                                        {{--
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="method_3" name="paying_method" value="bitpay" class="custom-control-input">
                                            <label class="custom-control-label w-100" for="method_3" style="height:32px;"><span>{{__('BitPay')}}<img style="height:1.5rem;" class="float-right" src="{{asset('images/bp-payment-mark.svg')}}"/></span></label>
                                        </div>
                                        --}}
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 mt-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="followup" name="notification" {{session('notification')?'checked':''}}>
                                        <label class="custom-control-label" for="followup">{{__('Sí, quiero recibir correos una vez mi pedido sea enviado.')}}</label>
                                    </div>
                                    <p>{{__('_pago1')}}<a href="{{localized_route('privacy')}}">{{__('política de privacidad')}}</a>.</p>
                                    <p>{{__('_pago2')}}</p>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                        <label class="custom-control-label" for="terms">{{__('He leído y estoy de acuerdo con los')}} <a href="{{localized_route('terms')}}">{{__('terminos y condiciones')}}</a> {{__('de la web.')}}</label>
                                    </div>
                                    <button id="do_payment" onclick="doPayment(event)" class="btn btn-b mt-3 w-100">{{__('Realizar pago')}}<br><span>{{number_format($data['total'],2)}}</span> €</button>
                                </div>
                            </div>
                            <div id="pay-content-form">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <hr class="divider-d">
        @include('layouts.last-section')
    </div>
    <div class="modal fade" id="shopModal" tabindex="-1" aria-labelledby="shopModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shopModalLabel">{{__('Selecciona una categoria...')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-6 work-item">
                            <a class="border rounded-lg" href="{{localized_route('bouquets')}}">
                                <div class="work-image"><img src="{{asset('images/cat-bouquets.jpg')}}" alt="bouquets"></div>
                                <div class="work-caption font-alt">
                                    <h3 class="work-title">{{__('Ramos')}}</h3>
                                    <div class="work-descr">{{__('Rosas / Multicolor')}}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 work-item">
                            <a class="border rounded-lg" href="{{localized_route('plants')}}">
                                <div class="work-image"><img src="{{asset('images/cat-plants.jpg')}}" alt="plants"></div>
                                <div class="work-caption font-alt">
                                    <h3 class="work-title">{{__('Plantas')}}</h3>
                                    <div class="work-descr">{{__('Interior / Exterior')}}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 work-item">
                            <a class="border rounded-lg" href="{{localized_route('bouquet-complements')}}">
                                <div class="work-image"><img src="{{asset('images/cat-bouquet-complements.jpg')}}" alt="bouquet complements"></div>
                                <div class="work-caption font-alt">
                                    <h3 class="work-title">{{__('Complementos para Ramos')}}</h3>
                                    <div class="work-descr">{{__('Jarrones')}}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 work-item">
                            <a class="border rounded-lg" href="{{localized_route('plant-complements')}}">
                                <div class="work-image"><img src="{{asset('images/cat-plant-complements.jpg')}}" alt="plant complements"></div>
                                <div class="work-caption font-alt">
                                    <h3 class="work-title">{{__('Complementos para Plantas')}}</h3>
                                    <div class="work-descr">{{__('Macetas')}}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($rollo)
    <div id="rollo" class="modal fade" data-backdrop="static" data-keyboard="false" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: url('{{asset('resources/frasquito-petalos-y-pergaminos.jpg')}}'); background-repeat: no-repeat, repeat;background-size: cover;">
                <div class="modal-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ff0000" class="mr-3" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                      </svg>                        
                        <h5 class="modal-title text-center w-100 font-weight-bold">
                          {{__('Necesitamos tus sentimientos')}}
                        </h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ff0000" class="ml-3" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                          </svg>
                </div>
                <div class="modal-body" style="background-color:#ffffff80;">
                    <p style="color:black;">{!!__('Este es un regalo único para la persona que quiera poner sus sentimientos en palabras. Un potecito de cristal que contiene pétalos de rosa roja donde se esconden <b>diez razones</b> en formato de pergamino, <b>las cuales exponen todo lo que siente</b> hacia la otra.')!!}</p>
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_1" placeholder="{{__('Razón 1')}}" autofocus>
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_2" placeholder="{{__('Razón 2')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_3" placeholder="{{__('Razón 3')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_4" placeholder="{{__('Razón 4')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_5" placeholder="{{__('Razón 5')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_6" placeholder="{{__('Razón 6')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_7" placeholder="{{__('Razón 7')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_8" placeholder="{{__('Razón 8')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_9" placeholder="{{__('Razón 9')}}">
                    <input type="text" class="form-control form-control-sm mt-1" style="background-color:#ffffff80" name="reason_10" placeholder="{{__('Razón 10')}}">
                    <div class="row mt-4">
                        <div class="col-6">
                            <button type="button" class="w-100 btn btn-secondary" data-dismiss="modal">{{__('No quiero')}}</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="w-100 btn btn-primary" onclick="reasons(event)">{{__('Ya están')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    $('#rollo').on('shown.bs.modal', function (event) {
        $('#rollo input[autofocus]').focus();
    })
    $( document ).ready(function() {
        $('#rollo').modal('show');
    });
    function reasons( e ) {
        e.preventDefault();
        e.stopPropagation();
        let d = '';
        for( let n = 1; n < 11; n++ ) {
            let r = $('#rollo input[name=reason_'+n+']').val();
            if( n == 10 )
                d+=r;
            else
                d+=(r+'|');
        }
        $('input[name=dedication]').val(d);
        $('#rollo').modal('hide');
    }
    </script>
    @endpush
    @endisset
    <x-login-modal/>
@push('styles')
    <link href="{{asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    @if( locale() != 'en' )
        <script src="{{asset('js/bootstrap-datepicker.'.locale().'.min.js')}}"></script>
    @endif
    <script>
        var shipping_value = {{session('shipping')??0}};
        var discount = 0;
        var coupon = {};
        function deleteItem(e) {
            let id = $(e.target).closest('tr').data('id');
            $(e.target).closest('tr').remove();
            $.post('commands',{_token:"{{csrf_token()}}",cmd:"deleteCartItem",cartId:id});
            if( id == 0 )
                $('#d_div').hide();
            calc();
        }
        function calc() {
            if( discount ) {
                $('#discount').show();
            } else {
                $('#discount').hide();
            }
            var sum = 0;
            $('#products tr').each(function() {
                sum += $(this).data('qty')*$(this).data('price');
            });
            $("#subtotal span").text(sum.toFixed(2));
            if( discount ) {
                var discount_value = (sum*discount)/100;
                sum = sum-discount_value;
                $("#discount .dto span").text(discount.toFixed(0));
                $("#discount .price span").text(discount_value.toFixed(2));
            }
            $('#shipping span').text(shipping_value.toFixed(2));
            sum += shipping_value;
            $("#total span").text(sum.toFixed(2));
            $("#do_payment span").text(sum.toFixed(2));
            $("#amount").val(sum);

        }
        function invoicefn( e ) {
            if( e.target.checked ) {
                $(".invoice").removeAttr('disabled');
                $(".invoice-form").show();
                $("input[name=invoice_name]").focus();
            } else {
                $(".invoice").attr('disabled',true);
                $(".invoice-form").hide();
            }
        }
        function deliveryChange( e, n ) {
            let o = document.getElementById('delivery').value;
            if( o == '3' ) {
                datepicker.show();
            } else {
                datepicker.hide();
            }
            let v = 0;
            if( o == '1' ) {
                v = {{config('rosistirem.shipping.price')}};
            }
            v += +(document.getElementById('deliveryTime').value);
            shipping_value = v;
            calc();
        }
        function dedicationChange( e ) {
            let v = 0;
            if( e.target.value != "" ) {
                v = {{config('rosistirem.dedication.price')}};
            }
            $("#d_price").text(v.toFixed(2));
            calc();
        }
        function doPayment( e ) {
            e.preventDefault();
            e.stopPropagation();
            $('#formId').addClass('was-validated');
            if( document.getElementById('formId').checkValidity() === true ) {
                if( $('select[name="delivery_type"]').val() == 0 ) {
                    $('input[name="delivery_date"]').val((getNextFreeDeliveryDay().valueOf()/1000).toFixed(0));    
                }
                let data = $('#formId').serializeArray();
                data.push({"name" : "cmd", "value" : "payment"});
                let items = '[';
                $("#products tr").each( function (){
                    if( $(this).data('qty') )
                        items += '{"qty":'+$(this).data('qty')+',"id":'+$(this).data('id')+',"price":'+$(this).data('price')+'},';
                });
                items = items.replace(/.$/,"]");
                data.push({"name":"items", "value":items});
                data.push({"name":"shipping", "value":shipping_value});
                $('#pay-content-form').load( $('#formId').attr('action'),data,function( response, status, xhr ) {
                    $('#protected').hide();
                });
            }
        }
        $("#formId").submit( function (event) {
            event.preventDefault();
            event.stopPropagation();
            this.classList.add('was-validated');
        });
        const datepicker = $('#datepicker ').datepicker({
            startDate: "0d",
            endDate: "+2m",
            autoclose: true,
            maxViewMode: 0,
            language: "{{locale()}}",
            //daysOfWeekHighlighted: "0,1,6",
            beforeShowDay: function(d) {
                if( isHoliday(d) )
                    return "highlighted";
            }
        }).on("changeDate", function(e){
            $('input[name="delivery_date"]').val(e.date.valueOf()/1000);
            let v = 0;
            if( isHoliday(e.date) ) {
                v = {{config('rosistirem.shipping.price')}};
            }
            let o = document.getElementById('deliveryTime').value;
            if( o != '0' )
                v += {{config('rosistirem.shipping.range_price')}};

            shipping_value = v;

            calc();
        });
        function isHoliday( d, monday = false ) {
            var holidays = ['1-1','1-6','4-10','5-1','8-15','10-12','12-6','12-8','12-25'];
            var date = (d.getMonth()+1)+'-'+d.getDate();
            let zip = Number($('input[name=zip_code]').val());
            let zips = {{json_encode(config('rosistirem.order.zips'))}};
            monday = true;
            zips.forEach(function(z){
                if( zip >= z[0] && zip <= z[1] )
                    monday = true;
            });
            return (holidays.indexOf(date) > -1 || d.getDay() == 0 || d.getDay() == 6 || (monday && d.getDay() == 1));
        }
        function getNextFreeDeliveryDay() {
            var currentDate = new Date();
            currentDate.setDate(currentDate.getDate()+1);
            while( isHoliday(currentDate) ) {
                currentDate.setDate(currentDate.getDate()+1);
            }
            return currentDate;
        }
        function modalClick() {
            let data = $('#formId').serializeArray();
            data.push({"name":"cmd","value":"storeSessionData"});
            $.post('commands',data);
        }
        function zipChange( e ) {
            if( e.target.value.length == 5 ) {
                $("select[name=delivery_type]").removeAttr('disabled');
            } else {
                $("select[name=delivery_type]").attr('disabled','disabled');
            }
            let zip = e.target.value;
            let zips = {{json_encode(config('rosistirem.order.zips'))}};
            $("#entrega_hoy").hide();
            zips.forEach(function(z){
                if( zip >= z[0] && zip <= z[1] ) {
                    $("#entrega_hoy").show();
                    return;
                }
            });
        }
        function applyCoupon(e) {
            e.preventDefault();
            var coupon_value = $("#coupon").val();
            if( coupon_value != '' ) {
                $(".spinner").show();
                $.post("{{localized_route('pay')}}",{ _token:"{{csrf_token()}}",cmd:"coupon",coupon:coupon_value}, function( data ) {
                    if( data.status == 'valid' ) {
                        coupon.type = data.type;
                        coupon.value = data.value;
                        coupon.reference = data.reference;
                        discount = data.value;
                        $('#reference').val(data.reference);
                        calc();
                    } 
                    $(".spinner").hide();
                });
            }
        }
        function inputCoupon() {
            if( $('#coupon').val().length < 5 )
                $('#coupon_button').attr('disabled',true);
            else
                $('#coupon_button').removeAttr('disabled');
        }
        calc();
    </script>
@endpush
</x-web>
